<?php
session_start();
include 'config.php';

// Add a product to the cart
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];  // Ensure the ID is an integer

    // Fetch product details from the database to add to the cart
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++; // Increment quantity if the product exists
        } else {
            // Add new product to cart and include product ID
            $_SESSION['cart'][$product_id] = array(
                'id' => $product_id, // Store product ID
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $product['image']
            );
        }

        // Redirect to cart.php to view updated cart
        header('Location: cart.php');
        exit;
    } else {
        echo "Product not found.";
        exit;
    }
}

// Remove a product from the cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
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
    <title>Your Cart - AH Men's Clothing Store</title>
    <link rel="stylesheet" href="stylephp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <div class="cart-header">
        <h1>Your Cart</h1>
    </div>
</header>

<main>
    <div class="container">
        <?php if (!empty($_SESSION['cart'])): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                        <tr>
                            <td><img src="Images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="50"></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td>₹<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo intval($product['quantity']); ?></td>
                            <td>₹<?php echo number_format($product['price'] * $product['quantity'], 2); ?></td>
                            <td>
                                <a href="cart.php?action=remove&id=<?php echo $id; ?>" class="btn remove-btn">Remove</a>
                            </td>
                        </tr>
                        <?php $total += $product['price'] * $product['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-actions">
                <a href="products.php" class="btn back-to-products-btn">Back to Products</a>
                <h3>Total: ₹<?php echo number_format($total, 2); ?></h3>
                <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <p>Your cart is empty. <a href="products.php">Go back to products</a></p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
