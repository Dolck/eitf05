  <?php
    function getProduct($id) {
      include_once("database.php");
      $db = Database::getInstance();
      $pdo = $db->getConnection();

      $stmt = $pdo->prepare('SELECT * FROM Products WHERE id=?');
      $stmt->execute(array($id));
      return $stmt->fetchAll()[0];
    }

    function debug($msg, $readable = true) {
        $out = fopen('php://stdout', 'w');
        fputs($out, ($readable ? print_r($msg, true) : $msg)."\n");
        fclose($out);
    }

    include 'header.php';
  ?>
  <div id="content">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-10 panel-title"><span style="line-height: 30px; font-size:20px;">Shopping cart</span></div>
          <div class="col-xs-2">
            <button type="button" class="btn btn-danger btn-sm btn-empty-cart pull-right"><span class="glyphicon glyphicon-remove"></span> Empty</button>
          </div>
        </div>
      </div>
      <?php
      if(!empty($_SESSION['cart'])){ ?>
        <ul class="list-group">
          <?php foreach ($_SESSION['cart'] as $id => $qty) { 
            $prod = getProduct($id);
            debug($prod)
          ?>
            <li class="list-group-item">
              <div class="row">
                <div class="col-xs-12 col-md-6">
                  <div class="row">
                    <div class="col-xs-6"><?php echo $prod['name'] ?></div>
                    <div class="col-xs-6"><?php echo $prod['description'] ?></div>
                  </div>
                </div>
                <div class="col-xs-12 col-md-6">
                  <?php echo $prod['price']."*".$qty ?>
                </div>
              </div>
            </li>
          <?php } ?>
        </ul>
        <div class="panel-footer">
          <button type="button" class="btn btn-warning btn-sm">&lt; Continue shopping</button>
          <button type="button" class="btn btn-success btn-sm pull-right">Checkout &gt;</button>
        </div>
      <?php
      } else { ?>
        <div class="panel-body">Cart is empty</div>
      <?php } ?>
    </div>
  </div>


  <script>
    $('.btn-empty-cart').click(function() {
      $.post("updateCart.php", {'action': "empty"});
      location.reload();
    });
  </script>

<?php /*
include 'header.php';
?>

<div id="content">
<div class="cart-view">
  <table width="100%" cellpadding="6" cellspacing="0"
  <thread><tr><th>Name</th><th>Quantity</th><thName></th><th>Price</th><th>Total</th><th>Remove</th>
  </tr></thread>
  <tbody>
    <?php
    $cartProducts = array("0"=>"5", "1"=>"2");
    if(isset($cartProducts)) //TODO check session variable
    {
      $total = 0; //set initial total value
      $b = 0; //var for zebra stripe table
      foreach ($cartProducts as $id => $qty)
      {
        //set variables to use in content below
        if($id == 0)
        {
          $product_name = "Råsa Cheps";
          $product_price = 30;
        } else if($id == 1){
          $product_name = "Lila Cheps";
          $product_price = 35;
        }
        $product_qty = $qty;
        $subtotal = ($product_price * $product_qty);

        $bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe
        echo '<tr class="'.$bg_color.'">';
        echo '<td>'.$product_name.'</td>';
        echo '<td>'.$qty.'</td>';
        echo '<td>'.$product_price.'</td>';
        echo '<td>'.$subtotal.'</td>';
        echo '<td><input type="checkbox" name="remove_code[]" value="'.$id.'" /></td>';
        echo '</tr>';
        $total = ($total + $subtotal); //add subtotal to total var
      }
    }
    ?>
    <tr><td colspan="5"><a href="index.php" class="button">Add More Items</a></td></tr>
  </tbody>
</table>
</form>
</div>
</div>
*/ ?>
</body>
</html>
