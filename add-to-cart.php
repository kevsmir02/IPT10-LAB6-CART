<?php
session_start();
require "products.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Find the product by id and add to cart
    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            $_SESSION['cart'][] = $product;
            break;
        }
    }
}

header("Location: cart.php");
exit();
?>
