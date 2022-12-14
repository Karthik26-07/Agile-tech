<?php
include('../Database_Connection/Dbconnect.php');
$timer = date_default_timezone_set("Asia/Kolkata");
$date = new DateTime();
//$Date = $date->format('Y-m-d');
$first_half = "0";
$second_half = "0";
$second_half_time = "00:00:00";
$first_half_time = "00:00:00";
$month = $date->format('F');
$year = $date->format('Y');
$sqli = "select * from attendance where month='$month'";
$result5 = mysqli_query($con, $sqli);
$row = mysqli_fetch_assoc($result5);
    $current_month = $row['month'];

if (empty($current_month)) { {
        $Month = date('m');
        $Year = date('y');
        $S_date = date('d');
        for ($d = $S_date; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $Month, $d, $Year);
            if (date('m', $time) == $Month) {
                $Date = date('Y-m-d', $time);
                $Day = date('D', $time);
                $guery = "select * from holyday ";
                $result1 = mysqli_query($con, $guery);
                while ($Hdate = mysqli_fetch_assoc($result1)) {

                    $holiday_dates = $Hdate['Date'];
                    if ($Date == $holiday_dates) {
                        echo 'Today is holiday';
                    } else {
                        if ($Day == 'Sun') {
                            echo 'Sunday';
                        } else {
                            $stmt = $con->prepare("insert into attendance(user_id,date,first_half,first_half_time,second_half,second_half_time,month,year)VALUES (?,?,?,?,?,?,?,?)");
                            $sql = "select * from registration";
                            $result = mysqli_query($con, $sql);
                            while ($ids = mysqli_fetch_assoc($result)) {
                                $id = $ids['Id'];
                                $stmt->bind_param("ssssssss", $id, $Date, $first_half, $first_half_time, $second_half, $second_half_time, $month, $year);
                                $stmt->execute();
                            }
                        }
                    }
                }
            }
        }
    }

    echo "<script>alert('Succesfullly Configured for this month');</script>";
    echo "<script>window.location.href='../Configure/Holyday.php'</script>";
} else {
    echo "<script>alert('Already configured for this month');</script>";
    echo "<script>window.location.href='../Configure/Holyday.php'</script>";
}
