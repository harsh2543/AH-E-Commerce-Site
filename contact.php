<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="stylephp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .main{
            background-color: #fff;
            height: 390px;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    <div class="container header-content">
        <div class="logo">
            <img src="AHlogo.jpg" alt="AH Men's Clothing Store Logo">
        </div>
        <h1>Contact Us</h1>
        <!-- Default navigation for larger screens -->
        <nav class="nav-left">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
        </nav>
        <nav class="nav-right">
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>
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

    <main class="main">
    <div class="container">
        <h2>Get in Touch</h2>
        <p>Email: info@mensclothingstore.com</p>
        <p>Phone: +91-1234567890  /  +91-0987654321</p>
        <p>Address: Main Office: Yagnik Road, Race Course near Jilla Panchayat Chowk, Rajkot 360001, Gujarat, India.</p>
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
