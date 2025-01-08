<?php 
$host  ="localhost";
$user  ="root";
$pass  = "";
$db    ="e_novel";

    $con = mysqli_connect("localhost","root","","e_novel");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>

