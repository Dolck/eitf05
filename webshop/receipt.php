<?php
	include 'header.php';
	include_once "toolbox.php";
	require_once('database.php');
	$db = Database::getInstance();
	$pdo_conn = $db->getConnection();
	$totalPrice = 0;
	$totalqty = 0;
?>
	<div class="container">

<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(empty($_SESSION['loggedIn'])){
            echo '<h1>You must <a href="login.php">login</a> before you can checkout!</h1>';
        }else{
        	//Here we would verify payment information etc..
        	if(!empty($_SESSION['cart'])){
        		$cart_info = $_SESSION['cart'];
        		unset($_SESSION['cart']);
?>
			<h1>Receipt</h1>
			<h3>Products</h3>
        	<table class="table">
        		<thead> <tr> <th>Product name</th> <th>Quantity</th> <th>Price</th> </tr> </thead>
	        	
	        	<?php
	        	foreach ($cart_info as $id => $qty) { 
	            	$prod = getProduct($id);
	            	$subtotal = $prod['price'] * $qty;
                    $totalPrice += $subtotal;
                    $totalqty += $qty;
	            	?>
	            	<tr>
	            		<td><?php echo $prod['name']; ?></td>
	            		<td><?php echo $qty; ?></td>
	            		<td><?php echo $subtotal; ?></td>
	            	</tr>
	            <?php
	        	}
	        	?>
	        	<tr class="active">
            		<td><b>Total<b></td>
            		<td><b><?php echo $totalqty; ?></b></td>
            		<td><b><?php echo $totalPrice; ?></b></td>
            	</tr>
			</table>
			<h3>Address</h3>
			<?php 
				$sql = "SELECT email, forename, lastname, city, street, zipcode FROM Users WHERE username=?";
				//$sql = "SELECT * FROM Users WHERE username=?";
				$stmt = $pdo_conn->prepare($sql);
				$stmt->execute(array($_SESSION['username']));
				$user = $stmt->fetchAll();
				echo "<p>" . $user[0]['forename'] . " " . $user[0]['lastname'] . "</p>";
				echo "<p>" . $user[0]['email'] . "</p>";
				echo "<p>" . $user[0]['street'] . "</p>";
				echo "<p>" . $user[0]['zipcode'] . "</p>";
				echo "<p>" . $user[0]['city'] . "</p>";
			?>
<?php
			}else{
				echo '<h2>You shouldn\'t be here with an empty cart. Go <a href="index.php">home</a></h2>';
			}

        }
	}else{
		echo 'You shouldn\'t be here. Go <a href="index.php">home</a>';
	}
?>

    </div> <!-- /container -->

</body>
</html>