<?php
require('../../../connect.php');
$imagesLocation = 'C:\xampp\htdocs\programmerka\language\image';

$id = $_POST['id'];

$readData = "SELECT `id`,`location` FROM `language` WHERE `language`.`id` = '$id'";
$readData = mysqli_query($conn,$readData);
$result = mysqli_fetch_assoc($readData);
$oldName = $result['location'];
$oldImageName = $oldName.'.jpg';
if(!empty($_POST['location'])){
    $newName = $_POST['location'];
    $newImageName = $_POST['location'].'.jpg';
    $defaulLocation = getcwd();
    chdir($imagesLocation);
    rename($oldImageName,$newImageName);
    $sql = "UPDATE `language` SET `location` = '$newName' WHERE `language`.`id` = '$id'";
    $sql = mysqli_query($conn,$sql);
    if(!$sql){
      echo 'Something went wrrong';
    } else {
      $oldImageName = $newImageName;
    }
}

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg');
    if(in_array($fileActualExt,$allowed)){
      if($fileError === 0){
        if ($fileSize <100000) {
          chdir($imagesLocation);
          move_uploaded_file($fileTmpName,$oldImageName);
        } else {
          echo 'Too big';
        }
      } else {
        echo 'There was an error uploading your file !';
      }
    } else {
      echo "Yon cann't upload file of this type";
    }
}

if(!empty($_POST['discription'])){
  $discription = $_POST['discription'];
  $sql = "UPDATE `language` SET `discription` = '$discription' WHERE `language`.`id` = '$id'";
  $sql = mysqli_query($conn,$sql);
}

?>
