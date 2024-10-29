<?php
include '../db.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Add a new plan to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];
    $template_count = $_POST['template_count'];

    $insert_query = "INSERT INTO plans (name, price, template_count) VALUES ('$plan_name', $price, $template_count)";
    if ($conn->query($insert_query) === TRUE) {
        $success_message = "New plan added successfully!";
    } else {
        $error_message = "Error adding plan: " . $conn->error;
    }
}

// Fetch all existing plans from the database
$plans_query = "SELECT * FROM plans";
$plans_result = $conn->query($plans_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Manage Plans</title>
    <style>
        body {
            padding-top: 70px; /* Ensures content doesn't overlap with the navbar */
            background: #f8f9fa;
        }

        .container {
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
            /* position: fixed; */
            bottom: 0;
            width: 100%;
        }

        .navbar-brand, .nav-link {
            font-weight: bold;
        }
    </style>
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
                <a class="nav-link" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <h1 class="text-center my-4">Manage Plans</h1>

    <!-- Display Success or Error Messages -->
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- Display Existing Plans -->
    <h3>Available Plans</h3>
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Plan Name</th>
            <th>Price (Rupees)</th>
            <th>Available Templates</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($plans_result->num_rows > 0): ?>
            <?php $index = 1; ?>
            <?php while ($plan = $plans_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $plan['name']; ?></td>
                    <td><?php echo $plan['price']; ?></td>
                    <td><?php echo $plan['template_count']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No plans available</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <!-- Add New Plan Form -->
    <h3>Add New Plan</h3>
    <form action="add_plan.php" method="POST" class="mt-3">
        <div class="form-group">
            <label for="plan_name">Plan Name:</label>
            <input type="text" class="form-control" id="plan_name" name="plan_name" required placeholder="Enter plan name">
        </div>
        <div class="form-group">
            <label for="price">Price (in Rupees):</label>
            <input type="number" class="form-control" id="price" name="price" required placeholder="Enter plan price">
        </div>
        <div class="form-group">
            <label for="template_count">Number of Available Templates:</label>
            <input type="number" class="form-control" id="template_count" name="template_count" required placeholder="Enter the number of available templates">
        </div>
        <button type="submit" class="btn btn-primary">Add Plan</button>
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
