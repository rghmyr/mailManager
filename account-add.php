<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
?>
<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>Konto anlegen - mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Domainauswahl</h1>
    <section class="my1">
      <form method="POST">
        <div class="grd-row">
          <div class="grd-row-col-11-24--md px1"><input type="text" name="username" required placeholder="max.mustermann"></div>
          <div class="grd-row-col-2-24--md px1">@</div>
          <div class="grd-row-col-11-24--md px1">
            <select id="domain" name="domain">
            <?php
              $res = $mysqli->query("SELECT * FROM domains ORDER BY domain ASC");
              while ($row = $res->fetch_assoc()) {
                if($row['domain'] == $conf['maindomain']) {
                  printf('<option selected>%s</option>',$row['domain']);
                } else {
                  printf('<option>%s</option>',$row['domain']);
                }
              }
            ?>
            </select>
          </div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><label for="password">Password</label> <input type="password" required name="password" id="password"></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><label for="quota">quota</label> <input type="text" name="quota" id="quota" required value="1024"></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><input type="checkbox" checked id="enabled" name="enabled"> <label for="enabled">aktivert</label></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><input type="checkbox" id="sendonly" name="sendonly"> <label for="sendonly">sendonly</label></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 txt--right"><button type="submit" class="btn--green">sichern <i class="fas fa-save"></i></button></div>
        </div>
      </form>
    </section>
    <section id="account-list" class="my1">
        <?php
          if(isset($_POST) && strlen($_POST['username'])>0 && strlen($_POST['username'])>0) {

            $salt = substr(sha1(rand()), 0, 16);
            $hashedPassword = "{SHA512-CRYPT}" . crypt($_POST['passwort'], "$6$$salt");

            if($_POST['enabled']=="on") $enabled = 1;
            else $enabled = 0;

            if($_POST['sendonly']=="on") $sendonly = 1;
            else $sendonly = 0;
            $query = "INSERT INTO accounts (id, username, domain, password, quota, enabled, sendonly) VALUES (NULL, '".$_POST['username']."', '".$_POST['domain']."', '".$hashedPassword."', '".$_POST['quota']."', '".$enabled."', '".$sendonly."');";
            //print($query);
            $mysqli->query($query);

            print($mysqli->error);
          }
          print('<section id="account-list-content">');
          include_once("./standards/include/account-list.php");
          print('</section>');
        ?>
      </div>
    </section>
  </main>
  <?php include_once("./standards/include/footer.php"); ?>
</body>
</html>
<?php
  } else {
    header("Location: ./");
  }
?>
