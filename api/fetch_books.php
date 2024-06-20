<?php
include 'connect.php';

// Fetch data from the books table
$sql = "SELECT id, title, author, genre, summary FROM book";
$result = $conn->query($sql);

$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Encode data as JSON and output it
echo json_encode($books);

$conn->close();
?>
