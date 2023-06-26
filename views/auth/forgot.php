<h1 class="page-name">FORGOT PASSWORD</h1>
<p class="page-desc">Enter Your Email</p>

<?php include_once __DIR__. "/../templates/alerts.php"; ?>

<form class="form" method="POST" action="/forgot">

  <div class="field">
    <label for="email">Email</label>
    <input
      id="email"
      name="email"
      type="email"
      placeholder="email@example.com"
    >
  </div>

  <input class="button" type="submit" value="Restore Password">

</form>

<div class="page-actions">
  <a href="/">Do You Have an Account? Log In!</a>
  <a href="/signup">Don't You Have an Account? Sign Up!</a>
</div>
