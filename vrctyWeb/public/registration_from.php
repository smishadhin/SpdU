<?php require_once ("../includes/functions.php"); ?>
<?php 
//session_destroy();
session_start();
if(logedin()){
    header("Location: {$_SESSION['id']}");
    exit();
}
?>
<?php require_once ("../includes/db_connection.php"); ?>


<?php
$user = $nameTitle = $firstName = $lastName = $initial = $dept = $faculty = $campus = $modeOfTeacher = $designation = $joinedSemester = $currentSemester = $emid = $email = $pass = $repass = $mobile = "";$image= false;
$erruser = $errnameTitle = $errfirstName = $errlastName = $errinitial = $errdept = $errfaculty = $errcampus = $errmodeOfTeacher = $errdesignation = $errjoinedSemester = $errcurrentSemester = $erremid  = $erremail = $errpass = $errrepass = $errmobile =$errimage= "";
$emiddata=$emaildata="";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['user'])) {
        $erruser = "<span style='color:red'>please select a user</span>";
    } else {
        $user = validate($_POST['user']);
    }

    if (empty($_POST['nameTitle']) ) {
        $errnameTitle = "<span style='color:red'>please select a title</span>";
    } else {
        $nameTitle = validate($_POST['nameTitle']);
    }

    if (empty($_POST['firstName']) /*|| preg_match("/[^A-Za-z0-9\-]/", $_POST['firstName'])*/) {
        $errfirstName = "<span style='color:red'>invalid name</span>";
    } else {
        $firstName = validate($_POST['firstName']);
    }
    if (empty($_POST['lastName'])/* || preg_match("/[^A-Za-z0-9\-]/", $_POST['lastName'])*/) {
        $errlastName = "<span style='color:red'>invalid name</span>";
    } else {
        $lastName = validate($_POST['lastName']);
    }

    if (empty($_POST['teacherInitial'])) {
        $errinitial = "<span style='color:red'>invalid initial</span>";
    } else {
        $initial = validate($_POST['teacherInitial']);
    }


    if (empty($_POST['dept'])) {
        $errdept = "<span style='color:red'>invalid dept</span>";
    } else {
        $dept = validate($_POST['dept']);
    }

    if (empty($_POST['faculty'])) {
        $errfaculty = "<span style='color:red'>invalid faculty</span>";
    } else {
        $faculty = validate($_POST['faculty']);
    }

    if (empty($_POST['campus'])) {
        $errcampus = "<span style='color:red'>invalid campus</span>";
    } else {
        $campus = validate($_POST['campus']);
    }

    if (empty($_POST['modeOfTeacher'])) {
        $errmodeOfTeacher = "<span style='color:red'>invalid mode of teacher</span>";
    } else {
        $modeOfTeacher = validate($_POST['modeOfTeacher']);
    }

    if (empty($_POST['designation'])) {
        $errdesignation = "<span style='color:red'>invalid designation</span>";
    } else {
        $designation = validate($_POST['designation']);
    }

    if (empty($_POST['joinedSemester'])) {
        $errjoinedSemester = "<span style='color:red'>invalid joined semester</span>";
    } else {
        $joinedSemester = validate($_POST['joinedSemester']);
    }

    if (empty($_POST['currentSemester'])) {
        $errcurrentSemester = "<span style='color:red'>invalid current semester</span>";
    } else {
        $currentSemester = validate($_POST['currentSemester']);
    }

    if (empty($_POST['emid'])) {
        $erremid = "<span style='color:red'>invalid employe ID</span>";
    } else {
        $emid = validate($_POST['emid']);
    }



    if (empty($_POST['email'])) {
        $erremail = "<span style='color:red'>invalid email address</span>";
    } else {
         $email = validate($_POST['email']);
    }

    if (empty($_POST['pass'])) {
        $errpass = "<span style='color:red'>invalid password</span>";
    } else {
        $pass = ($_POST['pass']);
    }

    if (empty($_POST['repass'])) {
        $errrepass = "<span style='color:red'>confirm password</span>";
    } else {
        $repass = ($_POST['repass']);
    }

    if (empty($_POST['mobile'])) {
        $errmobile = "<span style='color:red'>invalid mobile number</span>";
    } else {
        $mobile = validate($_POST['mobile']);
    }
    if (!empty($_FILES['pic']['tmp_name'])){
        $image=true;
      //  echo "img";


    }else{
        $errimage= "<span style='color:red'>select a image</span>";
    }

    if ($user === "admin") {

        if (!empty($pass) && !empty($repass) && $pass===$repass && !empty($nameTitle) && !empty($firstName) && !empty($lastName) && !empty($initial) && !empty($dept) && !empty($faculty) && !empty($campus) && !empty($modeOfTeacher) && !empty($designation) && !empty($joinedSemester) && !empty($currentSemester) && !empty($emid) && !empty($email) && !empty($mobile) && $image==true)
            {
            
            $emidstring = (string) $emid;
            $emidQuery = "SELECT emid FROM users WHERE emid=\"$emidstring\";";
            $emidQueryResult = mysqli_query($connection, $emidQuery);
            while ($row = mysqli_fetch_assoc($emidQueryResult)) {
                $emiddata = $row['emid'];
            } 

                 $emailString = (string) $email;
            $emailQuery = "SELECT email FROM users WHERE email=\"$emailString\";";
            $emailQueryResult = mysqli_query($connection, $emailQuery);
            while ($row = mysqli_fetch_assoc($emailQueryResult)) {
                $emaildata = $row['email'];           
            }

            if ($emidstring == $emiddata){
                $erremid = "<span style='color:red'>already registared</span>";
            }if ($emaildata==$email){
               $erremail = "<span style='color:red'>already registared</span>";
            }
            
            
            if ($emidstring != $emiddata &&  $emaildata!=$email) {
                

                $query = "INSERT INTO users ";
                $query .= "(title,firstname,lastname,initial,department,faculty,campus,mode,designation,joinsem,currentsem,emid,email,password,mobile,page,approved) ";
                $query .= "VALUES ('{$nameTitle}','{$firstName}','{$lastName}','{$initial}','{$dept}','{$faculty}','{$campus}','{$modeOfTeacher}','{$designation}','{$joinedSemester}','{$currentSemester}','{$emid}','{$email}','{$pass}','{$mobile}','admin.php','no');";
                $result = mysqli_query($connection, $query);

                if ($image==true){
                    $filetmp=$_FILES["pic"]["tmp_name"];
                    $filename=$_FILES["pic"]["name"];
                    $filetype=$_FILES["pic"]["type"];
                    $filepath="photo/".$filename;
                    move_uploaded_file($filetmp,$filepath);
                    $sql="insert into photo (emid,imgname,imgpath,imgtype) VALUES ('{$emid}','{$filename}','{$filepath}','{$filetype}');";
                    mysqli_query($connection,$sql);
                }


                if ($result) {

                    redirect_to("index.php?valid=registration");
                } else {
                    // Failure
                    // $message = "Subject creation failed";
                    die("Database query failed. " . mysqli_error($connection));
                }
            } else {
              //404
            }
        } else {
           // $errpass = "<span style='color:red'> password did not match</span>";
        }
    } elseif ($user === "teacher") {
        

        if (!empty($pass) && !empty($repass) && $pass===$repass && !empty($nameTitle) && !empty($firstName) && !empty($lastName) && !empty($initial) && !empty($dept) && !empty($faculty) && !empty($campus) && !empty($modeOfTeacher) && !empty($designation) && !empty($joinedSemester) && !empty($currentSemester) && !empty($emid) && !empty($email) && !empty($mobile) && $image==true)
        {

            $emidstring = (string) $emid;
            $emidQuery = "SELECT emid FROM users WHERE emid=\"$emidstring\";";
            $emidQueryResult = mysqli_query($connection, $emidQuery);
            while ($row = mysqli_fetch_assoc($emidQueryResult)) {
                $emiddata = $row['emid'];
            }

            $emailString = (string) $email;
            $emailQuery = "SELECT email FROM users WHERE email=\"$emailString\";";
            $emailQueryResult = mysqli_query($connection, $emailQuery);
            while ($row = mysqli_fetch_assoc($emailQueryResult)) {
                $emaildata = $row['email'];
            }

            if ($emidstring == $emiddata){
                $erremid = "<span style='color:red'>already registared</span>";
            }if ($emaildata==$email){
            $erremail = "<span style='color:red'>already registared</span>";
        }


            if ($emidstring != $emiddata &&  $emaildata!=$email) {


                $query = "INSERT INTO users ";
                $query .= "(title,firstname,lastname,initial,department,faculty,campus,mode,designation,joinsem,currentsem,emid,email,password,mobile,page,approved) ";
                $query .= "VALUES ('{$nameTitle}','{$firstName}','{$lastName}','{$initial}','{$dept}','{$faculty}','{$campus}','{$modeOfTeacher}','{$designation}','{$joinedSemester}','{$currentSemester}','{$emid}','{$email}','{$pass}','{$mobile}','teacher.php','no');";

                $result = mysqli_query($connection, $query);

                if ($image==true){
                    $filetmp=$_FILES["pic"]["tmp_name"];
                    $filename=$_FILES["pic"]["name"];
                    $filetype=$_FILES["pic"]["type"];
                    $filepath="photo/".$filename;
                    move_uploaded_file($filetmp,$filepath);
                    $sql="insert into photo (emid,imgname,imgpath,imgtype) VALUES ('{$emid}','{$filename}','{$filepath}','{$filetype}');";
                    mysqli_query($connection,$sql);
                }

                if ($result) {
                    redirect_to("index.php?valid=registration");
                } else {
                    // Failure
                    // $message = "Subject creation failed";
                    die("Database query failed. " . mysqli_error($connection));
                }
            } else {
                //404
            }
        }else {
           // $errpass = "<span style='color:red'>  password</span>";
        }
    } else {
        $erruser = "<span style='color:red'>select registration mode</span>";
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
        <title>Registration From</title>

        <!-- Bootstrap -->

        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css"/>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" charset="utf-8">
            $(function () {
                $("input:checkbox, input:radio, input:file, select").uniform();
            });
        </script>
    </head>
    <body>

    <!-- Start Registration Table -->
    <section>
        <div class="registration_table">
            <div class="container">
                <div class="row">
                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table">

                                <tr>
                                    <td>
                                        <p>
                                            All fields are mendatory to fill in:
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="user" value="admin">Admin
                                                    </label>

                                                    <label class="radio-inline">
                                                        <input type="radio" name="user" value="teacher">Teacher
                                                    </label><br/>
                                                    <label><?php echo $erruser ?></label>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <select name="nameTitle" class="form-control registration_from_control">
                                                        <option disabled selected>Select a title</option>
                                                        <option>Mr. </option>
                                                        <option>Ms. </option>
                                                        <option>Dr. </option>
                                                    </select><?php echo $errnameTitle ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <input type="text" class="form-control text_input" name="firstName"  placeholder="First Name"/><?php echo $errfirstName ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <input type="text" class="form-control text_input" name="lastName"  placeholder="Last Name"/><?php echo $errlastName ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <input type="text" class="form-control text_input" name="teacherInitial"  placeholder="Teacher initila"/><?php echo $errinitial ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <select name="dept" class="form-control registration_from_control">
                                                        <option  disabled selected>Select a Department</option>
                                                        <option>CSE</option>
                                                        <option>BBA</option>
                                                        <option>English</option>
                                                        <option>Hotel Management and turisum</option>
                                                    </select><?php echo $errdept ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <select name="faculty" class="form-control registration_from_control">
                                                        <option  disabled selected>Select a Faculty</option>
                                                        <option>FSIT</option>
                                                        <option>Natural Science</option>
                                                        <option>Option 3</option>
                                                    </select><?php echo $errfaculty ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <select name="campus" class="form-control registration_from_control">
                                                        <option  disabled selected>Select a Campus</option>
                                                        <option>Main Campus</option>
                                                        <option>Permanent Campus</option>
                                                        <option>Uttara Campus</option>
                                                    </select><?php echo $errcampus ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <select name="modeOfTeacher" class="form-control registration_from_control">
                                                        <option  disabled selected>Select a Mode</option>
                                                        <option>Full Time</option>
                                                        <option>Contractual</option>
                                                        <option>Part Time</option>
                                                        <option>Visiting</option>
                                                    </select><?php echo $errmodeOfTeacher ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <select name="designation" class="form-control registration_from_control">
                                                        <option  disabled selected>Select a Degisnation</option>
                                                        <option>Teaching Assistent</option>
                                                        <option>Lecturer</option>
                                                        <option>Sr. lecturer</option>
                                                        <option>Asst. Professor</option>
                                                        <option>Asso.Professor</option>
                                                        <option>Professor</option>
                                                        <option>Emeritus Professor</option>
                                                    </select><?php echo $errdesignation ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">

                                                <label for="semester" class="control-label">Select joined semester</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <select name="joinedSemester" class="form-control registration_from_control">
                                                        <option disabled selected>Select joined semester</option>
                                                        <option>Summer Semester</option>
                                                        <option>Spring Semester</option>
                                                        <option>Fall Semester</option>
                                                    </select><?php echo $errjoinedSemester ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">

                                                <label for="semester" class="control-label">Select Current semester</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                                    <select name="currentSemester" class="form-control registration_from_control">
                                                        <option disabled selected>Select current semester</option>
                                                        <option>Summer Semester</option>
                                                        <option>Spring Semester</option>
                                                        <option>Fall Semester</option>
                                                    </select><?php echo $errcurrentSemester ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control text_input" name="emid"  placeholder="DIU Employe ID"/><?php echo $erremid ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                    <input type="email" class="form-control text_input" name="email"  placeholder="DIU Email ID"/><?php echo $erremail ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="password" class="form-control text_input" name="pass"  placeholder="Type Password"/><?php echo $errpass ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="password" class="form-control text_input" name="repass"  placeholder="Re-Type Password"/><?php echo $errrepass ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control text_input" name="mobile"  placeholder="Contact Number"/><?php echo $errmobile ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <label for="semester" class="control-label">Select Your Image</label>
                                                <div class="input-group text_image" >
                                                    <input type="file" name="pic" accept="image/*"><?php echo $errimage;?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="text">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block text_input">Submit</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Registration Table -->
    <footer>
        <div class="pre_footer">
            <p>
                &copy GM ... 2016!!!
            </p>
        </div> <!-- End pre_footer -->
    </footer>

    </body>
    </html>
<?php mysqli_close($connection);
session_destroy();
?>