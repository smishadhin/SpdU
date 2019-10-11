<?php require_once("../includes/functions.php"); ?>
<?php
session_start();

if (!logedin()) {

    header("Location: index.php?valid=notlogedin");
    exit();
}
if (isset($_SESSION['address'])) {
    if ($_SESSION['address'] != "teacher.php") {
        redirect_to($_SESSION['id']);
    }
}
if (isset($_GET['id'])) {
    $userteacher = $_GET['id'];
} else {
    redirect_to("index.php");
}
$semestercode = semestercode();
?>
<?php require_once("../includes/db_connection.php"); ?>
<?php
$getteacheremid1query2 = "select emid from users where id={$userteacher};";
$getteacheremid2 = mysqli_query($connection, $getteacheremid1query2);
while ($inforow2 = mysqli_fetch_assoc($getteacheremid2)) {
    $teacheremid2 = $inforow2['emid'];
}

?>


<!DOCTYPE html>
<html>
<head>
    <style>

        aside.languages {
            font: .8em "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            background: #2e2e2e;
            padding: 25px;
            padding-top: 1em;
            float: right;
            width: 500px;
            margin-left: 1em;
        }

        .languages h3 {
            font-weight: normal;
            color: white;
            font-size: 1.6em;
            margin-bottom: .5em;
        }

        #tabContainer h4 {
            color: rgb(83, 104, 138);
            font-size: 2em;
        }

        #tabs {
            height: 30px;
            overflow: hidden;
        }

        #tabs > ul {
            font: 1em;
            list-style: none;
        }

        #tabs ul, #tabs li {
            margin: 0;
            padding: 0;
        }

        #tabs > ul > li {
            margin: 0 2px 0 0;
            padding: 7px 10px;
            display: block;
            float: left;
            color: #FFF;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            background: #CCC;
        }

        #tabs > ul > li:hover {
            background: white;
            cursor: pointer;
        }

        #tabs > ul > .active {
            background: white; /* old browsers */
            cursor: pointer;
        }

        #containers div {
            background: white;
            padding: 10px 10px 25px;
            margin: 0;
            color: #333;
        }

        #tabs a {
            text-decoration: none;
            color: black;
        }

        .img-circle {
            border-radius: 50%;
        }
    </style>
    <title></title>
    <link rel="stylesheet" href="styleadmin.css"/>
</head>
<body>
<ul class="nav">
    <div class="logo">Teacher Panal (<?php echo $semestercode ?>)</div>

    <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
    <li><a href="allofferedcourse.php?id=<?php echo $_GET['id'] ?>">Offered course</li>
    <li>
        <a href="viewandupdatecoursedetailforteacher.php?emid=<?php echo $teacheremid2 ?>&id=<?php echo $userteacher ?>">Course
            Details</li>
    <li><a href="logout.php">Logout</a></li>

</ul>


<section style="float: left;width: 50%">
    <div align="center" style="margin: 10%">

        <?php

        //colection profile info

        $collectInfoquery = "SELECT title,firstname,lastname,initial,department,faculty,campus,mode,designation,emid,email,mobile FROM users WHERE id={$userteacher};";
        $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
        while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
            $tctitle = $collectInforow['title'];
            $tcfirstname = $collectInforow['firstname'];
            $tclastname = $collectInforow['lastname'];
            $tcinitial = $collectInforow['initial'];
            $tcdepartment = $collectInforow['department'];
            $tcfaculty = $collectInforow['faculty'];
            $tccampus = $collectInforow['campus'];
            $tcmode = $collectInforow['mode'];
            $tcdesignation = $collectInforow['designation'];
            $tcemid = $collectInforow['emid'];
            $tcmobile = $collectInforow['mobile'];
            $tcemail = $collectInforow['email'];
        }

        $imgquery = "select imgpath from photo WHERE emid='{$tcemid}'";
        $imgrslt = mysqli_query($connection, $imgquery);
        while ($imgrow = mysqli_fetch_assoc($imgrslt)) {
            $img = $imgrow['imgpath'];
        }

        echo "
<p><img src=\"{$img}\"  style='width:304px;height:228px;border-radius: 50%;'></p>


<div align='left'>
<p>{$tctitle} {$tcfirstname} {$tclastname} ({$tcinitial}) </p>
 <p>{$tcdesignation} Dept. of {$tcdepartment} , {$tcfaculty} </p>
  <p>{$tcmode} , {$tccampus} </p>
  <p>Employe ID : {$tcemid}</p>
  <p>E-mail : {$tcemail}</p>
  <p>Phone : {$tcmobile}</p> </div>";

        ?>

    </div>
</section>


<section style="float: right;width: 40%">

    <main role="main">
        <article role="article">

            <aside role="complementary" class="languages">
                <h3>UPDATE INFORMATION</h3>
                <div id="tabContainer">
                    <div id="tabs">
                        <ul>
                            <li id="tab1"><a href="#tabPanel1">DayOff Information</a></li>
                            <li id="tab2"><a href="#tabPanel2">Edit Profile</a></li>
                        </ul>
                    </div>
                    <div id="containers">

                        <div id="tabPanel1">
                            <section >
                                <form action="actions/offdayupdate.php?id=<?php echo $userteacher;?>" method="post">
                                    <label>SELECT OFF DAY</label><br><br>
                                    <span><input type="checkbox" name="day[]" value="SATURDAY">SATURDAY</span>
                                    <span><input type="checkbox" name="day[]" value="SUNDAY">SUNDAY</span>
                                    <span><input type="checkbox" name="day[]" value="MONDAY">MONDAY</span><br>
                                    <span><input type="checkbox" name="day[]" value="TUESDAY">TUESDAY</span>
                                    <span><input type="checkbox" name="day[]" value="WEDNESDAY">WEDNESDAY</span>
                                    <span><input type="checkbox" name="day[]" value="THURSDAY">THURSDAY</span>
                                    <p><input type="submit" name="submit" value="SAVE"></p>
                                </form>
                                <br>
                                <?php
                                $dayof="select offday from photo WHERE emid='{$teacheremid2}'";
                                $dayofres=mysqli_query($connection,$dayof);
                                while ($rowoff=mysqli_fetch_assoc($dayofres)){
                                    $offday=$rowoff['offday'];
                                    echo "<p>Current Off Day : {$offday}</p>";
                                }
                                ?>

                            </section>


                        </div>
                        <div id="tabPanel2">
                            <section>

                                <?php

                                //colection profile info

                                $collectInfoquery = "SELECT title,firstname,lastname,initial,department,faculty,campus,mode,designation,emid,email,mobile FROM users WHERE id={$userteacher};";
                                $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
                                while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
                                    $tctitle = $collectInforow['title'];
                                    $tcfirstname = $collectInforow['firstname'];
                                    $tclastname = $collectInforow['lastname'];
                                    $tcinitial = $collectInforow['initial'];
                                    $tcdepartment = $collectInforow['department'];
                                    $tcfaculty = $collectInforow['faculty'];
                                    $tccampus = $collectInforow['campus'];
                                    $tcmode = $collectInforow['mode'];
                                    $tcdesignation = $collectInforow['designation'];
                                    $tcemid = $collectInforow['emid'];
                                    $tcmobile = $collectInforow['mobile'];
                                    $tcemail = $collectInforow['email'];
                                }
                                //$img="";
                                $imgquery = "select imgpath from photo WHERE emid='{$tcemid}'";
                                $imgrslt = mysqli_query($connection, $imgquery);
                                while ($imgrow = mysqli_fetch_assoc($imgrslt)) {
                                    $img = $imgrow['imgpath'];
                                }


                                /*echo "
<p><img src=\"{$img}\"  style='width:204px;height:128px;border-radius: 50%;'></p>";*/

                                ?>

                                <!--/////////////////////////////-->


                                <section>

                                    <form action="updateprofile.php?id=<?php echo $userteacher; ?>"
                                          class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <p><img src="<?php echo $img; ?>"
                                                style='width:204px;height:128px;border-radius: 50%;'></p>
                                        <p><label>Select Your
                                                Image</label>

                                            <input type="file" name="pic"
                                                   accept="image/*"><?php /*echo $errimage;*/ ?></p>
                                        <table class="table">


                                            <tr>
                                                <td>
                                                    <select name="nameTitle"
                                                            class="form-control registration_from_control">
                                                        <option disabled selected>Select a title</option>
                                                        <option>Mr.</option>
                                                        <option>Ms.</option>
                                                        <option>Dr.</option>
                                                    </select><br><?php echo $tctitle;/*echo $errnameTitle */ ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control text_input" name="firstName"
                                                           value="<?php echo $tcfirstname; ?>"
                                                           placeholder="First Name"/><?php /*echo $errfirstName */ ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>


                                                    <input type="text" class="form-control text_input" name="lastName"
                                                           value="<?php echo $tclastname; ?>"
                                                           placeholder="Last Name"/><?php /*echo $errlastName */ ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>


                                                    <input type="text" class="form-control text_input"
                                                           value="<?php echo $tcinitial; ?>"
                                                           name="teacherInitial"
                                                           placeholder="Teacher initila"/><?php /*echo $errinitial */ ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>


                                                    <select name="dept"
                                                            class="form-control registration_from_control">
                                                        <option disabled selected>Select a Department</option>
                                                        <option>CSE</option>
                                                        <option>BBA</option>
                                                        <option>English</option>
                                                        <option>Hotel Management and turisum</option>
                                                    </select><?php echo $tcdepartment;/*echo $errdept */ ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <select name="faculty"
                                                            class="form-control registration_from_control">
                                                        <option disabled selected>Select a Faculty</option>
                                                        <option>FSIT</option>
                                                        <option>Natural Science</option>
                                                        <option>Option 3</option>
                                                    </select><?php echo $tcfaculty;/*echo $errfaculty */ ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <select name="campus"
                                                            class="form-control registration_from_control">
                                                        <option disabled selected>Select a Campus</option>
                                                        <option>Main Campus</option>
                                                        <option>Permanent Campus</option>
                                                        <option>Uttara Campus</option>
                                                    </select><?php echo $tccampus;/*echo $errcampus */ ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <select name="modeOfTeacher"
                                                            class="form-control registration_from_control">
                                                        <option disabled selected>Select a Mode</option>
                                                        <option>Full Time</option>
                                                        <option>Contractual</option>
                                                        <option>Part Time</option>
                                                        <option>Visiting</option>
                                                    </select><?php echo $tcmode;/*echo $errmodeOfTeacher */ ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <select name="designation"
                                                            class="form-control registration_from_control">
                                                        <option disabled selected>Select a Degisnation
                                                        </option>
                                                        <option>Teaching Assistent</option>
                                                        <option>Lecturer</option>
                                                        <option>Sr. lecturer</option>
                                                        <option>Asst. Professor</option>
                                                        <option>Asso.Professor</option>
                                                        <option>Professor</option>
                                                        <option>Emeritus Professor</option>
                                                    </select><?php echo $tcdesignation;/*echo $errdesignation */ ?>
                                                </td>
                                            </tr>



                                            <tr>
                                                <td>
                                                    <input type="email" class="form-control text_input"
                                                           value="<?php echo $tcemail; ?>"
                                                           name="email"
                                                           placeholder="DIU Email ID"/><?php /*echo $erremail */ ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control text_input"
                                                           value="<?php echo $tcmobile; ?>"
                                                           name="mobile"
                                                           placeholder="Contact Number"/><?php /*echo $errmobile */ ?>

                                                </td>
                                            </tr>


                                            <tr>
                                                <td>

                                                    <input type="submit" name="submit" value="UPDATE">

                                                </td>
                                            </tr>
                                        </table>

                                    </form>

                                </section>


                                <!--//////////////////////////////////-->

                            </section>
                        </div>

                    </div>
                </div>
            </aside>


        </article>
    </main>

    <script type="text/javascript">
        //tabbed panels

        // declare globals to hold all the links and all the panel elements
        var tabLinks;
        var tabPanels;

        window.onload = function () {
            // when the page loads, grab the li elements
            tabLinks = document.getElementById("tabs").getElementsByTagName("li");
            // Now get all the tab panel container divs
            tabPanels = document.getElementById("containers").getElementsByTagName("div");

            // activate the _first_ one
            displayPanel(tabLinks[0]);

            // attach event listener to links using onclick and onfocus, fire the displayPanel function, return false to disable the link
            for (var i = 0; i < tabLinks.length; i++) {
                tabLinks[i].onclick = function () {
                    displayPanel(this);
                    return false;
                }
                tabLinks[i].onfocus = function () {
                    displayPanel(this);
                    return false;
                }
            }
        }

        function displayPanel(tabToActivate) {
            // go through all the <li> elements
            for (var i = 0; i < tabLinks.length; i++) {
                if (tabLinks[i] == tabToActivate) {
                    // if it's the one to activate, change its class
                    tabLinks[i].classList.add("active");
                    // and display the corresponding panel
                    tabPanels[i].style.display = "block";
                } else {
                    // remove the active class on the link
                    tabLinks[i].classList.remove("active");
                    // hide the panel
                    tabPanels[i].style.display = "none";
                }
            }
        }

    </script>
</section>


</body>


</html>
