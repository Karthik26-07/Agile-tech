<?php

include('../Database_Connection/Dbconnect.php');
session_start();
//if(empty($_POST['Login_Email'])){
//  $data = array('response' => 'Email is empty');
//  
//    header('Content-Type: application/json; charset=utf-8');
//    echo json_encode($data);  
//}else if(empty ($_POST['Login_Password'])){
//     $data = array('response' => 'Password is isempty');
//  
//    header('Content-Type: application/json; charset=utf-8');
//    echo json_encode($data);
//}else{
$Email_Id = $_POST['Login_Email'];
$login_password = $_POST['Login_Password'];
$sql = "select * from registration where email_id='$Email_Id' and password='$login_password'";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $ID = $row['Id'];
    $falg = $row['flag'];
    $_SESSION['Id'] = $row['Id'];
}
if (!empty($ID)) {
    if ($falg == 1) {
        $data = array('response' => 'Successfully login'); // for invalid login response
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    } else {
        $data = array('response' => 'You are not allowed to Login'); // for invalid login response
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
} else {
    $data = array('response' => "Invalid credential"); // for invalid login response
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}

//}
