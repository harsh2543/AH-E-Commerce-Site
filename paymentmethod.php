<?php
session_start();
include 'config.php';

// Redirect if customer details or cart are missing
if (empty($_SESSION['customer_details']) || empty($_SESSION['cart'])) {
    header('Location: checkout.php');
    exit;
}

// Handle payment and final order submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_payment'])) {
    $payment_method = $_POST['payment'];

    // Retrieve customer details from session
    $name = $_SESSION['customer_details']['name'];
    $address = $_SESSION['customer_details']['address'];
    $city = $_SESSION['customer_details']['city'];
    $postal = $_SESSION['customer_details']['postal'];
    $total_price = 0;

    // Calculate total price
    foreach ($_SESSION['cart'] as $product) {
        $total_price += $product['price'] * $product['quantity'];
    }

    // Insert order into the database
    $sql = "INSERT INTO orders (name, address, city, postal, payment, total_price) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssd", $name, $address, $city, $postal, $payment_method, $total_price);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Insert order items into the order_items table
        $order_item_sql = "INSERT INTO order_items (order_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)";
        $order_item_stmt = $conn->prepare($order_item_sql);

        foreach ($_SESSION['cart'] as $product) {
            $product_id = $product['id'];
            $quantity = $product['quantity'];
            $item_total_price = $product['price'] * $quantity;

            $order_item_stmt->bind_param("iiid", $order_id, $product_id, $quantity, $item_total_price);
            $order_item_stmt->execute();
        }

        // Close the order item statement
        $order_item_stmt->close();

        // Clear the cart and store the order ID in the session
        $_SESSION['cart'] = [];
        $_SESSION['order_id'] = $order_id;

        // Redirect to confirmation page
        header('Location: conformation.php'); 
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - AH Men's Clothing Store</title>
    <link rel="stylesheet" href="stylephp.css">
</head>
<body>

<header>
    <div class="container2">
        <h1>Payment</h1>
    </div>
</header>

<main>
    <div class="container5">
        <h2>Select Your Payment Method</h2>
        <form method="POST">
            <label for="payment">Payment Method:</label>
            <select id="payment" name="payment" required>
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <option value="upi">UPI Transaction</option>
                <option value="cod">Cash on Delivery</option>
            </select>

            <!-- Card details section, shown only if card payment is selected -->
            <div id="card-details" style="display: none;">
                <h3>Card Details</h3>
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" placeholder="Enter your card number">

                <label for="expiry">Expiry Date:</label>
                <input type="text" id="expiry" name="expiry" placeholder="MM/YY">

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" placeholder="CVV">
            </div>

            <!-- UPI details section, shown only if UPI is selected -->
            <div id="upi-details" style="display: none;">
                <h3>UPI Details</h3>
                <label for="upi_id">UPI ID:</label>
                <input type="text" id="upi_id" name="upi_id" placeholder="Enter your UPI ID">
            </div>

            <button type="submit" name="confirm_payment" class="btn checkout-btn">Confirm Payment</button>
        </form>
    </div>
</main>

<script>
    document.getElementById('payment').addEventListener('change', function() {
        const paymentMethod = this.value;
        const cardDetails = document.getElementById('card-details');
        const upiDetails = document.getElementById('upi-details');

        // Hide all payment-specific sections initially
        cardDetails.style.display = 'none';
        upiDetails.style.display = 'none';

        if (paymentMethod === 'credit_card' || paymentMethod === 'debit_card') {
            cardDetails.style.display = 'block';  // Show card details for card payments
        } else if (paymentMethod === 'upi') {
            upiDetails.style.display = 'block';  // Show UPI details for UPI payments
        }
    });
</script>

<footer>
    <div class="container">
        <p>&copy; 2024 AH Men's Clothing Store. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
