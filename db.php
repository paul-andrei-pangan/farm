<?php
$servername = "localhost";
$username = "u554719115_personal";
$password = "Panganpaul09+";
$dbname = "u554719115_church_db";  // Siguraduhing tama ang pangalan ng database dito

// Pag-connect sa database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
