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
?>
<?php require_once("../../../includes/db_connection.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title></title>

</head>
<body >



<section>




    <div>

            <section >
                <div >
                    <table style="border: groove;border-collapse: collapse">
                        <tbody>
                        <tr style="border: groove">
                            <th style="border: groove" >Name</th>
                            <th style="border: groove">Initial</th>
                            <th style="border: groove">Designation</th>
                            <th style="border: groove">Mobile</th>
                            <th style="border: groove">Email</th>
                        </tr>


                        <?php
                        $deprtmnt="";
                        if (isset($_POST['submit'])) {
                            if (!empty($_POST['teachers'])) {
                                foreach ($_POST['teachers'] as $te){
                                    if (!empty($te)) {
                                        $collectInfoquery = "SELECT title,firstname,lastname,initial,designation,email,mobile FROM users WHERE emid='{$te}';";
                                        $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
                                        while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
                                            $tctitle = $collectInforow['title'];
                                            $tcfirstname = $collectInforow['firstname'];
                                            $tclastname = $collectInforow['lastname'];
                                            $tcinitial = $collectInforow['initial'];
                                            //$tcdepartment = $collectInforow['department'];
                                            //$tcfaculty = $collectInforow['faculty'];
                                            //$tccampus = $collectInforow['campus'];
                                            //$tcmode = $collectInforow['mode'];
                                            $tcdesignation = $collectInforow['designation'];
                                           // $tcemid = $collectInforow['emid'];
                                            $tcmobile = $collectInforow['mobile'];
                                            $tcemail = $collectInforow['email'];

                                            echo "
                    <tr style=\"border: groove\">
                    <td style=\"border: groove\">
                    {$tctitle} {$tcfirstname} {$tclastname}</td>
                    <td style=\"border: groove\">{$tcinitial}</td>
                    <td style=\"border: groove\">{$tcdesignation}</td>
                    <td style=\"border: groove\">{$tcmobile}</td>
                    <td style=\"border: groove\">{$tcemail}</td>                  
                    </tr>                  
                ";
                                        }

                                    }
                                }
                            }
                        }




                        ?>


                        </tbody>
                    </table>
                </div>
            </section>


    </div>


</section>


</body>
</html>
