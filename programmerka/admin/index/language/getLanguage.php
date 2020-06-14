<?php
require('../../../connect.php');
$direction = '../../language/image/';
$sql = "SELECT * FROM `language`";
$sql = mysqli_query($conn,$sql);
while ($result = mysqli_fetch_assoc($sql)){
    ?>
    <div class="language" id="<?php echo $result['id']; ?>">
      <img id='image' src="<?php echo $direction.$result['location'].'.jpg';?>" alt="<?php echo $result['location'];?>"><br>
      <div class="about">
        <p><?php echo $result['languageName'];?></p>
        <p><?php echo $result['discription'];?></p>
        <button type="button" onclick="removeFunction('<?php echo $result['id']; ?>')">Remove</button>
        <button type="button" onclick="editFunction('<?php echo $result['id']; ?>')">Edit</button>
      </div>
    </div>
    <?php
}
?>
