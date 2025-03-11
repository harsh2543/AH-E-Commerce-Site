<?php
include 'config.php'; 

$sql = "INSERT INTO products (id,name, description, price, image, category) VALUES
('1','Plain White t-shirt','Plain White color t-shirt.','499.99','whitetshirt.jpg','T-shirt'),
('2','Black jeans','Black color Plain jeans.','799.99','jeans.jpg','Pant'),
('3','Jordan Hoodie','White color Jordan hoodie.','999.99','jordan_2.jpg','Hoodie'),
('4','Cargo Paint','Grey Color Cargo Paint.','1399.99','cargopaint.jpg','Pant'),
('5','Printed Sweat t-shirt','White Color Printed t-shirt.','999.99','printedsweatshirt.jpg','T-shirt'),
('6','Sky Blue Jacket','Sky Blue Color Plain Jacket.','699.99','skybluejacket.jpg','Jacket'),
('7','Vertical Line T-shirt','White Color Vertical Line t-shirt.','799.99','verticllineshirt.jpg','Shirt'),
('8','Cotton Pant','Cream Color Cotton Pant.','999.99','cottonpaint.jpg','Pant'),
('9','Full Slive T-shirt','Light Green Color Full Slive T-shirt.','599.99','fullslivetshirt.jpg','T-shirt'),
('10','Combo Pant Shirt','White color printed Shirt And Black Pant Combo.','2199.99','combo.jpg','Combo'),
('11','Jeans','Blue Color Jeans.','1399.99','jeans (2).jpg','Pant'),
('12','Cargo Paint','Golden Color Cargo Paint.','899.99','cargopaint2.jpg','Pant'),
('13','Hoodie','Blue Color Hoodie.','999.99','bluehoodie.jpg','Hoodie'),
('14','Hoodie','Sky Color Hoodie.','699.99','bluehoodie2.jpg','Hoodie'),
('15','Printed T-shirt','Black Color Printed T-shirt.','499.99','printedtshirt.jpg','T-shirt'),
('16','Cotton Track Pant','Black & White Color Cotton Track Pant.','699.99','track paint.jpg','Pant'),
('17','Formal Shirt','Premium Formal Shirt.','999.99','Formalshirt.jpg','Formal'),
('18','Formal Pant','Premium Formal Pant.','999.99','formalpant.jpg','Formal')";



// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "New products inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>;