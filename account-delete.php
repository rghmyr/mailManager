<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin" && isset($_POST['id'])) {
    $query = "DELETE FROM accounts WHERE accounts.id = ".$_POST['id']." AND accounts.username = '".$_POST['username']."' AND accounts.domain = '".$_POST['domain']."';";
    // print($query);
    $mysqli->query($query);

    print($mysqli->error);
  } else {
    header("Location: ./");
  }
?>
