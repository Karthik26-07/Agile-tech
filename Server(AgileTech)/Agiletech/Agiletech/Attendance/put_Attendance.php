<?php

include('../Database_Connection/Dbconnect.php');
session_start();
$id = $_SESSION['Id'];
$radio = $_POST['radio'];
//$radio="First half";
//$radio="Second half";
//$id=73;

$timer = date_default_timezone_set("Asia/Kolkata");
$date = new DateTime();
$current_date = $date->format('d-m-Y');
$current_time = $date->format('H:i:s');
$month = $date->format('F');
$Year = $date->format('Y');



$guery = "select * from attendance where date='$current_date' and user_id='$id'";
$result = mysqli_query($con, $guery);
while ($row = mysqli_fetch_assoc($result)) {
    $Ids = $row['id'];
    $first_half = $row['first_half'];
    $second_half = $row['second_half'];
}



//Checking if database already contains the records   
if (!empty($Ids)) {
    // if exist the check he already put his attendance
    if ($radio == "First half") {
        if ($first_half == "1") {
            $data = array('response' => 'We are already taken your morning  attendance');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            firsthalf();
        }
    } else {
        if ($radio == "Second half") {
            if ($second_half == "1") {
                $data = array('response' => 'We are already taken your evening  attendance');
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            } else {
                update_secondhalf();
            }
        }
    }
} else {
    //if no records exist on perticular date
    if ($radio == "First half") {
        firsthalf();
    } else {
        secondhalf();
    }
}

// Attedence for first half
function firsthalf() {
    $first_half_time = $GLOBALS['current_time'];
    $Id = $GLOBALS['id'];
    $Date = $GLOBALS['current_date'];
    $first_half = "1";
    $second_half = "0";
    $second_half_time = "00:00:00";
    $conn = $GLOBALS['con'];
    $month=$GLOBALS['month'];
    $year=$GLOBALS['Year'];
    //Checking he reached the company at currect time
    if ($first_half_time <= "09:30:00") {
        //reached at current time
        $sql = "insert into attendance(user_id,date,first_half,first_half_time,second_half,second_half_time,month,year)"
                . "values ('$Id','$Date','$first_half','$first_half_time','$second_half','$second_half_time','$month','$year')";

        if ($conn->query($sql) === TRUE) {
            $data = array('response' => 'Your Morning attendance successfully taken');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            $data = array('response' => 'Failed to put your attendance! Try again');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        }
    } else {
        // in he not reached at currect time
        $data = array('response' => 'Sorry you are to late! We cant take your attedence');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}

function secondhalf() {
    $second_half_time = $GLOBALS['current_time'];
    $Id = $GLOBALS['id'];
    $Date = $GLOBALS['current_date'];
    $second_half = "1";
    $conn = $GLOBALS['con'];
    $first_half = "0";

    $first_half_time = "00:00:00";
     $month=$GLOBALS['month'];
    $year=$GLOBALS['Year'];
    //Checking he reached the company at currect time
    if ($second_half_time >= "18:00:00") {
        //reached at current time
        $sql = "insert into attendance(user_id,date,first_half,first_half_time,second_half,second_half_time,month,year)"
                . "values ('$Id','$Date','$first_half','$first_half_time','$second_half','$second_half_time','$month','$year')";

        if ($conn->query($sql) === TRUE) {
            $data = array('response' => 'Your Evening attendance is successfully taken');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            $data = array('response' => 'Failed to put your attendance! Try again');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        }
    } else {
        // in he not reached at currect time
        $data = array('response' => 'Sorry we cannot take your attedence at this time');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}

function update_secondhalf() {

 
    $second_half_time = $GLOBALS['current_time'];
    $Id = $GLOBALS['id'];
    $Date = $GLOBALS['current_date'];
    $second_half = "1";
    $conn = $GLOBALS['con'];
    if ($second_half_time >= "18:00:00") {
        $sql = "update attendance set second_half='$second_half',second_half_time='$second_half_time' where user_id='$Id' and date='$Date' ";

        if ($conn->query($sql) === TRUE) {
            $data = array('response' => 'Your Evening attendance successfully taken');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            $data = array('response' => 'Failed to put your attendance! Try again');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        }
    } else {
        $data = array('response' => 'Sorry we cannot take your attedence at this time');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}
