
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="public/css/stylect.css" rel="stylesheet" media="screen" type="text/css"/>
    <!-- Responsive CSS -->
    <link href="public/css/responsive.css" rel="stylesheet" media="screen" type="text/css"/>
    <link rel="stylesheet" href="public/styleadmin.css"/>
</head>
<body >

            <section class="course_details_info">
                <div class="course_contant_info">

                        <table class="course_table_info" border="1" style="border-collapse: collapse">

                            <tr>
                                <td><b>Level&Term</b></td>
                                <td><b>Course Code</b></td>
                                <td><b>Course Title</b></td>
                                <td><b>Credit</b></td>
                                <td><b>Sections</b></td>

                            </tr>
                            <?php
                            for ($i=0;$i<5;$i++){


                            echo "<tr>
                                <td rowspan=\"6\">L1T1</td>
                                <!--<td>CSE111</td>
                                <td>Computer fundamental</td>
                                <td>3</td>
                                <td>pc-a,pc-b,pc-c</td>-->

                            </tr>";

                            for ($j=0;$j<5;$j++){
                                echo "<tr>

                                <td>CSE111</td>
                                <td>Computer fundamental</td>
                                <td>3</td>
                                <td>pc-a,pc-b,pc-c</td>

                            </tr>";
                            }

                            }
                            ?>



                           <!-- <tr>

                                <td>CSE111</td>
                                <td>Computer fundamental</td>
                                <td>3</td>
                                <td>pc-a,pc-b,pc-c</td>

                            </tr>
                            <tr>

                                <td>CSE111</td>
                                <td>Computer fundamental</td>
                                <td>3</td>
                                <td>pc-a,pc-b,pc-c</td>

                            </tr>
                            <tr>
                                <td rowspan="3">2</td>
                                <td>CSE111</td>
                                <td>Computer fundamental</td>
                                <td>3</td>
                                <td>pc-a,pc-b,pc-c</td>

                            </tr>
                            <tr>

                                <td>CSE111</td>
                                <td>Computer fundamental</td>
                                <td>3</td>
                                <td>pc-a,pc-b,pc-c</td>

                            </tr>
                            <tr>

                                <td>CSE111</td>
                                <td>Computer fundamental</td>
                                <td>3</td>
                                <td>pc-a,pc-b,pc-c</td>

                            </tr>-->
                        </table>
                </div>
            </section>



</body>
</html>
