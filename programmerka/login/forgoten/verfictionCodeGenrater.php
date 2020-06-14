<?php
require('../../programmerka.php');
require('../../connect.php');
if(isset($_SESSION['verficationId'])){
  $id = $_SESSION['verficationId'];
  $sql = "SELECT `id`,`timeStated` FROM `forgotenquery` WHERE `forgotenquery`.`id` = $id";
  $sql = mysqli_query($conn,$sql);
  $result = mysqli_fetch_assoc($sql);
  if(verficationLimits($result['timeStated'],1)){
    $_SESSION['verficationId'] = addVerfication($conn,$forgoterEmail);
  }
} else {
  $_SESSION['verficationId'] = addVerfication($conn,$forgoterEmail);
}
header('Location: verfication.php');
}
?>
