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
$current_date = $date->format('Y-m-d');
$current_time = $date->format('H:i:s');
$month = $date->format('F');
$Year = $date->format('Y');
$flag= TRUE;


   
    $time="select * from  time_management where ID=1";
    $result6= mysqli_query($con, $time);
    $row1= mysqli_fetch_assoc($result6);
    $morning=$row1['morning_time'];
    $evening=$row1['evening_time'];
    
    
    
    





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
    $guery = "select * from holyday ";
    $result1 = mysqli_query($con, $guery);
    while ($Hdate = mysqli_fetch_assoc($result1)) {
       
        $holiday_dates = $Hdate['Date'];
        if ($current_date == $holiday_dates) {
            $flag = FALSE;
//        echo 'Don,t insert';
            break;
        }
    }

    if (date('D')!= 'Sun' && $flag) {
//            echo "Today  Sunday.";
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
        $data2 = array('response' => 'We Cannot take attendance in holydays');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data2);
    }
} else {
//if no records exist on perticular dateor month

    $data3 = array('response' => 'Thereis no records founds on current date please contact admin');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data3);
}

// Attedence for first half
function firsthalf() {
    $first_half_time = $GLOBALS['current_time'];
    $Id = $GLOBALS['id'];
    $Date = $GLOBALS['current_date'];
    $first_half = "1";
    $morning=$GLOBALS['morning'];
//    $second_half = "0";
//    $second_half_time = "00:00:00";
    $conn = $GLOBALS['con'];
//    $month = $GLOBALS['month'];
//    $year = $GLOBALS['Year'];
//Checking he reached the company at currect time
    if ($first_half_time <=$morning) {
//reached at current time
        $sql = "update attendance set first_half='$first_half',first_half_time='$first_half_time' where user_id='$Id' and date='$Date' ";

//        $sql = "insert into attendance(user_id,date,first_half,first_half_time,second_half,second_half_time,month,year)"
//                . "values ('$Id','$Date','$first_half','$first_half_time','$second_half','$second_half_time','$month','$year')";

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
        $data = array('response' => 'Sorry you are too late! We cant take your attedence');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}

//function secondhalf() {
//    $second_half_time = $GLOBALS['current_time'];
//    $Id = $GLOBALS['id'];
//    $Date = $GLOBALS['current_date'];
//    $second_half = "1";
//    $conn = $GLOBALS['con'];
//    $first_half = "0";
//
//    $first_half_time = "00:00:00";
//    $month = $GLOBALS['month'];
//    $year = $GLOBALS['Year'];
//    //Checking he reached the company at currect time
//    if ($second_half_time >= "18:00:00") {
//        //reached at current time
//        $sql = "insert into attendance(user_id,date,first_half,first_half_time,second_half,second_half_time,month,year)"
//                . "values ('$Id','$Date','$first_half','$first_half_time','$second_half','$second_half_time','$month','$year')";
//
//        if ($conn->query($sql) === TRUE) {
//            $data = array('response' => 'Your Evening attendance is successfully taken');
//            header('Content-Type: application/json; charset=utf-8');
//            echo json_encode($data);
//        } else {
//            $data = array('response' => 'Failed to put your attendance! Try again');
//            header('Content-Type: application/json; charset=utf-8');
//            echo json_encode($data);
//        }
//    } else {
//        // in he not reached at currect time
//        $data = array('response' => 'Sorry we cannot take your attedence at this time');
//        header('Content-Type: application/json; charset=utf-8');
//        echo json_encode($data);
//    }
//}

function update_secondhalf() {


    $second_half_time = $GLOBALS['current_time'];
    $Id = $GLOBALS['id'];
    $Date = $GLOBALS['current_date'];
    $second_half = "1";
    $conn = $GLOBALS['con'];
    $evening=$GLOBALS['evening'];
    if ($second_half_time >= $evening) {
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

//function insert() {
//
//    $Radio = $GLOBALS['radio'];
//    $conn = $GLOBALS['con'];
//    $timer = date_default_timezone_set("Asia/Kolkata");
//    $date = new DateTime();
//    $Date = $date->format('Y-m-d');
//    $first_half = "0";
//    $second_half = "0";
//    $second_half_time = "00:00:00";
//    $first_half_time = "00:00:00";
//    $month = $date->format('F');
//    $year = $date->format('Y');
//    $flag = TRUE;
//
//    $guery = "select * from holyday ";
//    $result1 = mysqli_query($conn, $guery);
//    while ($Hdate = mysqli_fetch_assoc($result1)) {
//        $holiday_dates = '';
//        $holiday_dates = $Hdate['Date'];
//        if ($Date == $holiday_dates) {
//            $flag = FALSE;
////        echo 'Don,t insert';
//            break;
//        }
//    }
//
//    if (date('D') != 'Sun' && $flag) {
////            echo "Today  Sunday.";
//
//
//        $stmt = $conn->prepare("insert into attendance(user_id,date,first_half,first_half_time,second_half,second_half_time,month,year)VALUES (?,?,?,?,?,?,?,?)");
//        $sqli = "select * from attendance where date=? and user_id=?";
//        $rs = $conn->prepare($sqli);
//
//        $sql = "select * from registration";
//        $result = mysqli_query($conn, $sql);
//        while ($ids = mysqli_fetch_assoc($result)) {
//            $id = $ids['Id'];
//            $Dates = '';
//
//            $rs->bind_param("ss", $Date, $id);
//            $rs->execute();
//            $row = $rs->get_result();   // <--- add this instead
//            if ($row->num_rows > 0) {     // <--- change to $result->...!
//                while ($data = $row->fetch_assoc()) {
//
//                    $Dates = $data['date'];  // <--- available in $data
//                }
//            }
//
//
//            if (empty($Dates)) {
//
//                $stmt->bind_param("ssssssss", $id, $Date, $first_half, $first_half_time, $second_half, $second_half_time, $month, $year);
//                $stmt->execute();
//            } else {
//                
//            }
//        }
//    } else {
//        $data = array('response' => 'We cannot take attendence in holydays');
//        header('Content-Type: application/json; charset=utf-8');
//        echo json_encode($data);
//    }
//}
