<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin" && isset($_POST['id'])) {
    $query = "DELETE FROM aliases WHERE aliases.id = ".$_POST['id']." AND aliases.source_username = '".$_POST['username']."' AND aliases.source_domain = '".$_POST['domain']."';";
    // print($query);
    $mysqli->query($query);

    print($mysqli->error);
  } else {
    header("Location: ./");
  }
?>
