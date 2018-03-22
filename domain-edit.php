<?php
  include_once("./standards/include/usercontrol.php");
  if($_SESSION['backend-role'] == "admin") {
    if(isset($_POST) && strlen($_POST['domain'])>0 && (int) $_POST['domainid'] > 0) {

      $query = "UPDATE domains SET domain = '".$_POST['domain']."' WHERE domains.id = ".$_POST['domainid'].";";
      //print_r($query);
      $mysqli->query($query);
      print($mysqli->error);
      header("Location: index.php");
    }
    $id = (int) $_GET['id'];
    if($id>0) {
      $res = $mysqli->query("SELECT * FROM domains WHERE id=".$id.";");
      $row = $res->fetch_assoc();
?>
<html lang="de">
<head>
  <?php include_once("./standards/include/meta-head.php"); ?>
  <title>Domain ändern - mail Manager</title>
</head>
<body>
  <?php include_once("./standards/include/header.php"); ?>
  <main class="measure" id="standards">
    <h1>Domain ändern</h1>
    <section class="my1">
      <form method="POST">
        <input type="hidden" id="domainid" name="domainid" value="<?=$id?>"/>
        <div class="grd-row">
          <div class="grd-row-col-24 px1"><input type="text" name="domain" required placeholder="example.com" value="<?=$row['domain']?>"/></div>
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
