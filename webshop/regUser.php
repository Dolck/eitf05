<?php
// handle reg user post request here
require_once('database.php');
$db = Database::getInstance();
$pdo_conn = $db->getConnection();

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


?>
