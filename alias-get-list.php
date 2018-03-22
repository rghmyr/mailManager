<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
    $res = $mysqli->query("SELECT * FROM aliases ORDER BY source_domain,source_username ASC");
    while ($row = $res->fetch_assoc()) {
      if($_SESSION['backend-role'] == "admin") {
      $editBtn = sprintf('<a class="alias-edit" href="alias-edit.php?id=%s" data-user="%s" data-domain="%s"><i class="fas fa-pencil-alt"></i></i></a>',$row['id'],$row['source_username'],$row['source_domain']);
      $deleteBtn = sprintf('<a class="alias-delete" href="alias-delete.php" data-userid="%s" data-user="%s" data-domain="%s"><i class="fas fa-trash-alt"></i></a>',$row['id'],$row['source_username'],$row['source_domain']);
      $infoTxt = $editBtn . " " . $deleteBtn;
      } else {
        $infoTxt = "";
      }

      $selectedDomain = isset($_GET['domain'])?$_GET['domain']:$conf['maindomain'];

      printf('<div class="grd-row %s %s" data-domain="%s">',$selectedDomain==$row['source_domain']?'active':'',$row['enabled']==1?'fnt--green':'fnt--red',$row['source_domain']);
      printf('<div class="grd-row-col-20-24--md p1">%s <i class="fas fa-angle-double-right"></i> %s</div>',$row['source_username']."@".$row['source_domain'],$row['destination_username']."@".$row['destination_domain']);
      printf('<div class="grd-row-col-4-24--md txt--right p1">%s</div>',$infoTxt);
      print ('</div>');
    }
  } else {
    print("Zugriff verweigert");
  }
?>
