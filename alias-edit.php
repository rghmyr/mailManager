<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
    if(isset($_POST) && strlen($_POST['username'])>0 && strlen($_POST['username'])>0) {

      $setQuery = array();
      if(strlen($_POST['username']) > 0) {
        $setQuery['username'] = " source_username = '".$_POST['username']."' ";
      }
      if(strlen($_POST['domain']) > 0) {
        $setQuery['domain'] = " source_domain = '".$_POST['domain']."' ";
      }

      if(strlen($_POST['destination_username']) > 0) {
        $setQuery['destination_username'] = " destination_username = '".$_POST['destination_username']."' ";
      }
      if(strlen($_POST['destination_domain']) > 0) {
        $setQuery['destination_domain'] = " destination_domain = '".$_POST['destination_domain']."' ";
      }

      if($_POST['enabled']=="on") $enabled = 1;
      else $enabled = 0;
      $setQuery['enabled'] = " enabled = '".$enabled."' ";

      $query = "UPDATE aliases SET ".implode(",",$setQuery)." WHERE aliases.id = ".$_POST['userid'].";";
      //print_r($query);
      $mysqli->query($query);
      print($mysqli->error);
      header("Location: alias-list.php");
    }
    $id = (int) $_GET['id'];
    if($id>0) {
      $res = $mysqli->query("SELECT * FROM aliases WHERE id=".$id.";");
      $row = $res->fetch_assoc();
?>
<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>Umleitung ändern - mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Umleitung ändern</h1>
    <section class="my1">
      <form method="POST">
        <input type="hidden" id="userid" name="userid" value="<?=$id?>"/>
        <div class="grd-row">
          <div class="grd-row-col-11-24--md px1"><input type="text" name="username" required placeholder="max.mustermann" value="<?=$row['source_username']?>"></div>
          <div class="grd-row-col-2-24--md px1">@</div>
          <div class="grd-row-col-11-24--md px1">
            <select id="domain" name="domain">
            <?php
              $res2 = $mysqli->query("SELECT * FROM domains ORDER BY domain ASC");
              while ($row2 = $res2->fetch_assoc()) {
                if($row['source_domain'] == $row2['domain']) {
                  printf('<option selected>%s</option>',$row2['domain']);
                } else {
                  printf('<option>%s</option>',$row2['domain']);
                }
              }
            ?>
            </select>
          </div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-11-24--md px1"><input type="text" name="destination_username" required placeholder="max.mustermann" value="<?=$row['destination_username']?>"></div>
          <div class="grd-row-col-2-24--md px1">@</div>
          <div class="grd-row-col-11-24--md px1"><input type="text" name="destination_domain" required placeholder="example.com" value="<?=$row['destination_domain']?>"></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><input type="checkbox" <?=$row['enabled']==1?"checked":""?> id="enabled" name="enabled"> <label for="enabled">aktivert</label></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 txt--right"><button type="submit" class="btn--green">ändern <i class="fas fa-save"></i></button></div>
        </div>
      </form>
    </section>
  </main>
  <?php include_once("./standards/include/footer.php"); ?>
</body>
</html>
<?php
    }
  } else {
    header("Location: ./");
  }
?>
