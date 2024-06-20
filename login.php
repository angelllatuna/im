<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>Banking System Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="background-image"></div>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card shadow" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="images/bank (2).png" alt="login form" class="img-fluid h-100" style="border-radius: 1rem 0 0 1rem;"/>
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="text-center mb-4">
                                        <img src="images/logo (2).png" alt="Logo"/>
                                    </div>
                                    <form id="loginForm" action="" method="POST" autocomplete="off">
                                        <p class="text-danger" id="countdown"></p>
                                        <div class="form-group mt-4">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                <input type="text" name="username" class="form-control form-control-lg fix-rounded-right" placeholder="Enter username" required>
                                            </div>
                                            <small class="text-danger" id="username_validation"></small>
                                        </div>
                                        <div class="form-group mt-3">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                <input type="password" name="password" class="form-control form-control-lg fix-rounded-right" placeholder="Enter password" required>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-cust-citrus w-100 round-3">Login</button>
                                        </div>
                                        <div class="text-center link-container mt-3">
                                            <a href="signup.php" class="link-button">New User? Register Here</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a statement
    $stmt = $conn->prepare("SELECT userid, name, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['fullname'] = $user['name'];
            $_SESSION['userId'] = $user['userid'];
            $_SESSION['login_success'] = true; // Set login success flag
            header("Location: main.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Invalid username or password';
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = 'Invalid username or password';
        header("Location: login.php");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>