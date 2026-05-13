<?php
include "connection.php";
global $con;

$id = $_POST['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$profile = $_POST['profile'];
$sql = "UPDATE students SET name='$name',gender='$gender',dob='$dob',profile='$profile' WHERE id=$id";

$result = $con->query($sql);


?>