<?php
require('connect.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Language</title>

  </head>
  <body>
  <h2>Language here to challange your self</h2>
  <?php

  $languages = "SELECT `id`,`languageName`,`image`,`discription` FROM `language`";
  $languages = mysqli_query($conn,$languages);
  echo "<div class='container'>";
  while ($result = mysqli_fetch_assoc($languages)) {
    $id = $result['languageName'];
    // $id = $id repla
      echo "<div class='card' id='".$result['id']."'><img class='languageTemplate' src='language/".$result['image']."' alt='".$result['languageName']."'><h4>".$result['languageName']."</h4><p>".$result['discription']."</p></div>";
  }
  echo "</div>"
?>


  </body>
  <script src="assert/jquery.min.js" charset="utf-8"></script>
  <script>

      $('.card').click(function(){
        var link = $(this).attr('id');
        alert('project.php?language='+ link );
      });

  </script>
  <style>
  *{
    margin: 0;
    padding: 0;
  }
  .container{
    padding: 0px;
    margin-left: auto;
    margin-right: auto;
    background-color: blue;
  }

  .container .card {
    display: inline-block;
    height: 400px;
    overflow: hidden;
  }

  .container .card ,.languageTemplate{
    max-width: 250px;
    background-color: #333333;
    color: #fff;
  }


  </style>
</html>
