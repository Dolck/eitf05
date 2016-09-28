<?php
    include_once "toolbox.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        switch ($_POST['action']) {
            case "add": add(); break;
            case "set": set(); break; 
            case "empty": unset($_SESSION['cart']); break;
        }
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
            if ($quantity < 1 && isset($_SESSION['cart'][$id])) {
                if (sizeof($_SESSION['cart']) < 2)
                    unset($_SESSION['cart']);
                else
                    unset($_SESSION['cart'][$id]);
            }
            else
                $_SESSION['cart'][$id] = $quantity;
        }
    }
?>