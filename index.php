<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AH Men's Clothing Store</title>
    <link rel="stylesheet" href="stylephp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

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
        
        <div class="search-icon">
        <a href="javascript:void(0);" id="search-toggle"><i class="fas fa-search"></i></a>
        </div>

        <!-- Search Bar -->
        <div class="search-bar" id="search-bar">
        <input type="text" class="search-input" id="search-input" placeholder="Search items...">
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
    <section class="hero">
        <div class="hero-slideshow">
            <div class="hero-slide active" style="background-image: url('image2.jpg');"></div>
            <div class="hero-slide" style="background-image: url('image1.jpg');"></div>
            <div class="hero-slide" style="background-image: url('image4.jpg');"></div>
            <div class="hero-slide" style="background-image: url('jordan.jpg');"></div>
            <div class="hero-slide" style="background-image: url('warming-up.jpg');"></div>
        </div>
        <div class="container hero-content">
            <h2>Discover the Latest Trends</h2>
            <p>Explore our exclusive collection of men's clothing with timeless styles and premium quality.</p>
            <a href="products.php" class="button">Shop Now</a>
        </div>
    </section>

    <section class="featured-products">
    <div class="container">
        <h2>Featured Products</h2>
        <div class="products">
            <?php
            $sql = "SELECT * FROM products LIMIT 6";
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
document.addEventListener('DOMContentLoaded', function() {
    const searchToggle = document.getElementById('search-toggle');
    const searchBar = document.getElementById('search-bar');

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const products = {
            'plain white t-shirt': 1,  
            'black jeans': 2,
            // Add more products as necessary
        };

        const searchBtn = document.getElementById('search-btn');
        const searchInput = document.getElementById('search-input');

        // Check if button and input exist
        if (searchBtn && searchInput) {
            searchBtn.addEventListener('click', function () {
                const query = searchInput.value.trim().toLowerCase(); // Convert to lowercase for consistency
                console.log('Searching for:', query);  // Debug log

                // Check if the product exists
                if (products[query]) {
                    console.log('Product found, redirecting...');  // Debug log
                    window.location.href = `product_detail.php?id=${products[query]}`;
                } else {
                    alert('Product not found. Please check the name and try again.');
                }
            });
        } else {
            console.error('Search button or input not found');
        }
    });
</script>
</body>
</html>
