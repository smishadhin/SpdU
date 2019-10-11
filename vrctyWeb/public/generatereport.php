<?php require_once("../includes/functions.php"); ?>
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
<?php require_once("../includes/db_connection.php"); ?>

<!DOCTYPE html>
<html>
<head>


    <style>


        aside.languages {
            font: .8em "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            background: #2e2e2e;
            padding: 1%;
            width: auto;

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
            padding: 2%;
            margin: 0;
            color: #333;
        }

        #tabs a {
            text-decoration: none;
            color: black;
        }
    </style>


    <title></title>
    <link href="css/stylect.css" rel="stylesheet" media="screen" type="text/css"/>
    <!-- Responsive CSS -->
    <link href="css/responsive.css" rel="stylesheet" media="screen" type="text/css"/>
    <link rel="stylesheet" href="styleadmin.css"/>
</head>
<body style="background-color: #5e5e5e">
<ul class="nav">
    <div class="logo">Admin Panal (<?php echo $semestercode ?>)</div>
    <li><a href="<?php echo $_SESSION['id'] ?>">Home</li>
    <!--    <li><a href="teacherlistforadmin.php"> Give Course Offer</li>-->
    <li><a href="makecourseoffer.php">Declare course offer</a></li>
    <li><a href="inputallcourses.php">Manage Data</a></li>
    <li><a href="generatereport.php">Generate Report</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>


<!--<div style="background-color: #d4ffda;float: left;width: 20%;height: 100%;border: solid;border-color: #1b6d85;position: fixed">

    <section >
        <ul >
            <a href="report/pages/offeredcourse.php"><li style="margin: 5%">Offered course</li></a>

            <a href="report/pages/teacherinformation.php">
                <li style="margin: 5%">Teacher Information</li>
            </a>
            <a href="report/pages/teacherandcourseinfo.php">
                <li style="margin: 5%">Teacher and course Information</li>
            </a>
            <a href="report/pages/courseoutline.php">
                <li style="margin: 5%">Course Outline</li>
            </a>
            <a href="report/pages/crinfo.php">
                <li style="margin: 5%">CR Information</li>
            </a>
            <a href="report/pages/classsizeinfo.php">
                <li style="margin: 5%">Class Size Information</li>
            </a>
            <a href="report/pages/dayoffinfo.php">
                <li style="margin: 5%">Day off information</li>
            </a>


        </ul>

    </section>

</div>-->



<section>
    <main role="main">
        <article role="article">
            <aside role="complementary" class="languages">
                <h3 align="center">Generate Report</h3>
                <div id="tabContainer">
                    <div id="tabs">
                        <ul>
                            <li id="tab1"><a href="#tabPanel1">CR Information</a></li>
                            <li id="tab2"><a href="#tabPanel2">Teacher Information</a></li>
                            <li id="tab3" style="color: black"><a href="#tabPanel3"></a>Offered course</li>
                        </ul>
                    </div>
                    <div align="center" id="containers">
                        <div id="tabPanel1">
                            <!--//////////////////////////////////////////////////-->

                            <section>
                                <section class="course_details_info">
                                    <section >
                                        <form action="" method="post">
                                            <!--<input type="submit" name="submitdept" value="List by DEPT.">-->
                                            <select name="dept" style="margin-right: 5%;padding: 1%;margin-bottom: 2%">
                                                <option disabled selected>Select a Department</option>
                                                <option>CSE</option>
                                                <option>BBA</option>
                                                <option>English</option>
                                                <option>Hotel Management and turisum</option>
                                            </select>
                                            <input type="submit" name="submitdeptandlvltrm" value="FILTER">
                                            <select name="levelterm"
                                                    style="margin-left: 5%;padding: 1%;margin-bottom: 2%">
                                                <option disabled selected>Select Level & Term</option>
                                                <option>L1T1</option>
                                                <option>L1T2</option>
                                                <option>L1T3</option>
                                                <option>L2T1</option>
                                                <option>L2T2</option>
                                                <option>L2T3</option>
                                                <option>L3T1</option>
                                                <option>L3T2</option>
                                                <option>L3T3</option>
                                                <option>L4T1</option>
                                                <option>L4T2</option>
                                                <option>L4T3</option>
                                            </select>
                                           </form>
                                    </section>
                                    <a href="#offcreport"><input style="float: right" type="button" value="Set report header and footer"></a>
                                    <form action="report/actions/crinfoaction.php" method="post">
                                        <input align="center"  style="margin: 1%" type="submit" name="coursesubmit"
                                               value="GENERATE">
                                        <table class="course_table_info">

                                            <tr>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Department</th>
                                                <th>Level&Term</th>
                                                <th>Credit</th>

                                            </tr>
                                            <?php
                                            /*if (isset($_POST['submitlvltrm'])) {
                                                if (!empty($_POST['levelterm'])) {
                                                    echo "".$levelterm = $_POST['levelterm'];
                                                }
                                            }
                                            if (isset($_POST['submitdept'])) {
                                                if (!empty($_POST['dept'])) {
                                                    echo "DEPT. of ".$deprtmnt = $_POST['dept'];
                                                }
                                            }
                                            if (isset($_POST['submitdeptandlvltrm'])) {
                                                if (!empty($_POST['dept']) && !empty($_POST['levelterm'])) {
                                                    echo "DEPT. of ".$deprtmnt = $_POST['dept'];
                                                    echo "\t".$levelterm = $_POST['levelterm'];
                                                }
                                            }*/

                                            if (isset($_POST['submitdeptandlvltrm'])) {
                                                if (!empty($_POST['dept']) || !empty($_POST['levelterm'])) {
                                                    if (!empty($_POST['dept'])) {
                                                        echo "DEPT. of " . $deprtmnt = $_POST['dept'];
                                                    }
                                                    if (!empty($_POST['levelterm'])) {
                                                        echo "\t" . $levelterm = $_POST['levelterm'];
                                                    }


                                                }
                                            }

                                            ?>

                                            <?php


                                            if (!empty($deprtmnt) && !empty($levelterm)) {
                                                $selectallcoursequery = "SELECT * FROM allcourses WHERE dept='{$deprtmnt}' AND levelterm='{$levelterm}' ORDER BY levelterm;";
                                                $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                                                while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                                                    $id = $row['id'];
                                                    $dept = $row['dept'];
                                                    $lvtr = $row['levelterm'];
                                                    $cocode = $row['coursecode'];
                                                    $cotitle = $row['coursetitle'];
                                                    $credit = $row['credit'];

                                                    echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                                                }
                                            } elseif (!empty($deprtmnt)) {
                                                $selectallcoursequery = "SELECT * FROM allcourses WHERE dept='{$deprtmnt}' ORDER BY levelterm;";
                                                $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                                                while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                                                    $id = $row['id'];
                                                    $dept = $row['dept'];
                                                    $lvtr = $row['levelterm'];
                                                    $cocode = $row['coursecode'];
                                                    $cotitle = $row['coursetitle'];
                                                    $credit = $row['credit'];

                                                    echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                                                }
                                            } elseif (!empty($levelterm)) {
                                                $selectallcoursequery = "SELECT * FROM allcourses WHERE levelterm='{$levelterm}' ORDER BY levelterm;";
                                                $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                                                while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                                                    $id = $row['id'];
                                                    $dept = $row['dept'];
                                                    $lvtr = $row['levelterm'];
                                                    $cocode = $row['coursecode'];
                                                    $cotitle = $row['coursetitle'];
                                                    $credit = $row['credit'];

                                                    echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                                                }
                                            } else {
                                                $selectallcoursequery = "SELECT * FROM allcourses ORDER BY dept,levelterm;";
                                                $selectallcoursereslt = mysqli_query($connection, $selectallcoursequery);
                                                while ($row = mysqli_fetch_assoc($selectallcoursereslt)) {
                                                    $id = $row['id'];
                                                    $dept = $row['dept'];
                                                    $lvtr = $row['levelterm'];
                                                    $cocode = $row['coursecode'];
                                                    $cotitle = $row['coursetitle'];
                                                    $credit = $row['credit'];

                                                    echo " <tr>
                <td><input type=\"checkbox\" name=\"course[]\" value=\"{$id}\" class=\"course_radio\">{$cocode}</td>
                <td>$cotitle</td>
                <td>$dept</td>
                <td>$lvtr</td>
                <td>$credit</td>

            </tr>";


                                                }
                                            }


                                            ?>


                                        </table>

                                        <section id="offcreport" style="border: solid;border-color: #2b542c;margin-bottom: 10%">
                                            <h1 align="center">Header For the report<br>
                                                (NOTE: Use "&ltbr&gt after every line as shown in default text billow")
                                            </h1>
                                            <textarea name="header" rows="10" cols="50">
    Daffodil International University<br>
        Asulia,Savar,Dhaka-1341l<br>
Faculty of Science & Information Technology<br>
                                    </textarea>

                                            <h1 align="center">Title for the report<br>
                                                (NOTE: Use "&ltbr&gt after every line as shown in default text billow")</h1>
                                            <textarea name="title" rows="2" cols="50">CR Details<br></textarea>
                                            <h1 align="center">Footer for the report<br>
                                                (NOTE: Use "&ltbr&gt after every line as shown in default text billow")</h1>
                                            <textarea name="footer" rows="10" cols="50">END<br></textarea><br>
                                            <a href="#tabPanel1"><input style="margin: 2%" align="center" type="button" value="Save & go for generate"></a>
                                        </section>
                                    </form>


                                </section>

                            </section>

                            <!-- /////////////////////////////////////////////////////////////////////////////////////////////////-->

                        </div>
                        <div id="tabPanel2">
                            <h1 align="center">Report: Teacher And Course Information</h1>
                            <section style="background-color: ;width: auto;height: 100%;border: solid;border-color: #1b6d85;">
                                <h1 align="center">Generate By Department</h1>
                                <a href="#tcandcdreport"><input style="margin: 2%;float: right" align="right" type="button" value="Set header & footer"></a>
                                <form action="report/actions/teacherandcourseinformationaction.php" method="post">
                                        <select name="dept" style="margin:5%;padding: 1%">
                                            <option disabled selected>Select a Department</option>
                                            <option>CSE</option>
                                            <option>BBA</option>
                                            <option>English</option>
                                            <option>Hotel Management and turisum</option>
                                        </select>
                                        <input type="submit" name="submitdept" value="GENERATE">
                                </form>
<!--</section>-->
<!--                            <section style="background-color: ;width: auto;height: 100%;border: solid;border-color: #1b6d85;">-->
<h1 align="center">Generate By Selection</h1>
                                    <form action="report/actions/teacherandcourseinformationaction.php" method="post">
                                        <section class="course_details_info">
                                                <input  align="center" style="margin: 2%" type="submit" name="submit" value="GENERATE">
                                                <table class="course_table_info">
                                                    <tbody>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Initial</th>
                                                        <th>Designation</th>
                                                        <th>Mode</th>
                                                        <th>Em. ID</th>
                                                    </tr>

                                                    <?php
                                                    $deprtmnt="";
                                                    if (isset($_POST['submitdept'])) {
                                                        if (!empty($_POST['dept'])) {
                                                            echo "DEPT. of " . $deprtmnt = $_POST['dept'];
                                                        }
                                                    }
                                                    if (!empty($deprtmnt)) {
                                                        $collectInfoquery = "SELECT title,firstname,lastname,initial,designation,emid,email,mobile,mode FROM users WHERE page='teacher.php' AND department='{$deprtmnt}';";
                                                        $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
                                                        while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
                                                            $tctitle = $collectInforow['title'];
                                                            $tcfirstname = $collectInforow['firstname'];
                                                            $tclastname = $collectInforow['lastname'];
                                                            $tcinitial = $collectInforow['initial'];
                                                            //$tcdepartment = $collectInforow['department'];
                                                            //$tcfaculty = $collectInforow['faculty'];
                                                            //$tccampus = $collectInforow['campus'];
                                                            $tcmode = $collectInforow['mode'];
                                                            $tcdesignation = $collectInforow['designation'];
                                                            $tcemid = $collectInforow['emid'];
                                                            $tcmobile = $collectInforow['mobile'];
                                                            $tcemail = $collectInforow['email'];

                                                            echo "
                    <tr>
                    <td><input type='checkbox' name='teachers[]' value='{$tcemid}'>
                    {$tctitle} {$tcfirstname} {$tclastname}</td>
                    <td>{$tcinitial}</td>
                    <td>{$tcdesignation}</td>
                    <td>{$tcmode}</td>
                    <td>{$tcemid}</td>                  
                    </tr>                  
                ";
                                                        }

                                                    } else {
                                                        $collectInfoquery = "SELECT title,firstname,lastname,initial,designation,emid,email,mobile,mode FROM users WHERE page='teacher.php';";
                                                        $collectInfoqueryresult = mysqli_query($connection, $collectInfoquery);
                                                        while ($collectInforow = mysqli_fetch_assoc($collectInfoqueryresult)) {
                                                            $tctitle = $collectInforow['title'];
                                                            $tcfirstname = $collectInforow['firstname'];
                                                            $tclastname = $collectInforow['lastname'];
                                                            $tcinitial = $collectInforow['initial'];
                                                            //$tcdepartment = $collectInforow['department'];
                                                            //$tcfaculty = $collectInforow['faculty'];
                                                            //$tccampus = $collectInforow['campus'];
                                                            $tcmode = $collectInforow['mode'];
                                                            $tcdesignation = $collectInforow['designation'];
                                                            $tcemid = $collectInforow['emid'];
                                                            $tcmobile = $collectInforow['mobile'];
                                                            $tcemail = $collectInforow['email'];

                                                            echo "
                    <tr>
                    <td><input type='checkbox' name='teachers[]' value='{$tcemid}'>
                    {$tctitle} {$tcfirstname} {$tclastname}</td>
                    <td>{$tcinitial}</td>
                    <td>{$tcdesignation}</td>
                    <td>{$tcmode}</td>
                    <td>{$tcemid}</td>                  
                    </tr>                  
                ";
                                                        }

                                                    }
                                                    ?>


                                                    </tbody>
                                                </table>
                                        </section>
                                        <section id="tcandcdreport" style="border: solid;border-color: #2b542c;margin-bottom: 10%">
                                            <h1 align="center">Header For the report<br>
                                                (NOTE: Use "&ltbr&gt after every line as shown in default text billow")
                                            </h1>
                                            <textarea name="header" rows="10" cols="50">
    Daffodil International University<br>
        Asulia,Savar,Dhaka-1341l<br>
Faculty of Science & Information Technology<br>
                                    </textarea>

                                            <h1 align="center">Title for the report<br>
                                                (NOTE: Use "&ltbr&gt after every line as shown in default text billow")</h1>
                                            <textarea name="title" rows="2" cols="50">Teacher And Course Details<br></textarea>
                                            <h1 align="center">Footer for the report<br>
                                                (NOTE: Use "&ltbr&gt after every line as shown in default text billow")</h1>
                                            <textarea name="footer" rows="10" cols="50">END<br></textarea><br>
                                            <a href="#tabPanel2"><input style="margin: 2%" align="center" type="button" value="Save & go for generate"></a>
                                        </section>
                                    </form>
                            </section>



                        </div>
                        <!--<div id="tabPanel3">

                        </div>-->
                        <div id="tabPanel3">
                            <form action="report/actions/offeredcourseaction.php" method="post">
                                <section style="border: solid;border-color: #2b542c;margin-bottom: 2%">
                                    <h1 align="center">Generate Report on the basis of following Info.</h1>

                                    <select name="dept" style="margin:1%;">
                                        <option disabled selected>Select a Department</option>
                                        <option>CSE</option>
                                        <option>BBA</option>
                                        <option>English</option>
                                        <option>Hotel Management and turisum</option>
                                    </select>
                                    <input style="margin: 2%" type="submit" name="generate1" value="GENERATE">
                                </section>

                                <section style="border: solid;border-color: #2b542c;margin-bottom: 10%">
                                    <h1 align="center">Header For the report<br>
                                        (NOTE: Use "&ltbr&gt after every line as shown in default text billow")
                                    </h1>
                                    <textarea name="header" rows="10" cols="50">
    Daffodil International University<br>
        Asulia,Savar,Dhaka-1341l<br>
Faculty of Science & Information Technology<br>
                                    </textarea>

                                    <h1 align="center">Title for the report<br>
                                        (NOTE: Use "&ltbr&gt after every line as shown in default text billow")</h1>
                                    <textarea name="title" rows="2" cols="50">Course Offer<br></textarea>
                                    <h1 align="center">Footer for the report<br>
                                        (NOTE: Use "&ltbr&gt after every line as shown in default text billow")</h1>
                                    <textarea name="footer" rows="10" cols="50">END<br></textarea>
                                </section>
                            </form>
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
