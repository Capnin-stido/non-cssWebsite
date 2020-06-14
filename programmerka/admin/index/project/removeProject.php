<?php
require('../../../connect.php');
$id = $_POST['id'];

$sql = "DELETE FROM `projects` WHERE `projects`.`id` = '$id';";
$sql = mysqli_query($conn,$sql);
if(!$sql){
  echo "something went wrong";
}
?>
