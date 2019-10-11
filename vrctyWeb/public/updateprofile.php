<?php require_once("../includes/functions.php"); ?>
<?php
session_start();

if (!logedin()) {

    header("Location: index.php?valid=notlogedin");
    exit();
}
/*if (isset($_SESSION['address'])) {
    if ($_SESSION['address'] != "admin.php") {
        redirect_to($_SESSION['id']);
    }
}*/

if (isset($_GET['id'])) {
    $useradmin = $_GET['id'];
} else {
    redirect_to("index.php");
}

$semestercode = semestercode();
?>
<?php require_once("../includes/db_connection.php"); ?>


<?php

echo $useradmin;

if (!empty($_POST['submit'])) {

    $collectInfoquery = "SELECT emid FROM users WHERE id={$useradmin};";
    $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
    while ($roe=mysqli_fetch_assoc($collectInfoqueryresult)){
      echo $id=$roe['emid'];
    }

    if (empty($_POST['nameTitle'])) {
        $errnameTitle = "<span style='color:red'>please select a title</span>";
    } else {
        echo $nameTitle = validate($_POST['nameTitle']);
        $titleupdatequery = "update users set title='{$nameTitle}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }

    if (empty($_POST['firstName']) /*|| preg_match("/[^A-Za-z0-9\-]/", $_POST['firstName'])*/) {
        $errfirstName = "<span style='color:red'>invalid name</span>";
    } else {
        echo $firstName = validate($_POST['firstName']);
        $titleupdatequery = "update users set firstname='{$firstName}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }
    if (empty($_POST['lastName'])/* || preg_match("/[^A-Za-z0-9\-]/", $_POST['lastName'])*/) {
        $errlastName = "<span style='color:red'>invalid name</span>";
    } else {
        echo $lastName = validate($_POST['lastName']);
        $titleupdatequery = "update users set lastname='{$lastName}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }

    if (empty($_POST['teacherInitial'])) {
        $errinitial = "<span style='color:red'>invalid initial</span>";
    } else {
        echo $initial = validate($_POST['teacherInitial']);
        $titleupdatequery = "update users set initial='{$initial}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }


    if (empty($_POST['dept'])) {
        $errdept = "<span style='color:red'>invalid dept</span>";
    } else {
        echo $dept = validate($_POST['dept']);
        $titleupdatequery = "update users set department='{$dept}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }

    if (empty($_POST['faculty'])) {
        $errfaculty = "<span style='color:red'>invalid faculty</span>";
    } else {
        echo $faculty = validate($_POST['faculty']);
        $titleupdatequery = "update users set faculty='{$faculty}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }

    if (empty($_POST['campus'])) {
        $errcampus = "<span style='color:red'>invalid campus</span>";
    } else {
        echo $campus = validate($_POST['campus']);
        $titleupdatequery = "update users set campus='{$campus}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }

    if (empty($_POST['modeOfTeacher'])) {
        $errmodeOfTeacher = "<span style='color:red'>invalid mode of teacher</span>";
    } else {
        echo $modeOfTeacher = validate($_POST['modeOfTeacher']);
        $titleupdatequery = "update users set mode='{$modeOfTeacher}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }

    if (empty($_POST['designation'])) {
        $errdesignation = "<span style='color:red'>invalid designation</span>";
    } else {
        echo $designation = validate($_POST['designation']);
        $titleupdatequery = "update users set designation='{$designation}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }


    if (empty($_POST['emid'])) {
        $erremid = "<span style='color:red'>invalid employe ID</span>";
    } else {
        echo $emid = validate($_POST['emid']);
        $titleupdatequery = "update users set emid='{$emid}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }


    if (empty($_POST['email'])) {
        $erremail = "<span style='color:red'>invalid email address</span>";
    } else {
        echo $email = validate($_POST['email']);
        $titleupdatequery = "update users set email='{$email}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }


    if (empty($_POST['mobile'])) {
        $errmobile = "<span style='color:red'>invalid mobile number</span>";
    } else {
        echo $mobile = validate($_POST['mobile']);
        $titleupdatequery = "update users set mobile='{$mobile}' WHERE id={$useradmin}";
        mysqli_query($connection, $titleupdatequery);
    }
    if (!empty($_FILES['pic']['tmp_name'])) {
        $image = true;
        //  echo "img";
        if ($image==true){
            $filetmp=$_FILES["pic"]["tmp_name"];
            $filename=$_FILES["pic"]["name"];
            $filetype=$_FILES["pic"]["type"];
            $filepath="photo/".$filename;
            move_uploaded_file($filetmp,$filepath);
            $sql="update photo set imgname='{$filename}',imgpath='{$filepath}',imgtype='{$filetype}' WHERE emid='{$id}'";
            mysqli_query($connection,$sql);
        }




    } else {
        $errimage = "<span style='color:red'>select a image</span>";
    }


//redirect_to($_SESSION['id']);
    header("Location: index.php");


}



?>
