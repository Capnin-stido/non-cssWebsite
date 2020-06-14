<?php
$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbname = 'programmerka';

$conn = mysqli_connect($serverName,$userName,$password,$dbname);

date_default_timezone_set("Asia/Kolkata");

if (!$conn) {
  die('Something went wrong');
}

 ?>
