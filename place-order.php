<?php
session_start();
require "products.php";

// Generate a random order code
$order_code = generateOrderCode();
$order_date = date("Y-m-d H:i:s");
$cart = $_SESSION['cart'] ?? [];
$total_price = 0;

// Generate the order data
$order_data = "Order Code: $order_code\n";
$order_data .= "Date and Time Ordered: $order_date\n";
$order_data .= "Items:\n";

foreach ($cart as $item) {
    $order_data .= "Product ID: " . $item['id'] . "\n";
    $order_data .= "Product Name: " . $item['name'] . "\n";
    $order_data .= "Price: " . $item['price'] . " PHP\n";
    $order_data .= "------------------------\n";
    $total_price += $item['price'];
}

$order_data .= "Total Price: $total_price PHP\n";

// Save order to a text file (orders-[order_code].txt)
file_put_contents("orders-$order_code.txt", $order_data);

// Clear the cart after placing the order
$_SESSION['cart'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p><strong>Order Code:</strong> <?php echo $order_code; ?></p>
    <p><strong>Date and Time Ordered:</strong> <?php echo $order_date; ?></p>
    <p><strong>Total:</strong> <?php echo $total_price; ?> PHP</p>
    <a href="index.php">Back to Shopping</a>
</body>
</html>

<?php
// Function to generate a random order code
function generateOrderCode($length = 8) {
    return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
}
?>
