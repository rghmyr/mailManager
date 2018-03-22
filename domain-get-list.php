<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
    $res = $mysqli->query("SELECT d.id,d.domain,COUNT(DISTINCT a.username) AS accounts,COUNT(DISTINCT al.source_username) AS aliases FROM domains d LEFT JOIN accounts a on a.domain=d.domain LEFT JOIN aliases al on al.source_domain=d.domain GROUP BY d.id ORDER BY d.domain ASC");
    while ($row = $res->fetch_assoc()) {
      $infoTxt = "";
      if($row['accounts']==0 && $row['aliases']==0) {
        $editBtn = sprintf('<a class="domain-edit" href="domain-edit.php?id=%s" data-domain="%s"><i class="fas fa-pencil-alt"></i></i></a>',$row['id'],$row['domain']);
        $deleteBtn = sprintf('<a class="domain-delete" href="domain-delete.php" data-domainid="%s" data-domain="%s"><i class="fas fa-trash-alt"></i></a>',$row['id'],$row['domain']);

        $infoTxt = $editBtn . " " . $deleteBtn;
      } else {
        if($row['accounts']!=0) {
          $infoTxt .= sprintf('<div class=\"accounts\"><a href="account-list.php?domain=%s">%s Konten <i class="fas fa-angle-right"></i></a></div>',$row['domain'],$row['accounts']);
        }
        if($row['aliases']!=0) {
          $infoTxt .= sprintf('<div class=\"accounts\"><a href="alias-list.php?domain=%s">%s Umleitungen <i class="fas fa-angle-right"></i></a></div>',$row['domain'],$row['aliases']);
        }

      }
      printf('<div class="grd-row domain-select">');
      printf('<div class="grd-row-col-19-24--md px1" data-domain="%s">%s</div>',$row['domain'],$row['domain']);
      printf('<div class="grd-row-col-5-24--md px1">%s</div>',$infoTxt);
      print ('</div>');
    }
  } else {
    print("Zugriff verweigert");
  }
?>
