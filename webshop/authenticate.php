<?php
	require 'header.php';
?>
<div class="container">
	<p>

<?php 
	$bad_login_limit = 10;	
	$lockout_time = 600;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(!empty($_SESSION['login_token']) && hash_equals($_POST['csrfToken'], $_SESSION['login_token'])){
			require_once('database.php');
			$db = Database::getInstance();
			$pdo_conn = $db->getConnection();

			$usr = $_POST['inputUsername'];
			$stmt = $pdo_conn->prepare("select * from users where username=?;");
			$stmt->execute(array($usr));
			$result = $stmt->fetchAll();
			if(count($result) == 1) {
				$firstfailedlogin = new DateTime($result[0]['first_failed_login']);
				$failedlogincount = $result[0]['failed_login_count'];
				$current = new DateTime(date('Y-m-d H:i:s'));
				if (($failedlogincount >= $bad_login_limit) && abs($current->getTimestamp()-$firstfailedlogin->getTimestamp()) < $lockout_time) {
					echo "You're currently locked out because of to many login attempts in a short time(10minutes).";
				} else if(!password_verify($_POST['inputPassword'], $result[0]['password'])) {

					if(abs($current->getTimestamp()-$firstfailedlogin->getTimestamp()) >= $lockout_time || $firstfailedlogin == '1000-01-01 00:00:00') {
						$firstfailedlogin = new DateTime(date('Y-m-d H:i:s'));
						// first unsuccessful login since $lockout_time on the last one expired
						$update_stmt = $pdo_conn->prepare("update Users set first_failed_login=? where username=?;");
						$update_stmt->execute(array($firstfailedlogin->format('Y-m-d H:i:s'), $usr));
						$failedlogincount = 1;
						$update_stmt = $pdo_conn->prepare("update Users set failed_login_count=? where username=?;");
						$update_stmt->execute(array($failedlogincount,$usr));
						$result = $update_stmt->fetchAll();
					} else {
						$failedlogincount++;
						$update_stmt = $pdo_conn->prepare("update Users set failed_login_count=? where username=?;");
						$update_stmt->execute(array($failedlogincount, $usr));
						$result = $update_stmt->fetchAll();
					}

					echo "No soup for you! ", $bad_login_limit - $failedlogincount, " log in attempts remaining.";
				} else {
					//Regenerate session id to prevent session fixation attacks
					$update_stmt = $pdo_conn->prepare("update Users set failed_login_count=0 where username=?;");
					$update_stmt->execute(array($usr));
					$result = $update_stmt->fetchAll();
					session_regenerate_id();
					$_SESSION['username'] = $_POST['inputUsername'];
					$_SESSION['loggedIn'] = TRUE;
					echo "Yeay, you are logged in!";
				}
			}
		} else {
			echo "Sorry, it seems like your csrf token doesn't match, " .
			"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again";
		}
	} else{
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