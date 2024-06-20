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
$username_post = $_POST['username'];
$password_post = $_POST['password'];

// Hash the password (you should use a more secure hashing method)
$hashed_password = md5($password_post);

// Prepare SQL statement using prepared statements
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username_post, $hashed_password);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // User authenticated successfully
    $row = $result->fetch_assoc();
    $response = [
        'name' => $row['name'],
        'userid' => $row['id']
    ];
    echo "User successfully logged in. ";
    echo json_encode($response);
} else {
    // Authentication failed
    echo "0";
}

$stmt->close();
$conn->close();
?>
