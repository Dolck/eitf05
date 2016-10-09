<?php
	require 'header.php';
?>
<div class="container">
	<p>

<?php 
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(!empty($_SESSION['login_token']) && hash_equals($_POST['csrfToken'], $_SESSION['login_token'])){
			require_once('database.php');
			$db = Database::getInstance();
			$pdo_conn = $db->getConnection();

			$usr = $_POST['inputUsername'];

			$stmt = $pdo_conn->prepare("select * from users where username=?;");
			$stmt->execute(array($usr));
			$result = $stmt->fetchAll();	

			if(count($result) == 1 && password_verify($_POST['inputPassword'], $result[0]['password'])){
				//Regenerate session id to prevent session fixation attacks
				session_regenerate_id();
				$_SESSION['username'] = $_POST['inputUsername'];
				$_SESSION['loggedIn'] = TRUE;
				echo "Yeay, you are logged in!";
			}else{
				echo "No soup for you!";
			}
		}else{
			echo "Sorry, it seems like your csrf token doesn't match, " .
		"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again";
		}
	}else{
		echo 'You shouldn\'t be here. Go <a href="index.php">home</a>';
	}

	unset($_SESSION['login_token']);

?>
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