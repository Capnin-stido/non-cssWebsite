<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage progect</title>
    <script src="jquery.min.js" charset="utf-8"></script>
  </head>
  <body>
    <button onclick="addRedirct()">Add Project</button>
    <form action="" >
      <input type="text" id="search" placeholder="Search here.."><input type="submit" value="search">
    </form>
    <div class="projects">

    </div>
  </body>
</html>
<script>

  // function moveNext(){
  //   $('.project').click(function(){
  //      var fileName = $(this).attr('id');
  //      var languageName = $(this).find('#languageName').text();
  //      $(location).attr('href', 'code.php?title='+fileName+'&language='+languageName);
  //   });
  // }

  function editProject(id){
    $(location).attr('href',"project/editProject.php?selectId="+id);
  }

  function removeProject(selectId){
    $.ajax({
      url:'project/removeProject.php',
      type:'POST',
      data:{'id':selectId},
      success:function(result){
        if(result !=''){
          alert(result);
        }
        getProject();
      }
    });
  }
  function getProject(){
    $.ajax({
      url:'project/getProject.php',
      async:true,
      success: function(result){
        $('.projects').html(result);
        // moveNext();
      }
    });
  }

  function addRedirct(){
    $(location).attr('href','project/addProject.php');
  }

  $(document).ready(function(){
    getProject();
    $('#search').keyup(function(){
      var value = $('#search').val();
      $.ajax({
        url:'project/getProject.php',
        type:'POST',
        async:true,
        data:{'key':value},
        success: function(result){
          $('.projects').html(result);
          // moveNext();
        }
      })
    });

  });
</script>
<style media="screen">
  .projects{
    display: flex;
  }
  .project{
    margin:15px;
    position: relative;
    background-color: #f3f3f3;
    max-width: 500px;
  }

  #image{
    width: 100%;
  }

  .content{
    padding: 15px;
  }
</style>
