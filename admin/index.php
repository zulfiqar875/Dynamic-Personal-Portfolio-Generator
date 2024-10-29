<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            background: #f8f9fa;
            padding-top: 70px; /* Ensure the content doesn't overlap with the navbar */
        }

        .dashboard-container {
            padding: 20px;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .footer {
            text-align: center;
            color: #fff;
            background: #343a40;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .navbar-brand, .nav-link {
            font-weight: bold;
        }
    </style>
    <title>Admin Dashboard</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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

<!-- Main Content -->
<div class="container dashboard-container">
    <h1 class="text-center mb-4">Admin Dashboard</h1>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-primary animate__animated animate__fadeInUp">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">View, approve, or manage all users registered in the system.</p>
                    <a href="users.php" class="btn btn-light">Manage Users</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-success animate__animated animate__fadeInUp">
                <div class="card-body">
                    <h5 class="card-title">Add Plan</h5>
                    <p class="card-text">Create or update subscription plans available for portfolio users.</p>
                    <a href="add_plan.php" class="btn btn-light">Add Plan</a>
                </div>
            </div>
        </div>
    </div>
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
