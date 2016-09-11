<?php
include 'header.php'
?>

<div class="column">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="https://www.dsek.se/fotoarkiv/data/1999/Nollningen/Lekar-i-gr%F8ngr%E6set%20och%20sittning/00002850.jpg" alt="nollor">
      <div class="caption">
        <h3>Råsa Cheps</h3>
        <p>Det klassiska orginalet. Gör alla teknologer avundsjuka med det senaste från LTH:s modekatalog!</p>
        <p>
            <div class="input-group" style="width:200px">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[1]">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </span>
                <input type="text" name="quant[1]" class="form-control input-number" value="1" min="0" max="200">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </span>
            </div>
            <a href="#" class="btn btn-primary" role="button">Lägg till</a>
        </p>
      </div>
    </div>
  </div>
</div>


<div class="column">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="https://queerty-prodweb.s3.amazonaws.com/content/docs//2016/05/483208412-real-estate-tycoon-donald-trump-flashes-the-thumbs-up.jpg.CROP_.promo-xlarge2.jpg" alt="nollor">
      <div class="caption">
        <h3>Lila Cheps</h3>
        <p>En exklusiv variant för att sticka ut ur mängden. Detta lila alternativ lämnar inte en trosa torr.</p>
        <p>
            <a href="#" class="btn btn-default" role="button">-</a>
            <a href="#" class="btn btn-default" role="button">+</a>
            <a href="#" class="btn btn-primary" role="button">Lägg till</a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>