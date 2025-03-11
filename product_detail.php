<?php
include 'config.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details from the database  
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['name']); ?> - Product Details</title>
    <link rel="stylesheet" href="stylephp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .add-to-cart{
            margin-top: 30px;
        }
    </style>
</head>
<body>
<header>
    <div class="container3 header-content">
        <div class="logo">
            <img src="AHlogo.jpg" alt="AH Men's Clothing Store Logo">
        </div>
        <h1>Men's Clothing Store</h1>
        <nav class="nav-left">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
        </nav>

        <!-- Cart Icon with Badge -->
        <div class="cart-icon">
        <a href="cart.php" id="cart-link">
        <i class="fas fa-shopping-cart"></i>
        </a>
        </div>

        <div class="menu-icon" onclick="toggleSidebar()">
            ☰
        </div>
    </div>
</header>

<main>
    <div class="container">
        <div class="product-detail">
            <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="product-image">
            <div class="product-info">
                <h1><?php echo htmlspecialchars($row['name']); ?></h1>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <p class="price">Price: ₹<?php echo number_format($row['price'], 2); ?></p>
                <p class="category">Category: <?php echo htmlspecialchars($row['category']); ?></p>
                <a href="#" class="btn1 buy-now">Buy Now</a>
                <a href="cart.php?action=add&id=<?php echo $row['id']; ?>" class="btn1 add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</a>              
            </div>
        </div>
    </div>
</main>
<footer>
    <div class="container">
        <p>&copy; 2024 AH Men's Clothing Store. All rights reserved.</p>
    </div>
</footer>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active'); // Toggle the 'active' class
    }
</script>
</body>
</html>
