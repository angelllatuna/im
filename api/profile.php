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
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookvault";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userid = $_GET['userid'] ?? 0;

    $sql = "SELECT * FROM users WHERE userid = $userid";
    $result = $conn->query($sql);

    $user = null;
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }

    $conn->close();
    ?>

    <?php if ($user): ?>
    <ul>
        <li>User ID: <?php echo $user['userid']; ?></li>
        <li>Name: <?php echo $user['name']; ?></li>
        <li>Email: <?php echo $user['email']; ?></li>
        <li>Contact Number: <?php echo $user['contact_number']; ?></li>
        <li>Address: <?php echo $user['address']; ?></li>
        <li>Birthday: <?php echo $user['birthday']; ?></li>
        <li>Age: <?php echo $user['age']; ?></li>
        <li>Username: <?php echo $user['username']; ?></li>
    </ul>
    <?php else: ?>
    <p>User not found.</p>
    <?php endif; ?>
</body>

</html>
