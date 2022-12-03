<?php

include('../Database_Connection/Dbconnect.php');

//if(empty($_POST['FirstName'])){
//      $data = array('response' => 'Name is empty');
//   header('Content-Type: application/json; charset=utf-8');
//    echo json_encode($data);
//}else if (empty ( $_POST['LastName'])) {
//        $data = array('response' => 'last name is empty');
// header('Content-Type: application/json; charset=utf-8');
//    echo json_encode($data);
//    
//}else if (empty ( $_POST['Contact'])) {
//        $data = array('response' => 'Phone number is empty');
// header('Content-Type: application/json; charset=utf-8');
//    echo json_encode($data);
//    
//}
//else if (empty ( $_POST['Email'])) {
//        $data = array('response' => 'Email  is empty');
// header('Content-Type: application/json; charset=utf-8');
//    echo json_encode($data);
//    
//}
//else if (empty ( $_POST['Password'])) {
//        $data = array('response' => 'Password is empty');
// header('Content-Type: application/json; charset=utf-8');
//    echo json_encode($data);
//    
//} else {
   $fname = $_POST['FirstName'];
   $lname = $_POST['LastName'];
   $contact = $_POST['Contact'];
   $email = $_POST['Email'];
   $password = $_POST['Password']; 

$sql = "insert into registration(first_name,last_name,contact_number,email_id,password)"
        . "values ('$fname','$lname','$contact','$email','$password')";
if ($con->query($sql) === TRUE) {
    $data = array('response' => 'Successfully registered');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
} else {
    $data = array('response' => 'Failed to register');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
//}




