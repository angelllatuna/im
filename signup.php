<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookvault"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Insert user into database
    $sql = "INSERT INTO users (name, email, contact_number, address, birthday, age, username, password, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $email, $contact_number, $address, $birthday, $age, $username, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Record Successfully Saved!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Record NOT Saved!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
        <title>Book Vault Sign Up</title>
    </head>
    <body>
        <div class="background-image"></div>
        <section class="vh-100 d-flex justify-content-center align-items-center">
            <div class="container py-5">
                <div class="row d-flex justify-content-center">
                    <div class="col col-xl-8">
                        <div class="card shadow-lg p-4" style="border-radius: 1rem;">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="images/logo (2).png" alt="Logo" class="mb-3" style="max-width: 250px;"/>
                                    <h3 class="mb-0">Create an Account</h3>
                                </div>
                                <form id="signup-form" autocomplete="off" method="POST" action="">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                            <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-map-marker-alt"></i></span>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Address" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-birthday-cake"></i></span>
                                            <input type="date" name="birthday" id="birthday" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                            <input type="number" name="age_display" id="age_display" class="form-control" placeholder="Age" autocomplete="off" disabled>
                                            <input type="hidden" name="age" id="age">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="button-group">
                                            <button type="submit" class="btn btn-primary w-100" id="btnSignup">Create Account</button>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="login.html" class="text-decoration-none">Already have an account? Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.getElementById('birthday').addEventListener('change', function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = today.getFullYear() - dob.getFullYear();
                if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                    age--;
                }
                document.getElementById('age_display').value = age;
                document.getElementById('age').value = age;
                // Enable/disable form submission based on age
                var submitButton = document.getElementById('btnSignup');
                if (age >= 18) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            });
        </script>
    </body>
</html>
