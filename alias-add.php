<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
?>
<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>Umleitung anlegen - mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Umleitung anlegen</h1>
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
          <div class="grd-row-col-11-24--md px1"><input type="text" name="destination_username" required placeholder="max.mustermann"></div>
          <div class="grd-row-col-2-24--md px1">@</div>
          <div class="grd-row-col-11-24--md px1"><input type="text" name="destination_domain" required placeholder="example.com"></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><input type="checkbox" checked id="enabled" name="enabled"> <label for="enabled">aktivert</label></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 txt--right"><button type="submit" class="btn--green">sichern <i class="fas fa-save"></i></button></div>
        </div>
      </form>
    </section>
    <section id="alias-list" class="my1">
        <?php
          if(isset($_POST) && strlen($_POST['username'])>0 && strlen($_POST['username'])>0) {

            if($_POST['enabled']=="on") $enabled = 1;
            else $enabled = 0;

            $query = "INSERT INTO aliases (id, source_username, source_domain, destination_username, destination_domain, enabled) VALUES (NULL, '".$_POST['username']."', '".$_POST['domain']."','".$_POST['destination_username']."', '".$_POST['destination_domain']."',  '".$enabled."');";
            // print($query);
            $mysqli->query($query);

            print($mysqli->error);
          }
          print('<section id="alias-list-content">');
          include_once("./alias-get-list.php");
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
