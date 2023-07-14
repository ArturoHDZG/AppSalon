<h1 class="page-name">CONTROL PANEL</h1>

<?php include_once __DIR__ . '/../templates/bar.php'; ?>

<h2>Search for Reservations</h2>
<div class="search">
  <form class="form">
    <div class="field">
      <label for="date">Date</label>
      <input
        id="date"
        type="date"
        name="date"
      >
    </div>
  </form>
</div>

<div class="admin-reservations">
  <ul class="reservations">
    <?php $reservationId = ''; ?>
    <?php foreach ($reservations as $key => $reservation) : ?>
      <?php if ($reservationId !== $reservation->id) : ?>
        <?php
          $reservationId = $reservation->id;
          $total = 0;
        ?>
        <li>
          <p>ID: <span><?php echo $reservation->id; ?></span></p>
          <p>Time: <span><?php echo $reservation->time; ?></span></p>
          <p>Costumer: <span><?php echo $reservation->costumer; ?></span></p>
          <p>Email: <span><?php echo $reservation->email; ?></span></p>
          <p>Phone: <span><?php echo $reservation->phone; ?></span></p>
          <h3>Requested Services</h3>
      <?php endif; ?>
          <p class="services"><?php echo $reservation->service . ' USD$' . $reservation->price; ?></p>
      <?php
        $total += $reservation->price;
        $current = $reservation->id;
        $next = $reservations[$key + 1]->id ?? 0;

        if (isLast($current, $next)) :
      ?>
        <p class="total">Total: <span>USD$<?php echo $total; ?></span></p>
      <?php endif; ?>
    <?php endforeach; ?>
        </li>
  </ul>
</div>
