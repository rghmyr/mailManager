<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin" && isset($_POST['id'])) {
    $query = "SELECT d.id,d.domain,COUNT(DISTINCT a.username) AS accounts,COUNT(DISTINCT al.source_username) AS aliases FROM domains d LEFT JOIN accounts a on a.domain=d.domain LEFT JOIN aliases al on al.source_domain=d.domain WHERE d.id = ".$_POST['id']." AND d.domain = '".$_POST['domain']."' GROUP BY d.id ORDER BY d.domain ASC";
    $res = $mysqli->query($query);
    $row = $res->fetch_assoc();

    if($row['accounts'] == 0 && $row['aliases'] == 0){
      $query = "DELETE FROM domains WHERE domains.id = ".$_POST['id']." AND domains.domain = '".$_POST['domain']."';";
      $mysqli->query($query);
      print($mysqli->error);
    }

  } else {
    header("Location: ./");
  }
?>
