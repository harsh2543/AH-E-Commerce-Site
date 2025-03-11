<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="stylephp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <div class="container header-content">
        <div class="logo">
            <img src="AHlogo.jpg" alt="AH Men's Clothing Store Logo">
        </div>
        <h1>Products</h1>
        <!-- Default navigation for larger screens -->
        <nav class="nav-left">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
        </nav>
        <nav class="nav-right">
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>
        
        <div class="search-icon">
        <a href="javascript:void(0);" id="search-toggle"><i class="fas fa-search"></i></a>
        </div>

        <!-- Search Bar -->
        <div class="search-bar" id="search-bar">
        <input type="text" id="search-input" placeholder="Search items...">
        <div class="search-btn" id="search-btn">Search</div>
        </div>

        <!-- Cart Icon with Badge -->
        <div class="cart-icon">
        <a href="cart.php" id="cart-link">
        <i class="fas fa-shopping-cart"></i>
        </a>
        </div>


        <!-- Hamburger menu icon for mobile screens -->
        <div class="menu-icon" onclick="toggleSidebar()">
            ☰
        </div>
    </div>
</header>

<!-- Sidebar for mobile navigation -->
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
        <h2>All Products</h2>
        <div class="products">
            <?php
            $sql = "SELECT * FROM products LIMIT 18";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                            <a href='product_detail.php?id={$row['id']}'>
                                <img src='Images/{$row['image']}' alt='{$row['name']}'>
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
document.addEventListener('DOMContentLoaded', function() {
    const searchToggle = document.getElementById('search-toggle');
    const searchBar = document.getElementById('search-bar');

    // Ensure the search bar is hidden on page load
    searchBar.style.display = 'none';

    // Toggle the search bar visibility on click
    searchToggle.addEventListener('click', function () {
        if (searchBar.style.display === 'none' || searchBar.style.display === '') {
            searchBar.style.display = 'flex'; 
        } else {
            searchBar.style.display = 'none'; 
        }
    });
});
</script>
</body>
</html>
