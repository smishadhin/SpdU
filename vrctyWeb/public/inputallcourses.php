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

if (isset($_GET['status'])) {
    if ($_GET['status'] == "succed") {
        $msg = "input success";
    } elseif ($_GET['status'] == "faild") {
        $msg = "input faild";
    }elseif ($_GET['status'] == "succedp") {
        $msg = "data saved of the filled boxes";
    }

}

?>

<?php
$semestercode = semestercode();

//if (isset($_GET['id'])) {
//    $adminID = $_GET['id'];
//} else {
//    redirect_to("index.php");
//}

?>

<?php require_once("../includes/db_connection.php"); ?>


<?php

$department = $levelterm =   "";
$coursecodearr = $coursetitlearr = $creditarr = array();
$count1=$count2=$count3=0;
$errdepartment = $errlevelterm = $errcoursecode = $errcoursetitle = $errsection = $errcredit = "";
if (!empty($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!empty($_POST['department'])) {
            $department = ($_POST['department']);
        } else {
            $errdepartment = "<span style='color:red'>can not be empty</span>";
        }

        if (!empty($_POST['levelterm'])) {
            $levelterm = ($_POST['levelterm']);
        } else {
            $errlevelterm = "<span style='color:red'>can not be empty</span>";
        }

        if (!empty($_POST['coursecode'])) {
            // $coursecode = ($_POST['coursecode']);
            foreach ($_POST['coursecode'] as $cc) {
                $coursecodearr[] = $cc;
                $count1++;
            }

        } else {
            $errcoursecode = "<span style='color:red'>can not be empty</span>";
        }

        if (!empty($_POST['coursetitle'])) {
            // $coursetitle = ($_POST['coursetitle']);
            foreach ($_POST['coursetitle'] as $ct) {
                $coursetitlearr[] = $ct;
                $count2++;
            }
        } else {
            $errcoursetitle = "<span style='color:red'>can not be empty</span>";
        }

        if (!empty($_POST['credit'])) {
            foreach ($_POST['credit'] as $cr) {
                if (is_numeric($cr)) {
                    $creditarr[] = $cr;
                    $count3++;
                }

            }


//        if (is_numeric($_POST['credit'])) {
//           // $credit = ($_POST['credit']);
//        }else {
//            $errcredit = "<span style='color:red'>can not be empty & must be a number</span>";
//        }
        } else {
            $errcredit = "<span style='color:red'>can not be empty & must be a number</span>";
        }

    }
}

?>


<?php
if (!empty($_POST['submit'])){
    if (!empty($department) && !empty($levelterm) && !empty($coursecodearr) && !empty($coursetitlearr) && !empty($creditarr)) {
        $allstatus = false;
        $stat = false;

        for ($i = 0; $i < 7; $i++) {
            if (!empty($department) && !empty($levelterm) && !empty($coursecodearr[$i]) && !empty($coursetitlearr[$i]) && !empty($creditarr[$i])) {
                echo $query = "insert into allcourses (dept,levelterm,coursecode,coursetitle,credit) ";
                $query .= "VALUES ('{$department}','{$levelterm}','{$coursecodearr[$i]}','{$coursetitlearr[$i]}','{$creditarr[$i]}')";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    //redirect_to("inputallcourses.php");
                    redirect_to("inputallcourses.php?status=faild");
                } else {
                    $allstatus = true;
//        redirect_to("inputallcourses.php?status=faild");
                }

            } else {
                $stat = true;

            }
        }
       // redirect_to("inputallcourses.php?status=succed");
    }

    if ($stat=true){
        redirect_to("inputallcourses.php?status=succedp");
    }else{

    }
    if ($allstatus=true){
        redirect_to("inputallcourses.php?status=succed");
    }else{
        redirect_to("inputallcourses.php?status=faild");
    }
}
//if (!empty($department) && !empty($levelterm) && !empty($coursecode) && !empty($coursetitle) && !empty($credit)) {
//
//
//    $query = "insert into allcourses (dept,levelterm,coursecode,coursetitle,credit) ";
//    $query .= "VALUES ('{$department}','{$levelterm}','{$coursecode}','{$coursetitle}','{$credit}')";
//    $result = mysqli_query($connection, $query);
//    if ($result) {
//        redirect_to("inputallcourses.php?status=succed");
//    } else {
//        redirect_to("inputallcourses.php?status=faild");
//    }
//
//}


?>

<?php

if (!empty($_POST['csubmit'])){

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['csubmit'])) {
            if (!empty($_POST['takecourse'])) {
                foreach ($_POST['takecourse'] as $takecourse) {
                    echo $takecourse;
                    /*$takecoursequery = "insert into coursetaken (offeredcourseid,tcemid) VALUES ({$takecourse},'{$teacheremid}');";
                    mysqli_query($connection, $takecoursequery);
                    $courseInfoquery = "select id from coursetaken WHERE tcemid='{$teacheremid}' AND offeredcourseid={$takecourse}";
                    $courseInforesult = mysqli_query($connection, $courseInfoquery);
                    while ($courseInforow = mysqli_fetch_assoc($courseInforesult)) {
                        echo " , " . $courserowid = $courseInforow['id'];
                        $coursedetailidinsertionquery = "insert into coursedetails (emid,coursetaken) VALUES ('{$teacheremid}',{$courserowid})";
                        mysqli_query($connection, $coursedetailidinsertionquery);
                    }
                    $ofcourseupquery = "update offeredcourse set availability='no' WHERE id={$takecourse}";
                    mysqli_query($connection, $ofcourseupquery);*/
                    $ofcourseupquery = "Delete from offeredcourse WHERE id={$takecourse}";
                    mysqli_query($connection, $ofcourseupquery);
                }

            }
            redirect_to("inputallcourses.php");
        }
    }
}



?>





<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- Designed by: Md. Golam Maulla -->
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
<!--    <li><a href="teacherlistforadmin.php">Give Course Offer</li>-->
    <li><a href="makecourseoffer.php">Declare course offer</a></li>
    <li><a href="inputallcourses.php">Manage Data</a></li>
    <li><a href="generatereport.php">Generate Report</a></li>
    <li><a href="logout.php">Logout</a></li>

</ul>


<section>
    <div>
        <div >
            <h3><?php
                echo $msg;
                ?></h3>
            <!--                <td>-->
            <!--                    <input type="button" name="back" value="back"/>-->
            <!--                <td>-->
           <div align="center" style="width: 100%;"> <fieldset class="shadhin" style="display: inline-block;background: #b4c7ff">
                <legend>Input Details</legend>
                <form action="" method="post">
                    <table class="offer_course_details">
                        <tr style="margin: ;padding: ">
                                <select name="department" style="margin: 1%;margin-right: 10%;padding: 1%;margin-bottom: 5%">
                                    <option disabled selected >Select a Department</option>
                                    <option>CSE</option>
                                    <option>BBA</option>
                                    <option>English</option>
                                    <option>Hotel Management and turisum</option>
                                </select><?php echo $errdepartment ?>
                        </tr><br>

                        <tr><select name="levelterm" style="" >
                                    <option disabled selected>Select Level & Term</option>
                                    <option>L1T1</option><option>L1T2</option><option>L1T3</option>
                                    <option>L2T1 </option><option>L2T2 </option><option>L2T3 </option>
                                    <option>L3T1 </option><option>L3T2 </option><option>L3T3 </option>
                                    <option>L4T1 </option><option>L4T2 </option><option>L4T3 </option>
                                </select><?php echo $errlevelterm ?><br><br>
                        </tr>

                        <tr>
                            <td >
                                <input

                                    type="text" name="coursecode[]" size="10"
                                       placeholder="Course code"/><?php echo $errcoursecode ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="coursetitle[]"
                                       placeholder="Course Title"/><?php echo $errcoursetitle ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="credit[]" size="2"
                                       placeholder="Credit "/><?php echo $errcredit ?>
                            </td>
                        </tr>

                        <tr>
                            <td >
                                <input

                                       type="text" name="coursecode[]" size="10"
                                       placeholder="Course code"/><?php echo $errcoursecode ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="coursetitle[]"
                                       placeholder="Course Title"/><?php echo $errcoursetitle ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="credit[]" size="2"
                                       placeholder="Credit "/><?php echo $errcredit ?>
                            </td>
                        </tr>

                        <tr>
                            <td >
                                <input

                                       type="text" name="coursecode[]" size="10"
                                       placeholder="Course code"/><?php echo $errcoursecode ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="coursetitle[]"
                                       placeholder="Course Title"/><?php echo $errcoursetitle ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="credit[]" size="2"
                                       placeholder="Credit "/><?php echo $errcredit ?>
                            </td>
                        </tr>

                        <tr>
                            <td >
                                <input

                                       type="text" name="coursecode[]" size="10"
                                       placeholder="Course code"/><?php echo $errcoursecode ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="coursetitle[]"
                                       placeholder="Course Title"/><?php echo $errcoursetitle ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="credit[]" size="2"
                                       placeholder="Credit "/><?php echo $errcredit ?>
                            </td>
                        </tr>

                        <tr>
                            <td >
                                <input

                                       type="text" name="coursecode[]" size="10"
                                       placeholder="Course code"/><?php echo $errcoursecode ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="coursetitle[]"
                                       placeholder="Course Title"/><?php echo $errcoursetitle ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="credit[]" size="2"
                                       placeholder="Credit "/><?php echo $errcredit ?>
                            </td>
                        </tr>

                        <tr>
                            <td >
                                <input

                                       type="text" name="coursecode[]" size="10"
                                       placeholder="Course code"/><?php echo $errcoursecode ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="coursetitle[]"
                                       placeholder="Course Title"/><?php echo $errcoursetitle ?>
                            </td>
                            <td>
                                <input
                                       type="text" name="credit[]" size="2"
                                       placeholder="Credit "/><?php echo $errcredit ?>
                            </td>
                        </tr>

                        <tr>

                        </tr>
                        <tr>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" value="Submit"/>
                            <td>

                            </td>
                            </td>
                            <td>

                            <td>
                                <a href="inputallcourses.php"><input type="button"
                                                                                                  name="cancel"
                                                                                                  value="cancel"/></a>
                            </td>
                            </td>

                            <td>

                            <td>
                                <a href="admin.php?<?php echo $_SESSION['id'] ?>"><input type="button" name="cancel"
                                                                                         value="back"/></a>
                            </td>
                            </td>

                        </tr>
                    </table>
                </form>
            </fieldset>
           </div>


            <div align="center" style="margin-top: 5% ;background-color: #2b542c;width: 100%;border:double;border-color: #0303ff">



                <section class="course_details_info">
                    <h1>REMOVE COURSE OFFER</h1>
                    <div class="course_contant_info">
                        <form action="" method="post">
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
                        </form>

                        <form action="" method="post">
                            <input style="margin-bottom: 1%" type="submit" name="csubmit" value="REMOVE COURSE OFFER"><br>
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


                                    $courseretvquery = "select courseid from offeredcourse WHERE  semester='{$semestercode}';";
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

                                    $courseretvquery = "select courseid from offeredcourse WHERE  semester='{$semestercode}';";
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

            </div>

        </div>
    </div>
</section>


</body>
</html>





