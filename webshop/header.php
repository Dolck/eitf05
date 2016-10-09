<?php
	if(!isset($_SESSION)) {
		session_start();
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
	<title>ChepsShoppen</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">ChepsShoppen</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){ echo 'class="active"';} ?>><a href="index.php">Home</a></li>
            <!-- TODO: add logic to show different menu items when logged in -->

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
            	if(!empty($_SESSION['loggedIn'])){
            ?>
              <li><p class="navbar-text" style="color: lightblue;">Logged in as: <?php echo $_SESSION['username'] ?></p></li>
            	<li <?php if(basename($_SERVER['PHP_SELF']) == 'logout.php'){ echo 'class="active"';} ?>><a href="logout.php">Logout</a></li>
            <?php
            	}else{
            ?>
            	<li <?php if(basename($_SERVER['PHP_SELF']) == 'register.php'){ echo 'class="active"';} ?>><a href="register.php">Register</a></li>
	            <li <?php if(basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'authenticate.php'){ echo 'class="active"';} ?>><a href="login.php">Login</a></li>
            <?php
            	}
            ?>
            <li>
              <p><a href="cart.php" role="button" class="btn btn-default btn-sm btn-cart">
                <span class="glyphicon glyphicon-shopping-cart"></span> <span id="cart-text"></span>
                <script>
                  var cartSum = <?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0 ?>;
                  function cartText(toAdd){
                    cartSum += toAdd;
                    switch (cartSum) {
                      case 0: $('#cart-text').text('Cart is empty'); break;
                      case 1: $('#cart-text').text(cartSum + ' item'); break;
                      default: $('#cart-text').text(cartSum + ' items');
                    }
                  }
                  cartText(0);
                </script>
              </a></p>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
<?php
if(!function_exists('hash_equals')) {
  function hash_equals($str1, $str2) {
    if(strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}
?>