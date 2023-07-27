<div class="name-bar">
  <p>Hi <?php echo $name ?? ''; ?></p>
  <a href="/logout" class="button">Log Out</a>
</div>

<?php if(isset($_SESSION['admin'])): ?>
  <div class="admin-bar">
    <a href="/admin" class="button">Reservations</a>
    <a href="/services" class="button">Services</a>
    <a href="/services/create" class="button">New Services</a>
  </div>
<?php endif; ?>
