<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookvault";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection Successful!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
