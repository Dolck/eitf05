  <?php
    include_once "toolbox.php";
    include_once 'header.php';

    $_SESSION['cart_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    $token = $_SESSION['cart_token'];

    if (empty($_SESSION['checkout_token'])) {
        $_SESSION['checkout_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
    $checkout_token = $_SESSION['checkout_token'];

    $totalPrice = 0;
  ?>
  <div id="content">
    <div class="panel panel-default">
      <div class="panel-heading">
        <span style="line-height: 30px; font-size:20px;font-weight: 500;">Shopping cart</span>
        <?php if (!empty($_SESSION['cart'])) { ?>
          <button type="button" class="btn btn-danger btn-empty-cart pull-right">Empty <span class="glyphicon glyphicon-remove"></span></button>
        <?php } ?>
      </div>
      <?php
      if(!empty($_SESSION['cart'])){ ?>
        <ul class="list-group">
          <?php foreach ($_SESSION['cart'] as $id => $qty) { 
            $prod = getProduct($id);
          ?>
            <li class="list-group-item">
              <div class="row"><div class="row-height">
                <div class="col-xs-5 col-md-3 col-height col-middle">
                  <span class="thumbnail cart-img">
                    <img src="./img/<?php echo getImgFilename($prod['name']) ?>.jpg" alt="<?php echo $prod['name'] ?>" />
                  </span>
                </div>
                <div class="col-xs-6 col-md-8 col-height col-middle">
                  <div class="row">
                    <div class="col-xs-12 col-md-8">
                      <h4 style="font-weight: 400; text-align:center;"><?php echo $prod['name'] ?></h4>
                      <small><?php echo $prod['description'] ?></small>
                    </div>
                    <div class="hidden-lg hidden-md col-xs-12" style="padding-top: 10px"></div>
                    <div class="col-xs-12 col-md-4">
                      <div class="panel panel-default cart-calculation">
                        <input type="text" class="panel-heading form-control cart-item-qty" aria-label="Quantity" data-id="<?php echo $id ?>" value="<?php echo $qty ?>" />
                        <div class="input-group" style="width: 100%;">
                          <span class="input-group-addon" style="text-align: left;"><big>&times;</big></span>
                          <span class="input-group-addon"><?php echo $prod['price'] ?>:-<span>
                        </div>
                        <?php 
                          $subtotal = $prod['price'] * $qty;
                          $totalPrice += $subtotal;
                          ?>
                        <div class="panel-footer"><?php echo $subtotal ?>:-</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-1 col-md-1 col-height col-middle">
                  <button type="button" class="btn btn-danger pull-right cart-item-update" data-id="<?php echo $id ?>"><span class="glyphicon glyphicon-remove"></span></button>
                </div>
              </div></div>
            </li>
          <?php } ?>
        </ul>
        <div class="panel-footer">
          <a role="button" href="index.php" class="btn btn-warning"><span class="glyphicon glyphicon-chevron-left"></span> Continue shopping</a>
          <div class="input-group pull-right" style="width: 1rem;">
            <span class="input-group-addon">Total: <?php echo $totalPrice ?>:-</span>
            <span class="input-group-btn">
              <a href="checkout.php?csrfToken=<?php echo $checkout_token ?>" role="button" class="btn btn-success">Checkout <span class="glyphicon glyphicon-chevron-right"></span></a>
            </span>
          </div>
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

    function itemUpdate(id, qty = 0) {
      $.post('updateCart.php', { 'action': "set", 'product': id, 'quantity': qty, 'csrfToken': '<?php echo $token ?>'}, location.reload()).fail(function() {
                            alert( "error" ); });
    }
    $('.cart-item-update').click(function () {
      let id = $(this).attr('data-id');
      if ($(this).data('hasChanged')) {
        let qty = $('.cart-calculation input[data-id="'+id+'"]').val();
        itemUpdate(id, qty);
      } else {
        itemUpdate(id);
      }
    });
    $('.cart-item-qty').focusin(function () {
      let id = $(this).attr('data-id');
      let btn = $('.cart-item-update[data-id="'+id+'"]');
      btn.data('hasChanged', true);
      btn.removeClass('btn-danger');
      btn.addClass('btn-primary');
      btn.html('<span class="glyphicon glyphicon-refresh"></span>');
    });
  </script>
</body>
</html>
