<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM portfolios WHERE user_id = $user_id";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>ProGen Dashboard</title>
    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 80px;
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 15px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .navbar {
            margin-bottom: 30px;
        }

        /* Smoky effect */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://i.imgur.com/4G1D0G0.png') repeat;
            opacity: 0.1;
            z-index: -1;
        }

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">ProGen</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <?php
    if ($result->num_rows > 0) {
        $portfolio = $result->fetch_assoc();
        echo "<h1 class='my-4 text-center'>Welcome to Your Dashboard</h1>";
        echo '<div class="row mt-4">';
        
        echo '<div class="col-md-6 mb-4">';
        echo '<div class="card text-center">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">My Portfolio</h5>';
        echo '<p class="card-text">View and manage your portfolio</p>';
        echo '<a href="view_portfolio.php" class="btn btn-primary">Open Portfolio</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="col-md-6 mb-4">';
        echo '<div class="card text-center">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">View My Portfolio</h5>';
        echo '<p class="card-text">See your live portfolio</p>';
        echo '<a href="view_my_portfolio.php" class="btn btn-primary">View Portfolio</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        

        echo '</div>';
    } else {
        echo "<div class='text-center'>";
        echo "<h1>No portfolio found.</h1>";
        echo "<a href='create_portfolio.php' class='btn btn-primary mt-3'>Create one now</a>";
        echo "</div>";
    }
    ?>
</div>

<!-- Footer -->
<footer class="text-center">
    <p>&copy; 2024 ProGen. All Rights Reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
