<?php
include ("loginconnection.php"); 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="login-style.css">
    
    <title>Login</title>
</head>
<body>  
<div class="center">
        <h1>Login</h1>
    <form method="post">
        <div class="form">
            <input type="text" name="Email" class="textfiled" placeholder="Email" required>
            <input type="password" name="password" class="textfiled" placeholder="Password" required>
           <div class="forgetpass"><a href="#" class="link" onclick="message()">Forget Password ? </a></div>
           <input type="submit" name="login" value="Login" class="btn">
            <div class="signup">New Member ? <a href="form.php" class="link">SignUp Here</a></div>
        </div>
    </form>
</div>

<script>
    function message() {
        alert("Hi friends, what's up?");
    }
</script>

</body>
</html>

<?php
if (isset($_POST['login'])) {  
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);  
    $password = mysqli_real_escape_string($conn, $_POST['password']);  
    
    // Insert query
    $query = "INSERT INTO login_data (Email, password) VALUES ('$Email','$password')"; 
    
    $data = mysqli_query($conn, $query);
    
    if ($data) {
        
        //echo "Data inserted successfully into the database!";
        header("Location: index.php"); 
        exit(); 
    } else {
        echo "Failed to insert data: " . mysqli_error($conn); 
    }
}
?>
