<h1 class="page-name">SIGN UP</h1>
<p class="page-desc">Create New Account</p>

<?php include_once __DIR__. "/../templates/alerts.php"; ?>

<form class="form" method="POST" action="/signup">

  <div class="field">
    <label for="name">Name</label>
    <input
      id="name"
      name="name"
      type="text"
      placeholder="John"
      value="<?php echo s($user->name); ?>"
    >
  </div>

  <div class="field">
    <label for="lastName">Last Name</label>
    <input
      id="lastName"
      name="lastName"
      type="text"
      placeholder="Smith"
      value="<?php echo s($user->lastName); ?>"
    >
  </div>

  <div class="field">
    <label for="phone">Phone</label>
    <input
      id="phone"
      name="phone"
      type="tel"
      placeholder="55-5555-5555"
      value="<?php echo s($user->phone); ?>"
    >
  </div>

  <div class="field">
    <label for="email">Email</label>
    <input
      id="email"
      name="email"
      type="email"
      placeholder="email@example.com"
      value="<?php echo s($user->email); ?>"
    >
  </div>

  <div class="field">
    <label for="password">Password</label>
    <input
      id="password"
      name="password"
      type="password"
      placeholder="Password"
    >
  </div>

  <input class="button" type="submit" value="SIGN UP">

</form>

<div class="page-actions">
  <a href="/">Did You Already Had an Account? Login!</a>
  <a href="/forgot">Forgot Password?</a>
</div>
