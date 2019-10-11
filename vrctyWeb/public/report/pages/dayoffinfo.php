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
    <link rel="stylesheet" href="../../styleadmin.css"/>
</head>
<body style="background-color: #5e5e5e">
<section >
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



<div style="background-color: #d4ffda;float: left;width: 20%;height: 100%;border: solid;border-color: #1b6d85;position: fixed">

    <section >
        <ul >
            <a href="offeredcourse.php"><li style="margin: 5%">Offered course</li></a>
            <a href="teacherinformation.php"><li style="margin: 5%">Teacher Information</li></a>
            <a href="teacherandcourseinfo.php"><li style="margin: 5%">Teacher and course Information</li></a>
            <a href="courseoutline.php"><li style="margin: 5%">Course Outline</li></a>
            <a href="crinfo.php"><li style="margin: 5%">CR Information</li></a>
            <a href="classsizeinfo.php"><li style="margin: 5%">Class Size Information</li></a>
            <a href="dayoffinfo.php"><li style="margin: 5%">Day off information</li></a>

        </ul>

    </section>

</div>








<section style="background-color: #b4c7ff;float: right;width: 79%;height: 100%;border: solid;border-color: #1b6d85;position:inherit ">



</section>


</body>
</html>
