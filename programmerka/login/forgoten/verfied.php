<form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="password" name="newPassword" placeholder="Enter new password">
  <input type="password" name="conformPassword" placeholder="Conform password">
  <input type="submit" value="change">
</form>

<?php
require('../../programmerka.php');
require('../../connect.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  session_start();
  $id = $_SESSION['verficationId'];
  $sql = "SELECT `id`,`forgoterEmail` FROM `forgotenquery` WHERE `forgotenquery`.`id` = $id";
  $sql = mysqli_query($conn,$sql);
  $result = mysqli_fetch_assoc($sql);
  $email = $result['forgoterEmail'];
  $error = '';
  $newPassword = $_POST['newPassword'];
  $conformPassword = $_POST['conformPassword'];
  $error .= passwordCheck($newPassword);
  $error .= conformPasswordCheck($newPassword,$conformPassword);
  if(empty($error)){
    $sql = "UPDATE `users` SET `password` = '$newPassword' WHERE `users`.`email` = '$email';";
    $sql = mysqli_query($conn,$sql);
    if(!$sql){
      echo 'Something went wrong';
    } else {
      header('Location: ../../index.php');
    }
  } else {
    echo 'Oh set';
  }
}

?>
