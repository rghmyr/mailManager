<?php
  session_start();
  include_once("./standards/include/conf.php");
  $mysqli = new mysqli($db['host'], $db['username'], $db['password'], $db['database']);

  $_SESSION['backend-user'] = "admin";
  if(strpos($_SERVER['REMOTE_ADDR'],"::1")!==false)
    $_SESSION['backend-role'] = "admin";
  else
    $_SESSION['backend-role'] = "others";

//$_SESSION['backend-role'] = "user";



  function printSingleAlias($id,$source_username,$source_domain,$destination_username,$destination_domain,$enabled) {
    if($_SESSION['backend-role'] == "admin") {
      $editBtn = sprintf('<a class="alias-edit" href="alias-edit.php?id=%s" data-user="%s" data-domain="%s"><i class="fas fa-pencil-alt"></i></i></a>',$id,$source_username,$source_domain);
      $deleteBtn = sprintf('<a class="alias-delete" href="alias-delete.php" data-userid="%s" data-user="%s" data-domain="%s"><i class="fas fa-trash-alt"></i></a>',$id,$source_username,$source_domain);
      $infoTxt = $editBtn . " " . $deleteBtn;
    } else if($_SESSION['backend-role'] == "user") {
      $infoTxt = "";
    }

    if($_SESSION['backend-role'] != "others" ) {
      $selectedDomain = isset($_GET['domain'])?$_GET['domain']:MAINDOMAIN;

      $output = sprintf('<div class="grd-row %s %s" data-domain="%s">',$selectedDomain==$source_domain?'active':'',$enabled==1?'fnt--green':'fnt--red',$source_domain);
      $output.= sprintf('<div class="grd-row-col-10-24--md p1">%s</div>',$source_username."@".$source_domain);
      $output.= sprintf('<div class="grd-row-col-10-24--md p1"><i class="fas fa-angle-double-right"></i> %s</div>',$destination_username."@".$destination_domain);
      $output.= sprintf('<div class="grd-row-col-4-24--md txt--right p1">%s</div>',$infoTxt);
      $output.= sprintf('</div>');

      return $output;
    }
  }
  function printMultipleAlias($source_username,$source_domain,$destinations) {
    if($_SESSION['backend-role'] != "others" ) {
      $aliases = "";
      $enabled = 0;
      foreach($destinations as $destination) {
        if($_SESSION['backend-role'] == "admin") {
          $editBtn = sprintf('<a class="alias-edit" href="alias-edit.php?id=%s" data-user="%s" data-domain="%s"><i class="fas fa-pencil-alt"></i></i></a>',$destination['id'],$source_username,$source_domain);
          $deleteBtn = sprintf('<a class="alias-delete" href="alias-delete.php" data-userid="%s" data-user="%s" data-domain="%s"><i class="fas fa-trash-alt"></i></a>',$destination['id'],$source_username,$source_domain);
          $infoTxt = $editBtn . " " . $deleteBtn;
        } else if($_SESSION['backend-role'] == "user") {
          $infoTxt = "";
        }

        if($destination['enabled']==1) $enabled = 1;

        $aliases.= sprintf('<div class="grd-row %s active">',$destination['enabled']==1?'fnt--green':'fnt--red');
        $aliases.= sprintf('<div class="grd-row-col-18-24--md "><i class="fas fa-angle-double-right"></i> %s</div>',$destination['destination_username']."@".$destination['destination_domain']);
        $aliases.= sprintf('<div class="grd-row-col-6-24--md txt--right">%s</div>',$infoTxt);
        $aliases.= sprintf('</div>');
      }
      $selectedDomain = isset($_GET['domain'])?$_GET['domain']:MAINDOMAIN;
      $output = sprintf('<div class="grd-row %s %s" data-domain="%s">',$selectedDomain==$source_domain?'active':'',$enabled==1?'fnt--green':'fnt--red',$source_domain);
      $output.= sprintf('<div class="grd-row-col-10-24--md p1">%s</div>',$source_username."@".$source_domain);
      $output.= sprintf('<div class="grd-row-col-14-24--md p1">%s</div>',$aliases);
      $output.= sprintf('</div>');

      return $output;
    }
  }
?>
