<?php
require('../../../connect.php');
function addInProjects($data,$conn,$languageId,$title,$location,$description,$plugin,$level){
  $sql = "SELECT `location` FROM `projects` WHERE `projects`.`location` ='$location'";
  $fileName = $location.".ka";
  $sql = mysqli_query($conn,$sql);
  $numberOfRow = mysqli_num_rows($sql);
  if($numberOfRow != 0){
    echo "Location is already exists";
  } else {
    $path = 'C:\xampp\htdocs\programmerka\projectFile\content';
    chdir($path);
    $file = fopen($location,"w") or die('Unable to open');
    fwrite($file,$data);
    fclose($file);

    $insertSql = "INSERT INTO `projects` (`id`,`languageId`,`title`,`location`,`description`,`plugin`,`level`) VALUES(NULL,'$languageId','$title','$location','$description','$plugin',$level)";
    die($insertSql);
    $insertSql = mysqlI_query($conn,$insertSql);
    if(!$insertSql){
      echo "Something went wrrong";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add language</title>
  </head>
  <body>
    <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="text" name="title" placeholder="title"><br>
      <input type="text" name="location" placeholder="location"><br>
      <input type="text" name="plugin" placeholder="plugins"><br>
      <select name="languageId">
        <?php
        $sql = "SELECT `id`,`languageName` FROM `language`";
        $sql = mysqli_query($conn,$sql);
        while ($result = mysqli_fetch_assoc($sql)) {
          ?>
          <option value="<?php echo $result['id']; ?>"> <?php echo $result['languageName']; ?></option>
          <?php
          }
         ?>
      </select>
      <select name="level">
        <option value=1 >beginner</option>
        <option value=2 >Advavce</option>
        <option value=3 >Professional</option>
      </select><p></p>
      <textarea name="description" placeholder="description"></textarea><br>
      <textarea name="data" placeholder="Enter Content"></textarea><br>
      <input type="submit" value="Sumbit">
    </form>
  </body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

  $title = $_POST['title'];
  $location = $_POST['location'];
  $plugin = $_POST['plugin'];
  $description = $_POST['description'];
  $data = $_POST['data'];
  $languageId = $_POST['languageId'];
  $level = $_POST['level'];
  addInProjects($data,$conn,$languageId,$title,$location,$description,$plugin,$level);
}
?>
