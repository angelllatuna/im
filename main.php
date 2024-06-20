<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['fullname'])) {
    header("Location: login.php");
    exit();
}

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

// Fetch books using the stored procedure
$books = [];
$sql = "CALL GetBooks()";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    $result->close();
}

// Close the connection
$conn->close();

// Pagination settings
$booksPerPage = 5;
$totalBooks = count($books);
$totalPages = ceil($totalBooks / $booksPerPage);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $booksPerPage;
$currentBooks = array_slice($books, $start, $booksPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>Library</title>
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
                    <a href="favorite.php" class="sidebar-link">
                        <i class="fa-solid fa-table-list pe-1"></i>
                        <span>Favorite Books</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="logout-button">
            <a href="login.php" class="logout-button link-button">
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
                <div class="row mt-3">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title fs-3 display-1">Library</h5>
                                        <button class="btn btn-cust-citrus" id="btnAdd"><i class="fa-solid fa-plus"></i> Add book</button>
                                    </div>
                                    <div class="card-body">
                                        <div id="mainDiv">
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
                                                <tbody id="booksTableBody">
                                                    <?php foreach ($currentBooks as $book): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($book['title']); ?></td>
                                                            <td><?php echo htmlspecialchars($book['author']); ?></td>
                                                            <td><?php echo htmlspecialchars($book['genre']); ?></td>
                                                            <td><?php echo htmlspecialchars($book['summary']); ?></td>
                                                            <td><a href="favorites.php?book_id=<?php echo $book['id']; ?>" class="btn btn-primary">Add to Favorites</a></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php if ($page > 1): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                    <?php if ($page < $totalPages): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlCOv7B2xP6KT6VhZKQFKA/VGPNSxZlNf6A/0oPzVJ+J5XicKpPzo3B4tW6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cM03K5JdRmsKN/t8FzfGQ1ZXOlGIZ7Wv24e1LYD+47kxR/1D9t8L+BxNk3A2lQA5" crossorigin="anonymous"></script>
</body>
</html>
