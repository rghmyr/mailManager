<header id="header" class="measure">
  <section class="top-header">
    <div class="h2">Mail Manager<div>
  </section>
  <?php
    if($_SESSION['backend-role'] == "admin") {
  ?>
  <nav id="main-navigation">
    <ul class="list--unstyled">
      <li><a href="domain-add.php" class="btn btn--s"><i class="fas fa-plus"></i> Domains</a></li>
      <li><a href="account-add.php" class="btn btn--s"><i class="fas fa-plus"></i> Accounts</a></li>
      <li><a href="alias-add.php" class="btn btn--s"><i class="fas fa-plus"></i> Alias</a></li>
    </ul>
  </nav>
  <?php
    }
  ?>
</header>
