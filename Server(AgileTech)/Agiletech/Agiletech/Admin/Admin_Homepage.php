<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Home page</title>
    </head>
    <body>
        <nav class="navbar navbar-light" style="background-color: #a041e8">
            <span class="navbar-brand mb-0 h1">Admin Page</span>
            <ul class="nav nav-pills">

                <li class="nav-item dropdown px-0  ">
                    <a class="nav-link text-white btn " id="faculty" href="../Faculty/FacultyPage.php">Faculty</a>
                </li>
                <li class="nav-item dropdown px-5  ">


                    <a class="nav-link text-white btn" id="Attendance" href="../AdminAttendance/attendenceview.php">Attendance</a>


                </li>
                <li class="nav-item dropdown px-3 ">


                    <a class="nav-link bg-white" href="../Admin/AdminLogin.php">Logout</a>


                </li>
            </ul>
        </nav>
        <form class="my-5">

            <div id="new"></div>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>

            $("#faculty").click(function (e) {
                $.ajax({
                    type: "GET",
                    url: "../Admin/Faculty/FacultyPage.php",
                    success: function (result) {
                        $("#new").html(result);  // print the result
                        return;
                    }

                });
                e.preventDefault();
            });


        </script>
        <script>

            $("#Attendance").click(function (e) {
                $.ajax({
                    type: "GET",
                    url: "../Admin/Attendance/attendenceview.php",
                    success: function (result) {
                        $("#new").html(result);  // print the result
                        return;
                    }

                });
                e.preventDefault();
            });


        </script>-->
    </body>
</html>
