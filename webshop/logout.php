<?php
	require('header.php');
	session_destroy();
?>

<div class="container">
	<p>
		You are now logged out.
	</p>
	<p>You will automaticly be redirected to startpage within 3 seconds.</p>
</div>
<script type="text/javascript">
//Redirect after a short time
window.setTimeout(function function_name(argument) {
	window.location = "index.php";
}, 3000);
</script>   
</body>
</html>