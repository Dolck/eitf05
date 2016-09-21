<?php
// handle reg user post request here
require_once('database.php');
$db = Database::getInstance();
$pdo_conn = $db->getConnection();

$username = $_POST['inputUsername'];
$password = $_POST['inputPassword'];
$email = $_POST['inputEmail'];
$forname = $_POST['inputForename'];
$lastname = $_POST['inputLastname'];
$city = $_POST['inputCity'];
$street =$_POST['inputStreet'];
$zipcode =  $_POST['inputZip'];

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

try {
		$stmt = $pdo_conn->prepare($sql);
		$stmt->execute(array($username, $hashedPassword, $email, $forname, $lastname, $city, $street, $zipcode));
		$count = $stmt->rowCount();
		echo "Successfully created user, returning to homepage!";

	} catch (PDOException $e) {
		echo "Unable to create user";
		$error = "Unable to create user";
		die($error);
	}


?>
<script type="text/javascript">
//Redirect after a short time
window.setTimeout(function function_name(argument) {
	window.location = "index.php";
}, 3000);
</script>
