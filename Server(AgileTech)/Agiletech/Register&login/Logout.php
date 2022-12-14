<?php

session_start();
session_destroy();
$data = array('response' => "Logout"); // for invalid login response
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>