<?php
  session_start();
  include_once($conf['base-path']."standards/include/conf.php");
  $mysqli = new mysqli($db['host'], $db['username'], $db['password'], $db['database']);

  $_SESSION['backend-user'] = "admin";
  $_SESSION['backend-role'] = "admin";
?>
