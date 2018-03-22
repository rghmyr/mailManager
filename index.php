<?php include_once("./standards/include/usercontrol.php"); ?>
<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Domainauswahl</h1>
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
