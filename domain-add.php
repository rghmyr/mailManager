<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>Konto anlegen - mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Domainauswahl</h1>
    <section class="grd m1">
      <form method="POST">
        <div class="grd-row">
          <div class="grd-row-col-11-24--md px1"><input type="text" name="username" placeholder="max.mustermann"></div>
          <div class="grd-row-col-2-24--md px1">@</div>
          <div class="grd-row-col-11-24--md px1"><input type="text" name="domain"></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 txt--right"><button type="submit" class="btn--green">Add</button></div>
        </div>
      </form>
    </section>
    <section class="grd m1">
        <?php
          if(isset($_POST) && strlen($_POST['adresse'])>0) {
            // $mysqli->query("INSERT INTO accounts (id, username, domain, password, quota, enabled, sendonly) VALUES (NULL, '".$_POST['username']."', '".$_POST['domain']."', '".$hashedPassword."', '".$_POST['quota']."', '".$_POST['enabled']."', '".$_POST['sendonly']."');");
          }

          $res = $mysqli->query("SELECT * FROM domains ORDER BY username ASC");
          while ($row = $res->fetch_assoc()) {
            print ('<div class="grd-row">');
            printf('<div class="grd-row-col-10-24--md p1">%s</div>',"");
            printf('<div class="grd-row-col-2-24--md p1">%s</div>',"");
            printf('<div class="grd-row-col-12-24--md p1">%s</div>',"");
            print ('</div>');
          }
        ?>
      </div>
    </section>
  </main>
  <?php include_once("./standards/include/footer.php"); ?>
</body>
</html>
