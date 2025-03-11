<?php


$query = "SELECT * FROM form_anil";
$data = mysqli_query($conn,$query);

$total = mysqli_num_rows($data);
echo $total;
?>