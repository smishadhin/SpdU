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
<?php
$samesec="";
if (isset($_POST['coursesubmit'])) {
    // if (!empty($_POST['dept'])) {
    if (!empty($_POST['sections'])) {
        //$selectedsection = $_POST['section'];
        $sectionarr = array();
    } else {
        $errselectedsection = "<span style='color: red;'>select section</span>";
    }
    if (!empty($_POST['course']) && !empty($_POST['sections'])) {
        foreach ($_POST['course'] as $check) {
            //echo $check;
            $courseid = $check;
            foreach ($_POST['sections'] as $selectedsection) {
                //echo $selectedsection."<br>";

                $samecourseinsertquery = "select section from offeredcourse WHERE courseid={$courseid} AND semester='{$semestercode}' AND section='{$selectedsection}'";
                $samecourseinsertresult = mysqli_query($connection, $samecourseinsertquery);
                while ($samecourseinsertrow = mysqli_fetch_assoc($samecourseinsertresult)) {
                    $samesec = $samecourseinsertrow['section'];
                }
                if ($samesec!=$selectedsection) {
                    $courseinsertquery = "insert into offeredcourse (courseid,section,semester,availability) ";
                    $courseinsertquery .= "VALUES ($courseid,'{$selectedsection}','{$semestercode}','available');";
                    mysqli_query($connection, $courseinsertquery);
                }


            }


        }
    }
    // }
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
    <div class="logo">Admin Panal (<?php echo $semestercode ?>)</div>

    <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
    <li><a href="makecourseoffer.php">Declare course offer</a></li>
    <li><a href="inputallcourses.php">Manage Data</a></li>
    <li><a href="generatereport.php">Generate Report</a></li>
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

            <input type="submit" name="submitdeptandlvltrm" value="FILTER">

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
            <section>
                <section style="margin: 1%">
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-A">PC-A
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-B">PC-B
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-C">PC-C
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-D">PC-D
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-E">PC-E
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-F">PC-F
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-G">PC-G
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-H">PC-H
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-I">PC-I
                    <input style="margin: 1%" type="checkbox" name="sections[]" value="PC-J">PC-J
                    <?php echo "<p style=\"float: right\">{$errselectedsection}</p>" ?>

                </section>
                <div style="float: right;margin: 1%">
                    <input type="submit" name="coursesubmit" value="make offer">
                </div>


                <table class="course_table_info">
                    <tbody>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Department</th>
                        <th>Level&Term</th>
                        <th>Credit</th>

                    </tr>
                    <?php
                    /*if (isset($_POST['submitlvltrm'])) {
                        if (!empty($_POST['levelterm'])) {
                            echo "".$levelterm = $_POST['levelterm'];
                        }
                    }
                    if (isset($_POST['submitdept'])) {
                        if (!empty($_POST['dept'])) {
                            echo "DEPT. of ".$deprtmnt = $_POST['dept'];
                        }
                    }
                    if (isset($_POST['submitdeptandlvltrm'])) {
                        if (!empty($_POST['dept']) && !empty($_POST['levelterm'])) {
                            echo "DEPT. of ".$deprtmnt = $_POST['dept'];
                            echo "\t".$levelterm = $_POST['levelterm'];
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


                    if (!empty($deprtmnt) && !empty($levelterm)) {
                        $selectallcoursequery = "SELECT * FROM allcourses WHERE dept='{$deprtmnt}' AND levelterm='{$levelterm}' ORDER BY levelterm;";
                        $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                        while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                            $id = $row['id'];
                            $dept = $row['dept'];
                            $lvtr = $row['levelterm'];
                            $cocode = $row['coursecode'];
                            $cotitle = $row['coursetitle'];
                            $credit = $row['credit'];
                            $sections = "";
                            $sectionquery = "select section from offeredcourse WHERE courseid={$id} AND semester='{$semestercode}'";
                            $secrslt = mysqli_query($connection, $sectionquery);
                            while ($secrow = mysqli_fetch_assoc($secrslt)) {
                                $sections .= $secrow['section'];
                                $sections .= ",";
                            }
                            echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}: {$sections}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                        }
                    } elseif (!empty($deprtmnt)) {
                        $selectallcoursequery = "SELECT * FROM allcourses WHERE dept='{$deprtmnt}' ORDER BY levelterm;";
                        $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                        while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                            $id = $row['id'];
                            $dept = $row['dept'];
                            $lvtr = $row['levelterm'];
                            $cocode = $row['coursecode'];
                            $cotitle = $row['coursetitle'];
                            $credit = $row['credit'];
                            $sections = "";
                            $sectionquery = "select section from offeredcourse WHERE courseid={$id} AND semester='{$semestercode}' ORDER BY section";
                            $secrslt = mysqli_query($connection, $sectionquery);
                            while ($secrow = mysqli_fetch_assoc($secrslt)) {
                                $sections .= $secrow['section'];
                                $sections .= ",";
                            }
                            echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}: {$sections}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                        }
                    } elseif (!empty($levelterm)) {
                        $selectallcoursequery = "SELECT * FROM allcourses WHERE levelterm='{$levelterm}' ORDER BY levelterm;";
                        $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                        while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                            $id = $row['id'];
                            $dept = $row['dept'];
                            $lvtr = $row['levelterm'];
                            $cocode = $row['coursecode'];
                            $cotitle = $row['coursetitle'];
                            $credit = $row['credit'];
                            $sections = "";
                            $sectionquery = "select section from offeredcourse WHERE courseid={$id} AND semester='{$semestercode}'";
                            $secrslt = mysqli_query($connection, $sectionquery);
                            while ($secrow = mysqli_fetch_assoc($secrslt)) {
                                $sections .= $secrow['section'];
                                $sections .= ",";
                            }

                            echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode} : {$sections}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                        }
                    } else {
                        $sections = "";
                        $selectallcoursequery = "SELECT * FROM allcourses ORDER BY dept,levelterm;";
                        $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                        while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                            $id = $row['id'];
                            $dept = $row['dept'];
                            $lvtr = $row['levelterm'];
                            $cocode = $row['coursecode'];
                            $cotitle = $row['coursetitle'];
                            $credit = $row['credit'];

                            $sections = "";
                            $sectionquery = "select section from offeredcourse WHERE courseid={$id} AND semester='{$semestercode}'";
                            $secrslt = mysqli_query($connection, $sectionquery);
                            while ($secrow = mysqli_fetch_assoc($secrslt)) {
                                $sections .= $secrow['section'];
                                $sections .= ",";
                            }
//echo $sections;


                            echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode} : {$sections}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                        }
                    }


                    ?>
                    <!--            <tr>-->
                    <!--                <td><input type="checkbox" name="course" value="" class="course_radio">CSE111</td>-->
                    <!--                <td>Computer Fundamental</td>-->
                    <!--                <td>CSE</td>-->
                    <!--                <td>L1T1</td>-->
                    <!--                <td>3</td>-->
                    <!---->
                    <!--            </tr>-->
                    </tbody>
                </table>
            </section>


        </form>

    </div>
</section>
</body>
</html>


