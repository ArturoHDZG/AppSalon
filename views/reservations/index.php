<h1 class="page-name">RESERVATIONS</h1>
<p class="page-desc">Select services below</p>

<div id="app">

  <nav class="tabs">
    <button class="current" type="button" data-step="1">Services</button>
    <button type="button" data-step="2">Reservation</button>
    <button type="button" data-step="3">Summary</button>
  </nav>

  <div id="step-1" class="section">
    <h2>Services</h2>
    <p class="center">Choose your preferred services</p>
    <div id="services" class="list-services"></div>
  </div>

  <div id="step-2" class="section">
    <h2>Your Data and Reservation</h2>
    <p class="center">Enter your information and schedule an appointment</p>
    <form class="form">

      <div class="field">
        <label for="name">Name</label>
        <input
          id="name"
          type="text"
          value="<?php echo $name ?>"
          disabled
          placeholder="John Smith"
        >
      </div>
      <div class="field">
        <label for="date">Date</label>
        <input
          id="date"
          type="date"
          min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>"
        >
      </div>
      <div class="field">
        <label for="time">Time</label>
        <input
          id="time"
          type="time"
        >
      </div>

    </form>
  </div>

  <div id="step-3" class="section">
    <H2>Summary</H2>
    <p class="center">Check if the following information is correct</p>
  </div>

  <div class="pagination">
    <button id="back" class="button">&laquo; Back</button>
    <button id="next" class="button">Next &raquo;</button>
  </div>

</div>

<?php $script = "<script src='build/js/app.js'></script>"; ?>
