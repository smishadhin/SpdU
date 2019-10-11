<?php require_once("../includes/functions.php"); ?>
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
    $userteacher1 = $_GET['id'];
} else {
    redirect_to("index.php");
}

if (isset($_GET['emid'])) {
    $teacheremid1 = $_GET['emid'];
} else {
    redirect_to("index.php");
}


$semestercode = semestercode();
?>

<?php
$usmsg = $updatecc = "";
if (isset($_GET['us'])) {
    $updatestatus = $_GET['us'];
    if (isset($_GET['cc'])) {
        $updatecc = $_GET['cc'];
    }

    if ($updatestatus == "success") {
        $usmsg = "<span style='color: green;'>update success</span>";
    } elseif ($updatestatus == "same") {
        $usmsg = "<span style='color: red;'>same info need not to update</span>";
    } elseif ($updatestatus == "empty") {
        $usmsg = "<span style='color: red;'>field can not be empty</span>";
    } else {
        $usmsg = "<span style='color: red;'>update faild</span>";
    }
}


?>


<?php require_once("../includes/db_connection.php"); ?>

<?php
//$getteacheremid1query1 = "select emid from users where id={$userteacher};";
//$getteacheremid1 = mysqli_query($connection, $getteacheremid1query1);
//while ($inforow1 = mysqli_fetch_assoc($getteacheremid1)) {
//    $teacheremid1 = $inforow1['emid'];
//}
//
//?>


    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <link rel="stylesheet" href="styleadmin.css"/>
    </head>
    <body>
    <ul class="nav">
        <div class="logo">Teacher Panal (<?php echo $semestercode ?>)</div>

        <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
        <li><a href="allofferedcourse.php?id=<?php echo $_GET['id'] ?>">Offered course</li>
        <li>
            <a href="viewandupdatecoursedetailforteacher.php?emid=<?php echo $teacheremid1 ?>&id=<?php echo $userteacher1 ?>">Course
                Details</li>
        <li><a href="logout.php">Logout</a></li>

    </ul>

    <!--detail section-->
    <!--<fieldset style="align:'center';">-->
    <!--    <legend>Teacher Details</legend>-->


    <!--    --><?php
    //
    //    //colection profile info
    //
    //    $collectInfoquery = "SELECT title,firstname,lastname,initial,department,faculty,campus,mode,designation,emid,email,mobile FROM users WHERE emid={$teacheremid1};";
    //    $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
    //    while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
    //        $tctitle = $collectInforow['title'];
    //        $tcfirstname = $collectInforow['firstname'];
    //        $tclastname = $collectInforow['lastname'];
    //        $tcinitial = $collectInforow['initial'];
    //        $tcdepartment = $collectInforow['department'];
    //        $tcfaculty = $collectInforow['faculty'];
    //        $tccampus = $collectInforow['campus'];
    //        $tcmode = $collectInforow['mode'];
    //        $tcdesignation = $collectInforow['designation'];
    //        $tcemid = $collectInforow['emid'];
    //        $tcmobile = $collectInforow['mobile'];
    //        $tcemail = $collectInforow['email'];
    //    }
    //
    //    echo "<p>{$tctitle} {$tcfirstname} {$tclastname} ({$tcinitial}) <br />
    // {$tcdesignation} Dept. of {$tcdepartment} , {$tcfaculty} <br>
    //  {$tcmode} , {$tccampus} <br>
    //  Employe ID : {$tcemid}<br>
    //  E-mail : {$tcemail}<br>
    //  Phone : {$tcmobile}</p> ";
    //
    //

    echo "<h3 style='color: green;'>$usmsg </h3>";

    ?>

    <div align="center">
    <fieldset style="border-color: #4cae4c;display: inline-block">
        <legend><h3>Course Details</h3></legend>

        <?php

        $courseInfoquery = "select * from coursetaken WHERE tcemid='{$teacheremid1}'";
        $courseInforesult = mysqli_query($connection, $courseInfoquery);
        while ($courseInforow = mysqli_fetch_assoc($courseInforesult)) {

            $offeredcourseid = $courseInforow['offeredcourseid'];
            $courserowid = $courseInforow['id'];

            $offeredcoursetabledetailquery = "select courseid,section,semester from offeredcourse WHERE id={$offeredcourseid} AND semester='{$semestercode}'";
            $offeredcoursetabledetailresult = mysqli_query($connection, $offeredcoursetabledetailquery);
            while ($offeredcoursetabledetailrow = mysqli_fetch_assoc($offeredcoursetabledetailresult)) {
                $ofcourseid = $offeredcoursetabledetailrow['courseid'];
                $ofcoursesection = $offeredcoursetabledetailrow['section'];
                $ofcoursesemester = $offeredcoursetabledetailrow['semester'];

                $crouseinfodetailsquery = "select * from allcourses WHERE id={$ofcourseid}";
                $crouseinfodetailsresult = mysqli_query($connection, $crouseinfodetailsquery);
                while ($crouseinfodetailsrow = mysqli_fetch_assoc($crouseinfodetailsresult)) {
                    $dept = $crouseinfodetailsrow['dept'];
                    $leverterm = $crouseinfodetailsrow['levelterm'];
                    $coursecode = $crouseinfodetailsrow['coursecode'];
                    $coursetitle = $crouseinfodetailsrow['coursetitle'];
                    $credit = $crouseinfodetailsrow['credit'];

                    $retrivecrinfoquery = "select * from coursedetails WHERE emid='{$teacheremid1}' AND coursetaken={$courserowid}";
                    $retrivecrinforesult = mysqli_query($connection, $retrivecrinfoquery);
                    while ($retrivecrinfoqueryrow = mysqli_fetch_assoc($retrivecrinforesult)) {
                        $totalstudenttaken = $retrivecrinfoqueryrow['totalstudent'];
                        $regstudenttaken = $retrivecrinfoqueryrow['regstudent'];
                        $crnametaken = $retrivecrinfoqueryrow['crname'];
                        $cridtaken = $retrivecrinfoqueryrow['crid'];
                        $cremailtaken = $retrivecrinfoqueryrow['cremail'];
                        $crnumtaken = $retrivecrinfoqueryrow['crnum'];


                    }


                    echo "
        <form action='action_c_i_u_forteacher.php?id={$userteacher1}&emid={$teacheremid1}&cc={$courserowid}' method='post' >
        <fieldset style='border-color: #66afe9;'>
        <legend style='margin: 1%;font-size: 100%'><b> {$coursecode} : {$coursetitle}  ({$credit} Credits) {$ofcoursesemester}</b></legend>
        <b style='font-size: 80%'>LEVEL&TERM</> :</b> <span style='font-size: 90%'>{$leverterm}</span>
        <b style='margin-left: 3%;font-size: 80%'>SECTION : </b><span style='font-size: 90%'>{$ofcoursesection}</span> 
        <b style='margin-left: 3%;font-size: 80%'>Total Student : </b> <input style='border: inherit;border-color: #449d44;margin: 0%' type='text' value='{$totalstudenttaken}' name='totalstudent' size='3'>  
        <b style='margin-left: 3%;font-size: 80%'>Registered Student : </b> <input style='border: inherit;border-color: #449d44;margin: 0%' type='text' value='{$regstudenttaken}' name='regstudent' size='3'>  <br><br>
        <b style='font-size: 90%'>CR name : </b> <input style='border: inherit;border-color: #449d44;margin-bottom: 1%' type='text' value='{$crnametaken}' name='crname' size='30'>  
        <b style='margin-left: 3%;font-size: 90%'>CR ID : </b> <input style='border: inherit;border-color: #449d44;margin-bottom: 1%' type='text' value='{$cridtaken}' name='crid' size='30'> <br>
        <b style='font-size: 90%'>CR e-mail : </b> <input style='border: inherit;border-color: #449d44;margin-bottom: 1%' type='text' value='{$cremailtaken}' name='cremail' size='30'> 
        <b style='font-size: 90%'>CR phone : </b> <input style='border: inherit;border-color: #449d44;margin-bottom: 1%' type='text' value='{$crnumtaken}' name='crphone' size='30'>  <br>
      
          <input style='background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    float: right;
    cursor: pointer;
    border-radius: 5%;'
     type='submit' value='UPDATE' >
        </fieldset><br></form>";

                }


            }


        }


        /*
                $courseInfoquery = "select * from coursedetails WHERE emid='{$teacheremid1}'";
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
        <form action='action_c_i_u_forteacher.php?id={$userteacher1}&emid={$teacheremid1}&cc={$courseCodetaken}' method='post' >
        <fieldset>
        <legend><b> {$courseCodetaken} : {$coursetitletaken}  ({$credithourtaken} Credits) {$semestercodetaken}</b></legend>
        <b><u>LEVEL&TERM</u> :</b> {$leveltermtaken} &emsp;&emsp;
        <b><u>SECTION</u> : </b>   {$sectiontaken} &emsp;&emsp;
        <b><u>Total Student</u> : </b> <input type='text' value='{$totalstudenttaken}' name='totalstudent' size='3'>  &emsp;&emsp;
        <b><u>Registered Student</u> : </b> <input type='text' value='{$regstudenttaken}' name='regstudent' size='3'>  &emsp;&emsp; <br><br>
        <b><u>CR name</u> : </b> <input type='text' value='{$crnametaken}' name='crname' size='30'>   &emsp;&emsp;
        <b><u>CR ID</u> : </b> <input type='text' value='{$cridtaken}' name='crid' size='30'>   &emsp;&emsp;<br>
        <b><u>CR e-mail</u> : </b> <input type='text' value='{$cremailtaken}' name='cremail' size='30'>  &emsp;&emsp;
        <b><u>CR phone</u> : </b> <input type='text' value='{$crnumtaken}' name='crphone' size='30'>   &emsp;&emsp;<br>
         &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          <input type='submit' value='UPDATE' >
        </fieldset><br></form>";
                }*/


        ?>
    </fieldset>
    </div>

    <!--</fieldset>-->


    </body>
    </html>


<?php
//$toralstudentupdate=$totalstudenttaken;
//$regstudentupdate=$regstudenttaken;
//$crnameupdate=$crnametaken;
//$cridupdate=$cridtaken;
//$cremailupdate=$cremailtaken;
//$crphoneupdata=$crnumtaken;
//
//if ($_SERVER['REQUEST_METHOD']=='POST'){
//    if (!empty($_POST['totalstudent'])){
//        $toralstudentupdate=$_POST['totalstudent'];
//        $toralstudentupdatequery="update takencourses set totalstudent='{$toralstudentupdate}' WHERE emid='{$teacheremid1}' AND coursecode='{$courseCodetaken}' limit 1";
//        mysqli_query($connection,$toralstudentupdatequery);
//    }
//    if (!empty($_POST['regstudent'])){
//        $regstudentupdate=$_POST['regstudent'];
//    }
//    if (!empty($_POST['crname'])){
//        $crnameupdate=$_POST['crname'];
//    }
//    if (!empty($_POST['crid'])){
//        $cridupdate=$_POST['crid'];
//    }
//    if (!empty($_POST['cremail'])){
//        $cremailupdate=$_POST['cremail'];
//    }
//    if (!empty($_POST['crphone'])){
//        $crphoneupdata=$_POST['crphone'];
//    }
//
//
//}


?>