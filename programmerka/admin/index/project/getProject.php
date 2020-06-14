<?php
require('../../../connect.php');

function infoLanguage($id,$conn){
  $language = "SELECT `languageName` FROM `language` WHERE `language`.`id` = '$id';";
  $language = mysqli_query($conn,$language);
  $information = mysqli_fetch_assoc($language);
  return $information['languageName'];
}

function plugin($list){
    $list = explode(',',$list);
    echo '<ul>';
      foreach ($list as $plugins => $plugin) {
      $plugin = explode(':',$plugin);
      $pluginName = $plugin[0];
      $pluginUrl = $plugin[1];
      echo "<li><a herf='".$pluginUrl."'>".$pluginName."</a></li>";
    }
    echo '</ul>';
}

if(isset($_POST['key'])){
  $key = $_POST['key'];
  $sql = "SELECT * FROM `projects` WHERE `title` LIKE '%$key%'";
} else {
  $sql = "SELECT * FROM `projects`";
}
$sql = mysqli_query($conn,$sql);

while ($result = mysqli_fetch_assoc($sql)) {
  ?>
  <div class="project" id='<?php echo $result['location'];?>'>
    <img id='image' src="../../projectFile/image/<?php echo $result['location'].'.jpg';?>" alt="">
    <div class="content">
      <p id='languageName'><?php  echo infoLanguage($result['languageId'],$conn);?></p>
      <p><?php echo $result['title']; ?></p>
      <p><?php echo $result['description'];?></p>
      <?php plugin($result['plugin']);?>

      <!-- only in addmin -->
      <button type="button" onclick="removeProject('<?php echo $result['id'];?>')">Remove project</button>
      <button type="button" onclick="editProject('<?php echo $result['id'];?>')">Edit project</button>
    </div>
  </div>
  <?php
}
?>
