<?php require_once("../includes/functions.php"); ?>
<?php
session_start();
$delsuc = "";
if (!logedin()) {

    header("Location: index.php?valid=notlogedin");
    exit();
}
if (isset($_SESSION['address'])) {
    if ($_SESSION['address'] != "superadmin.php") {
        redirect_to($_SESSION['id']);
    }
    if (isset($_GET['deletionStatus'])) {
        if ($_GET['deletionStatus'] == "success") {
            $delsuc = "<h1 style='color: green;'>deletion successfull</h1>";
        } else {
            $delsuc = "<h1 style='color: red;'>deletion unsuccessfull</h1>";
        }
    }
    if (isset($_GET['approveStatus'])) {
        if ($_GET['approveStatus'] == "success") {
            $delsuc = "<h1 style='color: green;'>approved</h1>";
        } else {
            $delsuc = "<h1 style='color: red;'>approve unsuccessfull</h1>";
        }
    }
    if (isset($_GET['approveStatus'])) {
        if ($_GET['approveStatus'] == "unsuccessfull") {
            $delsuc = "<h1 style='color: red;'>approve unsuccessfull</h1>";
        } else {
            $delsuc = "<h1 style='color: green;'>approve successfull</h1>";
        }
    }
    if (isset($_GET['approveStatus'])) {
        if ($_GET['approveStatus'] == "unsuccessfullmail") {
            $delsuc = "<h1 style='color: red;'>approve unsuccessfull, mail send error</h1>";
        } else {
            $delsuc = "<h1 style='color: green;'>approve successfull</h1>";
        }
    }
}

$semestercode = semestercode();
?>
<?php require_once("../includes/db_connection.php");
//$count = 0;
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin page </title>
    <link rel="stylesheet" href="styleadmin.css"/>
</head>
<body>
<ul class="nav">
    <div class="logo">Super Admin Panal (<?php echo $semestercode ?>)</div>

    <li><a href="logout.php">Logout</a></li>

</ul>
<?php
$secode = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $secode = generateRandomString();
        $codequery = "update secretcode set secode='{$secode}' WHERE id=1 limit 1;";
        mysqli_query($connection, $codequery);
    }
}


?>


<form action="" method="post">
    <table>
        <tr>
            <td>
                <input type="submit" name="submit" value="Genetate Code">
            </td>
            <td>
                <label><?php
                    $retvcodequery = "select secode from secretcode WHERE id=1;";
                    $rtvrslt = mysqli_query($connection, $retvcodequery);
                    if ($rtvrslt) {
                        while ($rsrow = mysqli_fetch_assoc($rtvrslt)) {
                            echo $rtvcode = $rsrow['secode'];
                        }
                    }

                    ?></label>
            </td>
        </tr>
    </table>
</form>

<center><?php echo $delsuc; ?>
    <h3>Users table<?php // echo "($count)"?></h3>
    <center>
        <table align='center' width='' border='5'>


            <tr>
                <th>Employe ID</th>
                <th> Name</th>
                <th> Depertment</th>
                <th> email</th>
                <th>Delete User</th>
                <th>Approve User</th>
            </tr>
            <?php
            $nonApprovalIdQuery = "SELECT id FROM users WHERE approved='no';";
            $nonApprovalIdQueryResult = mysqli_query($connection, $nonApprovalIdQuery);
            while ($row = mysqli_fetch_assoc($nonApprovalIdQueryResult)) {
                $nonApprovalIdQuerydata = (int)$row['id'];
                $idInfoQuery = "SELECT title,firstname,lastname,department,emid,email FROM users WHERE id={$nonApprovalIdQuerydata};";
                $idInfoQueryResult = mysqli_query($connection, $idInfoQuery);
                while ($row = mysqli_fetch_assoc($idInfoQueryResult)) {
                    $idTitle = $row['title'];
                    $idFirstName = $row['firstname'];
                    $idLastName = $row['lastname'];
                    $iddepartment = $row['department'];
                    $idemid = $row['emid'];
                    $idemail = $row['email'];

                    echo "  

            <tr>
                <td> {$idemid} </td>
                <td> {$idTitle} {$idFirstName} {$idLastName} </td>
                <td> {$iddepartment} </td>
                <td> {$idemail} </td>
                <td> <a href='delete.php?del={$idemid}'>Delete</a></td>
                <td><a href='sendmail.php?approved={$idemid}'>Approve</a> </td>
            </tr> ";


                }
                // $count++;

            }


            //while ($count < 10) {


            // }

            ?>
        </table>
</body>


</html>
