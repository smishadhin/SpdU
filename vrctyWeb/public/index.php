<?php require_once("../includes/functions.php"); ?>
<?php
//session_destroy();
session_start();
if (logedin()) {
    header("Location: {$_SESSION['id']}");
    exit();
}
$loginstatus = "";
if (isset($_GET['valid'])) {
    if ($_GET['valid'] == "logout") {
        $loginstatus = "logout successfull";
    }
    if ($_GET['valid'] == "registration") {
        $loginstatus = "registration successful ";
    }
    if ($_GET['valid'] == "faild") {
        $loginstatus = "login faild";
    }
    if ($_GET['valid'] == "notlogedin") {
        $loginstatus = "please login";
    }

}
?>

<?php require_once("../includes/functions.php"); ?>


<?php require_once("../includes/db_connection.php"); ?>
<?php
$userName = $password = "";
$error = "";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['userName']) || empty($_POST['password'])) {
        $error = "<span style='color:red'>enter username and password </span>";
    }

    if (!empty($_POST['userName']) && !empty($_POST['password'])) {
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        // if (preg_match("/admin/", $password)) {

        $userNameQuery = "SELECT id FROM users WHERE emid='{$userName}';";
        $userNameQueryResult = mysqli_query($connection, $userNameQuery);
        while ($row = mysqli_fetch_assoc($userNameQueryResult)) {
            $userNameID = $row['id'];
        }

        if (!isset($userNameID)) {
            redirect_to("index.php?valid=faild");
        }

        $passwordQuery = "SELECT password FROM users WHERE id='{$userNameID}';";
        $passwordQueryResult = mysqli_query($connection, $passwordQuery);
        while ($row = mysqli_fetch_assoc($passwordQueryResult)) {
            $passwordID = $row['password'];
        }

        if ($password===$passwordID) {
            $userNameID = (int)$userNameID;

            $approveQuery = "SELECT approved FROM users WHERE id={$userNameID};";
            $approveQueryResult = mysqli_query($connection, $approveQuery);
            while ($row = mysqli_fetch_assoc($approveQueryResult)) {
                $approvedata = (string)$row['approved'];
            }
            // $approvedata=$approvedata;
            if ($approvedata == "yes") {
                $pageQuery = "SELECT page FROM users WHERE id={$userNameID};";
                $pageQueryResult = mysqli_query($connection, $pageQuery);
                while ($row = mysqli_fetch_assoc($pageQueryResult)) {
                    $pagedata = $row['page'];
                }

                $pagedata = (string)$pagedata;
                $_SESSION['address'] = $pagedata;
                $_SESSION['id'] = "{$pagedata}?id={$userNameID}";
                redirect_to($_SESSION['id']);
            } else {
                redirect_to("approvalstatus.php");
            }


        } else {
            redirect_to("index.php?valid=faild");
        }
        //  }
//        else {
//            $error = "<span style='color:red'>username and password does not match</span>";
//        }
    } else {
        $error = "<span style='color:red'>username and password does not match</span>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="back"></div>
<div class="container">
    <div class="row">
        <div class="wrapper_login">
            <div class="Login_header col-md-offset-3 col-md-6">
                <h3><?php echo $loginstatus; ?></h3>
                <h2>Log In</h2>
                <p><?php echo $error; ?></p>
            </div>
            <div class="login col-md-offset-3 col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="userName" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                        <a href="forgetPassword.php">forget password</a>
                    </div>
                    <a href="">
                        <button type="submit" class="btn btn-success btn-block">Log in</button>
                    </a>
                    <a href="registration_from.php">
                        <button type="button" class="btn btn-primary btn-block">Register?</button>
                    </a>
                </form>
            </div><!-- End Login -->
        </div><!-- End Wrapper -->
    </div><!-- End Row -->
</div><!-- End Container -->


<div class="footer">
    <h5>
        &copy;
    </h5>
</div>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>