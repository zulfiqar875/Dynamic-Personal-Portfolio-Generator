<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database
    $query = "SELECT * FROM users WHERE email='$email' AND status='approved'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the entered password with the hashed password stored in the database
        if ($password == $user['password']) {
            // Store user data in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] == 'admin') {
                header("Location: admin/index.php"); // Redirect to the admin dashboard
            } else {
                header("Location: user/dashboard.php"); // Redirect to the user dashboard
            }
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Invalid password.</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>No account found or account not approved.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #007bff, #00c6ff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            padding-top: 70px; /* Ensure the content doesn't overlap with the navbar */
        }
        
        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            animation: bounceInDown 1s;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #007bff;
        }

        .form-control {
            border-radius: 50px;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0px 4px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-primary:hover {
            background: #0056b3;
            box-shadow: 0px 6px 20px rgba(0, 123, 255, 0.4);
            transform: scale(1.05);
        }

        .login-container:hover {
            box-shadow: 0px 10px 20px rgba(0, 123, 255, 0.2);
            transition: box-shadow 0.3s ease;
        }

        .footer {
            text-align: center;
            color: #fff;
            position: fixed;
            bottom: 10px;
            width: 100%;
        }

        @keyframes bounceInDown {
            0% {
                opacity: 0;
                transform: translateY(-500px);
            }
            60% {
                opacity: 1;
                transform: translateY(20px);
            }
            80% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }

        /* Adding some hover effects */
        input:focus {
            border-color: #007bff;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }
    </style>
    <title>Login</title>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">ProGen</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
        </ul>
    </div>
</nav>

<div class="login-container animate__animated animate__bounceInDown">
    <h2 class="text-center">Login</h2>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2024 ProGen. All Rights Reserved.</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
