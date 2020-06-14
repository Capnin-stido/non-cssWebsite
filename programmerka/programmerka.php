<?php

function getTime(){
  date_default_timezone_set('Asia/Kolkata');
  $time = date("Y-m-d-h-i-s");
  return $time;
}


function timeCheck($timeStarted,$timeEnded){
  if ($timeStarted[0] == $timeEnded[0] && $timeStarted[1] == $timeEnded[1] && $timeStarted[2] == $timeEnded[2]) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function hoursToMin($array){
  $hours = $array['3'];
  $minutes = $array['4'];
  $total = (int)($hours*60)+$minutes;
  return $total;
}

function addVerfication($conn,$email){
  $time = getTime();
  $verficationCode = randomGentate(10);
  $verficationCode = password_hash($verficationCode,PASSWORD_DEFAULT);
  $sqli = "INSERT INTO `forgotenquery` (`id`, `forgoterEmail`, `timeStated`, `verficationCode`) VALUES (NULL, '$email', '$time', '$verficationCode');";
  $sqli = mysqli_query($conn,$sqli);
  $get = "SELECT `id`,`verficationCode` FROM `forgotenquery` WHERE `forgotenquery`.`verficationCode`='$verficationCode'";
  $get = mysqli_query($conn,$get);
  $result = mysqli_fetch_assoc($get);
  $id = $result['id'];
  return $id;
}

function verficationLimits($time,$duration){
  $startedTime = explode('-',$time);
  $endedTime = (int) $startedTime[4] +(int)$duration;
  $endedTime = array_replace($startedTime, array(4 => $endedTime));
  $currentTime = explode('-',getTime());
  if(!timeCheck($currentTime,$endedTime)){
    return 0;
  }
  $endedTime = hoursToMin($endedTime);
  $currentTime = hoursToMin($currentTime);

  if($endedTime <= $currentTime){
    return 1;
  } else {
    return 0;
  }
}
function limitVerification($timeStarted,$validateFor){
  $currentTime = getTime();
  $currentTime = explode('-',$currentTime);
  $currentTime = hoursToMin($currentTime);
  $timeUnset = explode('-',$timeStarted);
  $minutes = (int)$timeUnset[4] + (int)$validateFor;
  $timeEnded = array_replace($timeUnset,array(4 => $minutes));
  if(!timeCheck($timeUnset,$timeEnded)){
    return 0;
  }
  $timeStarted = hoursToMin($timeUnset);
  $timeEnded = hoursToMin($timeEnded);
  if ($currentTime >= $timeEnded){
    return 1;
  } else {
    return 0;
  }
}

function nameCheck($conn,$userName){
    $error = '';
    if(!empty($userName)){
        if(strlen($userName) <= 2){
            $error = 'To short must be above 2 digit';
        }
        elseif(strlen($userName) >20){
            $error = 'To long must be below 20 digit';
        }
        else {
            if(!ctype_alpha($userName)){
                $error = 'Please enter a validata name';
            }
        }
    } else {
        $error = "please enter name";
    }
    return $error;
}

function domain_exists($email, $record = 'MX'){
    list($user, $domain) = explode('@', $email);
    return checkdnsrr($domain, $record);
}

function emailCheck($conn,$email){
    $error = '';
    if(!empty($email)){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            if(!domain_exists($email)) {
                $error =  'This is not validate email';
            } else {
                $emailSql = "SELECT `email` FROM `users` WHERE `email`='$email'";
                $emailSql = mysqli_query($conn,$emailSql);
                if(mysqli_num_rows($emailSql)== 1){
                    $error = 'This email is already used';
                }
            }
        }else {
            $error = 'Doesn\'t look like email';
        }

    } else {
        $error = 'Please enter email';
    }
    return $error;
}

function userName($conn,$userName){
  $userName = testInput($userName);
  if(strlen($userName) <2){
     $error = 'Too small as user name';
  }
  elseif (strlen($userName) > 22) {
    $error = 'Too small as user name';
  } else {
    $userNameSql = "SELECT `userName` FROM `users` WHERE `userName`='$userName'";
    $userNameSql = mysqli_query($conn,$userNameSql);
    if(mysqli_num_rows($userNameSql)== 1){
        $error = 'This userName is already used';
    }
  }

}

function passwordCheck($password){
    $error = '';
    if(empty($password)){
        $error = 'Please enter password';
    } else {
        if(strlen($password) < 8){
            $error = 'To short must be above or equal 8 digit';
        }
        elseif(strlen($password) > 16){
            $error = 'To long must be below 16 digit';
        }
    }
    return $error;
}

function conformPasswordCheck($password,$conformPassword){
    $error ='';
    if(empty($conformPassword)){
        $error = 'Please enter conform password';
    } else {
        if($password !== $conformPassword){
            $error = 'Your conform password doesn\'t match with conform password';
        }
    }
    return $error;
}

function testInput($data){
    // $data = mysql_real_escape_string($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    return $data;
}

function getVisIpAddr() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		return $_SERVER['REMOTE_ADDR'];
	}
}

function nameOrEmail($data){
  if(!ctype_alpha($data)){
    $type ='email';
  } else {
    $type ='name';
  }
  return $type;
}

function checkValidity($conn,$data,$type,$password){
  $error = NULL;
  $sql = "SELECT '$type',`password` FROM `users` WHERE `users`.`$type` = '$data'";
  $sql = mysqli_query($conn,$sql);
  if(mysqli_num_rows($sql) == 0){
      $error = 'Does not exgist';
  } else {
    $result = mysqli_fetch_assoc($sql);
    $DBpassword = $result['password'];
    if($DBpassword !== $password){
      $error = 'Invalidate password for entered data';
    }
  }
  return $error;
}

function randomUser($conn,$name){
  $userNewName = NULL;
  while (TRUE) {
    $random = randomGentate(5);
    $userNewName = $name.$random;
    $userNameSql = "SELECT `userName` FROM `users` WHERE `userName`='$userNewName'";
    $userNameSql = mysqli_query($conn,$userNameSql);
    if(mysqli_num_rows($userNameSql)== 0){
        break;
    }
  }
  return $userNewName;
}

function randomGentate($amount){
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $amount; $i++) {
          $index = rand(0, strlen($characters) - 1);
          $randomString .= $characters[$index];
      }
      return $randomString;
  }

function sendEmail($emailId,$message){
    echo "Leave a life you will be remember #".$message;
}

?>
