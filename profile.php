<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bookvault";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['userId'];

// Prepare a statement to fetch user data
$stmt = $conn->prepare("SELECT userid, name, email, contact_number, address, birthday, username FROM users WHERE userid = ?");
$stmt->bind_param("i", $userId);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch user data
$user = null;
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Calculate age
    $user['age'] = date_diff(date_create($user['birthday']), date_create('today'))->y;
} else {
    $user = [
        'userid' => 'N/A',
        'name' => 'N/A',
        'email' => 'N/A',
        'contact_number' => 'N/A',
        'address' => 'N/A',
        'birthday' => 'N/A',
        'age' => 'N/A',
        'username' => 'N/A'
    ];
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <h1>User Profile</h1>
    <ul id="user-info">
        <li>User ID: <span id="user-id"><?php echo htmlspecialchars($user['userid']); ?></span></li>
        <li>Name: <span id="name"><?php echo htmlspecialchars($user['name']); ?></span></li>
        <li>Email: <span id="email"><?php echo htmlspecialchars($user['email']); ?></span></li>
        <li>Contact Number: <span id="contact-number"><?php echo htmlspecialchars($user['contact_number']); ?></span></li>
        <li>Address: <span id="address"><?php echo htmlspecialchars($user['address']); ?></span></li>
        <li>Birthday: <span id="birthday"><?php echo htmlspecialchars($user['birthday']); ?></span></li>
        <li>Age: <span id="age"><?php echo htmlspecialchars($user['age']); ?></span></li>
        <li>Username: <span id="username"><?php echo htmlspecialchars($user['username']); ?></span></li>
    </ul>
</body>
</html>
