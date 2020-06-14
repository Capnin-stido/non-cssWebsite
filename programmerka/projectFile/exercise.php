<?php
require('../connect.php');
$language = $_GET['language'];


function levelNumberToString($level){
  switch ($level) {
    case 1:
      $level = "Beginner";
      break;
    case 2:
      $level = "Intermediate";
    case 3:
      $level = "Professional";
    default:
      $level = "Indefined";
      break;
  }
}

function getProject($conn,$id){

}

// echo getLanguageId($conn,$language);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="../assert/jquery.min.js" charset="utf-8"></script>
    <script>
    function getProject(language){
      $.ajax({
        url:'exerciseScript/getProject.php',
        type:"POST",
        data:{'language':language},
        async:1,
        success: function(result){
          $('.projects').html(result);
          selectClick('.project')
          }
      });
    }

    function selectClick(className){
      $(className).click(function(){
        var className = $(this).attr('id');
        $(location).attr('href','content.php?fileName='+className);
      });
    }

    getProject("<?php echo $language;?>");
      $(document).ready(function(){

      });

    </script>
  </head>
  <body>
    <div class="projects"></div>

  </body>
  <style media="screen">
    .projects{
      position: relative;
    }

    .title{
      display:flex;
      width:100%;
    }

    .project{
      background-color: #f3f3f3;
      max-width: 400px;
    }

    #image{
      width: 100%;
    }
  </style>
</html>
