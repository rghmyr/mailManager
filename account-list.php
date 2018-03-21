<?php
  include_once($conf['base-path']."standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
?>
<html lang="de">
<head>
  <?php include_once($conf['base-path']."standards/include/meta-head.php"); ?>
  <title>Kontoen - mail Manager</title>
</head>
<body>
  <?php include_once($conf['base-path']."standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Accounts</h1>
    <section id="account-list" class="my1">
        <?php


          include_once($conf['base-path']."account-get-list.php");
        ?>
      </div>
    </section>
  </main>
  <?php include_once($conf['base-path']."standards/include/footer.php"); ?>
</body>
</html>
<?php
  } else {
    header("Location: ./");
  }
?>
