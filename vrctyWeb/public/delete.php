<?php require_once("../includes/functions.php");?>
<?php
session_start();

if(!logedin()){

    header("Location: index.php?valid=notlogedin");
    exit();
}
if(isset($_SESSION['address'])){
    if($_SESSION['address']!="superadmin.php"){
        redirect_to($_SESSION['id']);
}
}


?>
<?php require_once("../includes/db_connection.php");?>

<?php

if (isset($_GET['del'])) {
    $delate_emid = $_GET['del'];
    $query = "delete FROM users WHERE emid='{$delate_emid}' limit 1";

    if (mysqli_query($connection, $query)) {
        // echo    "<script>window.open('Userstable.php?deleted = User has been deleted!!!','_self')</script>";
        redirect_to($_SESSION['id'] . " && deletionStatus=success");
    }
}else{
    redirect_to($_SESSION['id']);
}
 ?>
