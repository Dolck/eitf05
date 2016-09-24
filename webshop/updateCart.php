<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        print("hi");
        switch ($_POST['action']) {
            case "add": add(); break;
            case "remove": remove(); break; 
            case "empty":
                unset($_SESSION['cart']);
            break;
        }
    }

    function add() {
        $id = $_POST['product'];
        $quantity = $_POST['quantity'];
        if ($quantity > 0) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array($id->$quantity);
            } else {
                $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $quantity || $quantity;
            }
        }
    }

    function remove() {
        if (isset($_SESSION['cart'])) {
            $id = $_POST['product'];
            $quantity = $_POST['quantity'];
            $_SESSION['cart'][$id] = $_SESSION['cart'][$product] - $quantity || 0;
        }
    }
?>