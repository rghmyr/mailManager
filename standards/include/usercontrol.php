<?php
  session_start();
  include_once("./standards/include/conf.php");
  $mysqli = new mysqli($db['host'], $db['username'], $db['password'], $db['database']);

  $_SESSION['backend-user'] = "admin";
  if(strpos($_SERVER['REMOTE_ADDR'],"::1")!==false)
    $_SESSION['backend-role'] = "admin";
  else
    $_SESSION['backend-role'] = "other";
?>
