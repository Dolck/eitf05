<?php
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
