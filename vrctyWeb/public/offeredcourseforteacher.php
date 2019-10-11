<?php require_once("../includes/functions.php"); ?>
<?php
session_start();
$msgwithcourse=$status=$cc="";
if (!logedin()) {

    header("Location: index.php?valid=notlogedin");
    exit();
}
if (isset($_SESSION['address'])) {
    if ($_SESSION['address'] != "teacher.php") {
        redirect_to($_SESSION['id']);
    }
}
if (isset($_GET['id'])) {
    $teacherselfid = $_GET['id'];

}

if(isset($_GET['status']) && isset($_GET['cc'])){
    $status=$_GET['status'];
    $cc=$_GET['cc'];
    if($status=="success"){
        $msgwithcourse="<p style='color: green'>{$cc}  submit success</p>";
    }else{
        $msgwithcourse="<p style='color: red'> submit success</p>";
    }
}


$semestercode= semestercode();

$teacheremid="";
?>





<?php require_once("../includes/db_connection.php"); ?>
<?php
$getteacheremidquery = "select emid from users where id={$teacherselfid};";
$getteacheremid = mysqli_query($connection, $getteacheremidquery);
while ($inforow = mysqli_fetch_assoc($getteacheremid)) {
    $teacheremid = $inforow['emid'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="styleadmin.css"/>
</head>
<body>
<ul class="nav">
    <div class="logo">Teacher Panal (<?php echo $semestercode?>)</div>

    <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
    <li><a href="offeredcourseforteacher.php?id=<?php echo $_GET['id'] ?>">Offered course</li>
    <li><a href="viewandupdatecoursedetailforteacher.php?emid=<?php echo $teacheremid?>&id=<?php echo $teacherselfid ?>">Course Details</li>
    <li><a href="logout.php">Logout</a></li>

</ul>

<h3 ><?php echo $msgwithcourse?></h3>
<div id="">
    <div class="">
        <form action="action_for_t_o_course.php?emid=<?php echo $teacheremid?>&id=<?php echo $teacherselfid?>" method="post">
        <fieldset>
            <legend>select course and input information</legend>
            <table align='center' width='1000' border="">
                <tr>
                    <th> Course Code</th>
                    <th> Course Title</th>
                    <th> Level & Term</th>
                    <th> Depertment</th>
                    <th> Section</th>
                    <th> credit</th>
                </tr>
                <?php

//                $getteacheremidquery = "select emid from users where id={$teacherselfid};";
//                $getteacheremid = mysqli_query($connection, $getteacheremidquery);
//                while ($inforow = mysqli_fetch_assoc($getteacheremid)) {
//                    $teacheremid = $inforow['emid'];
//                }
                $courseinfoQuery = "SELECT dept,levelterm,coursecode,coursetitle,section,credithour FROM courses WHERE emid={$teacheremid} AND status='not'";
                $courseinfoQueryresult = mysqli_query($connection, $courseinfoQuery);
                while ($courserow = mysqli_fetch_assoc($courseinfoQueryresult)) {
                    $batchcode = $courserow['dept'];
                    $levelterm = $courserow['levelterm'];
                    $coursecode = $courserow['coursecode'];
                    $coursetitle = $courserow['coursetitle'];
                    $section = $courserow['section'];
                    $credithour = $courserow['credithour'];

                    echo "

          <tr>
              <td><input type='radio' name='courseCode' value='{$coursecode}'>{$coursecode}</td>
              <td> {$coursetitle} </td>
               <td> {$levelterm} </td>
               <td> {$batchcode} </td>
               <td>{$section}</td>
              <td>{$credithour}</td>
             
          </tr> ";

                }

                ?>
            </table>

            <fieldset>
                <legend>Class Representative information:</legend>
                <table class="cr_details">
                    <tr>
                        <td>
                            <input type="text" name="crname" placeholder="CR Name"/>
                        </td>
                        <td>
                            <input type="text" name="crid" placeholder="CR ID"/>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <input type="email" name="cremail" placeholder="CR Email"/>
                        </td>
                        <td>
                            <input type="text" name="crnum" placeholder="CR Contact Number"/>
                        </td>
                    </tr>

                </table>
            </fieldset>

            <fieldset>
                <legend>registration information</legend>
                <table>
                    <tr>
                        <td>
                            <input type="text" name="totalstudent" placeholder="Total student"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="registerdstudent" placeholder="Registered student"/>
                        </td>
                    </tr>
                </table>


            </fieldset>
            <table>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Submit Information"/>
                    </td>
                </tr>

            </table>

        </fieldset>
        </form>


    </div>
</div>


</body>
</html>
