<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="form-style.css">
    <title>Form</title>

</head>
<body>
    <div class="container">
        <form action="" method="POST">
        <div class="title">
        Registration form
        </div>
        <div class="form">
            <div class="input_field">
                <label>First Name </label>
                <input type="text" class="input" name="Fname" required>
            </div>
             
            <div class="input_field">
                <label>Last Name </label>
                <input type="text" class="input" name="Lname" required>
            </div>
            <div class="input_field">
                <label>Password </label>
                <input type="password" class="input" name="Password" required>
            </div>
            <div class="input_field">
                <label>Confirm Password </label>
                <input type="password" class="input" name="Conpassword" required>
            </div>
            <div class="input_field">
                <label>Gender </label>
                <select class="selectbox" name="Gender" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div> 
            <div class="input_field">
                <label>Email </label>
                <input type="email" class="input" name="Email" required>
            </div>
            <div class="input_field">
                <label>Phone Number </label>
                <input type="text" class="input" name="Pnumber" required> 
            </div>
            <div class="input_field">
                <label>Address </label>
                <textarea class="textarea" name="Address" required></textarea>
            </div>
            <div class="input_field terms">
                <label class="check">
                    <input type="checkbox" required>
                    <span class="checkmark"></span>
                </label>
                <p>Agree to terms and conditions</p>
            </div>
            
            <div class="input_field">
                <input type="submit" value="Register" class="btn" name="Register">

            </div>
                     
        </div>
        </form>
    </div>

</body>
</html>

<?php
if (isset($_POST['Register'])) { // Check if form is submitted
    $Fname       = mysqli_real_escape_string($conn, $_POST['Fname']);
    $Lname       = mysqli_real_escape_string($conn, $_POST['Lname']);
    $Password    = mysqli_real_escape_string($conn, $_POST['Password']);
    $Conpassword = mysqli_real_escape_string($conn, $_POST['Conpassword']);
    $Gender      = mysqli_real_escape_string($conn, $_POST['Gender']);
    $Email       = mysqli_real_escape_string($conn, $_POST['Email']);
    $Pnumber     = mysqli_real_escape_string($conn, $_POST['Pnumber']);
    $Address     = mysqli_real_escape_string($conn, $_POST['Address']);
    
    // Password match validation
    if ($Password !== $Conpassword) {
        echo "Passwords do not match!";
    } else {
        // Insert query with specified column names
        $query = "INSERT INTO form_anil (Fname, Lname, Password, Gender, Email, Pnumber, Address) 
                  VALUES ('$Fname', '$Lname', '$Password', '$Gender', '$Email', '$Pnumber', '$Address')";
        
        $data = mysqli_query($conn, $query);
        if ($data) {
            echo "Data inserted successfully!";
        } else {
            echo "Failed to insert data: " . mysqli_error($conn);
        }
    }
}
?>
