<?php
if(isset($_GET['language'])){
  $selectedLanguage = $_GET['language'];
}
$file = 'projectFile/ThisIsStillGreat.ka';
$languages = fopen($file,'r') or die('error');
$data = fread($languages,filesize($file));

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php echo $data;?>
  </body>
</html>
