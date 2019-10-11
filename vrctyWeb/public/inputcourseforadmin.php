<?php require_once("../includes/functions.php"); ?>
<?php
session_start();
$msg = "";
if (!logedin()) {

    header("Location: index.php?valid=notlogedin");
    exit();
}
if (isset($_SESSION['address'])) {
    if ($_SESSION['address'] != "admin.php") {
        redirect_to($_SESSION['id']);
    }
}

if (isset($_GET['status'])) {
    if ($_GET['status'] == "succed") {
        $msg = "input success";
    } elseif ($_GET['status'] == "faild") {
        $msg = "input faild";
    }

}

?>

<?php
$semestercode= semestercode();

if (isset($_GET['input'])) {
    $teacherID = $_GET['input'];
} else {
    redirect_to("index.php");
}

?>

<?php require_once("../includes/db_connection.php"); ?>


<?php

$batchcode = $levelterm = $coursecode = $coursetitle = $section = $credit = "";
$errbatchcode = $errlevelterm = $errcoursecode = $errcoursetitle = $errsection = $errcredit = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['batchcode'])) {
        $batchcode = validate($_POST['batchcode']);
    } else {
        $errbatchcode = "<span style='color:red'>can not be empty</span>";
    }

    if (!empty($_POST['levelterm'])) {
        $levelterm = validate($_POST['levelterm']);
    } else {
        $errlevelterm = "<span style='color:red'>can not be empty</span>";
    }

    if (!empty($_POST['coursecode'])) {
        $coursecode = validate($_POST['coursecode']);
    } else {
        $errcoursecode = "<span style='color:red'>can not be empty</span>";
    }

    if (!empty($_POST['coursetitle'])) {
        $coursetitle = validate($_POST['coursetitle']);
    } else {
        $errcoursetitle = "<span style='color:red'>can not be empty</span>";
    }

    if (!empty($_POST['section'])) {
        $section = validate($_POST['section']);
    } else {
        $errsection = "<span style='color:red'>can not be empty</span>";
    }

    if (!empty($_POST['credit'])) {
        $credit = validate($_POST['credit']);
    } else {
        $errcredit = "<span style='color:red'>can not be empty</span>";
    }

}


?>



<?php

if (!empty($teacherID) && !empty($batchcode) && !empty($levelterm) && !empty($coursecode) &&
    !empty($coursetitle) && !empty($section) && !empty($credit)
) {


    $query = "insert into courses (emid,dept,levelterm,coursecode,coursetitle,section,credithour,semestercode,status) ";
    $query .= "VALUES ('{$teacherID}','{$batchcode}','{$levelterm}','{$coursecode}','{$coursetitle}','{$section}','{$credit}','{$semestercode}','not')";
    $result = mysqli_query($connection, $query);
    if ($result) {
        redirect_to("inputcourseforadmin.php?input={$teacherID}&status=succed");
    } else {
        redirect_to("inputcourseforadmin.php?input={$teacherID}&status=faild");
    }

}


?>


<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- Designed by: Md. Golam Maulla -->
<head>
    <title></title>
    <link rel="stylesheet" href="styleadmin.css"/>

</head>
<body>

<ul class="nav">
    <div class="logo">Admin Panal (<?php echo $semestercode?>) </div>

    <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
    <li><a href="teacherlistforadmin.php">Give Course Offer</li>
    <li><a href="logout.php">Logout</a></li>

</ul>


<section class="admin_offer_course hidden">
    <div class="admin_offer_content">
        <div class="offer_course">
            <h3><?php
                echo $msg;
                ?></h3>
            <!--                <td>-->
            <!--                    <input type="button" name="back" value="back"/>-->
            <!--                <td>-->
            <fieldset class="shadhin">
                <legend>Course 1</legend>
                <form action="" method="post">
                    <table class="offer_course_details">
                        <tr>
                            <td>
                                <input type="text" name="batchcode"
                                       placeholder="Department"/><?php echo $errbatchcode ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" name="levelterm"
                                       placeholder="Level & Term"/><?php echo $errlevelterm ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" name="coursecode"
                                       placeholder="Course code"/><?php echo $errcoursecode ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" name="coursetitle"
                                       placeholder="Course Title"/><?php echo $errcoursetitle ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" name="section" placeholder="Section"/><?php echo $errsection ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" name="credit"
                                       placeholder="Credite hours"/><?php echo $errcredit ?>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" value="Submit"/>
                            <td>

                            </td>
                            </td>
                            <td>

                            <td>
                                <a href="inputcourseforadmin.php?input=<?php echo $teacherID ?>"><input type="button" name="cancel" value="cancel"/></a>
                            </td>
                            </td>

                            <td>

                            <td>
                                <a href="teacherlistforadmin.php"><input type="button" name="cancel" value="back"/></a>
                            </td>
                            </td>

                        </tr>
                    </table>
                </form>
            </fieldset>

        </div>
    </div>
</section>


</body>
</html>





