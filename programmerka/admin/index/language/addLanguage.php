<?php
require('../../../connect.php');
$imagesLocation = 'C:\xampp\htdocs\programmerka\language\image';

$location = $imageName = $discription = $languageName ='';
$error = '';


if(!empty($_POST['location'])){
  $languageLocation = $_POST['location'];
  $sql = "SELECT * FROM `language` WHERE `language`.`location` = '$languageLocation'";
  $sql = mysqli_query($conn,$sql);
  if(mysqli_num_rows($sql) != 0){
      $error .= "This userName is already used";
      echo 'This userName is already used';
  } else {
    $location = $languageLocation ;
  }
} else {
  $error .= "Idot pleases give location";
  echo "Idot pleases give location";
}

if(!empty($_POST['languageName'])){
  $languageName = $_POST['languageName'];
} else {
  $error .= "Idot pleases give Name";
  echo "Idot pleases give Name";
}

if(!empty($_POST['discription'])){
  $discription = $_POST['discription'];
} else {
  $error .= "Idot pleases give discription";
  echo "Idot pleases give discription";
}

if (isset($_POST['submit'])) {
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg');
    if(in_array($fileActualExt,$allowed)){
      if($fileError === 0){
        if ($fileSize <100000) {
          chdir($imagesLocation);
          $imageName = $location.'.jpg';
          move_uploaded_file($fileTmpName,$imageName);
        } else {
          $error .= "Too big";
          echo 'Too big';
        }
      } else {
        $error .= "There was an error uploading your file !";
        echo 'There was an error uploading your file !';
      }
    } else {
      $error .= "Yon cann't upload file of this type";
      echo "Yon cann't upload file of this type";
    }
}

if( $error=='' ){
  $sql = "INSERT INTO `language` (`id`, `languageName`, `location`, `discription`) VALUES (NULL, '$languageName', '$location', '$discription');";
  $sql = mysqli_query($conn,$sql);
  if(!$sql){
    echo 'Some thing went wrong';
  }
}
