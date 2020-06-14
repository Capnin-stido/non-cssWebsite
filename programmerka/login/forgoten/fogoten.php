<?php
require('../../programmerka.php');
require('../../connect.php');
session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $forgoterEmail = $_POST['forgoterEmail'];

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

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgoten Password</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="email" name="forgoterEmail" placeholder="Your email">
      <input type="submit" value="Next">
    </form>
  </body>
</html>
