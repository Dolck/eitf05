<?php
require 'header.php';
if (empty($_SESSION['login_token'])) {
    $_SESSION['login_token'] = bin2hex(openssl_random_pseudo_bytes(32));
}
$token = $_SESSION['login_token'];
?>


	<div class="container">

      <form class="form-signin" action="authenticate.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
        <input type="hidden" name="csrfToken" value="<?php echo $token ?>" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

</body>
</html>