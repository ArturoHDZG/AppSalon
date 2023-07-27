<h1 class="page-name">RESTORE PASSWORD</h1>
<p class="page-desc">Type a new Password below</p>

<?php include_once __DIR__. "/../templates/alerts.php"; ?>

<?php if (!$error): ?>
<form class="form" method="POST">

  <div class="field">
    <label for="password">Password</label>
    <input
      id="password"
      name="password"
      type="password"
      placeholder="Password"
    >
  </div>

  <input class="button" type="submit" value="Set New Password">

</form>
<?php endif; ?>

<div class="page-actions">
  <a href="/">Do You Have an Account? Log In!</a>
  <a href="/signup">Don't You Have an Account? Sign Up!</a>
</div>
