<?php
include "connection.php";

$name = $_POST['name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$profile = $_POST['profile'];

$insert = "INSERT INTO students(name, gender, dob, profile) 
VALUES ('$name','$gender','$dob','$profile')";

$con->query($insert);
echo $con->insert_id;
?>