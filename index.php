<?php
session_start();
include 'db.php';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/index.php");
    } else {
        header("Location: user/dashboard.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto&display=swap" rel="stylesheet">
    <title>Portfolio Website</title>
    <style>
        body {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            font-family: 'Poppins', sans-serif;
            color: white;
            height: 100vh;
        }

        .container {
            text-align: center;
            margin-top: 100px;
        }

        h1 {
            font-size: 3.5rem;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            animation: neon-glow 1.5s ease-in-out infinite alternate;
        }

        @keyframes neon-glow {
            0% {
                text-shadow: 0 0 10px #fff, 0 0 20px #00c6ff, 0 0 30px #00c6ff, 0 0 40px #0072ff, 0 0 70px #0072ff, 0 0 80px #0072ff, 0 0 100px #0072ff, 0 0 150px #0072ff;
            }
            100% {
                text-shadow: 0 0 20px #fff, 0 0 30px #00c6ff, 0 0 40px #00c6ff, 0 0 50px #0072ff, 0 0 80px #0072ff, 0 0 90px #0072ff, 0 0 120px #0072ff, 0 0 180px #0072ff;
            }
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 50px;
        }

        .btn {
            font-size: 1.2rem;
            border-radius: 30px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4);
        }

        .logo {
            font-family: 'Poppins', sans-serif;
            font-size: 4rem;
            font-weight: bold;
            background: -webkit-linear-gradient(45deg, #fff, #00c6ff, #0072ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            animation: logo-slide 2s ease-in-out forwards;
        }

        @keyframes logo-slide {
            0% {
                opacity: 0;
                transform: translateY(-100px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated-bg {
            background: linear-gradient(-45deg, #0072ff, #00c6ff, #0072ff, #00c6ff);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            color: white;
            font-size: 0.9rem;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="animated-bg"></div>

<div class="container">
    <div class="logo">ProGen</div>
    <h1>Welcome to the Portfolio Website</h1>
    <p>Create your personal portfolio with ease and showcase your skills to the world.</p>

    <div class="row justify-content-center mt-4">
        <div class="col-md-3">
            <a href="register.php" class="btn btn-primary btn-block">Register</a>
        </div>
        <div class="col-md-3">
            <a href="login.php" class="btn btn-success btn-block">Login</a>
        </div>
    </div>
</div>

<footer>
    &copy; 2024 ProGen. All rights reserved.
</footer>

</body>
</html>
