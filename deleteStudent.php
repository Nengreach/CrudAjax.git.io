<?php
include 'connection.php';
global $con;
$id = $_POST['delete_id'];
$sql = "DELETE FROM `students` WHERE id = '$id'";
$result = $con->query($sql);
?>