<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; Filename= teacher details.doc");
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
    <title></title>

</head>
<body>




<section>
    <div>
        <section>
            <div align="center">
                <div>
                    <img src="logo/diulogo.png">
                    <h4>
                        <?php echo $header; ?>
                    </h4>
                    <h3><?php echo $title; ?></h3>
                </div>
                <table>
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <th>Initial</th>
                        <th>Designation</th>
                        <th>Mobile</th>
                        <th>Email</th>
                    </tr>

                    <?php
                    $deprtmnt = "";
                    if (isset($_POST['submit'])) {
                        if (!empty($_POST['teachers'])) {
                            foreach ($_POST['teachers'] as $te) {
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
                    <tr >
                    <td >
                    {$tctitle} {$tcfirstname} {$tclastname}</td>
                    <td >{$tcinitial}</td>
                    <td >{$tcdesignation}</td>
                    <td >{$tcmobile}</td>
                    <td >{$tcemail}</td>                  
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
                <br><br>
                <h4 align="center" style="margin: 2%"><?php echo $footer; ?></h4>
            </div>
        </section>


    </div>


</section>


</body>
</html>
