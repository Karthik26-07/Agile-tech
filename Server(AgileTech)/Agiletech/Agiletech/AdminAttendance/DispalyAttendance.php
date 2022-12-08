<?php
include('../Database_Connection/Dbconnect.php');
$Faculty_id = $_GET['Fname'];
$Month = $_GET['Month'];
$Year = $_GET['Year'];
//$sql = "SELECT * FROM attendance
//WHERE user_id='$Faculty_id' AND month='$Month' AND year='$Year'";
$sql = "SELECT * FROM attendance
WHERE user_id=$Faculty_id AND MONTH='$Month' AND YEAR=$Year";
$result = mysqli_query($con, $sql);
$i = 1;
$row = [];
if ($result->num_rows > 0) {

    $row = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            .stud{
                width: 85%;
                left: 8%;
            }
        </style>
        <title>DispalyAttendance</title>
    </head>
    <body>
        <form class=" card stud   shadow-lg p-3 mb-5 bg-white rounded" method="post" id="form">
            <div class="form-group ">

            </div>

            <div class="form-group">
                <table class="table  table-striped table-hover ">
                    <thead>
                        <tr>
                            <th scope=col>S.NO</th>

                            <th scope=col>Date</th>
                            <th scope=col>Morning</th>
                            <th scope=col>Evening</th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($row)) {
                            foreach ($row as $rows) {
                                ?>   <tr>   
                                    <td><?php echo $i++ ?> </td>
                                    <td><?php echo $rows['date']; ?> </td>
                                    <?php
                                    if ($rows['first_half'] == 1) {
                                        $rows['first_half'] = 'Present';
                                    } else {
                                        if ($rows['first_half'] == 0) {
                                            $rows['first_half'] = 'Absent';
                                        } else {
                                            $rows['first_half'] = 'Absent';
                                        }
                                    }
                                    ?>

                                    <td><?php echo $rows['first_half_time']; ?>   :<?php echo $rows['first_half']; ?></td>
                                    <?php
                                    if ($rows['second_half'] == 1) {
                                        $rows['second_half'] = 'Present';
                                    } else {
                                        if ($rows['second_half'] == 0) {
                                            $rows['second_half'] = 'Absent';
                                        } else {
                                            $rows['second_half'] = 'Absent';
                                        }
                                    }
                                    ?>

                                    <td><?php echo $rows['second_half_time']; ?>    :<?php echo $rows['second_half']; ?> </td>


        <?php
    }
}
?>

                            </body>
                            </html>
