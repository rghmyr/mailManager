<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
?>
<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>Domain anlegen - mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Domain anlegen</h1>
    <section class="my1">
      <form method="POST">
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><input type="text" name="domain" required placeholder="example.com"/></div>
        </div>
        <div class="grd-row">
          <div class="grd-row-col-24 txt--right"><button type="submit" class="btn--green">sichern <i class="fas fa-save"></i></button></div>
        </div>
      </form>
    </section>
    <?php
      if(isset($_POST) && strlen($_POST['domain'])>0) {
        $query = "INSERT INTO domains (id, domain) VALUES (NULL, '".$_POST['domain']."');";

        //print($query);
        $mysqli->query($query);

        print($mysqli->error);
      }
    ?>
    <section id="domain-list" class="table">
      <div class="grd-row">
        <div class="grd-row-col-19-24 p1">Domain</div>
        <div class="grd-row-col-5-24 p1"></div>
      </div>
      <section id="domain-list-content">
      <?php
        include_once("./domain-get-list.php");
      ?>
      </section>
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
