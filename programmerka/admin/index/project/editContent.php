<?php
$fileName = $_GET['fileName'].".ka";
$path = 'C:\xampp\htdocs\programmerka\projectFile\content';
chdir($path);
$fileReaded = fopen($fileName,'r') or die('unable to open file');
$data = fread($fileReaded,filesize($fileName));
fclose($fileReaded);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $content = $_POST['content'];
  $fileWrite = fopen($fileName,"w") or die('Unable to open the file');
  fwrite($fileWrite,$content);
  fclose($fileWrite);
}

// $list = explode(' ',$data);
?>
<?php echo $data; ?>
<form action="<?php echo $_SERVER['PHP_SELF']."?fileName=".$fileName; ?>" method="post">
  <textarea name="content" style="width:500px;height:500px"><?php echo $data; ?></textarea><br>
  <input type="submit" value="done">
</form>
