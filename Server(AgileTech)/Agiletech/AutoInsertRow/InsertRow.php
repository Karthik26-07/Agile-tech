<?php

include('../Database_Connection/Dbconnect.php');

$timer = date_default_timezone_set("Asia/Kolkata");
$date = new DateTime();
$Date = $date->format('Y-m-d');
$first_half = "0";
$second_half = "0";
$second_half_time = "00:00:00";
$first_half_time = "00:00:00";
$month = $date->format('F');
$year = $date->format('Y');


$guery = "select * from holyday ";
$result1 = mysqli_query($con, $guery);
while ($Hdate = mysqli_fetch_assoc($result1)) {
    $holiday_dates = $Hdate['Date'];
    if ($Date == $holiday_dates) {
        echo 'Don,t insert';
        return;
    } else {
        if (date('D') == 'Sun') {
            echo "Today  Sunday.";
        } else {


            $sql = "select * from registration";
            $result = mysqli_query($con, $sql);
            while ($ids = mysqli_fetch_assoc($result)) {
                $id = $ids['Id'];
                $sqli = "select * from attendance where date='$Date' and user_id='$id'";

                $Attendence = mysqli_query($con, $sqli);
                while ($row = mysqli_fetch_assoc($Attendence)) {
                    $Dates = $row['date'];
                }
                if (empty($Dates)) {
                    $insert = "insert into attendance(user_id,date,first_half,first_half_time,second_half,second_half_time,month,year)"
                            . "values ('$id','$Date','$first_half','$first_half_time','$second_half','$second_half_time','$month','$year')";
                    mysqli_query($con, $insert);
                } else {
                    echo 'DOnt insert';
                }
            }
        }
    }
}
