<?php
session_start();
include 'config.php';

// Redirect to cart if no order ID is present
if (!isset($_SESSION['order_id'])) {
    header('Location: cart.php');
    exit;
}

// Fetch the order details from the database
$order_id = $_SESSION['order_id'];
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - AH Men's Clothing Store</title>
    <link rel="stylesheet" href="stylephp.css">
</head>
<body>

<header>
    <div class="containerss">
        <h1>Order Conformation</h1>
    </div>
</header>

<main>
    <div class="containers">
        <h2>Thank you for your order!</h2>
        <p>Your order ID is: <strong><?php echo htmlspecialchars($order['id']); ?></strong></p>
        <p>Details:</p>
        <ul>
            <li>Name: <?php echo htmlspecialchars($order['name']); ?></li>
            <li>Address: <?php echo htmlspecialchars($order['address']); ?></li>
            <li>City: <?php echo htmlspecialchars($order['city']); ?></li>
            <li>Postal Code: <?php echo htmlspecialchars($order['postal']); ?></li>
            <li>Payment Method: <?php echo htmlspecialchars($order['payment']); ?></li>
            <li>Total Amount: ₹<?php echo number_format($order['total_price'], 2); ?></li>
        </ul>
        
        <p><a href="products.php" class="btn2">Continue Shopping</a></p>
    </div>
</main>

<footer>
    <div class="container">
        <p>&copy; 2024 AH Men's Clothing Store. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
