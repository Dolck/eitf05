<?php
include 'header.php';
require_once('database.php');
$db = Database::getInstance();
$pdo_conn = $db->getConnection();

if (empty($_SESSION['payment_token'])) {
    $_SESSION['payment_token'] = bin2hex(openssl_random_pseudo_bytes(32));
}
$payment_token = $_SESSION['payment_token'];
?>

	<div class="container">
        <?php
            if(empty($_SESSION['loggedIn'])){
                echo '<h1>You must <a href="login.php">login</a> before you can checkout!</h1>';
            }else if(empty($_SESSION['cart'])){
                echo '<h1>No items to checkout, try <a href="index.php">add</a> something to your cart first!</h1>';
            }else if(!empty($_SESSION['checkout_token']) && hash_equals($_GET['csrfToken'], $_SESSION['checkout_token'])){
        ?>

        <form action="receipt.php" method="post">
            <h2>This is a mockup checkout page</h2>
            <label for="inputCard" class="sr-only">Cardnumber</label>
            <input type="text" id="inputCard" name="inputCard" class="form-control" placeholder="Cardnumber (Not used right now)">
            <input type="hidden" name="csrfToken" value="<?php echo $payment_token ?>" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Pay</button>
        </form>

        <?php
          foreach ($_SESSION['cart'] as $p_id => $qty) {
              $sql = "INSERT INTO orders (username, p_id, quantity) VALUES (?, ?, ?)";
              $stmt = $pdo_conn->prepare($sql);
              $stmt->execute(array($_SESSION['username'], $p_id, $qty));
          }
            }else{
                echo '<h1>Invalid csrf token, go <a href="index.php">home</a>!</h1>';
            }
            unset($_SESSION['checkout_token']);
         ?>
    </div> <!-- /container -->

</body>
</html>
