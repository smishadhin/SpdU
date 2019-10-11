<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; Filename= teacher and course.doc");
?>

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
    <style>
        table, td, th {
            padding: 1%;
            border: 1px solid black;
            width: inherit;
        }

        table {
            border-collapse: collapse;
            width: inherit;
        }

        th {
            height: 50px;
        }
    </style>
    <title></title>

</head>
<?php
$header = $title = $footer = "";
if (!empty($_POST['header'])) {
    $header = $_POST['header'];
} else {
    $header = "Daffodil International University<br>
            Asulia,Savar,Dhaka-1341<br>
            Faculty of Science & Information Technology<br>
            {$semestercode}";
}
if (!empty($_POST['title'])) {
    $title = $_POST['title'];
} else {
    $title = "Teacher And Course Details";
}
if (!empty($_POST['footer'])) {
    $footer = $_POST['footer'];
} else {
    $footer = "END";
}
?>


<body>


<section>
    <div>
        <section>
            <div align="center">
                <div>
                    <img src="logo/diulogo.png">
                    <h4>
                        <?php echo $header; ?>
                    </h4>
                    <h3><?php echo $title; ?></h3>
                </div>
                <table>
                    <tbody>
                    <tr>
                        <td><b>Teacher Detail</b></td>
                        <td><b>Level & Term</b></td>
                        <td><b>Assigned Courses</b></td>
                        <td><b>Credit</b></td>
                        <td><b>Section</b></td>
                    </tr>

                    <?php
                    $deprtmnt = $leverterm = $coursecode = $coursetitle = $offday = "";
                    $credit = 0;
                    $ofcoursesection = array();

                    ///////////////////////////////

                    if (isset($_POST['submitdept'])) {
                        if (!empty($_POST['dept'])) {

                            $collectInfoquery = "SELECT title,firstname,lastname,emid,initial,designation,email,mobile,mode FROM users WHERE department='{$_POST['dept']}' AND page='teacher.php';";
                            $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
                            while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
                                $rowspan = 0;
                                $tctitle = $collectInforow['title'];
                                $tcfirstname = $collectInforow['firstname'];
                                $tclastname = $collectInforow['lastname'];
                                $tcinitial = $collectInforow['initial'];
                                //$tcdepartment = $collectInforow['department'];
                                //$tcfaculty = $collectInforow['faculty'];
                                //$tccampus = $collectInforow['campus'];
                                $tcmode = $collectInforow['mode'];
                                $tcdesignation = $collectInforow['designation'];
                                $tcemid = $collectInforow['emid'];
                                $tcmobile = $collectInforow['mobile'];
                                $tcemail = $collectInforow['email'];

                                $dayoffqu = "select offday from photo WHERE emid='{$tcemid}'";
                                $dayoffqrslt = mysqli_query($connection, $dayoffqu);
                                while ($dayoffrow = mysqli_fetch_assoc($dayoffqrslt)) {
                                    $offday = $dayoffrow['offday'];
                                }

                                $courseInfoquery = "select * from coursetaken WHERE tcemid='{$tcemid}'";
                                $courseInforesult = mysqli_query($connection, $courseInfoquery);
                                while ($courseInforow = mysqli_fetch_assoc($courseInforesult)) {
                                    $offeredcourseid = $courseInforow['offeredcourseid'];

                                    $offeredcoursetabledetailquery = "select courseid,section,semester from offeredcourse WHERE id={$offeredcourseid} AND semester='{$semestercode}'";
                                    $offeredcoursetabledetailresult = mysqli_query($connection, $offeredcoursetabledetailquery);

                                    while ($offeredcoursetabledetailrow = mysqli_fetch_assoc($offeredcoursetabledetailresult)) {
                                        $ofcourseid = $offeredcoursetabledetailrow['courseid'];
                                        $rowspan++;
                                    }
                                }


                                // echo $rowspan."<br>";
                                $rowspan += 1;

                                echo "
                    <tr >
                    <td rowspan='{$rowspan}'>
                    {$tctitle} {$tcfirstname} {$tclastname}({$tcinitial})<br>
                    
                    {$tcdesignation}<br>
                    Mode: {$tcmode}<br>
                    ID: {$tcemid}<br>
                    Pn:{$tcmobile}<br> 
                     Em: {$tcemail}<br>
                      Off Day : {$offday}<br>
                            </td>
                    </tr>                  
                ";
                                $courseInfoquery = "select * from coursetaken WHERE tcemid='{$tcemid}'";
                                $courseInforesult = mysqli_query($connection, $courseInfoquery);
                                while ($courseInforow = mysqli_fetch_assoc($courseInforesult)) {

                                    $offeredcourseid = $courseInforow['offeredcourseid'];
                                    $courserowid = $courseInforow['id'];
                                    $offeredcoursetabledetailquery = "select courseid,section,semester from offeredcourse WHERE id={$offeredcourseid} AND semester='{$semestercode}'";
                                    $offeredcoursetabledetailresult = mysqli_query($connection, $offeredcoursetabledetailquery);


                                    while ($offeredcoursetabledetailrow = mysqli_fetch_assoc($offeredcoursetabledetailresult)) {
                                        $ofcourseid = $offeredcoursetabledetailrow['courseid'];
                                        $ofcoursesection[] = $offeredcoursetabledetailrow['section'];
                                        $ofcoursesemester = $offeredcoursetabledetailrow['semester'];

                                        $crouseinfodetailsquery = "select * from allcourses WHERE id={$ofcourseid}";
                                        $crouseinfodetailsresult = mysqli_query($connection, $crouseinfodetailsquery);
                                        while ($crouseinfodetailsrow = mysqli_fetch_assoc($crouseinfodetailsresult)) {
                                            $dept = $crouseinfodetailsrow['dept'];
                                            $leverterm = $crouseinfodetailsrow['levelterm'];
                                            $coursecode = $crouseinfodetailsrow['coursecode'];
                                            $coursetitle = $crouseinfodetailsrow['coursetitle'];
                                            $credit = $crouseinfodetailsrow['credit'];
                                        }
                                    }
                                    echo "
                                                <tr>
                                                <td>{$leverterm}</td>
                                                <td>{$coursecode} : {$coursetitle}</td>
                                                <td>{$credit}</td>
                                                <td>";
                                    //echo "size".sizeof($ofcoursesection)."<br>";
                                    for ($z = 0; $z < sizeof($ofcoursesection); $z++) {
                                        echo $ofcoursesection[$z] . ",";
                                    }
                                    $ofcoursesection = null;

                                    echo "</td></tr>";
                                }
                            }
                        }
                    }

                    /////////////////////////
                    if (isset($_POST['submit'])) {
                        if (!empty($_POST['teachers'])) {
                            foreach ($_POST['teachers'] as $te) {
                                if (!empty($te)) {
                                    $collectInfoquery = "SELECT title,firstname,lastname,emid,initial,designation,email,mobile,mode FROM users WHERE emid='{$te}' AND page='teacher.php';";
                                    $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
                                    while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
                                        $rowspan = 0;
                                        $tctitle = $collectInforow['title'];
                                        $tcfirstname = $collectInforow['firstname'];
                                        $tclastname = $collectInforow['lastname'];
                                        $tcinitial = $collectInforow['initial'];
                                        //$tcdepartment = $collectInforow['department'];
                                        //$tcfaculty = $collectInforow['faculty'];
                                        //$tccampus = $collectInforow['campus'];
                                        $tcmode = $collectInforow['mode'];
                                        $tcdesignation = $collectInforow['designation'];
                                        $tcemid = $collectInforow['emid'];
                                        $tcmobile = $collectInforow['mobile'];
                                        $tcemail = $collectInforow['email'];
                                        $courseInfoquery = "select * from coursetaken WHERE tcemid='{$tcemid}'";
                                        $courseInforesult = mysqli_query($connection, $courseInfoquery);
                                        while ($courseInforow = mysqli_fetch_assoc($courseInforesult)) {
                                            $offeredcourseid = $courseInforow['offeredcourseid'];

                                            $offeredcoursetabledetailquery = "select courseid,section,semester from offeredcourse WHERE id={$offeredcourseid} AND semester='{$semestercode}'";
                                            $offeredcoursetabledetailresult = mysqli_query($connection, $offeredcoursetabledetailquery);

                                            while ($offeredcoursetabledetailrow = mysqli_fetch_assoc($offeredcoursetabledetailresult)) {
                                                $ofcourseid = $offeredcoursetabledetailrow['courseid'];
                                                $rowspan++;
                                            }
                                        }

                                        $rowspan += 1;

                                        echo "
                    <tr >
                    <td rowspan='{$rowspan}'>
                    {$tctitle} {$tcfirstname} {$tclastname}({$tcinitial})<br>
                    
                    {$tcdesignation}<br>
                    Mode: {$tcmode}<br>
                    ID: {$tcemid}<br>
                    Pn:{$tcmobile}<br> 
                     Em: {$tcemail}<br> 
                            </td>
                    </tr>                  
                ";
                                        $courseInfoquery = "select * from coursetaken WHERE tcemid='{$tcemid}'";
                                        $courseInforesult = mysqli_query($connection, $courseInfoquery);
                                        while ($courseInforow = mysqli_fetch_assoc($courseInforesult)) {

                                            $offeredcourseid = $courseInforow['offeredcourseid'];
                                            $courserowid = $courseInforow['id'];
                                            $offeredcoursetabledetailquery = "select courseid,section,semester from offeredcourse WHERE id={$offeredcourseid} AND semester='{$semestercode}'";
                                            $offeredcoursetabledetailresult = mysqli_query($connection, $offeredcoursetabledetailquery);


                                            while ($offeredcoursetabledetailrow = mysqli_fetch_assoc($offeredcoursetabledetailresult)) {
                                                $ofcourseid = $offeredcoursetabledetailrow['courseid'];
                                                $ofcoursesection[] = $offeredcoursetabledetailrow['section'];
                                                $ofcoursesemester = $offeredcoursetabledetailrow['semester'];


                                                $crouseinfodetailsquery = "select * from allcourses WHERE id={$ofcourseid}";
                                                $crouseinfodetailsresult = mysqli_query($connection, $crouseinfodetailsquery);
                                                while ($crouseinfodetailsrow = mysqli_fetch_assoc($crouseinfodetailsresult)) {
                                                    $dept = $crouseinfodetailsrow['dept'];
                                                    $leverterm = $crouseinfodetailsrow['levelterm'];
                                                    $coursecode = $crouseinfodetailsrow['coursecode'];
                                                    $coursetitle = $crouseinfodetailsrow['coursetitle'];
                                                    $credit = $crouseinfodetailsrow['credit'];

                                                }
                                            }
                                            echo "
                                                <tr>
                                                <td>{$leverterm}</td>
                                                <td>{$coursecode} : {$coursetitle}</td>
                                                <td>{$credit}</td>
                                                <td>";
                                            //echo "size".sizeof($ofcoursesection)."<br>";
                                            for ($z = 0; $z < sizeof($ofcoursesection); $z++) {
                                                echo $ofcoursesection[$z] . ",";
                                            }
                                            $ofcoursesection = null;
                                            echo "</td></tr>";
                                        }
                                    }
                                }
                            }
                        }
                    }

                    ?>

                    </tbody>
                </table>
                <br><br>
                <h4 align="center" style="margin: 2%"><?php echo $footer; ?></h4>
            </div>
        </section>


    </div>


</section>


</body>
</html>
