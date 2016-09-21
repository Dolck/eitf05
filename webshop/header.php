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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.slim.min.js"></script>

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
            	if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE){
            ?>
              <li class="display-user"> <span> <?php echo 'Logged in as: '?> <?php echo $_SESSION['username']?></span></li>
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
              <a href="cart.php" <button type="button" class="btn btn-default btn-sm btn-cart">
                <span class="glyphicon glyphicon-shopping-cart"></span> 3 items
              </button></a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
