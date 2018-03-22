<header id="header" class="measure">
  <section class="top-header">
    <a href="./" class="h2">Mail Manager</a>
  </section>
  <?php
    if($_SESSION['backend-role'] == "admin") {
  ?>
  <nav id="main-navigation">
    <div id="back-container"><div id="back-btn"><a href="javascript:history.back();" class="btn btn--s"><i class="fas fa-angle-left"></i> Zurück</a></div></div>
    <ul class="list--unstyled">
      <li><a href="domain-add.php" class="btn btn--s"><i class="fas fa-plus"></i> Domains</a></li>
      <li><a href="account-add.php" class="btn btn--s"><i class="fas fa-plus"></i> Konten</a></li>
      <li><a href="alias-add.php" class="btn btn--s"><i class="fas fa-plus"></i> Umleitungen</a></li>
    </ul>
  </nav>
  <?php
    }
  ?>
</header>
