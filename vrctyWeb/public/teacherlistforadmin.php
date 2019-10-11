<?php require_once ("../includes/functions.php"); ?>
<?php
session_start();

if(!logedin()){

    header("Location: index.php?valid=notlogedin");
    exit();
}
if(isset($_SESSION['address'])){
    if($_SESSION['address']!="admin.php"){
        redirect_to($_SESSION['id']);
    }
}
$semestercode= semestercode();
?>
<?php require_once("../includes/db_connection.php");?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="styleadmin.css"/>
</head>
<body>
<ul class="nav">
    <div class="logo">Admin Panal (<?php echo $semestercode?>)</div>

    <li><a href="<?php echo $_SESSION['id']?>">Home</li>
    <li><a href="teacherlistforadmin.php">Give Course Offer</li>
    <li><a href="logout.php">Logout</a></li>

</ul>


<div id="container">
    <div class="sidebar">
 teacher list


        <table align='center' width='' border='5'>


            <tr>
                <th>Employe ID</th>
                <th> Name</th>
                <th> Depertment</th>
                <th> email</th>
                <th> course</th>
                <th>details</th>
            </tr>
            <?php
            $emidQuery = "SELECT emid FROM users WHERE approved='yes' and page='teacher.php';";
            $emidQueryResult = mysqli_query($connection, $emidQuery);
            while ($row = mysqli_fetch_assoc($emidQueryResult)) {
                $emidQuerydata = $row['emid'];
                $emidInfoQuery = "SELECT title,firstname,lastname,department,emid,email FROM users WHERE emid={$emidQuerydata};";
                $emidInfoQueryResult = mysqli_query($connection, $emidInfoQuery);
                while ($row = mysqli_fetch_assoc($emidInfoQueryResult)) {
                    $emidTitle = $row['title'];
                    $emidFirstName = $row['firstname'];
                    $emidLastName = $row['lastname'];
                    $emiddepartment = $row['department'];
                    $emidemid = $row['emid'];
                    $emidemail = $row['email'];

                    echo "  

            <tr>
                <td> {$emidemid} </td>
                <td> {$emidTitle} {$emidFirstName} {$emidLastName} </td>
                <td> {$emiddepartment} </td>
                <td> {$emidemail} </td>
                <td> <a href='inputcourseforadmin.php?input={$emidemid}'>Input course</a></td>
                <td><a href='showteacherdetails.php?details={$emidemid}'>view details</a> </td>
            </tr> ";


                }


            }

            ?>
        </table>





    </div>
    <div class="content">
    </div>
</div>
</body>



</html>
