<h1 class="page-name">SERVICES</h1>
<p class="page-desc">Service Management</p>

<?php include_once __DIR__ . '/../templates/bar.php'; ?>

<ul class="services">
  <?php foreach($services as $service): ?>
  <li>
    <p>Name: <span><?php echo $service->name; ?></span></p>
    <p>Price: <span>$<?php echo $service->price; ?></span></p>
    <div class="page-actions">
      <a href="/services/update?id=<?php echo $service->id; ?>" class="button">Edit</a>
      <form action="/services/delete" method="post">
        <input type="hidden" name="id" value="<?php echo $service->id; ?>">
        <input type="submit" class="button-delete" value="Delete">
      </form>
    </div>
  </li>
  <?php endforeach; ?>
</ul>
