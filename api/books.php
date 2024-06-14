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

// Call the stored procedure
$sql = "CALL GetBooks()";
$result = $conn->query($sql);

$books = [];
if ($result) {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    } else {
        echo "No books found";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

$conn->close();
?>
