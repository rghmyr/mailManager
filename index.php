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
    <section class="table">
      <div class="grd-row">
        <div class="grd-row-col-19-24 p1">Domain</div>
        <div class="grd-row-col-5-24 p1"></div>
      </div>
      <?php
        $res = $mysqli->query("SELECT d.domain,COUNT(DISTINCT a.username) AS accounts,COUNT(DISTINCT al.source_username) AS aliases FROM domains d LEFT JOIN accounts a on a.domain=d.domain LEFT JOIN aliases al on al.source_domain=d.domain GROUP BY d.id ORDER BY d.domain ASC");
        while ($row = $res->fetch_assoc()) {
          $infoTxt = "";
          if($row['accounts']==0 && $row['aliases']==0) {
            $editBtn = '<a href="domain-edit.php"><i class="fas fa-pencil-alt"></i></i></a>';
            $deleteBtn = '<a href="domain-delete.php"><i class="fas fa-trash-alt"></i></a>';
            $infoTxt = $editBtn . " " . $deleteBtn;
          } else {
            if($row['accounts']!=0) {
              $infoTxt .= "<div class=\"accounts\">".$row['accounts']." Konten</div>";
            }
            if($row['aliases']!=0) {
              $infoTxt .= "<div class=\"aliases\">".$row['aliases']." Umleitungen</div>";
            }

          }
          printf('<div class="grd-row">');
          printf('<div class="grd-row-col-19-24--md px1 domain-select" data-domain="%s">%s</div>',$row['domain'],$row['domain']);
          printf('<div class="grd-row-col-5-24--md px1">%s</div>',$infoTxt);
          print ('</div>');
        }
      ?>
    </section>
  </main>
  <?php include_once("./standards/include/footer.php"); ?>
</body>
</html>
