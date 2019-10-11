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
if (isset($_GET['cc'])) {
    $courseCodetaken = $_GET['cc'];
} else {
    redirect_to("index.php");
}

$updatestatusall = false;
$semestercode = semestercode();
?>
<?php require_once("../includes/db_connection.php"); ?>

<?php


$toralstudentupdate = $regstudentupdate = $crnameupdate = $cridupdate = $cremailupdate = $crphoneupdata = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['totalstudent'])) {
        $toralstudentupdate = $_POST['totalstudent'];
        $presenttotstqury = "select totalstudent from coursedetails  WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
        $presenttotstquryresult = mysqli_query($connection, $presenttotstqury);

        if ($presenttotstquryresult) {
            while ($psrow = mysqli_fetch_assoc($presenttotstquryresult)) {
                $presenttotalstudent = $psrow['totalstudent'];
            }
            if ($presenttotalstudent != $toralstudentupdate) {
                $toralstudentupdatequery = "update coursedetails set totalstudent='{$toralstudentupdate}' WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
                $updaterslt = mysqli_query($connection, $toralstudentupdatequery);
                if ($updaterslt) {
                    $updatestatusall = true;
                    // redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=success&cc={$courseCodetaken}");
                }
            } else {
                //  $updatestatusall=false;
                //  redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=same&cc={$courseCodetaken}");
            }

        } else {
            //  redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=faild");
        }
    } else {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=empty");
    }

    if (!empty($_POST['regstudent'])) {
        $regstudentupdate = $_POST['regstudent'];
        $presentregtstqury = "select regstudent from coursedetails  WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
        $presentregtstquryresult = mysqli_query($connection, $presentregtstqury);

        if ($presentregtstquryresult) {
            while ($regstrow = mysqli_fetch_assoc($presentregtstquryresult)) {
                $presentregstudent = $regstrow['regstudent'];
            }
            if ($presentregstudent != $regstudentupdate) {
                $regstudentupdatequery = "update coursedetails set regstudent='{$regstudentupdate}' WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
                $updaterslt = mysqli_query($connection, $regstudentupdatequery);
                if ($updaterslt) {
                    $updatestatusall = true;
                }
            }
        }
    } else {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=empty");
    }
    if (!empty($_POST['crname'])) {
        $crnameupdate = $_POST['crname'];
        $presentcrnamequry = "select crname from coursedetails  WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
        $presentcrnamequryresult = mysqli_query($connection, $presentcrnamequry);

        if ($presentcrnamequryresult) {
            while ($crnmrow = mysqli_fetch_assoc($presentcrnamequryresult)) {
                $presentcrname = $crnmrow['crname'];
            }
            if ($presentcrname != $crnameupdate) {
                $presentcrnamequryupdatequery = "update coursedetails set crname='{$crnameupdate}' WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
                $updaterslt = mysqli_query($connection, $presentcrnamequryupdatequery);
                if ($updaterslt) {
                    $updatestatusall = true;
                }
            }
        }


    } else {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=empty");
    }
    if (!empty($_POST['crid'])) {
        $cridupdate = $_POST['crid'];
        $presentcridqury = "select crid from coursedetails  WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
        $presentcridquryresult = mysqli_query($connection, $presentcridqury);

        if ($presentcridquryresult) {
            while ($cridrow = mysqli_fetch_assoc($presentcridquryresult)) {
                $presentcrid = $cridrow['crid'];
            }
            if ($presentcrid != $cridupdate) {
                $presentcridquryupdatequery = "update coursedetails set crid='{$cridupdate}' WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
                $updaterslt = mysqli_query($connection, $presentcridquryupdatequery);
                if ($updaterslt) {
                    $updatestatusall = true;
                }
            }
        }



    } else {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=empty");
    }
    if (!empty($_POST['cremail'])) {
        $cremailupdate = $_POST['cremail'];
        $presentcremailqury = "select cremail from coursedetails  WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
        $presentcremailquryresult = mysqli_query($connection, $presentcremailqury);

        if ($presentcremailquryresult) {
            while ($cremailrow = mysqli_fetch_assoc($presentcremailquryresult)) {
                $presentcremail = $cremailrow['cremail'];
            }
            if ($presentcremail != $cremailupdate) {
                $cremailupdatequery = "update coursedetails set cremail='{$cremailupdate}' WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
                $updaterslt = mysqli_query($connection, $cremailupdatequery);
                if ($updaterslt) {
                    $updatestatusall = true;
                }
            }
        }



    } else {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=empty");
    }
    if (!empty($_POST['crphone'])) {
        $crphoneupdata = $_POST['crphone'];
        $presentcrnumqury = "select crnum from coursedetails  WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
        $presentcrnumquryresult = mysqli_query($connection, $presentcrnumqury);

        if ($presentcrnumquryresult) {
            while ($crnumrow = mysqli_fetch_assoc($presentcrnumquryresult)) {
                $presentcrnum = $crnumrow['crnum'];
            }
            if ($presentcrnum != $crphoneupdata) {
                $crphoneupdataquery = "update coursedetails set crnum='{$crphoneupdata}' WHERE emid='{$teacheremid1}' AND coursetaken={$courseCodetaken} limit 1";
                $updaterslt = mysqli_query($connection, $crphoneupdataquery);
                if ($updaterslt) {
                    $updatestatusall = true;
                }
            }
        }





    } else {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=empty");
    }


    if ($updatestatusall == true) {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=success&cc={$courseCodetaken}");
    }
    if ($updatestatusall == false) {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=same&cc={$courseCodetaken}");
    }
    if ($updatestatusall == null) {
        redirect_to("viewandupdatecoursedetailforteacher.php?emid={$teacheremid1}&id={$userteacher1}&us=faild");
    }


}


?>