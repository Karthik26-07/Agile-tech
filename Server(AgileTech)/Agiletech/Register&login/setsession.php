<?php
session_start();
$id=(int)$_POST['U_ID'];

$_SESSION['Id']=$id;
       
$data = array('response' => 'reset');
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);



?>