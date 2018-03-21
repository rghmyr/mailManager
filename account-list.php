<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
?>
<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>Kontoen - mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Accounts</h1>
    <section id="account-list" class="my1">
        <?php


          include_once("./standards/include/account-list.php");
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
