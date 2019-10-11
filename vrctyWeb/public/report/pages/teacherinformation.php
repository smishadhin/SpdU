<?php require_once("../../../includes/functions.php"); ?>
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

?>

<?php
$semestercode = semestercode();
$selectedsection = $errselectedsection = "";
?>
<?php require_once("../../../includes/db_connection.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="css/stylect.css" rel="stylesheet" media="screen" type="text/css"/>
    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet" media="screen" type="text/css"/>
    <link rel="stylesheet" href="../../styleadmin.css"/>
</head>
<body style="background-color: #5e5e5e">
<section>
    <ul class="nav">
        <div class="logo">Admin Panal (<?php echo $semestercode ?>)</div>
        <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
        <!--    <li><a href="teacherlistforadmin.php"> Give Course Offer</li>-->
        <li><a href="../../makecourseoffer.php">Declare course offer</a></li>
        <li><a href="../../inputallcourses.php">Manage Data</a></li>
        <li><a href="../../generatereport.php">Generate Report</a></li>
        <li><a href="../../logout.php">Logout</a></li>
    </ul>
</section>


<div
    style="background-color: #d4ffda;float: left;width: 20%;height: 100%;border: solid;border-color: #1b6d85;position: fixed">

    <section>
        <ul>
            <a href="offeredcourse.php">
                <li style="margin: 5%">Offered course</li>
            </a>
            <a href="teacherinformation.php">
                <li style="margin: 5%">Teacher Information</li>
            </a>
            <a href="teacherandcourseinfo.php">
                <li style="margin: 5%">Teacher and course Information</li>
            </a>
            <a href="courseoutline.php">
                <li style="margin: 5%">Course Outline</li>
            </a>
            <a href="crinfo.php">
                <li style="margin: 5%">CR Information</li>
            </a>
            <a href="classsizeinfo.php">
                <li style="margin: 5%">Class Size Information</li>
            </a>
            <a href="dayoffinfo.php">
                <li style="margin: 5%">Day off information</li>
            </a>

        </ul>

    </section>

</div>


<section
    style="background-color: #b4c7ff;float: right;width: 79%;height: 100%;border: solid;border-color: #1b6d85;position:inherit ">


    <div align="center">
        <h1>Report: Teacher Information</h1>
        <form action="" method="post">

            <select name="dept" style="margin:5%;padding: 1%">
                <option disabled selected>Select a Department</option>
                <option>CSE</option>
                <option>BBA</option>
                <option>English</option>
                <option>Hotel Management and turisum</option>
            </select>
            <input type="submit" name="submitdept" value="Filter">
        </form>
    </div>


    <div>
<form action="../actions/teacherinformationaction.php" method="post">
        <section class="course_details_info">

            <div class="course_contant_info">
                <input style="float: right;margin: 2%" type="submit" name="submit" value="GENERATE">
                <table class="course_table_info">
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <th>Initial</th>
                        <th>Designation</th>
                        <th>Mobile</th>
                        <th>Email</th>
                    </tr>


                    <?php
                    $deprtmnt="";
                    if (isset($_POST['submitdept'])) {
                        if (!empty($_POST['dept'])) {
                            echo "DEPT. of " . $deprtmnt = $_POST['dept'];
                        }
                    }



                    if (!empty($deprtmnt)) {
                        $collectInfoquery = "SELECT title,firstname,lastname,initial,designation,emid,email,mobile FROM users WHERE page='teacher.php' AND department='{$deprtmnt}';";
                        $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
                        while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
                            $tctitle = $collectInforow['title'];
                            $tcfirstname = $collectInforow['firstname'];
                            $tclastname = $collectInforow['lastname'];
                            $tcinitial = $collectInforow['initial'];
                            //$tcdepartment = $collectInforow['department'];
                            //$tcfaculty = $collectInforow['faculty'];
                            //$tccampus = $collectInforow['campus'];
                            //$tcmode = $collectInforow['mode'];
                            $tcdesignation = $collectInforow['designation'];
                            $tcemid = $collectInforow['emid'];
                            $tcmobile = $collectInforow['mobile'];
                            $tcemail = $collectInforow['email'];

                            echo "
                    <tr>
                    <td><input type='checkbox' name='teachers[]' value='{$tcemid}'>
                    {$tctitle} {$tcfirstname} {$tclastname}</td>
                    <td>{$tcinitial}</td>
                    <td>{$tcdesignation}</td>
                    <td>{$tcmobile}</td>
                    <td>{$tcemail}</td>                  
                    </tr>                  
                ";
                        }

                    } else {
                        $collectInfoquery = "SELECT title,firstname,lastname,initial,designation,emid,email,mobile FROM users WHERE page='teacher.php';";
                        $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
                        while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
                            $tctitle = $collectInforow['title'];
                            $tcfirstname = $collectInforow['firstname'];
                            $tclastname = $collectInforow['lastname'];
                            $tcinitial = $collectInforow['initial'];
                            //$tcdepartment = $collectInforow['department'];
                            //$tcfaculty = $collectInforow['faculty'];
                            //$tccampus = $collectInforow['campus'];
                            //$tcmode = $collectInforow['mode'];
                            $tcdesignation = $collectInforow['designation'];
                            $tcemid = $collectInforow['emid'];
                            $tcmobile = $collectInforow['mobile'];
                            $tcemail = $collectInforow['email'];

                            echo "
                    <tr>
                    <td><input type='checkbox' name='teachers[]' value='{$tcemid}'>
                    {$tctitle} {$tcfirstname} {$tclastname}</td>
                    <td>{$tcinitial}</td>
                    <td>{$tcdesignation}</td>
                    <td>{$tcmobile}</td>
                    <td>{$tcemail}</td>                  
                    </tr>                  
                ";
                        }

                    }
                    ?>


                    </tbody>
                </table>
            </div>
        </section>

</form>
    </div>


</section>


</body>
</html>
