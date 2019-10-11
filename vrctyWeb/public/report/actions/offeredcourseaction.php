<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; Filename= OfferedCourseDetails.doc");
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
$dept = $available = $no = $lvltrm = "";
?>
<?php require_once("../../../includes/db_connection.php"); ?>


<?php

if (!empty($_POST['dept'])) {
    $dept = $_POST['dept'];
    if (!empty($_POST['available'])) {
        $available = $_POST['available'];
    }
    if (!empty($_POST['no'])) {
        $no = $_POST['no'];
    }
    if (!empty($_POST['levelterm'])) {
        $lvltrm = $_POST['levelterm'];
    }


} else {
    echo "<div align='center'>
<a href='../pages/offeredcourse.php'><input style='font-size: 200%' type='button' value='go back and select DEPT.'></a>

</div>";
}

?>


<html>
<head>
    <style>
        table, td, th {
            padding: 1%;
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: auto;
        }

        th {
            height: 50px;
        }
    </style>
    <title>

    </title>
</head>
<?php
$header=$title=$footer="";
if (!empty($_POST['header'])){
    $header=$_POST['header'];
}else{
    $header="Daffodil International University<br>
            Asulia,Savar,Dhaka-1341<br>
            Faculty of Science & Information Technology<br>
            {$semestercode}";
}
if (!empty($_POST['title'])){
    $title=$_POST['title'];
}else{
    $title="Course Offer";
}
if (!empty($_POST['footer'])){
    $footer=$_POST['footer'];
}else{
    $footer="END";
}
?>

<body>
<div align="center">
    <div>

        <img src="logo/diulogo.png">
        <h4 align="center">
            <?php echo $header; ?>
        </h4>
        <h3 align="center"><?php echo $title; ?></h3>
    </div>
<table >
    <tr >
        <th >Level&Term</th>
        <th >Course Code</th>
        <th >Course Title</th>
        <th >Credit</th>
        <th >Sections</th>
    </tr>
<?php
$ava = "not offered";
$arrsection = array();
if (!empty($dept)) {
    $arraylvltrm = array("L1T1", "L1T2", "L1T3", "L2T1", "L2T2", "L2T3", "L3T1", "L3T2", "L3T3", "L4T1", "L4T2", "L4T3");

    foreach ($arraylvltrm as $class) {
        $query = "select * from allcourses WHERE dept='{$dept}' AND levelterm='{$class}'";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $lelevterm = $row['levelterm'];
            $coursecode = $row['coursecode'];
            $coursetitle = $row['coursetitle'];
            $credit = $row['credit'];
            $query2 = "select * from offeredcourse WHERE courseid={$id} AND semester='{$semestercode}'";
            $result2 = mysqli_query($connection, $query2);
            $arrsection = array();
            $count = 0;
            $ava="not offered";
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $courseid = $row2['courseid'];
                $arrsection[$count] = $row2['section'];
                $semester = $row2['semester'];
                $availability = $row2['availability'];
                if ($availability == "no") {
                    $availability = "(N)";
                    $arrsection[$count].=$availability;
                } elseif ($availability == "available") {
                    $availability = "(Y)";
                    $arrsection[$count].=$availability;
                } else {
                    $availability = "(nu'')";
                    $arrsection[$count].=$ava;
                }
                $count++;
            }
            echo "
               
                <tr >
                <td >{$class}</td>
                <td >{$coursecode}</td>
                <td >{$coursetitle}</td>
                <td >{$credit}</td>
                <td>";

            for ($i = 0; $i < sizeof($arrsection); $i++) {
                echo "{$arrsection[$i]} , ";
            }

            echo "</td></tr>";
        }
        $arrsection == null;

    }
}


?>
</table>
    <h4 align="center" style="margin: 2%"><?php echo $footer; ?></h4>
</div>

</body>


</html>
