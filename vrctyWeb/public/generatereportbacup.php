<?php require_once("../includes/functions.php"); ?>
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
<?php require_once("../includes/db_connection.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="css/stylect.css" rel="stylesheet" media="screen" type="text/css"/>
    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet" media="screen" type="text/css"/>
    <link rel="stylesheet" href="styleadmin.css"/>
</head>
<body style="background-color: #5e5e5e">
<ul class="nav">
    <div class="logo">Admin Panal (<?php echo $semestercode ?>)</div>
    <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
    <!--    <li><a href="teacherlistforadmin.php"> Give Course Offer</li>-->
    <li><a href="makecourseoffer.php">Declare course offer</a></li>
    <li><a href="inputallcourses.php">Manage Data</a></li>
    <li><a href="generatereport.php">Generate Report</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>



<div style="background-color: #d4ffda;float: left;width: 20%;height: 100%;border: solid;border-color: #1b6d85;position: fixed">

    <section >
        <ul >
            <a href="report/pages/offeredcourse.php"><li style="margin: 5%">Offered course</li></a>

            <a href="report/pages/teacherinformation.php">
                <li style="margin: 5%">Teacher Information</li>
            </a>
            <a href="report/pages/teacherandcourseinfo.php">
                <li style="margin: 5%">Teacher and course Information</li>
            </a>
            <a href="report/pages/courseoutline.php">
                <li style="margin: 5%">Course Outline</li>
            </a>
            <a href="report/pages/crinfo.php">
                <li style="margin: 5%">CR Information</li>
            </a>
            <a href="report/pages/classsizeinfo.php">
                <li style="margin: 5%">Class Size Information</li>
            </a>
            <a href="report/pages/dayoffinfo.php">
                <li style="margin: 5%">Day off information</li>
            </a>


        </ul>

    </section>

</div>








<section style="background-color: #b4c7ff;float: right;width: 80%;height: 100%;border: solid;border-color: #1b6d85;position:inherit ">

    <section class="course_details_info">
        <div class="course_contant_info">
            <form action="" method="post">
                <!--<input type="submit" name="submitdept" value="List by DEPT.">-->
                <select name="dept" style="margin-right: 5%;padding: 1%;margin-bottom: 2%">
                    <option disabled selected>Select a Department</option>
                    <option>CSE</option>
                    <option>BBA</option>
                    <option>English</option>
                    <option>Hotel Management and turisum</option>
                </select>

                <input type="submit" name="submitdeptandlvltrm" value="FILTER DATA">

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
                <!--<input type="submit" name="submitlvltrm" value="List by Level&Term">-->

            </form>

            <form action="" method="post">
                <!--<input type="submit" name="csubmit" value="take course">-->
                <table class="course_table_info">
                    <tbody>
                    <tr>
                        <th>Department</th>
                        <th>Level&Term</th>
                        <th>Course Code</th>
                        <th>Course Title</th>

                        <th>Cedit</th>
                        <th>Section</th>
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
							  <td>{$maincoursedept}</td>
							  <td>{$maincourselvltrm}</td>
						<td>{$maincoursecode}</td>
						<td>{$maincoursetitle}</td>
						
						<td>{$maincoursecredit}</td>
						
						<td>";
                                for ($i = 0; $i < sizeof($sectionarr); $i++) {
                                    $ofcourseIdquery = "select id from offeredcourse WHERE courseid={$ci} AND section='{$sectionarr[$i]}' ;";
                                    $ofcourseIdqueryresult = mysqli_query($connection, $ofcourseIdquery);
                                    while ($ofcrow = mysqli_fetch_assoc($ofcourseIdqueryresult)) {
                                        $ofcourseId = $ofcrow['id'];
                                    }

                                    echo "<input type=\"checkbox\" name=\"takecourse[]\" value=\"{$ofcourseId}\" class=\"course_radio\">{$sectionarr[$i]}<br>";
                                }
                                echo "</td>

					  </tr>

					  ";
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
                            $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci};";
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
							  <td>{$maincoursedept}</td>
							  <td>{$maincourselvltrm}</td>
						<td>{$maincoursecode}</td>
						<td>{$maincoursetitle}</td>
						
						<td>{$maincoursecredit}</td>
						
						<td>";
                                for ($i = 0; $i < sizeof($sectionarr); $i++) {
                                    $ofcourseIdquery = "select id from offeredcourse WHERE courseid={$ci} AND section='{$sectionarr[$i]}' ;";
                                    $ofcourseIdqueryresult = mysqli_query($connection, $ofcourseIdquery);
                                    while ($ofcrow = mysqli_fetch_assoc($ofcourseIdqueryresult)) {
                                        $ofcourseId = $ofcrow['id'];
                                    }

                                    echo "<input type=\"checkbox\" name=\"takecourse[]\" value=\"{$ofcourseId}\" class=\"course_radio\">{$sectionarr[$i]}<br>";
                                }
                                echo "</td>

					  </tr>

					  ";
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
							  <td>{$maincoursedept}</td>
							  <td>{$maincourselvltrm}</td>
						<td>{$maincoursecode}</td>
						<td>{$maincoursetitle}</td>
						
						<td>{$maincoursecredit}</td>
						
						<td>";
                                for ($i = 0; $i < sizeof($sectionarr); $i++) {
                                    $ofcourseIdquery = "select id from offeredcourse WHERE courseid={$ci} AND section='{$sectionarr[$i]}' ;";
                                    $ofcourseIdqueryresult = mysqli_query($connection, $ofcourseIdquery);
                                    while ($ofcrow = mysqli_fetch_assoc($ofcourseIdqueryresult)) {
                                        $ofcourseId = $ofcrow['id'];
                                    }

                                    echo "<input type=\"checkbox\" name=\"takecourse[]\" value=\"{$ofcourseId}\" class=\"course_radio\">{$sectionarr[$i]}<br>";
                                }
                                echo "</td>

					  </tr>

					  ";
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
							  <tr><td>{$maincoursedept}</td>
							  <td>{$maincourselvltrm}</td>
						<td>{$maincoursecode}</td>
						<td>{$maincoursetitle}</td>
						
						<td>{$maincoursecredit}</td>
						
						<td>";
                                for ($i = 0; $i < sizeof($sectionarr); $i++) {
                                    $ofcourseIdquery = "select id from offeredcourse WHERE courseid={$ci} AND section='{$sectionarr[$i]}' ;";
                                    $ofcourseIdqueryresult = mysqli_query($connection, $ofcourseIdquery);
                                    while ($ofcrow = mysqli_fetch_assoc($ofcourseIdqueryresult)) {
                                        $ofcourseId = $ofcrow['id'];
                                    }

                                    echo "<input type=\"checkbox\" name=\"takecourse[]\" value=\"{$ofcourseId}\" class=\"course_radio\">{$sectionarr[$i]}<br>";
                                }
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
        </div>
    </section>

</section>
























</body>
</html>
