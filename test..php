<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="container header-content">
        <div class="logo">
            <img src="AHlogo.jpg" alt="AH Men's Clothing Store Logo">
        </div>
        <h1>Men's Clothing Store</h1>
        <nav class="nav-left">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
        </nav>
        <nav class="nav-right">
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>
        <div class="header-icons">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search products..." required>
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            <a href="cart.php" class="cart-icon">
                <i class="fas fa-shopping-cart"></i>
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                    <span class="cart-count"><?php echo count($_SESSION['cart']); ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>

</header>

<div id="sidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="toggleSidebar()">&times;</a>
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact Us</a>
</div>

<main>
<section class="featured-products">
    <div class="container">
        <h2>Featured Products</h2>
        <div class="products">
            <?php
            $sql = "SELECT * FROM products LIMIT 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                            <a href='product_detail.php?id={$row['id']}'>
                                <img src='images/{$row['image']}' alt='{$row['name']}'>
                                <div class='product-info'>
                                    <h3>{$row['name']}</h3>
                                    <p>{$row['description']}</p>
                                    <p class='price'>Price: ₹{$row['price']}</p>
                                </div>
                            </a>
                          </div>";
                }
            } else {
                echo "<p>No products available.</p>";
            }
            ?>
        </div>    
    </div>
</section>
    
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

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const slideInterval = 3000; // Change image every 3 seconds

    function showNextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    setInterval(showNextSlide, slideInterval);
</script>
<script>
// Select the search icon and search bar
const searchToggle = document.getElementById('search-toggle');
const searchBar = document.getElementById('search-bar');

// Toggle the search bar visibility on click
searchToggle.addEventListener('click', function () {
    if (searchBar.style.display === 'none' || searchBar.style.display === '') {
        searchBar.style.display = 'flex'; // Show the search bar
    } else {
        searchBar.style.display = 'none'; // Hide the search bar
    }
});
</script>
</body>
</html>
