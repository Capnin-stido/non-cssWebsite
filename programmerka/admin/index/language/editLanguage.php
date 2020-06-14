<?php
$id = $_POST['id'];
?>
<hr>
Edit select language
<form class='upload' action="upload.php" method="post" enctype="multipart/form-data">
  <input type="file" name="file"><br>
  <input type="hidden" name="id" value="<?php echo $id;?>"><br>
  <input type="text" name="languageName" placeholder="Enter new languge name"><br>
  <input type="text" name="location" placeholder="Enter new location "><br>
  <textarea name="discription" placeholder="Enter discription" ></textarea><br>
  <input type="submit" name='submit'>
</form>
