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
    <link href="css/stylect.css" rel="stylesheet" media="screen" type="text/css"/>
    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet" media="screen" type="text/css"/>
    <link rel="stylesheet" href="../../styleadmin.css"/>
</head>
<body style="background-color: #5e5e5e">
<section>
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


<div
    style="background-color: #d4ffda;float: left;width: 20%;height: 100%;border: solid;border-color: #1b6d85;position: fixed">

    <section>
        <ul>
            <a href="offeredcourse.php">
                <li style="margin: 5%">Offered course</li>
            </a>
            <a href="teacherinformation.php">
                <li style="margin: 5%">Teacher Information</li>
            </a>
            <a href="teacherandcourseinfo.php">
                <li style="margin: 5%">Teacher and course Information</li>
            </a>
            <a href="courseoutline.php">
                <li style="margin: 5%">Course Outline</li>
            </a>
            <a href="crinfo.php">
                <li style="margin: 5%">CR Information</li>
            </a>
            <a href="classsizeinfo.php">
                <li style="margin: 5%">Class Size Information</li>
            </a>
            <a href="dayoffinfo.php">
                <li style="margin: 5%">Day off information</li>
            </a>

        </ul>

    </section>

</div>



<div>
    <section
        style="background-color: #b4c7ff;float: right;width: 79%;height: 100%;border: solid;border-color: #1b6d85;position:inherit ">

        <div>


            <section class="course_details_info">
                <div align="center"><h1 style="color: #ac2925">Report: Offered Course</h1></div>
                <div class="course_contant_info">

<form action="../actions/offeredcourseaction.php" method="post">
                    <section  style="border: solid;border-color: #2b542c;margin-bottom: 10%">
<h1 align="center">Generate Report on the basis of following Info.</h1>
                        <div align="top" ><span style="color: red;">Dept. Must be selected</span><br>
                            <select name="dept" style="margin:1%;">
                                <option disabled selected>Select a Department</option>
                                <option>CSE</option>
                                <option>BBA</option>
                                <option>English</option>
                                <option>Hotel Management and turisum</option>
                            </select>
                            <input style="" type="checkbox" value="available">Available Cources
                            <input style="margin:1%;padding: 1%" type="checkbox" value="no">Unvailable Cources
                            <select name="levelterm" style="margin: 1%">
                                <option disabled selected>Select Level & Term</option>
                                <option>L1T1</option>
                                <option>L1T2</option>
                                <option>L1T3</option>
                                <option>L2T1</option>
                                <option>L2T2</option>
                                <option>L2T3</option>
                                <option>L3T1</option>
                                <option>L3T2</option>
                                <option>L3T3</option>
                                <option>L4T1</option>
                                <option>L4T2</option>
                                <option>L4T3</option>
                            </select>

                        </div>

                        <div align="center">
                            <input style="margin: 2%" type="submit" name="generate1" value="GENERATE">
                        </div>

                    </section>
</form>



<section style="border: solid">
    <h1 align="center">Genetate Report By Course</h1>

                    <form action="" method="post">

                        <select name="dept" style="margin-right: 5%;padding: 1%;margin-bottom: 2%">
                            <option disabled selected>Select a Department</option>
                            <option>CSE</option>
                            <option>BBA</option>
                            <option>English</option>
                            <option>Hotel Management and turisum</option>
                        </select>

                        <input type="submit" name="submitdeptandlvltrm" value="Filter">

                        <select name="levelterm" style="margin-left: 5%;padding: 1%;margin-bottom: 2%">
                            <option disabled selected>Select Level & Term</option>
                            <option>L1T1</option>
                            <option>L1T2</option>
                            <option>L1T3</option>
                            <option>L2T1</option>
                            <option>L2T2</option>
                            <option>L2T3</option>
                            <option>L3T1</option>
                            <option>L3T2</option>
                            <option>L3T3</option>
                            <option>L4T1</option>
                            <option>L4T2</option>
                            <option>L4T3</option>
                        </select>


                    </form>

                    <form action="" method="post">
                        <input style="float: right;margin: 1%" type="submit" name="csubmit" value="Generate">
                        <table class="course_table_info">
                            <tbody>
                            <tr>
                                <th>Course Code</th>
                                <th>Level&Term</th>
                                <th>Course Title</th>
                                <th>Department</th>
                                <th>Cedit</th>

                               <!-- <th>Section</th>-->
                            </tr>

                            <?php

                            if (isset($_POST['submitdeptandlvltrm'])) {
                                if (!empty($_POST['dept']) || !empty($_POST['levelterm'])) {
                                    if (!empty($_POST['dept'])) {
                                        echo "DEPT. of " . $deprtmnt = $_POST['dept'];
                                    }
                                    if (!empty($_POST['levelterm'])) {
                                        echo "\t" . $levelterm = $_POST['levelterm'];
                                    }


                                }
                            }

                            ?>

                            <?php

                            $sectionarr = $courseidarr = $tempcourseidarr = array();
                            if (!empty($deprtmnt) && !empty($levelterm)) {


                                $courseretvquery = "select courseid from offeredcourse WHERE semester='{$semestercode}';";
                                $courseretvrslt = mysqli_query($connection, $courseretvquery);
                                while ($cinforow = mysqli_fetch_assoc($courseretvrslt)) {
                                    $maincourseID = $cinforow['courseid'];
                                    $tempcourseidarr[] = $maincourseID;
                                }
                                $courseidarr[0] = $tempcourseidarr[0];
                                for ($c = 1; $c < sizeof($tempcourseidarr); $c++) {
                                    if ($tempcourseidarr[$c] != $tempcourseidarr[$c - 1]) {
                                        $courseidarr[] = $tempcourseidarr[$c];
                                    }
                                }
                                foreach ($courseidarr as $ci) {
                                    $ci;
                                    $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci};";
                                    $sectionselectresult = mysqli_query($connection, $sectionselectquery);
                                    while ($secrow = mysqli_fetch_assoc($sectionselectresult)) {
                                        $sectionarr[] = $secrow['section'];
                                    }
                                    $maincourseinfoquery = "select * from allcourses WHERE id={$ci} AND dept='{$deprtmnt}'AND levelterm='{$levelterm}';";
                                    $maincourseinforslt = mysqli_query($connection, $maincourseinfoquery);
                                    while ($maincourseinforow = mysqli_fetch_assoc($maincourseinforslt)) {
                                        // echo $ofcourseId = $maincourseinforow['id'];
                                        $maincoursedept = $maincourseinforow['dept'];
                                        $maincourselvltrm = $maincourseinforow['levelterm'];
                                        $maincoursecode = $maincourseinforow['coursecode'];
                                        $maincoursetitle = $maincourseinforow['coursetitle'];
                                        $maincoursecredit = $maincourseinforow['credit'];

                                        echo "
							  <tr>
						<td>{$maincoursecode}</td>
						<td>{$maincourselvltrm}</td>
						<td>{$maincoursetitle}</td>
						<td>{$maincoursedept}</td>
						<td>{$maincoursecredit}</td>
						
						<!--<td>-->";
                                        /*for ($i = 0; $i < sizeof($sectionarr); $i++) {
                                            $ofcourseIdquery = "select id from offeredcourse WHERE courseid={$ci} AND section='{$sectionarr[$i]}' ;";
                                            $ofcourseIdqueryresult = mysqli_query($connection, $ofcourseIdquery);
                                            while ($ofcrow = mysqli_fetch_assoc($ofcourseIdqueryresult)) {
                                                $ofcourseId = $ofcrow['id'];
                                            }

                                            echo "{$sectionarr[$i]}<br>";
                                        }
                                        echo "</td>

					  </tr>

					  ";*/
                                    }

                                    $sectionarr = null;

                                }

                            } elseif (!empty($deprtmnt)) {


                                $courseretvquery = "select courseid from offeredcourse WHERE semester='{$semestercode}';";
                                $courseretvrslt = mysqli_query($connection, $courseretvquery);
                                while ($cinforow = mysqli_fetch_assoc($courseretvrslt)) {
                                    $maincourseID = $cinforow['courseid'];
                                    $tempcourseidarr[] = $maincourseID;
                                }
                                $courseidarr[0] = $tempcourseidarr[0];
                                for ($c = 1; $c < sizeof($tempcourseidarr); $c++) {
                                    if ($tempcourseidarr[$c] != $tempcourseidarr[$c - 1]) {
                                        $courseidarr[] = $tempcourseidarr[$c];
                                    }
                                }
                                foreach ($courseidarr as $ci) {
                                    $ci;
                                    $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci}/* AND availability='available'*/;";
                                    $sectionselectresult = mysqli_query($connection, $sectionselectquery);
                                    while ($secrow = mysqli_fetch_assoc($sectionselectresult)) {
                                        $sectionarr[] = $secrow['section'];
                                    }
                                    $maincourseinfoquery = "select * from allcourses WHERE id={$ci} AND dept='{$deprtmnt}';";
                                    $maincourseinforslt = mysqli_query($connection, $maincourseinfoquery);
                                    while ($maincourseinforow = mysqli_fetch_assoc($maincourseinforslt)) {
                                        // echo $ofcourseId = $maincourseinforow['id'];
                                        $maincoursedept = $maincourseinforow['dept'];
                                        $maincourselvltrm = $maincourseinforow['levelterm'];
                                        $maincoursecode = $maincourseinforow['coursecode'];
                                        $maincoursetitle = $maincourseinforow['coursetitle'];
                                        $maincoursecredit = $maincourseinforow['credit'];

                                        echo "
							  <tr>
						<td>{$maincoursecode}</td>
						<td>{$maincourselvltrm}</td>
						<td>{$maincoursetitle}</td>
						<td>{$maincoursedept}</td>
						<td>{$maincoursecredit}</td>
						
						<!--<td>-->";
                                        /*for ($i = 0; $i < sizeof($sectionarr); $i++) {
                                            $ofcourseIdquery = "select id from offeredcourse WHERE courseid={$ci} AND section='{$sectionarr[$i]}' ;";
                                            $ofcourseIdqueryresult = mysqli_query($connection, $ofcourseIdquery);
                                            while ($ofcrow = mysqli_fetch_assoc($ofcourseIdqueryresult)) {
                                                $ofcourseId = $ofcrow['id'];
                                            }

                                            echo "{$sectionarr[$i]}<br>";
                                        }*/
                                       // echo "</td> </tr>";
                                    }

                                    $sectionarr = null;

                                }


                            } elseif (!empty($levelterm)) {

                                $courseretvquery = "select courseid from offeredcourse WHERE semester='{$semestercode}';";
                                $courseretvrslt = mysqli_query($connection, $courseretvquery);
                                while ($cinforow = mysqli_fetch_assoc($courseretvrslt)) {
                                    $maincourseID = $cinforow['courseid'];
                                    $tempcourseidarr[] = $maincourseID;
                                }
                                $courseidarr[0] = $tempcourseidarr[0];
                                for ($c = 1; $c < sizeof($tempcourseidarr); $c++) {
                                    if ($tempcourseidarr[$c] != $tempcourseidarr[$c - 1]) {
                                        $courseidarr[] = $tempcourseidarr[$c];
                                    }
                                }
                                foreach ($courseidarr as $ci) {
                                    $ci;
                                    $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci};";
                                    $sectionselectresult = mysqli_query($connection, $sectionselectquery);
                                    while ($secrow = mysqli_fetch_assoc($sectionselectresult)) {
                                        $sectionarr[] = $secrow['section'];
                                    }
                                    $maincourseinfoquery = "select * from allcourses WHERE id={$ci} AND levelterm='{$levelterm}';";
                                    $maincourseinforslt = mysqli_query($connection, $maincourseinfoquery);
                                    while ($maincourseinforow = mysqli_fetch_assoc($maincourseinforslt)) {
                                        // echo $ofcourseId = $maincourseinforow['id'];
                                        $maincoursedept = $maincourseinforow['dept'];
                                        $maincourselvltrm = $maincourseinforow['levelterm'];
                                        $maincoursecode = $maincourseinforow['coursecode'];
                                        $maincoursetitle = $maincourseinforow['coursetitle'];
                                        $maincoursecredit = $maincourseinforow['credit'];

                                        echo "
							  <tr>
						<td>{$maincoursecode}</td>
						<td>{$maincourselvltrm}</td>
						<td>{$maincoursetitle}</td>
						<td>{$maincoursedept}</td>
						<td>{$maincoursecredit}</td>
						
						<!--<td>-->";
                                        /*for ($i = 0; $i < sizeof($sectionarr); $i++) {
                                            $ofcourseIdquery = "select id from offeredcourse WHERE courseid={$ci} AND section='{$sectionarr[$i]}' ;";
                                            $ofcourseIdqueryresult = mysqli_query($connection, $ofcourseIdquery);
                                            while ($ofcrow = mysqli_fetch_assoc($ofcourseIdqueryresult)) {
                                                $ofcourseId = $ofcrow['id'];
                                            }

                                            echo "{$sectionarr[$i]}<br>";
                                        }
                                        echo "</td>

					  </tr>

					  ";*/
                                    }

                                    $sectionarr = null;

                                }


                            } else {

                                $courseretvquery = "select courseid from offeredcourse WHERE semester='{$semestercode}';";
                                $courseretvrslt = mysqli_query($connection, $courseretvquery);
                                while ($cinforow = mysqli_fetch_assoc($courseretvrslt)) {
                                    $maincourseID = $cinforow['courseid'];
                                    $tempcourseidarr[] = $maincourseID;
                                }
                                $courseidarr[0] = $tempcourseidarr[0];
                                for ($c = 1; $c < sizeof($tempcourseidarr); $c++) {
                                    if ($tempcourseidarr[$c] != $tempcourseidarr[$c - 1]) {
                                        $courseidarr[] = $tempcourseidarr[$c];
                                    }
                                }
                                foreach ($courseidarr as $ci) {
                                    $ci;
                                    $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci};";
                                    $sectionselectresult = mysqli_query($connection, $sectionselectquery);
                                    while ($secrow = mysqli_fetch_assoc($sectionselectresult)) {
                                        $sectionarr[] = $secrow['section'];
                                    }
                                    $maincourseinfoquery = "select * from allcourses WHERE id={$ci};";
                                    $maincourseinforslt = mysqli_query($connection, $maincourseinfoquery);
                                    while ($maincourseinforow = mysqli_fetch_assoc($maincourseinforslt)) {
                                        // echo $ofcourseId = $maincourseinforow['id'];
                                        $maincoursedept = $maincourseinforow['dept'];
                                        $maincourselvltrm = $maincourseinforow['levelterm'];
                                        $maincoursecode = $maincourseinforow['coursecode'];
                                        $maincoursetitle = $maincourseinforow['coursetitle'];
                                        $maincoursecredit = $maincourseinforow['credit'];

                                        echo "
							  <tr>
						<td>{$maincoursecode}</td>
						<td>{$maincourselvltrm}</td>
						<td>{$maincoursetitle}</td>
						<td>{$maincoursedept}</td>
						<td>{$maincoursecredit}</td>
						
						";
                                        /*for ($i = 0; $i < sizeof($sectionarr); $i++) {
                                            $ofcourseIdquery = "select id from offeredcourse WHERE courseid={$ci} AND section='{$sectionarr[$i]}' ;";
                                            $ofcourseIdqueryresult = mysqli_query($connection, $ofcourseIdquery);
                                            while ($ofcrow = mysqli_fetch_assoc($ofcourseIdqueryresult)) {
                                                $ofcourseId = $ofcrow['id'];
                                            }

                                            echo "{$sectionarr[$i]}<br>";
                                        }*/
                                        echo "</td>

					  </tr>

					  ";
                                    }

                                    $sectionarr = null;

                                }

                            }


                            ?>

                            </tbody>
                        </table>
                    </form>

</section>


                </div>
            </section>


        </div>


    </section>
</div>

</body>
</html>
