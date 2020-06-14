<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="jquery.min.js"></script>
  </head>
  <body>
    <div class="addLanguage">
      <form action="addLanguage.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <br>
        <input type="text" name="languageName" placeholder="Enter new languge name"><br>
        <input type="text" name="location" placeholder="Enter new location "><br>
        <textarea name="discription" placeholder="Enter discription" ></textarea>
        <input type="submit" name ="submit"><br>
      </form>

    </div>
    <div class="editter">

    </div>
    <div class="container">

    </div>
  </body>

  <script>
    function removeFunction(selectId){
      $.ajax({
          url:'language/removeLanguage.php',
          type:'POST',
          data:{'Id':selectId},
          success: function(result){
            if(result !=''){
              alert(result);
            }
          }
        });
        getSubject();
    }
    function getSubject(){
      $.ajax({
          url:'language/getLanguage.php',
          success: function(result){
            $('.container').html(result);
          }
        });

    }

    function editFunction(selectId){
      $.ajax({
        url:'language/editLanguage.php',
        type:"POST",
        data:{'id':selectId},
        success: function(result){
          $('.editter').html(result);
        }
      });
    }
    $(document).ready(function(){
        getSubject();
    });
  </script>
  <style media="screen">
  .language{
    position: relative;
    background-color: #f3f3f3;
    max-width: 500px;
    margin: 10px;
    /* padding: 15px; */
  }
  #image{
      width: 100%;
  }
  .about{
    padding: 15px;
  }
  .content{
    display: grid;
  }
  .container{
    display: flex;
  }
  </style>

</html>
