<h1 class="page-name">EDIT SERVICE</h1>
<p class="page-desc">Edit a Service in the Form Below</p>

<?php
  include_once __DIR__ . '/../templates/bar.php';
  include_once __DIR__ . '/../templates/alerts.php';
?>

<form class="form" method="POST">
<?php include_once __DIR__ . '/form.php'; ?>
  <input type="submit" class="button" value="Save">
</form>
