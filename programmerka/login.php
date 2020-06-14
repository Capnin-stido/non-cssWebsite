<?php

require('connect.php');
require('programmerka.php');
$error = NULL;
$userEnter = NULL;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userEnter = $_POST['userEnter'];
  $password = $_POST['password'];

  if(empty($userName)){
    $error = 'Please enter a filed is empty';
  }
  elseif (empty($password)) {
      $error = 'Please enter password';
  } else {
    $type = nameOrEmail($userEnter);
    if($type == 'email'){
      $error = checkValidity($conn,$userEnter,'email',$password);
    } else {
      $error = checkValidity($conn,$userEnter,'userName',$password);
    }
  }
  if(!$error){
    echo 'Wellcome';
  }
}

?>
<span id='error'><?php echo $error;?></span>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <input type="text" name="userEnter" value='<?php echo $userEnter;?>' placeholder="Your email or user name"><br>
  <input type="password" name="password" placeholder="Password">
  <br>
  <input type="submit" value="login">
</form>

<a href="login/forgot/forgoten.php">forgoten password</a>
