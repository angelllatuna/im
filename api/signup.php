<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookvault";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];
$age = $_POST['age'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "CALL UserSignUpLogin('signup', NULL, '$name', '$email', '$contact_number', '$address', '$birthday', $age, '$username', '$password')";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row['message'];
    }
} else {
    echo "Sign-up failed.";
}

$conn->close();
?>
