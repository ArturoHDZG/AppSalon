<h1 class="page-name">CREATE NEW SERVICE</h1>
<p class="page-desc">Create a Service in the Form Below</p>

<?php
  include_once __DIR__ . '/../templates/bar.php';
  include_once __DIR__ . '/../templates/alerts.php';
?>

<form action="/services/create" class="form" method="POST">
<?php include_once __DIR__ . '/form.php'; ?>
  <input type="submit" class="button" value="Create">
</form>
