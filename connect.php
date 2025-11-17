<?php 
$connection = new mysqli("localhost", "root", "", "toko_roti");
if($connection->connect_errno){
    die("Failed to Connect to Database: " . $connection->connect_error);
}
?>