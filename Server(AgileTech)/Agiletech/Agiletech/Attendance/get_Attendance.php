<?php

include('../Database_Connection/Dbconnect.php');
session_start();
$id = $_SESSION['Id'];
$timer = date_default_timezone_set("Asia/Kolkata");
$date = new DateTime();
$Date = $date->format('d-m-Y');
//$id=73;
$sql = "SELECT *
FROM attendance
WHERE user_id='$id' 
 
 ORDER BY id DESC LIMIT 7";
$result = mysqli_query($con, $sql);
$Attendance = [];
while ($row = mysqli_fetch_assoc($result)) {
    $first = $row['first_half'];
    $second = $row['second_half'];
    if ($first == 1) {
        $first = 'Present';
    } else {
        $first = 'Absent';
    }
    if ($second == 1) {
        $second = 'Present';
    } else {
        $second = 'Absent';
    }
    $item = array(
        "date" => $row['date'],
        "first_half" => $first,
        "first_half_time" => $row['first_half_time'],
        "second_half" => $second,
        "second_half_time" => $row['second_half_time']
    );
    array_push($Attendance, $item);
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode($Attendance);
