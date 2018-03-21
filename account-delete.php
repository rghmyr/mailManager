<?php
  include_once($conf['base-path']."standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
    $query = "DELETE FROM accounts WHERE accounts.id = ".$_POST['id']." AND accounts.username = '".$_POST['username']."' AND accounts.domain = '".$_POST['domain']."';";
    // print($query);
    $mysqli->query($query);

    print($mysqli->error);
  } else {
    header("Location: ./");
  }
?>
