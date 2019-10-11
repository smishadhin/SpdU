<?php require_once("../includes/functions.php"); ?>
<?php
session_start();
$msgwithcourse = $status = $cc = "";
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
    $teacherselfid = $_GET['id'];

}

if (isset($_GET['status']) && isset($_GET['cc'])) {
    $status = $_GET['status'];
    $cc = $_GET['cc'];
    if ($status == "success") {
        $msgwithcourse = "<p style='color: green'>{$cc}  submit success</p>";
    } else {
        $msgwithcourse = "<p style='color: red'> submit success</p>";
    }
}


$semestercode = semestercode();

$teacheremid = "";
?>

<?php require_once("../includes/db_connection.php"); ?>
<?php
$getteacheremidquery = "select emid from users where id={$teacherselfid};";
$getteacheremid = mysqli_query($connection, $getteacheremidquery);
while ($inforow = mysqli_fetch_assoc($getteacheremid)) {
    $teacheremid = $inforow['emid'];
}

?>

<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['csubmit'])) {
        if (!empty($_POST['takecourse'])) {
            foreach ($_POST['takecourse'] as $takecourse) {
                echo $takecourse;
                $takecoursequery = "insert into coursetaken (offeredcourseid,tcemid) VALUES ({$takecourse},'{$teacheremid}');";
                mysqli_query($connection, $takecoursequery);
                $courseInfoquery = "select id from coursetaken WHERE tcemid='{$teacheremid}' AND offeredcourseid={$takecourse}";
                $courseInforesult = mysqli_query($connection, $courseInfoquery);
                while ($courseInforow = mysqli_fetch_assoc($courseInforesult)) {
                    echo " , " . $courserowid = $courseInforow['id'];
                    $coursedetailidinsertionquery = "insert into coursedetails (emid,coursetaken) VALUES ('{$teacheremid}',{$courserowid})";
                    mysqli_query($connection, $coursedetailidinsertionquery);
                }
                $ofcourseupquery = "update offeredcourse set availability='no' WHERE id={$takecourse}";
                mysqli_query($connection, $ofcourseupquery);

            }

        }
        redirect_to("allofferedcourse.php?id={$teacherselfid}");
    }
}

?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- Designed by: Md. Golam Maulla -->
<head>
    <title>Home</title>
    <!-- Main CSS -->
    <link href="css/stylect.css" rel="stylesheet" media="screen" type="text/css"/>
    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet" media="screen" type="text/css"/>
    <link rel="stylesheet" href="styleadmin.css"/>

</head>
<body>
<ul class="nav">
    <div class="logo">Teacher Panal (<?php echo $semestercode ?>)</div>

    <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
    <li><a href="allofferedcourse.php?id=<?php echo $_GET['id'] ?>">Offered course</li>
    <li>
        <a href="viewandupdatecoursedetailforteacher.php?emid=<?php echo $teacheremid ?>&id=<?php echo $teacherselfid ?>">Course
            Details</li>
    <li><a href="logout.php">Logout</a></li>

</ul>
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
            <input type="submit" name="csubmit" value="take course">
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
                /*if (isset($_POST['submitlvltrm'])) {
                    if (!empty($_POST['levelterm'])) {
                        echo "" . $levelterm = $_POST['levelterm'];
                    }
                }
                if (isset($_POST['submitdept'])) {
                    if (!empty($_POST['dept'])) {
                        echo "DEPT. of " . $deprtmnt = $_POST['dept'];
                    }
                }
                if (isset($_POST['submitdeptandlvltrm'])) {
                    if (!empty($_POST['dept']) && !empty($_POST['levelterm'])) {
                        echo "DEPT. of " . $deprtmnt = $_POST['dept'];
                        echo "\t" . $levelterm = $_POST['levelterm'];
                    }
                }*/

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


                    $courseretvquery = "select courseid from offeredcourse WHERE availability='available';";
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
                        $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci} AND availability='available';";
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


                    /*$courseretvquery = "select * from offeredcourse WHERE availability='available';";
                    $courseretvrslt = mysqli_query($connection, $courseretvquery);
                    while ($cinforow = mysqli_fetch_assoc($courseretvrslt)) {
                        $ofcourseId = $cinforow['id'];
                        $maincourseID = $cinforow['courseid'];
                        $ofsection = $cinforow['section'];
                        $ofsemester = $cinforow['semester'];
                        $ofavailibility = $cinforow['availability'];

                        $maincourseinfoquery = "select * from allcourses WHERE id={$maincourseID} AND dept='{$deprtmnt}'AND levelterm='{$levelterm}'";
                        $maincourseinforslt = mysqli_query($connection, $maincourseinfoquery);
                        while ($maincourseinforow = mysqli_fetch_assoc($maincourseinforslt)) {
                            $maincoursedept = $maincourseinforow['dept'];
                            $maincourselvltrm = $maincourseinforow['levelterm'];
                            $maincoursecode = $maincourseinforow['coursecode'];
                            $maincoursetitle = $maincourseinforow['coursetitle'];
                            $maincoursecredit = $maincourseinforow['credit'];

                            echo "
							  <tr>
						<td>{$maincoursecode}</td>
						<td>{$maincoursetitle}</td>
						<td>{$maincoursedept}</td>						
						<td>{$maincoursecredit}</td>
						<td>{$maincourselvltrm}</td>
						<td><input type=\"checkbox\" name=\"takecourse[]\" value=\"{$ofcourseId}\" class=\"course_radio\">{$ofsection}</td>
						
					  </tr>
					  
					  ";
                        }
                    }*/
                } elseif (!empty($deprtmnt)) {


                    $courseretvquery = "select courseid from offeredcourse WHERE availability='available';";
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
                        $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci} AND availability='available';";
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


                    /*$courseretvquery = "select * from offeredcourse WHERE availability='available';";
                    $courseretvrslt = mysqli_query($connection, $courseretvquery);
                    while ($cinforow = mysqli_fetch_assoc($courseretvrslt)) {
                        $ofcourseId = $cinforow['id'];
                        $maincourseID = $cinforow['courseid'];
                        $ofsection = $cinforow['section'];
                        $ofsemester = $cinforow['semester'];
                        $ofavailibility = $cinforow['availability'];

                        $maincourseinfoquery = "select * from allcourses WHERE id={$maincourseID} AND dept='{$deprtmnt}';";
                        $maincourseinforslt = mysqli_query($connection, $maincourseinfoquery);
                        while ($maincourseinforow = mysqli_fetch_assoc($maincourseinforslt)) {
                            $maincoursedept = $maincourseinforow['dept'];
                            $maincourselvltrm = $maincourseinforow['levelterm'];
                            $maincoursecode = $maincourseinforow['coursecode'];
                            $maincoursetitle = $maincourseinforow['coursetitle'];
                            $maincoursecredit = $maincourseinforow['credit'];

                            echo "
							  <tr>
						<td>{$maincoursecode}</td>
						<td>{$maincoursetitle}</td>
						<td>{$maincoursedept}</td>						
						<td>{$maincoursecredit}</td>
						<td>{$maincourselvltrm}</td>
						<td><input type=\"checkbox\" name=\"takecourse[]\" value=\"{$ofcourseId}\" class=\"course_radio\">{$ofsection}</td>
						
					  </tr>
					  
					  ";
                        }
                    }*/
                } elseif (!empty($levelterm)) {

                    $courseretvquery = "select courseid from offeredcourse WHERE availability='available';";
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
                        $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci} AND availability='available';";
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


                    /*$courseretvquery = "select * from offeredcourse WHERE availability='available';";
                    $courseretvrslt = mysqli_query($connection, $courseretvquery);
                    while ($cinforow = mysqli_fetch_assoc($courseretvrslt)) {
                        $ofcourseId = $cinforow['id'];
                        $maincourseID = $cinforow['courseid'];
                        $ofsection = $cinforow['section'];
                        $ofsemester = $cinforow['semester'];
                        $ofavailibility = $cinforow['availability'];

                        $maincourseinfoquery = "select * from allcourses WHERE id={$maincourseID} AND levelterm='{$levelterm}'";
                        $maincourseinforslt = mysqli_query($connection, $maincourseinfoquery);
                        while ($maincourseinforow = mysqli_fetch_assoc($maincourseinforslt)) {
                            $maincoursedept = $maincourseinforow['dept'];
                            $maincourselvltrm = $maincourseinforow['levelterm'];
                            $maincoursecode = $maincourseinforow['coursecode'];
                            $maincoursetitle = $maincourseinforow['coursetitle'];
                            $maincoursecredit = $maincourseinforow['credit'];

                            echo "
							  <tr>
						<td>{$maincoursecode}</td>
						<td>{$maincoursetitle}</td>
						<td>{$maincoursedept}</td>						
						<td>{$maincoursecredit}</td>
						<td>{$maincourselvltrm}</td>
						<td><input type=\"checkbox\" name=\"takecourse[]\" value=\"{$ofcourseId}\" class=\"course_radio\">{$ofsection}</td>
						
					  </tr>
					  
					  ";
                        }
                    }*/
                } else {

                    $courseretvquery = "select courseid from offeredcourse WHERE availability='available';";
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
                        $sectionselectquery = "select section from offeredcourse WHERE courseid={$ci} AND availability='available';";
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


                    /*           $courseretvquery = "select * from offeredcourse WHERE availability='available';";
                              //$courseretvquery = "select id,courseid from offeredcourse WHERE availability='available';";
                              $courseretvrslt = mysqli_query($connection, $courseretvquery);
                              while ($cinforow = mysqli_fetch_assoc($courseretvrslt)) {
                                  $ofcourseId = $cinforow['id'];
                                  $maincourseID = $cinforow['courseid'];
                                  $ofsection = $cinforow['section'];
                                  $ofsemester = $cinforow['semester'];
                                  $ofavailibility = $cinforow['availability'];

                                  $sectionselectquery = "select section from offeredcourse WHERE availability='available' AND id={$ofcourseId} AND courseid={$maincourseID};";
                                  $sectionselectresult = mysqli_query($connection, $sectionselectquery);
                                  while ($secrow = mysqli_fetch_assoc($sectionselectresult)) {
                                      echo $sectionarr[]=$secrow['section'];
                                  }




                                  $maincourseinfoquery = "select * from allcourses WHERE id={$maincourseID};";
                                  $maincourseinforslt = mysqli_query($connection, $maincourseinfoquery);
                                  while ($maincourseinforow = mysqli_fetch_assoc($maincourseinforslt)) {
                                      $maincoursedept = $maincourseinforow['dept'];
                                      $maincourselvltrm = $maincourseinforow['levelterm'];
                                      $maincoursecode = $maincourseinforow['coursecode'];
                                      $maincoursetitle = $maincourseinforow['coursetitle'];
                                      $maincoursecredit = $maincourseinforow['credit'];

                                      echo "
                                        <tr>
                                  <td>{$maincoursecode}</td>
                                  <td>{$maincoursetitle}</td>
                                  <td>{$maincoursedept}</td>
                                  <td>{$maincoursecredit}</td>
                                  <td>{$maincourselvltrm}</td>
                                  <td>";
                                  //for ($i=0;$i<11;$i++){
                                      echo "<input  type=\"checkbox\" name=\"takecourse[]\" value=\"{
                                          $ofcourseId}\" class=\"course_radio\">{$ofsection} <br>";
                                 // }
                                  echo "</td>

                                </tr>

                                ";
                                  }
                              }*/

                }


                ?>

                </tbody>
            </table>
        </form>
    </div>
</section>
</body>
</html>



