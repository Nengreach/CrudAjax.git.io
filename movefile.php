<?php
$profile = $_FILES['profile']['name'];
$tmp_name = $_FILES['profile']['tmp_name'];
$path = "./upload/".$profile;

move_uploaded_file($tmp_name,$path);
echo $profile;
?>