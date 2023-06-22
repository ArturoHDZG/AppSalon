<h1 class="page-name">Login</h1>
<p class="page-desc">Login with your data</p>

<form class="form" method="POST" action="/">

  <div class="field">
    <label for="email">Email</label>
    <input
      id="email"
      name="email"
      type="email"
      placeholder="email@example.com"
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

  <input class="button" type="submit" value="Login">

</form>

<div class="page-actions">
  <a href="/signup">Don't you have an Account? Sign Up!</a>
  <a href="/forgot">Forgot Password?</a>
</div>
