<?php require_once("../../includes/functions.php"); ?>
<?php
session_start();

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
    $userteacher = $_GET['id'];
} else {
    redirect_to("index.php");
}
$semestercode = semestercode();
?>
<?php require_once("../../includes/db_connection.php"); ?>
<?php
$getteacheremid1query2 = "select emid from users where id={$userteacher};";
$getteacheremid2 = mysqli_query($connection, $getteacheremid1query2);
while ($inforow2 = mysqli_fetch_assoc($getteacheremid2)) {
   echo $teacheremid2 = $inforow2['emid'];
}

$offday="";
if (!empty($_POST['day'])){
    foreach ($_POST['day'] as $day){
        $offday.=$day;
        $offday.=",";
    }

    echo $offday;
    $upquery="update photo set offday='{$offday}' WHERE emid='{$teacheremid2}';";
    $upreasult=mysqli_query($connection,$upquery);
    header("Location: ../index.php");


}




?>