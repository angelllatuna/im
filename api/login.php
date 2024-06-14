<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookvault";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL statement
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // User authenticated successfully
    $row = $result->fetch_assoc();
    $response = [
        'name' => $row['name'],
        'userid' => $row['id']
    ];
    echo json_encode($response);
} else {
    // Authentication failed
    echo "0";
}

$conn->close();
?>
