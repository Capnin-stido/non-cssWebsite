<?php
$fileName = $_GET['fileName'].'.ka';
$path = 'C:\xampp\htdocs\programmerka\projectFile\content';
chdir($path);
$data = fopen($fileName,'r');
$readedFile = fread($data,filesize($fileName));
fclose($data);
echo $readedFile;
?>
