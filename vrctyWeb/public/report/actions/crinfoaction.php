<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; Filename= CR Details.doc");
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


<html>
<head>
    <style>
        table, td, th {
            width: inherit;
            padding: 1%;
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: inherit;
        }

        th {
            height: inherit;
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
        <h4><?php echo $header; ?></h4>
        <h3 align="center"><?php echo $title; ?></h3>
    </div>
    <table>
        <tr>
            <th>SL</th>
            <th>Level&Term</th>
            <th>Course Code & title</th>
            <th>Sections</th>
            <th>CR Name</th>
            <th>CR ID</th>
            <th>CR Phone & Email</th>
            <th>Remarks</th>
        </tr>

        <?php
        $crname =$crid =$cremail = $crnum = $massage = "";
        $sl = 0;
        $coursetakenrowid=$offeredcourserowid=0;

        if (!empty($_POST['course'])) {
            foreach ($_POST['course'] as $check) {

                //echo "<br>".$sl.":".$check;
                $courseid = $check;
                $allcoursesquery = "select coursecode,coursetitle,levelterm from allcourses WHERE id={$courseid}";
                $allcoursesresult = mysqli_query($connection, $allcoursesquery);
                while ($allcoursesrow = mysqli_fetch_assoc($allcoursesresult)) {
                    $coursecode = $allcoursesrow['coursecode'];
                    $coursetitle = $allcoursesrow['coursetitle'];
                    $levelterm = $allcoursesrow['levelterm'];
                    //echo "<br>";
                    $offeredcoursequery = "select * from offeredcourse WHERE semester='{$semestercode}' AND availability='no' AND courseid={$courseid}";
                    $offeredcourseresult = mysqli_query($connection, $offeredcoursequery);
                    if ($offeredcourseresult) {
                        while ($offeredcourserow = mysqli_fetch_assoc($offeredcourseresult)) {
                            $sl++;
                             $offeredcourserowid = $offeredcourserow['id'];
                            $section = $offeredcourserow['section'];
                            $coursetakenquery = "select id from coursetaken WHERE offeredcourseid={$offeredcourserowid}";
                            $coursetakenresult = mysqli_query($connection, $coursetakenquery);
                            while ($coursetakenrow = mysqli_fetch_assoc($coursetakenresult)) {
                                 $coursetakenrowid = $coursetakenrow['id'];
                                $coursedetailsquery = "select crname,crid,cremail,crnum from coursedetails WHERE coursetaken={$coursetakenrowid}";
                                $coursedetailsresult = mysqli_query($connection, $coursedetailsquery);
                               // echo "empty= ".!empty($coursedetailsresult);
                                while ($coursedetailsrow = mysqli_fetch_assoc($coursedetailsresult)) {
                                     $crname = $coursedetailsrow['crname'];
                                   // echo "<br>";
                                    $crid = $coursedetailsrow['crid'];
                                    $cremail = $coursedetailsrow['cremail'];
                                    $crnum = $coursedetailsrow['crnum'];
                                    echo "
                    <tr>
                    <td>{$sl}</td>
                    <td>{$levelterm}</td>
                    <td>{$coursecode} : {$coursetitle}</td>
                    <td>{$section}</td>
                    <td>{$crname}</td>
                    <td>{$crid}</td>
                    <td>{$crnum}<br>{$cremail}</td>
                    <td></td></tr>";
                                }
                            }
                            }


                    } else {
                        $massage = "course is not taken";
                    }




                }


            }
        }


        ?>


    </table><br><br>
    <h4 align="center" style="margin: 2%"><?php echo $footer; ?></h4>
</div>

</body>


</html>
