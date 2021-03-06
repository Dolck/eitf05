    <?php
        include_once 'header.php';
        include_once 'toolbox.php';

        $_SESSION['cart_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $token = $_SESSION['cart_token'];
    ?>

    <div id="content">
        <?php $products = getAllProducts();
        while($product = $products->fetch()) { ?>
            <div class="column">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="./img/<?php echo getImgFilename($product['name']) ?>.jpg" alt="<?php echo $product['name'] ?>" />
                        <div class="caption product-caption">
                            <h3><?php echo $product['name']; ?></h3>
                            <p><?php echo $product['description']; ?></p>

                            <?php $id = $product['id']; ?>
                            <div class="input-group quantity-selector">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number" data-type="minus" data-field-id="quant[<?php echo $id ?>]" disabled="disabled">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input type="text" name="quant[<?php echo $id ?>]" class="form-control input-number" value="1" min="1" max="200" data-toggle="tooltip" data-placement="bottom" title="Input a value between 1 and 200">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field-id="quant[<?php echo $id ?>]">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                            <span class="add-to-cart">
                                <button class="btn btn-primary" role="button" data-id="<?php echo $id ?>">Add to cart</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <script>
        $(document).ready(() => {
            function updateNumber(btn, op){
                let fieldId = $(btn).attr('data-field-id');
                let input = $("input[name='" + fieldId + "']");
                let value = parseInt(input.val());

                input.val(isNaN(value) ? value : op(value)).change();
            }

            $('.btn-number[data-type="plus"]').click(function() { updateNumber(this, v => v + 1 ) } );
            $('.btn-number[data-type="minus"]').click(function() { updateNumber(this,  v => v - 1 ) } );

            $('.input-number').focusin(function(){
                $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {
                name = $(this).attr('name');
                min = parseInt($(this).attr('min'));
                max = parseInt($(this).attr('max'));
                current = parseInt($(this).val());
                
                if (current <= max && current >= min) {
                    $(".btn-number[data-field-id='" + name + "']").removeAttr('disabled');
                    if (current === max) {
                        $('.btn-number[data-field-id="' + name + '"][data-type="plus"]').attr('disabled', true);
                    } else if (current === min) {
                        $('.btn-number[data-field-id="' + name + '"][data-type="minus"]').attr('disabled', true);
                    }
                } else {
                    $(this).val($(this).data('oldValue'));
                }
            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.add-to-cart button').click(function() {
                let id = parseInt($(this).attr('data-id'));
                let quantity = parseInt($('input[name="quant['+id+']"]').val());
                $.post("updateCart.php",
                       { 'action': "add", 'product': id, 'quantity': quantity, 'csrfToken': '<?php echo $token ?>' },
                       cartText(quantity)).fail(function() {
                            alert( "error" );
                        });
            });
        });
    </script>
</body>
</html>
