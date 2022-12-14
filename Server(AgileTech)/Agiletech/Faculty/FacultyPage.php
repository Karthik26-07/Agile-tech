

<?php
include('../Admin/Admin_Homepage.php');
include('../Database_Connection/Dbconnect.php');
$sql = "select * from registration";
$result = mysqli_query($con, $sql);
$i = 1;
$row = [];
if ($result->num_rows > 0) {

    $row = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Attedence</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            .stud{
                width: 85%;
                left: 8%;
            }
            body {
                background-image: url("Home.webp");
                background-size: cover;
                background-repeat: no-repeat;
                /*background-position: center;*/
                position: relative;
                /*z-index: 2;*/
                overflow: auto;


            }
        </style>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var scrollpos = localStorage.getItem('scrollpos');
                if (scrollpos)
                    window.scrollTo(0, scrollpos);
            });

            window.onbeforeunload = function () {
                localStorage.setItem('scrollpos', window.scrollY);
            };
        </script>

    </head>

    <body>
        <form class=" card stud   shadow-lg p-3 mb-5 bg-white rounded body" method="post" id="form">
            <div class="form-group ">

            </div>

            <div class="form-group">
                <table class="table  table-striped table-hover ">
                    <thead>
                        <tr>
                            <th scope=col>S.NO</th>

                            <th scope=col>First Name</th>
                            <th scope=col>Last Name</th>
                            <th scope=col>Phone Number</th>
                            <th scope=col>Email</th>
                            <th scope=col>Status</th>
                            <th scope=col>Action</th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($row)) {
                            foreach ($row as $row) {
                                ?>   <tr>   
                                    <td><?php echo $i++ ?> </td>
                                    <td><?php echo $row['first_name']; ?> </td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['contact_number']; ?> </td>
                                    <td><?php echo $row['email_id']; ?></td>
                                    <td> <?php
                                        if ($row['flag'] == 0) {
                                           
                                            echo   '<span style="color:#fc0313;text-align:center;">Deactive</span>';
                                        } else {
                                           
                                            echo  '<span style="color:#36b028;text-align:center;">Active</span>';
                                        }
                                        ?></td>
                                    <td class="Action" id="<?= $row['Id'] ?>"> <?php
                                        if ($row['flag'] == '0') {
                                            echo '<p> <button type="button"  onclick="change(' . $row['Id'] . ',1);" class="btn btn-success" >Enable</button></p>';

//                                    echo '<p> <a href="UpdateStatus.php?id='.$row['Id'].'&flag=1" class="btn btn-success" id="check" >Enable</a></p>';
                                        } else if ($row['flag'] == '1') {
                                            echo '<p> <button type="button"  onclick="change(' . $row['Id'] . ',0);" class="btn btn-danger" >Disable</button></p>';
//                                      echo '<p> <a href="UpdateStatus.php?id='.$row['Id'].'&flag=0" class="btn btn-danger" id="check" >Disable</a></p>';
                                        }
                                        ?></td>
                                    <?php
                                }
                            }
                            ?>


                    </tbody>
                </table>
            </div></form>
        <div id ="here"></div>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


        <script type="text/javascript"  >

            function change(id, data) {
                if (confirm('Are you sure?')) {
                    $.ajax({
                        type: "GET",
                        url: "UpdateStatus.php",

                        data: {id: id,
                            flag: data},
                        timeout: 10000,
                        success: function () {
                            document.location.reload()
                        }
                    });
                } else {
                    // Do nothing!
                   
                }
            }


        </script>

    </body>
</html>
