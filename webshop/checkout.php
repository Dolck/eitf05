<?php
include 'header.php';

?>
    
	<div class="container">
        <?php 
            if(empty($_SESSION['loggedIn'])){
                echo '<h1>You must <a href="login.php">login</a> before you can checkout!</h1>';
            }else if(empty($_SESSION['cart'])){
                echo '<h1>No items to checkout, try <a href="index.php">add</a> something to your cart first!</h1>';
            }else{
        ?>
        
        <form action="receipt.php" method="post">
            <h2>This is a mockup checkout page</h2>
            <label for="inputCard" class="sr-only">Cardnumber</label>
            <input type="text" id="inputCard" name="inputCard" class="form-control" placeholder="Cardnumber (Not used right now)">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Pay</button>
        </form>
        
        <?php } ?>
    </div> <!-- /container -->

</body>
</html>
