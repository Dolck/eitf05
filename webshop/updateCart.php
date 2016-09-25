<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        switch ($_POST['action']) {
            case "add": add(); break;
            case "set": set(); break; 
            case "empty": unset($_SESSION['cart']); break;
        }
    }

    function isValidID($id) {
        require_once('database.php');
        $db = Database::getInstance();
		$pdo = $db->getConnection();

        $stmt = $pdo->prepare('SELECT EXISTS(SELECT 1 FROM Products WHERE id=?)');
        $stmt->execute(array($id));
        return $stmt->fetchAll()[0][0];
    }

    function debug($msg, $readable = true) {
        $out = fopen('php://stdout', 'w');
        fputs($out, ($readable ? print_r($msg, true) : $msg)."\n");
        fclose($out);
    }

    function add() {
        $id = $_POST['product'];
        $quantity = $_POST['quantity'];
        if ($quantity > 0 && isValidID($id)) {
            if (isset($_SESSION['cart'])) {
                $oldSum = isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id] : 0;
                $_SESSION['cart'][$id] = $oldSum + $quantity;
            } else
                $_SESSION['cart'] = array($id=>$quantity);
        }
    }

    function set() {
        $id = $_POST['product'];
        $quantity = $_POST['quantity'];
        if (isValidID($id)) {
            if ($quantity < 1 && isset($_SESSION['cart'][$id]))
                unset($_SESSION['cart'][$id]);
            else
                $_SESSION['cart'][$id] = $quantity;
        }
    }
?>