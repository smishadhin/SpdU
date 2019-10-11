<?php require_once("../includes/functions.php"); ?>
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

if (isset($_GET['approved'])) {
    $approved_emid = $_GET['approved'];
    //$query = "update users set approved='yes' WHERE emid='{$approved_emid}' limit 1";
    $query1 = "select id from users WHERE emid='{$approved_emid}' limit 1";

    if (mysqli_query($connection, $query1)) {
        $mailqury = "select email from users WHERE emid='{$approved_emid}' limit 1";
        $mailquryresult=mysqli_query($connection,$mailqury);
        while ($row = mysqli_fetch_assoc($mailquryresult)){
            $mailadd=$row['email'];
        }


//        if (!mail($mailadd,"dcms","aapproved",'From: app.shadhin@gmail.com')){
//
//            redirect_to($_SESSION['id'] . " && approveStatus=unsuccessfullmail");
//        }else{
            $query = "update users set approved='yes' WHERE emid='{$approved_emid}' limit 1";
            if (mysqli_query($connection,$query)) {
                redirect_to($_SESSION['id'] . " && approveStatus=success");
            }else{
                redirect_to($_SESSION['id'] . " && approveStatus=unsuccessfull");
            }
       // }



    }
}else{
    redirect_to($_SESSION['id']);
}
?>