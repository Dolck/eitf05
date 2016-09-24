<?php
    include 'header.php';
    if(!empty($_SESSION['cart'])){
        echo $_SESSION['cart'];
    } else {
        echo "cart is empty";
    }
?>