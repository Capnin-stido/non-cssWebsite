<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>programmerka</title>
  </head>
  <body>
    <!-- <a herf='index.php'>Next!</a> -->
  </body>
</html>


<?php

function timeCheck($timeStarted,$timeEnded){
  if ($timeStarted[0] == $timeEnded[0] && $timeStarted[1] == $timeEnded[1] && $timeStarted[2] == $timeEnded[2]) {

    return TRUE;
  } else {
    return FALSE;
  }
}


// $validate = timeCheck($timeStarted,)
function hoursToMin($array){
  $hours = $array['3'];
  $minutes = $array['4'];
  $total = (int)($hours*60)+$minutes;
  return $total;
}

function limitVerification($timeStarted,$validateFor){
  $timeUnset = explode('-',$timeStarted);
  $minutes = (int)$timeUnset[4] + (int)$validateFor;
  $timeEnded = array_replace($timeUnset,array(4 => $minutes));
  if(!timeCheck($timeUnset,$timeEnded)){
    return FALSE;
  }

  $timeStarted = hoursToMin($timeUnset);
  $timeEnded = hoursToMin($timeEnded);

  if ($timeStarted <=  $timeEnded) {
    return TRUE;
  } else {
    return FALSE;
  }
}

date_default_timezone_set('Asia/Kolkata');
$timeStarted = date('y-m-d-h-i');

limitVerification($timeStarted,30);
// implode

 ?>
