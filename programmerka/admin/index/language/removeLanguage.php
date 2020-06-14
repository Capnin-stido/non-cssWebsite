<?php
require('../../../connect.php');
$id = $_POST['Id'];
$removeLanguage = "DELETE FROM `language` WHERE `language`.`id` = $id";
$removeLanguage = mysqli_query($conn,$removeLanguage);
if(!$removeLanguage){
  echo "Sorry can't remove the subject";
}
?>
