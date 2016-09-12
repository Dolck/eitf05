	<?php
	include 'header.php'
	?>
	<div id="content">
		<div class="column">
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="https://www.dsek.se/fotoarkiv/data/1999/Nollningen/Lekar-i-gr%F8ngr%E6set%20och%20sittning/00002850.jpg" alt="nollor">
					<div class="caption">
						<h3>Råsa Cheps</h3>
						<p>Det klassiska orginalet. Gör alla teknologer avundsjuka med det senaste från LTH:s modekatalog!</p>
						<p>
							<div class="input-group">
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
								<span class="input-group-btn" style="padding-left:10px">
									<a href="#" class="btn btn-primary" role="button">Lägg till</a>
								</span>
							</div>
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
	</div>
</body>
</html>

<script>
function updateNumber(op){
	e.preventDefault();

	let fieldId = $(this).attr('data-field-id');
	let input = $("input[name='" + fieldId + "']");
	let value = parseInt(input.val());

	input.val(isNaN(value) ? value : op(value)).change();
}

$('.btn-number[data-type="plus"]').click(e => updateNumber( v => v + 1 ));
$('.btn-number[data-type="minus"]').click(e => updateNumber( v => v - 1 ));

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
	
	min =  parseInt($(this).attr('min'));
	max =  parseInt($(this).attr('max'));
	current = parseInt($(this).val());
	
	name = $(this).attr('name');
	if (current < max && current > min) {
		$(".btn-number[data-field='" + name + "']").removeAttr('disabled');
	} else if (current === max) {
		$('.btn-number[data-field="' + name + '"][data-type="plus"]').attr('disabled', true);
	} else if (current === min) {
		$('.btn-number[data-field="' + name + '", data-type="minus"]').attr('disabled', true);
	} else {
		$('this').val($('this').data('oldValue'));
	}
});
/*$(".input-number").keydown(function (e) {
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
	});*/
</script>