<?php require_once("../includes/functions.php"); ?>
<?php
session_start();

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
if (isset($_GET['details'])) {
    $teacheremIdfordetails = $_GET['details'];
}

$semestercode = semestercode();
?>
<?php require_once("../includes/db_connection.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="styleadmin.css"/>
</head>
<body>
<ul class="nav">
    <div class="logo">Admin Panal (<?php echo $semestercode ?>)</div>

    <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
    <li><a href="teacherlistforadmin.php"> BACK</li>

    <li><a href="logout.php">Logout</a></li>

</ul>

<!--detail section-->
<fieldset style="align:'center';">
    <legend>Teacher Details</legend>


    <?php

    //colection profile info

    $collectInfoquery = "SELECT title,firstname,lastname,initial,department,faculty,campus,mode,designation,emid,email,mobile FROM users WHERE emid={$teacheremIdfordetails};";
    $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
    while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
        $tctitle = $collectInforow['title'];
        $tcfirstname = $collectInforow['firstname'];
        $tclastname = $collectInforow['lastname'];
        $tcinitial = $collectInforow['initial'];
        $tcdepartment = $collectInforow['department'];
        $tcfaculty = $collectInforow['faculty'];
        $tccampus = $collectInforow['campus'];
        $tcmode = $collectInforow['mode'];
        $tcdesignation = $collectInforow['designation'];
        $tcemid = $collectInforow['emid'];
        $tcmobile = $collectInforow['mobile'];
        $tcemail = $collectInforow['email'];
    }

    echo "<div style='background: green;'><section><p>{$tctitle} {$tcfirstname} {$tclastname} ({$tcinitial}) <br />
 {$tcdesignation} Dept. of {$tcdepartment} , {$tcfaculty} <br>
  {$tcmode} , {$tccampus} <br>
  Employe ID : {$tcemid}<br>
  E-mail : {$tcemail}<br>
  Phone : {$tcmobile}</p></section></div> ";

    ?>
    <fieldset><legend><h3>Course Details</h3></legend>
    <?php

    $courseInfoquery = "select * from takencourses WHERE emid='{$tcemid}'";
    $courseInforesult = mysqli_query($connection, $courseInfoquery);
    while ($courseInforow = mysqli_fetch_assoc($courseInforesult)) {
        $depttaken = $courseInforow['dept'];
        $leveltermtaken = $courseInforow['levelterm'];
        $courseCodetaken = $courseInforow['coursecode'];
        $coursetitletaken = $courseInforow['coursetitle'];
        $sectiontaken = $courseInforow['section'];
        $credithourtaken = $courseInforow['credithour'];
        $crnametaken = $courseInforow['crname'];
        $cridtaken = $courseInforow['crid'];
        $cremailtaken = $courseInforow['cremail'];
        $crnumtaken = $courseInforow['crnum'];
        $totalstudenttaken = $courseInforow['totalstudent'];
        $regstudenttaken = $courseInforow['regstudent'];
        $semestercodetaken = $courseInforow['semestercode'];

        echo "
<fieldset>
<legend><b> {$courseCodetaken} : {$coursetitletaken}  ({$credithourtaken} Credits) {$semestercodetaken}</b></legend>
<b><u>LEVEL&TERM</u> :</b> {$leveltermtaken} &emsp;&emsp;
<b><u>SECTION</u> : </b>   {$sectiontaken} &emsp;&emsp;
<b><u>Total Student</u> : </b> {$totalstudenttaken}  &emsp;&emsp;
<b><u>Registered Student</u> : </b> {$regstudenttaken} &emsp;&emsp; <br><br>
<b><u>CR name</u> : </b> {$crnametaken} &emsp;&emsp;
<b><u>CR ID</u> : </b> {$cridtaken} &emsp;&emsp;<br>
<b><u>CR e-mail</u> : </b> {$cremailtaken} &emsp;&emsp;
<b><u>CR phone</u> : </b> {$crnumtaken} &emsp;&emsp;
</fieldset><br>";

    }


    ?>
    </fieldset>

</fieldset>
<input type="button" value="PRINT">
</body>
</html>
