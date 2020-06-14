<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  </head>
  <body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <input type="text" name='userName'placeholder="Admin name"><br>
      <input type="password" name="adminPassword" placeholder="Password"><br>
      <button type="submit">Verify</button>
    </form>
  </body>
  <?php

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userName = $_POST['userName'];
    $password = $_POST['adminPassword'];
    if($userName == 'ujjwakanis' && $password == '@@ppllee17'){
      session_start();
      $_SESSION['Verified'] = 1;
      header('Location: index/main.php');
    }
  }
  ?>
</html>
