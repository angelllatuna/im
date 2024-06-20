<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['fullname'])) {
    header("Location: login.php");
    exit();
}

$userid = $_SESSION['userid']; // Assuming you have stored the user_id in session when the user logged in

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookvault"; // Update this with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch favorite books
$favorites = [];
$sql = "SELECT book.id, book.title, book.author, book.genre, book.summary 
        FROM favorite
        JOIN book ON favorite.book_id = book.id 
        WHERE favorite.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $favorites[] = $row;
    }
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>Favorite Books</title>
    <link rel="stylesheet" href="css/page_style.css">
</head>
<body>
<div class="wrapper">
    <aside id="sidebar" class="expand">
        <div class="h-100">
            <div class="d-flex" id="system-info">
                <a href="main.php" class="box_icon" type="button">
                    <i class="fa-solid fa-warehouse"></i>
                </a>
                <div class="sidebar-logo">
                    <a href="main.php">Book Vault System</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="main.php" class="sidebar-link">
                        <i class="fa-solid fa-book"></i>
                        <span>Library</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="favorites.php" class="sidebar-link">
                        <i class="fa-solid fa-table-list pe-1"></i>
                        <span>Favorite Books</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="logout-button">
            <a href="logout.php" class="logout-button link-button">
                <span>Logout</span>
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </button>
    </aside>

    <div class="main">
        <nav class="navbar navbar-expand px-3 p-0 border-bottom shadow border-bottom">
            <div class="navbar-collapse navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="d-flex search-form">
                            <input class="form-control search-input me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success search-button" type="submit">Search</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a id="name" href="profile.php" class="nav-link">
                            <?php echo htmlspecialchars($_SESSION['fullname']); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Summary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="favoritesTableBody">
                            <?php foreach ($favorites as $book): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                                    <td><?php echo htmlspecialchars($book['genre']); ?></td>
                                    <td><?php echo htmlspecialchars($book['summary']); ?></td>
                                    <td><a href="remove_favorite.php?id=<?php echo $book['id']; ?>&userid=<?php echo $userid; ?>" class="btn btn-danger">Remove from Favorites</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlCOv7B2xP6KT6VhZKQFKA/VGPNSxZlNf6A/0oPzVJ+J5XicKpPzo3B4tW6" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cM03K5JdRmsKN/t8FzfGQ1ZXOlGIZ7Wv24e1LYD+47kxR/1D9t8L+BxNk3A2lQA5" crossorigin="anonymous"></script> -->
</body>
</html>
