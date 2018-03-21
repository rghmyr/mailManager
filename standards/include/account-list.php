<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
    $res = $mysqli->query("SELECT * FROM accounts ORDER BY domain,username ASC");
    while ($row = $res->fetch_assoc()) {
      if($_SESSION['backend-role'] == "admin") {
      $editBtn = sprintf('<a class="account-edit" href="account-edit.php" data-userid="%s" data-user="%s" data-domain="%s"><i class="fas fa-pencil-alt"></i></i></a>',$row['id'],$row['username'],$row['domain']);
      $deleteBtn = sprintf('<a class="account-delete" href="account-delete.php" data-userid="%s" data-user="%s" data-domain="%s"><i class="fas fa-trash-alt"></i></a>',$row['id'],$row['username'],$row['domain']);
      $infoTxt = $editBtn . " " . $deleteBtn;
      } else {
        $infoTxt = "";
      }


      printf('<div class="grd-row %s" data-domain="%s">',$conf['maindomain']==$row['domain']?'active':'',$row['domain']);
      printf('<div class="grd-row-col-20-24--md p1">%s</div>',$row['username']."@".$row['domain']);
      printf('<div class="grd-row-col-4-24--md txt--right p1">%s</div>',$infoTxt);
      print ('</div>');
    }
  }
?>
