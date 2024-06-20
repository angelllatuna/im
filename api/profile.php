<?php
session_start();

// Include database connection
include 'connect.php';

// Fetch the current user's ID from the session
$userid = $_SESSION['userid'] ?? 0;

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userid);
$stmt->execute();
$result = $stmt->get_result();

$user = null;
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}

// Encode data as JSON and output it
echo json_encode($user);

$conn->close();
?>
