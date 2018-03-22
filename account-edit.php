<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
    if(isset($_POST) && strlen($_POST['username'])>0 && strlen($_POST['username'])>0) {

      $setQuery = array();
      if(strlen($_POST['username']) > 0) {
        $setQuery['username'] = " username = '".$_POST['username']."' ";
      }
      if(strlen($_POST['domain']) > 0) {
        $setQuery['domain'] = " domain = '".$_POST['domain']."' ";
      }
      if($_POST['password'] != "no-change" && strlen($_POST['password']) > 0) {
        $salt = substr(sha1(rand()), 0, 16);
        $hashedPassword = "{SHA512-CRYPT}" . crypt($_POST['passwort'], "$6$$salt");
        $setQuery['password'] = "password = '".$hashedPassword."'";
      }

      if((int) $_POST['quota'] > 0) {
        $setQuery['quota'] = " quota = '".$_POST['quota']."' ";
      }

      if($_POST['enabled']=="on") $enabled = 1;
      else $enabled = 0;
      $setQuery['enabled'] = " enabled = '".$enabled."' ";

      if($_POST['sendonly']=="on") $sendonly = 1;
      else $sendonly = 0;
      $setQuery['sendonly'] = " sendonly = '".$sendonly."' ";

      $query = "UPDATE accounts SET ".implode(",",$setQuery)." WHERE accounts.id = ".$_POST['userid'].";";
      //print_r($query);
      $mysqli->query($query);
      print($mysqli->error);
      header("Location: account-list.php");
    }
    $id = (int) $_GET['id'];
    if($id>0) {
      $res = $mysqli->query("SELECT * FROM accounts WHERE id=".$id.";");
      $row = $res->fetch_assoc();
?>
<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>Konto ändern - mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Konto ändern</h1>
    <section class="my1">
      <form method="POST">
        <input type="hidden" id="userid" name="userid" value="<?=$id?>"/>
        <div class="grd-row">
          <div class="grd-row-col-11-24--md px1"><input type="text" name="username" required placeholder="max.mustermann" value="<?=$row['username']?>"></div>
          <div class="grd-row-col-2-24--md px1">@</div>
          <div class="grd-row-col-11-24--md px1">
            <select id="domain" name="domain">
            <?php
              $res2 = $mysqli->query("SELECT * FROM domains ORDER BY domain ASC");
              while ($row2 = $res2->fetch_assoc()) {
                if($row['domain'] == $row2['domain']) {
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
          <div class="grd-row-col-24 px1"><label for="password">Password</label> <input type="password" required value="no-change" name="password" id="password"></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><label for="quota">quota</label> <input type="text" name="quota" id="quota" required value="<?=$row['quota']?>"></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><input type="checkbox" <?=$row['enabled']==1?"checked":""?> id="enabled" name="enabled"> <label for="enabled">aktivert</label></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><input type="checkbox" <?=$row['sendonly']==1?"checked":""?> id="sendonly" name="sendonly"> <label for="sendonly">sendonly</label></div>
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
