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
                width: 80%;
                left: 8%;
            }
            body {
                background-image: url("Home.webp");
                background-size: cover;
                background-repeat: no-repeat;
                /*background-position: center;*/
                position: relative;
                /*z-index: 2;*/
                /*overflow: hidden;*/


            }
        </style>
        <title>DispalyAttendance</title>
    </head>
    <body>
        <form class=" card stud   shadow-lg p-3 mb-5 bg-white rounded body" method="post" id="form">
            <div class="form-group" id="printablediv">

                <div class="form-row">
                    <div class="form-group  col-md-" id="data" >
                        <a class="btn btn-secondary px-4 "  onclick="javascript:printDiv('printablediv', 'data')" >Print</a>

                    </div>

                    <?php
                    $query1 = "SELECT COUNT(first_half) AS first_total FROM attendance WHERE  MONTH='$Month' AND YEAR='$Year' AND user_id='$Faculty_id' and first_half=0 and  second_half=1";
                    $result1 = mysqli_query($con, $query1);
                    $total1 = mysqli_fetch_assoc($result1);
                    ?>
                    <div class="form-group  col-md-1 "></div>
                    <div class="form-group  col-md-3 ">
                        <div class="form-outline w-75">
                            <label for="firhalf"><b>First Half Leave</b></label>
                            <input type="text" class="form-control" value="<?php echo $total1['first_total']; ?>"id="First" name="userid" readonly  >
                        </div>
                    </div>
                    <?php
                    $query2 = "SELECT COUNT(second_half) AS second_total FROM attendance WHERE  MONTH='$Month' AND YEAR='$Year' AND user_id='$Faculty_id' and second_half=0 and first_half=1";
                    $result2 = mysqli_query($con, $query2);
                    $total2 = mysqli_fetch_assoc($result2);
                    ?>

                    <div class="form-group  col-md-3 ">
                        <div class="form-outline w-75">
                            <label for="inputphonenumber"><b>Second Half Leave</b></label>
                            <input type="text" class="form-control"  value="<?php echo $total2['second_total']; ?>" id="second" name="userid" readonly  >
                        </div>
                    </div>      
                    <?php
                    $query3 = "SELECT COUNT(user_id) as total_leave FROM attendance WHERE  MONTH='$Month' AND YEAR='$Year' AND user_id='$Faculty_id' AND first_half=0 AND second_half=0";
                    $result3 = mysqli_query($con, $query3);
                    $total3 = mysqli_fetch_assoc($result3);
                    ?>
                    <div class="form-group  col-md-3 ">
                        <div class="form-outline w-75">
                            <label for="inputphonenumber"><b>Full Day Leave</b></label>
                            <input type="text" class="form-control" value="<?php echo $total3['total_leave']; ?>" id="full" name="userid" readonly >
                        </div>
                    </div>

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
                                        <td><?php
                                        $newDate = date("d-m-Y", strtotime($rows['date']));
                                        
                                        echo $newDate; ?> </td>
                                        <?php
                                        if ($rows['first_half'] == 1) {

                                            $rows['first_half'] = '<span style="color:#36b028;text-align:center;">Present</span>';
                                        } else {
                                            if ($rows['first_half'] == 0) {
                                                $rows['first_half'] = '<span style="color:#fc0313;text-align:center;">Absent</span>';
                                            } else {
                                                $rows['first_half'] = '<span style="color:#fc0313;text-align:center;">Absent</span>';
                                            }
                                        }
                                        ?>

                                        <td><?php echo $rows['first_half_time']; ?>   :<?php echo $rows['first_half']; ?></td>
                                        <?php
                                        if ($rows['second_half'] == 1) {
                                            $rows['second_half'] = '<span style="color:#36b028;text-align:center;">Present</span>';
                                        } else {
                                            if ($rows['second_half'] == 0) {
                                                $rows['second_half'] = '<span style="color:#fc0313;text-align:center;">Absent</span>';
                                            } else {
                                                $rows['second_half'] = '<span style="color:#fc0313;text-align:center;">Absent</span>';
                                            }
                                        }
                                        ?>

                                        <td><?php echo $rows['second_half_time']; ?>    :<?php echo $rows['second_half']; ?> </td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            function printDiv(divID, data) {
                //Get the HTML of div
                document.getElementById(data).style.display = "none"

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
