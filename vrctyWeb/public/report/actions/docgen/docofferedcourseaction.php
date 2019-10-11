<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; Filename= teacher.doc");
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
    <title>

    </title>
</head>


<body>

<table style="border: groove;border-collapse: collapse">
    <tr style="border: groove">
        <th style="border: groove">Level&Term</th>
        <th style="border: groove">Course Code</th>
        <th style="border: groove">Course Title</th>
        <th style="border: groove">Credit</th>
        <th style="border: groove">Sections</th>
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
               
                <tr style=\"border: groove\">
                <td style=\"border: groove\">{$class}</td>
                <td style=\"border: groove\">{$coursecode}</td>
                <td style=\"border: groove\">{$coursetitle}</td>
                <td style=\"border: groove\">{$credit}</td>
                <td style=\"border: groove\">";

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

</body>


</html>
