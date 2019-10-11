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

$semestercode= semestercode();

?>
<?php require_once("../includes/db_connection.php"); ?>


<?php

if (isset($_GET['id']) && isset($_GET['emid']) && !empty($_GET['id']) && !empty($_GET['emid'])) {
    $tcid = $_GET['id'];
    $tcemid = $_GET['emid'];

    $coursecode = $crname = $crid = $cremail = $crnub = $totalstudent = $regstudent = "";
    $errcoursecode = $errcrname = $errcrid = $errcremail = $errcrnub = $errtotalstudent = $errregstudent = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!empty($_POST['courseCode'])) {
            $coursecode = validate($_POST['courseCode']);
        } else {
            echo $errcoursecode = "<span style='color: red;font-size: 35px ;'> go back select course code <br/><br/></span>";
        }
        if (!empty($_POST['crname'])) {
            $crname = validate($_POST['crname']);
        } else {
            echo $errcrname = "<span style='color: red;font-size: 35px ;'> go back and input CR name <br/><br/></span>";
        }
        if (!empty($_POST['crid'])) {
            $crid = validate($_POST['crid']);
        } else {
            echo $errcrid = "<span style='color: red;font-size: 35px ;'> go back and input CR ID <br/><br/></span>";
        }
        if (!empty($_POST['cremail'])) {
            $cremail = validate($_POST['cremail']);
        } else {
            echo $errcremail = "<span style='color: red;font-size: 35px ;'> go back and input CR Email <br/><br/></span>";
        }
        if (!empty($_POST['crnum'])) {
            $crnub = validate($_POST['crnum']);
        } else {
            echo $errcrnub = "<span style='color: red;font-size: 35px ;'> go back and input CR Contact number <br/><br/></span>";
        }
        if (!empty($_POST['totalstudent'])) {
            $totalstudent = trim($_POST['totalstudent']);
        } else {
            echo $errtotalstudent = "<span style='color: red;font-size: 35px ;'> go back and input total student <br/><br/></span>";
        }
        if (!empty($_POST['registerdstudent'])) {
            $regstudent = trim($_POST['registerdstudent']);
        } else {
            echo $errcrname = "<span style='color: red;font-size: 35px ;'> go back and input Registered Student <br/><br/></span>";
        }


        if (!empty($coursecode) && !empty($crname) && !empty($crid) && !empty($cremail) && !empty($crnub) && !empty($totalstudent) && !empty($regstudent))
        {


            $courseinfoQuery1 = "SELECT dept,levelterm,coursecode,coursetitle,section,credithour,semestercode FROM courses WHERE coursecode='{$coursecode}' limit 1";
            $courseinfoQueryresult1 = mysqli_query($connection, $courseinfoQuery1);
            while ($courserow1 = mysqli_fetch_assoc($courseinfoQueryresult1)) {
                echo $dept1 = $courserow1['dept'];
                echo $levelterm1 = $courserow1['levelterm'];
                echo $coursecode1 = $courserow1['coursecode'];
                echo $coursetitle1 = $courserow1['coursetitle'];
                echo $section1 = $courserow1['section'];
                echo $credithour1 = $courserow1['credithour'];
                echo $semcod = $courserow1['semestercode'];

            }

            if (!empty($dept1) && !empty($coursetitle1) && !empty($coursecode1)) {
                $insertquery = "insert into takencourses ";
                $insertquery .= "(emid,dept,levelterm,coursecode,coursetitle,section,credithour,crname,crid,cremail,crnum,totalstudent,regstudent,semestercode) ";
                $insertquery .= "values ('{$tcemid}','{$dept1}','{$levelterm1}','{$coursecode1}','{$coursetitle1}','{$section1}',{$credithour1},'{$crname}','{$crid}','{$cremail}','{$crnub}','{$totalstudent}','{$regstudent}','{$semcod}')";
                $insertresult = mysqli_query($connection, $insertquery);
                if ($insertresult){
                    $delidquery="SELECT id FROM courses WHERE coursecode='{$coursecode1}' AND emid='{$tcemid}';";
                    $delidqueryresult=mysqli_query($connection,$delidquery);
                    if ($delidqueryresult){
                        while ($idrow=mysqli_fetch_assoc($delidqueryresult)){
                           $delid=$idrow['id'];
                        }
                        $delqu="update courses set status='taken' WHERE id={$delid};";
                        $delrslt=mysqli_query($connection,$delqu);
                        if ($delrslt){
                            echo "delition success";
                            redirect_to("offeredcourseforteacher.php?id={$tcid}&status=success&cc={$coursecode1}");
                        }
                    }
                    echo "insert success";
                }else{
                    echo "insertion faild inside";
                }

            }else{
                echo "insertion faild";
            }

        } else {
            echo "<span style='color: red;font-size: 35px ;'> course operation error please go back and try again <br/><br/></span>";
        }


    } else {
        redirect_to("index.php");
    }


} else {
    redirect_to("index.php");
}


?>
