<?php
require('../../../connect.php');
$projectId = $_POST['projectId'];
$sql = "SELECT `location` FROM `projects` WHERE `projects`.`id`='$projectId'";
$sql = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($sql);
$imageLocation = $result['location'].".jpg";
$path = 'C:\xampp\htdocs\programmerka\projectFile\image';
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
        if ($fileSize <1000000) {
          chdir($path);
          echo $path;
          move_uploaded_file($fileTmpName,$imageLocation);
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
 ?>
