<?php
session_start();
if (!isset($_SESSION['Verified'])) {
  header('Location: ../../index.php');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Control Panel</title>
  </head>
  <body>
    <a href="contactUsResult.php">comments</a><br>
    <a href="manageLanguage.php">manage language</a><br>
    <a href="manageProject.php">manage project</a><br>
    <a href="manageUser.php">Manage user</a><br>
  </body>
</html>
