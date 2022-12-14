<?php

include('../Database_Connection/Dbconnect.php');
$id = $_GET['id'];
$falg=$_GET['flag'];
//$id = $_POST['id'];
//$flag = $_POST['Flag'];
$update = mysqli_query($con, "update registration set flag='$falg' where Id='$id'");



//header("location:../Faculty/FacultyPage.php");
?>











