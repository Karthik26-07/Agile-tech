<?php

include('../Database_Connection/Dbconnect.php');
session_start();
//$Email_Id ="karthigudigar@gmail.com";
//$login_password="qwerty";
$Email_Id = $_GET['Login_Email'];
$login_password = $_GET['Login_Password'];
$sql = "select * from registration where email_id='$Email_Id' and password='$login_password'";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $ID = $row['Id'];
    $falg = $row['flag'];
    $_SESSION['Id'] = $row['Id'];
    $Email=$row['email_id'];
    $fname=$row['first_name'];
    $lname=$row['last_name'];
    $name=$fname. " " . $lname. "";
    $_SESSION['email'] = $row['email_id'];
    $_SESSION['Name'] = $name;
//    $data = array(
//        "email" => $Email,
//        "name" => $name,
//       
//    );
//   array_push($login, $data);
}
if (!empty($ID)) {
    if ($falg == 1) {
        $data = array('response' => 'Successfully login',
              "email" => $Email,
              "name" => $name,
              "id"=>$ID,
            ); // for invalid login response
        
        } else {
        $data = array('response' => '! You are not allowed to Login ! Please contact admin !'); // for invalid login response
   
        }
} else {
    $data = array('response' => "Invalid credential"); // for invalid login response
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);

//}
