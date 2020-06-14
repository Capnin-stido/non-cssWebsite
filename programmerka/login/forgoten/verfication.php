<?php
require('../../connect.php');
$verficationCode = NULL;
session_start();
if (isset($_SESSION['verficationId'])) {
  $id = $_SESSION['verficationId'];
  $sql = "SELECT `id`,`verficationCode`,`forgoterEmail` FROM `forgotenquery` WHERE `forgotenquery`.`id` = $id";
  $sql = mysqli_query($conn,$sql);
  $result = mysqli_fetch_assoc($sql);
  $verficationCode = $result['verficationCode'];
  $email = $result['forgoterEmail'];
} else {
  header('Location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="../../assert/jquery.min.js"></script>
  </head>
  <body>
    <div class="classLoad">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="verfication" placeholder="Enter your verfication code">
        <input type="submit" value="Verfication">
      </form>
      <a href="verficationCodeGenrater.php">Resend code</a>
    </div>
  </body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $verficationEnter = $_POST['verfication'];
  if (password_verify($verficationEnter,$verficationCode)) {
    echo "<script>$('.classLoad').load('verfied.php');</script> ";
  }
}
?>
