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
<section >
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



<div style="background-color: #d4ffda;float: left;width: 20%;height: 100%;border: solid;border-color: #1b6d85;position: fixed">

    <section >
        <ul >
            <a href="offeredcourse.php"><li style="margin: 5%">Offered course</li></a>
            <a href="teacherinformation.php"><li style="margin: 5%">Teacher Information</li></a>
            <a href="teacherandcourseinfo.php"><li style="margin: 5%">Teacher and course Information</li></a>
            <a href="courseoutline.php"><li style="margin: 5%">Course Outline</li></a>
            <a href="crinfo.php"><li style="margin: 5%">CR Information</li></a>
            <a href="classsizeinfo.php"><li style="margin: 5%">Class Size Information</li></a>
            <a href="dayoffinfo.php"><li style="margin: 5%">Day off information</li></a>

        </ul>

    </section>

</div>








<section style="background-color: #b4c7ff;float: right;width: 79%;height: 100%;border: solid;border-color: #1b6d85;position:inherit ">


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

                <select name="levelterm" style="margin-left: 5%;padding: 1%;margin-bottom: 2%" >
                    <option disabled selected>Select Level & Term</option>
                    <option>L1T1</option><option>L1T2</option><option>L1T3</option>
                    <option>L2T1 </option><option>L2T2 </option><option>L2T3 </option>
                    <option>L3T1 </option><option>L3T2 </option><option>L3T3 </option>
                    <option>L4T1 </option><option>L4T2 </option><option>L4T3 </option>
                </select>
                <!--<input type="submit" name="submitlvltrm" value="List by Level&Term">-->

            </form>
            <form action="../actions/crinfoaction.php" method="post">

                    <div style="float: right;margin: 1%">
                        <input type="submit" name="coursesubmit" value="GENERATE">
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
                                $id= $row['id'];
                                $dept = $row['dept'];
                                $lvtr = $row['levelterm'];
                                $cocode = $row['coursecode'];
                                $cotitle = $row['coursetitle'];
                                $credit = $row['credit'];

                                echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                            }
                        }elseif (!empty($deprtmnt)) {
                            $selectallcoursequery = "SELECT * FROM allcourses WHERE dept='{$deprtmnt}' ORDER BY levelterm;";
                            $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                            while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                                $id= $row['id'];
                                $dept = $row['dept'];
                                $lvtr = $row['levelterm'];
                                $cocode = $row['coursecode'];
                                $cotitle = $row['coursetitle'];
                                $credit = $row['credit'];

                                echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                            }
                        }elseif (!empty($levelterm)) {
                            $selectallcoursequery = "SELECT * FROM allcourses WHERE levelterm='{$levelterm}' ORDER BY levelterm;";
                            $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                            while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                                $id= $row['id'];
                                $dept = $row['dept'];
                                $lvtr = $row['levelterm'];
                                $cocode = $row['coursecode'];
                                $cotitle = $row['coursetitle'];
                                $credit = $row['credit'];

                                echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                            }
                        } else {
                            $selectallcoursequery = "SELECT * FROM allcourses ORDER BY dept,levelterm;";
                            $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                            while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                                 $id= $row['id'];
                                $dept = $row['dept'];
                                $lvtr = $row['levelterm'];
                                $cocode = $row['coursecode'];
                                $cotitle = $row['coursetitle'];
                                $credit = $row['credit'];

                                echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                            }
                        }


                        ?>

                        </tbody>
                    </table>
                </section>



            </form>

        </div>
    </section>




</body>
</html>
