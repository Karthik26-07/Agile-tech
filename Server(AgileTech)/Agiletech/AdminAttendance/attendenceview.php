<?php include('../Admin/Admin_Homepage.php'); ?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            .stud{
                width: 60%;
                left: 8%;
            }
            .button {

                border: none;
                color: white;
                padding: 8px 30px;
                text-align: center;
                text-decoration: none;
                border-radius: 8px;
                font-size: 16px;
                margin: 2px 2px;

                width: 150px;






            }
        </style>
        <title>Attendance</title>
    </head>
    <body>
        <form class=" card index my-5 stud  shadow-lg p-3 mb-5 bg-white rounded">


            <div class="form-group row my-5 ">

                <label class=" col-form-label px-3">  <b> Name:</b></label> <select class="btn btn-secondary px-3" name="selectnameid" id="name" selected="selected">
                    <option value="" selected="selected"  >--Select Name--</option>
                    <?php
                    include('../Database_Connection/Dbconnect.php');
                    session_start();
                    $sql = "SELECT * from registration";
                    $result2 = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($result2)) {
                        ?>
                        <option value="<?php echo $row['Id']; ?>"  ><?php echo $row['first_name']; ?></option>
                    <?php } ?>
                </select>


                <label class=" col-form-label px-3">  <b> Year:</b></label> <select class="btn btn-secondary px-3" name="selectnameid" id="year"  selected="selected">
                    <option value="" selected="selected"  >--Select Year--</option>
                    <?php
                    include('../Database_Connection/Dbconnect.php');
                    session_start();
                    $sql = "SELECT DISTINCT year FROM attendance ORDER BY year DESC";
                    $result1 = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($result1)) {
                        ?>

                        <option value="<?php echo $row['year']; ?>" ><?php echo $row['year']; ?></option>
                    <?php } ?>
                </select>


                <label class=" col-form-label px-3">  <b> Month:</b></label> <select class="btn btn-secondary px-3" name="selectnameid" id="month" selected="selected">
                    <option value="" selected="selected"  >--Select Month--</option>
                    <?php
                    include('../Database_Connection/Dbconnect.php');
                    session_start();
                    $sql = "SELECT DISTINCT month FROM attendance ORDER BY month DESC";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['month']; ?>"  ><?php echo $row['month']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <div class="text-center">
                <button class="btn-primary button" id="button">Show</button>
            </div>
        </form>
        <div id="display"></div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#button").click(function (e) {
                    if ($("#name").val() === "" || $("#year").val() === "" || $("#month").val() === "") {

                        
                    } else {
                        $.ajax({
                            type: "GET",
                            url: "DispalyAttendance.php",
                            data: {Fname: $("#name").val(),
                                Year: $("#year").val(),
                                Month: $("#month").val()

                            }, //sending the data to the displayStudent.php

                            success: function (result) {

                                $("#display").html(result);
                                return;
                                // print the result

                            }

                        });
                    }

                    e.preventDefault();

                });

            });





        </script>
    </body>
</html>
