<?php
include('../Database_Connection/Dbconnect.php');
session_start();
$Month = $_GET['month'];
$Year = $_GET['year'];
//$sql = "SELECT * FROM attendance
//WHERE user_id='$Faculty_id' AND month='$Month' AND year='$Year'";
$sql = "SELECT DISTINCT registration.first_name,
registration.last_name,
registration.Id

FROM registration
JOIN attendance
WHERE registration.Id=attendance.user_id
AND MONTH='$Month' AND YEAR='$Year'";
$result = mysqli_query($con, $sql);
$i = 1;
$row = [];
if ($result->num_rows > 0) {

    $row = $result->fetch_all(MYSQLI_ASSOC);
}
$sqli = "SELECT 
COUNT(DISTINCT(DATE)) AS total_days
FROM attendance

WHERE MONTH='$Month' AND YEAR='$Year'";
$result4 = mysqli_query($con, $sqli);
$days = mysqli_fetch_assoc($result4);
$_SESSION['days'] = $days['total_days'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title></title>
    </head>
    <body>
        <form class=" card stud   shadow-lg p-3 mb-5 bg-white rounded body" method="post" id="form">
            <div class="form-group" id="printablediv">
                <div style="align-content: left" id="data">
                    <input class="btn btn-secondary" value="Print" onclick="javascript:printDiv('printablediv', 'data')" />

                </div>
                <table class="table  table-striped table-hover " id="table">

                    <thead>
                        <tr>
                            <th scope=col>S.NO</th>

                            <th scope=col>Name</th>
                            <th scope=col>Total working Days</th>
                            <th scope=col>First Half Leave</th>
                            <th scope=col>Second Half Leave</th>
                            <th scope=col>Full Day Leave</th>
                            <th scope=col>Total Absent</th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($row)) {
                            foreach ($row as $rows) {
                                $Faculty_id = $rows['Id'];
                                $query1 = "SELECT COUNT(first_half) AS first_total FROM attendance WHERE  MONTH='$Month' AND YEAR='$Year' AND user_id='$Faculty_id' and first_half=0 and second_half=1";
                                $result1 = mysqli_query($con, $query1);
                                $first = [];
                                if ($result1->num_rows > 0) {

                                    $first = $result1->fetch_all(MYSQLI_ASSOC);
                                }
                                $query2 = "SELECT COUNT(second_half) AS second_total FROM attendance WHERE  MONTH='$Month' AND YEAR='$Year' AND user_id='$Faculty_id' and second_half=0 and first_half=1";
                                $result2 = mysqli_query($con, $query2);
                                $second = [];
                                if ($result2->num_rows > 0) {

                                    $second = $result2->fetch_all(MYSQLI_ASSOC);
                                }
                                $query3 = "SELECT COUNT(user_id) as total_leave FROM attendance WHERE  MONTH='$Month' AND YEAR='$Year' AND user_id='$Faculty_id' AND first_half=0 AND second_half=0";
                                $result3 = mysqli_query($con, $query3);
                                $third = [];
                                if ($result3->num_rows > 0) {

                                    $third = $result3->fetch_all(MYSQLI_ASSOC);
                                }
                                ?>   <tr>   
                                    <td><?php echo $i++ ?> </td>
                                    <td><?php echo $rows['first_name']; ?> <?php echo $rows['last_name']; ?> </td>
                                    <td><?php echo $_SESSION['days']; ?> </td>
                                    <?php foreach ($first as $first_half) { ?>

                                        <td><?php echo $first_half['first_total']; ?> </td>
                                        <?php foreach ($second as $second_half) { ?>

                                            <td><?php echo $second_half['second_total']; ?> </td>
                                            <?php foreach ($third as $total_leave) { ?>

                                                <td><?php echo $total_leave['total_leave']; ?> </td>

                                                <?php
                                                $f_half = $first_half['first_total'];
                                                $s_half = $second_half['second_total'];
                                                $total = $total_leave['total_leave'];
                                                $sum1 = $f_half + $s_half;
                                                $sum = $sum1 / 2;
                                                $total_absent = $total + $sum;
                                                ?>
                                                <td><?php echo $total_absent; ?> </td>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                        </tr></tbody></table></div></form>

        <script type="text/javascript">
            function printDiv(divID, data) {
                document.getElementById(data).style.display = "none"
                //Get the HTML of div
                var divElements = document.getElementById(divID).innerHTML;
                //Get the HTML of whole page
                var oldPage = document.body.innerHTML;
                //Reset the page's HTML with div's HTML only
                document.body.innerHTML =
                        "<html><head><title></title></head><body>" +
                        divElements + "</body>";
                //Print Page
                window.print();
                //Restore orignal HTML
                document.body.innerHTML = oldPage;
                location.reload();
            }

        </script>

    </body>
</html>
