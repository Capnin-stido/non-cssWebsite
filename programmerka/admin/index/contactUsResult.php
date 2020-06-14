<?php
require('../../connect.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>  Contact us Query</title>
  </head>
  <body>
    <?php
    $sql = "SELECT * FROM `contactus` ORDER BY `contactus`.`id`";
    $sql = mysqli_query($conn,$sql);
    while($result = mysqli_fetch_assoc($sql)){
      ?>
      <div class="message">
        by:- <?php echo $result['id']; ?>
        <p><?php echo $result['message'];?></p>
        on:-<?php echo $result['time']; ?>
      </div>
      <?php
    }
    ?>
  </body>
  <style media="screen">
    .message{
      background-color: #f3f3f3;
      max-width: 500px;
      margin: 10px;
      padding: 15px;
    }
  </style>
</html>
