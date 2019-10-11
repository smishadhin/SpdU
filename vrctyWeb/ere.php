<!DOCTYPE html>
<html>
<head>
    <link href="public/css/stylect.css" rel="stylesheet" media="screen" type="text/css"/>
    <!-- Responsive CSS -->
    <link href="public/css/responsive.css" rel="stylesheet" media="screen" type="text/css"/>
    <link rel="stylesheet" href="public/styleadmin.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <style>
        th {
            border-bottom: 1px solid #d6d6d6;
        }

        tr:nth-child(even) {
            background: #e9e9e9;
        }
    </style>
</head>
<body>




    <ul class="nav" style="color: #4cae4c">
        <div class="logo">Admin Panal (<?php //echo $semestercode ?>)</div>
        <li><a href="<?php //echo $_SESSION['id'] ?>">Home</li>
        <!--    <li><a href="teacherlistforadmin.php"> Give Course Offer</li>-->
        <li><a href="public/makecourseoffer.php">Declare course offer</a></li>
        <li><a href="inputallcourses.php">Manage Data</a></li>
        <li><a href="generatereport.php">Generate Report</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>





        <form>
            <input id="filterTable-input" data-type="search" placeholder="Search For Customers...">
        </form>
    <section style="width: 20%">
        <table data-role="table" data-mode="columntoggle" class="ui-responsive ui-shadow" id="myTable" data-filter="true" data-input="#filterTable-input">
            <thead>
            <tr>
                <th data-priority="6">CustomerID</th>
                <th>CustomerName</th>
                <th data-priority="1">ContactName</th>
                <th data-priority="2">Address</th>
                <th data-priority="3">City</th>
                <th data-priority="4">PostalCode</th>
                <th data-priority="5">Country</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0;$i<10;$i++){
                echo "<tr>
                <td>{$i}</td>
                <td>Alfreds{$i} Futterkiste</td>
                <td>Maria Anders</td>
                <td>Obere Str. 57</td>
                <td>Berlin</td>
                <td>12209</td>
                <td>Germany</td>
            </tr>";
            }

            ?>
            <tr>
                <td>2</td>
                <td>Antonio Moreno Taquería</td>
                <td>Antonio Moreno</td>
                <td>Mataderos 2312</td>
                <td>México D.F.</td>
                <td>05023</td>
                <td>Mexico</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Around the Horn</td>
                <td>Thomas Hardy</td>
                <td>120 Hanover Sq.</td>
                <td>London</td>
                <td>WA1 1DP</td>
                <td>UK</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Berglunds snabbköp</td>
                <td>Christina Berglund</td>
                <td>Berguvsvägen 8</td>
                <td>Luleå</td>
                <td>S-958 22</td>
                <td>Sweden</td>
            </tr>

            </tbody>
        </table>
    </section>


    <div data-role="footer">
        <h1>Footer Text</h1>
    </div>

<section >

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
                    <div id="containers">
                        <div id="tabPanel1">



                            <!--//////////////////////////////////////////////////-->








                            <!-- /////////////////////////////////////////////////////////////////////////////////////////////////-->



                        </div>

                        <div id="tabPanel2">



                        </div>
                        <!--<div id="tabPanel3">

                        </div>-->
                        <div id="tabPanel3">

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

        window.onload=function() {
            // when the page loads, grab the li elements
            tabLinks = document.getElementById("tabs").getElementsByTagName("li");
            // Now get all the tab panel container divs
            tabPanels = document.getElementById("containers").getElementsByTagName("div");

            // activate the _first_ one
            displayPanel(tabLinks[0]);

            // attach event listener to links using onclick and onfocus, fire the displayPanel function, return false to disable the link
            for (var i = 0; i < tabLinks.length; i++) {
                tabLinks[i].onclick = function() {
                    displayPanel(this);
                    return false;
                }
                tabLinks[i].onfocus = function() {
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

