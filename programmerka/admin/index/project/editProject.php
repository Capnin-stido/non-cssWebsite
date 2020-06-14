<?php
require('../../../connect.php');
$projectId = $_GET["selectId"];
$sql = "SELECT * FROM `projects` WHERE `projects`.`id`='$projectId'";
$sql = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($sql);

?>
<a href="<?php echo "editContent.php?fileName=".$result['location']; ?>">Edit Content</a>

<form class="uploadImage" action="uploadImage.php" method="post" enctype="multipart/form-data">
  <input type="file" name="file">
  <input type="submit" name="submit">
  <input type="hidden" name="projectId" value="<?php echo $projectId; ?>">
</form>

<form class="contentManager" action="<?php echo $_SERVER['PHP_SELF']."?selectId=$projectId"; ?>" method="post">
  <input type="text" name="languageId" value="<?php echo $result['languageId'];?>"><br>
  <input type="hidden" name="projectId" value="<?php echo $projectId; ?>">
  <input type="text" name="title" value="<?php echo $result['title'];?>"><br>
  <input type="text" name="plugins" value="<?php echo $result['plugin'];?>"><br>
  <input type="text" name="level" value="<?php echo $result['level'];?>"><br>
  <textarea name="description" ><?php echo $result['description'];?></textarea>
  <input type="submit" value="done">
</form>


<?php
function updataData($conn,$colume,$value){
  $projectId = $_POST['projectId'];
  $sql = "UPDATE `projects` SET `$colume` = '$value' WHERE `projects`.`id` = $projectId";
  $sql = mysqli_query($conn,$sql);
  if(!$sql){
    echo "something went wrong";
  }
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $languageId = $_POST['languageId'];
  // $location = $_POST['location'];
  $title = $_POST['title'];
  $plugins = $_POST['plugins'];
  $level = $_POST['level'];
  $description = $_POST['description'];
  updataData($conn,'languageId',$languageId);
  updataData($conn,'title',$title);
  updataData($conn,'level',$level);
  updataData($conn,'plugin',$plugins);
  updataData($conn,'description',$description);
}
?>
