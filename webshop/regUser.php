<?php
// handle reg user post request here
require_once('database.php');
include('header.php');
$db = Database::getInstance();
$pdo_conn = $db->getConnection();

if(!function_exists('hash_equals')) {
  function hash_equals($str1, $str2) {
    if(strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}

$username = $_POST['inputUsername'];
$password = $_POST['inputPassword'];
$confirmPassword = $_POST['confirmPassword'];
$email = $_POST['inputEmail'];
$forname = $_POST['inputForename'];
$lastname = $_POST['inputLastname'];
$city = $_POST['inputCity'];
$street =$_POST['inputStreet'];
$zipcode =  $_POST['inputZip'];

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if (strlen($username) > 20) {
	echo "Sorry, it seems like the username is too long, the maximum length is 20, " .
	"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again.";
}	else if (strlen($username) < 1) {
	echo "Sorry, seems like the username is too short, the minimum length is 1, " .
	"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again.";
}	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "Sorry, it seems like the email has the wrong format, " .
	"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again.";
}	else if (strlen($email) > 50) {
	echo "Sorry, it seems like the email is too long, the maximum length is 50, " .
	"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again.";
}	else if (strlen($forname) > 30 || strlen($lastname) > 30 || strlen($city) > 30 || strlen($street) > 30 || strlen($zipcode) > 30) {
		echo "Sorry, it seems like some input field is too long, the maximum length is 30, " .
		"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again.";
}	else if (strlen($forname) < 1 || strlen($lastname) < 1 || strlen($city) < 1 || strlen($street) < 1 || strlen($zipcode) < 1) {
		echo "Sorry, it seems like some input field is too short, the minimum length is 1, " .
		"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again.";
}	else if(htmlspecialchars($username, ENT_QUOTES, 'UTF-8') != $username || htmlspecialchars($email, ENT_QUOTES, 'UTF-8') != $email ||
	htmlspecialchars($forname, ENT_QUOTES, 'UTF-8') != $forname || htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8') != $lastname ||
	htmlspecialchars($city, ENT_QUOTES, 'UTF-8') != $city || htmlspecialchars($street, ENT_QUOTES, 'UTF-8') != $street ||
	htmlspecialchars($zipcode, ENT_QUOTES, 'UTF-8') != $zipcode) {
	echo "Sorry, it seems like you're using prohibited charactes in your input fields, " .
		"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again";
} else if(!empty($_SESSION['register_token']) && hash_equals($_POST['csrfToken'], $_SESSION['register_token'])){
 	if($password == $confirmPassword){
		try {
			$stmt = $pdo_conn->prepare($sql);
			$stmt->execute(array($username, $hashedPassword, $email, $forname, $lastname, $city, $street, $zipcode));
			$count = $stmt->rowCount();
			echo "Successfully created user, returning to homepage!"; ?>
			<script type="text/javascript">
				//Redirect after a short time
				window.setTimeout(function function_name(argument) {
					window.location = "index.php";
				}, 3000);
				</script>
				<?php
		} catch (PDOException $e) {
			echo "Unable to create user";
			$error = "Unable to create user";
			die($error);
		}
	} else {
		echo "Sorry, it seems like the passwords don't match, please " .
		"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again";

	}
}else{
	echo "Sorry, it seems like your csrf token doesn't match, " .
		"<a href=\"javascript:history.go(-1)\">go back</a>" . " and try again";
}
//Unset token so it only is used once!
unset($_SESSION['register_token']);
?>
