<?php
    include_once "toolbox.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        if(!empty($_SESSION['cart_token']) && hash_equals($_POST['csrfToken'], $_SESSION['cart_token'])){
            switch ($_POST['action']) {
                case "add": add(); break;
                case "set": set(); break; 
                case "empty": unset($_SESSION['cart']); break;
            }
        }else{
            //Csrf dont match.
            http_response_code(400);
        }
    }

    function add() {
        $id = $_POST['product'];
        $quantity = intval($_POST['quantity']);
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
        $quantity = intval($_POST['quantity']);
        if (isValidID($id)) {
            if ($quantity > 0) {
                $_SESSION['cart'][$id] = $quantity;
            } else if (isset($_SESSION['cart'][$id]) && sizeof($_SESSION['cart']) == 1) {
                unset($_SESSION['cart']);
            }else
                unset($_SESSION['cart'][$id]);
        }
    }
?>