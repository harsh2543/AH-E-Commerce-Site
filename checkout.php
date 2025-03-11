<?php
session_start();
include 'config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Redirect if the cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Handle form submission for placing an order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal = $_POST['postal'];

    // Validate that all required fields are filled
    if (!empty($name) && !empty($address) && !empty($city) && !empty($postal)) {
        // Save customer details in session for use in payment process
        $_SESSION['customer_details'] = [
            'name' => $name,
            'address' => $address,
            'city' => $city,
            'postal' => $postal,
        ];

        // Redirect to payment method page
        header('Location: paymentmethod.php');
        exit;
    } else {
        // Show an error message if required fields are missing
        echo "Please fill in all required fields.";
    }
}

// Remove a product from the cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]); // Remove the product from the cart
    }
    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - AH Men's Clothing Store</title>
    <link rel="stylesheet" href="stylephp.css">
</head>
<body>
</header>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - AH Men's Clothing Store</title>
    <link rel="stylesheet" href="stylephp.css">
</head>
<body>

<header>
    <div class="container2">
        <h1>Checkout</h1>
    </div>
</header>

<main>
    <div class="container">
        <h2>Your Order</h2>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td>₹<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo intval($product['quantity']); ?></td>
                            <td>₹<?php echo number_format($product['price'] * $product['quantity'], 2); ?></td>
                        </tr>
                        <?php $total += $product['price'] * $product['quantity']; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Total Amount: ₹<?php echo number_format($total, 2); ?></h3>

        <h2>Shipping Information</h2>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="postal">Postal Code:</label>
            <input type="text" id="postal" name="postal" required>

            <button type="submit" name="place_order" class="btn checkout-btn">Confirm Order</button>
        </form>
    </div>
</main>

<footer>
    <div class="container">
        <p>&copy; 2024 AH Men's Clothing Store. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
