<?php

include('../Database_Connection/Dbconnect.php');


$id = $_POST['id'];
//$id = $_GET['id'];
//$isenabled=$_GET['isenabled'];
var_dump($id);
$sql = "select * from registration where Id='$id'";
$result1 = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result1)) {
    $flag = $row['flag'];
}
var_dump($flag);
if ($flag === '1') {
    $update = mysqli_query($con, "update registration set flag=0 where Id='$id'");
} else if ($flag === '0') {

    $update1 = mysqli_query($con, "update registration set flag=1 where Id='$id'");
}

//header("location:../Admin/Admin_Homepage.php?");
?>











