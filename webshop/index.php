	<?php
		include 'header.php';
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
									<button type="button" class="btn btn-default btn-number" data-type="minus" data-field-id="quant[1]" disabled="disabled">
										<span class="glyphicon glyphicon-minus"></span>
									</button>
								</span>
								<input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="200" data-toggle="tooltip" data-placement="bottom" title="Input a value between 1 and 200">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number" data-type="plus" data-field-id="quant[1]">
										<span class="glyphicon glyphicon-plus"></span>
									</button>
								</span>
							</div>
							<span class="input-group-btn">
								<a href="#" class="btn btn-primary" role="button">Add</a>
							</span>
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
function updateNumber(e, op){
	e.preventDefault();

	let fieldId = $(e.currentTarget).attr('data-field-id');
	let input = $("input[name='" + fieldId + "']");
	let value = parseInt(input.val());

	input.val(isNaN(value) ? value : op(value)).change();
}

$('.btn-number[data-type="plus"]').click(e => updateNumber(e, v => v + 1 ));
$('.btn-number[data-type="minus"]').click(e => updateNumber(e,  v => v - 1 ));

$('.input-number').focusin(function(){
	$(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
	name = $(this).attr('name');
	min =  parseInt($(this).attr('min'));
	max =  parseInt($(this).attr('max'));
	current = parseInt($(this).val());
	
	if (current < max && current > min) {
		$(".btn-number[data-field-id='" + name + "']").removeAttr('disabled');
	} else if (current === max) {
		$('.btn-number[data-field-id="' + name + '"][data-type="plus"]').attr('disabled', true);
	} else if (current === min) {
		$('.btn-number[data-field-id="' + name + '"][data-type="minus"]').attr('disabled', true);
	} else {
		$(this).val($(this).data('oldValue'));
	}
});
$('[data-toggle="tooltip"]').tooltip()
</script>