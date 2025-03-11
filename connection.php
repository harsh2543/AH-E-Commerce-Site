<?php
$servername="localhost";
$username="root";
$password="";
$dbname="anil_form";
$conn= mysqli_connect($servername,$username,$password,$dbname);

if($conn)
{
    //echo "connected ok";
}
else
{
    echo "Connection failed".$mysqli_connect_error();
}
?> 