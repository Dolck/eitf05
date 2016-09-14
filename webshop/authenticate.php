
<?php 
	/* Authenticates user */

	require_once('database.php');
	session_start();
	$db = Database::getInstance();
	$pdo_conn = $db->getConnection();

	$usr = $_POST['inputUsername'];
	$pwd = $_POST['inputPassword'];

	$stmt = $pdo_conn->prepare("select * from users where username=?;");
	$stmt->execute(array($usr));
	$result = $stmt->fetchAll();
	

	if(count($result) == 1){
		echo "success!";
	}else{
		echo "uhm no, just no";
	}

?>