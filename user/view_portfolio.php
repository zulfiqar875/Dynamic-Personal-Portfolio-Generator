<?php
if (isset($_GET['success']) && $_GET['success'] == 'template_applied') {
    echo "<div class='alert alert-success'>Template has been applied successfully!</div>";
}

include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the user's portfolio and plan data
$portfolio_query = "SELECT portfolios.*, portfolios.plan_id as user_plan_id FROM portfolios 
                    WHERE portfolios.user_id = $user_id";
$portfolio_result = $conn->query($portfolio_query);

if ($portfolio_result->num_rows > 0) {
    $portfolio = $portfolio_result->fetch_assoc();
    $current_plan_id = $portfolio['user_plan_id'];
} else {
    echo "<div class='alert alert-warning'>You haven't created a portfolio yet. <a href='create_portfolio.php'>Create Now</a></div>";
    exit();
}

// Fetch all available plans
$plans_query = "SELECT * FROM plans";
$plans_result = $conn->query($plans_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>View Portfolio</title>
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 40px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar {
            margin-bottom: 30px;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            text-align: center;
            /* position: fixed; */
            width: 100%;
            bottom: 0;
        }
        .card {
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
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
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_portfolio.php">View Portfolio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger text-white" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Your Portfolio</h2>
    <hr>
    <div class="card p-4 mb-3">
        <div class="card-body">
            <h5 class="card-title"><strong>Name:</strong> <?php echo $portfolio['name']; ?></h5>
            <p><strong>About Me:</strong> <?php echo $portfolio['about']; ?></p>
            <p><strong>Skills:</strong> <?php echo $portfolio['skills']; ?></p>
            <p><strong>Tools:</strong> <?php echo $portfolio['tools']; ?></p>
            <p><strong>Education:</strong> <?php echo $portfolio['education']; ?></p>
            <p><strong>Experience:</strong> <?php echo $portfolio['experience']; ?></p>
            <p><strong>Projects:</strong> <?php echo $portfolio['projects']; ?></p>
            <p><strong>Services:</strong> <?php echo $portfolio['services']; ?></p>
            <p><strong>Social Media Links:</strong> <?php echo $portfolio['social_media_links']; ?></p>
            <a href="edit_portfolio.php" class="btn btn-primary mt-3">Edit Portfolio</a>
        </div>
    </div>

    <h4 class="mt-4">Current Plan: 
        <?php
        $current_plan_query = "SELECT * FROM plans WHERE id = $current_plan_id";
        $current_plan_result = $conn->query($current_plan_query);
        if ($current_plan_result->num_rows > 0) {
            $current_plan = $current_plan_result->fetch_assoc();
            echo $current_plan['name'];
        }
        ?>
    </h4>

    <form action="upgrade_plan.php" method="GET" class="mt-3">
        <div class="form-group">
            <label for="planSelect">Upgrade Your Plan:</label>
            <select class="form-control" id="planSelect" name="plan_id" required>
                <option value="">Select a Plan</option>
                <?php
                if ($plans_result->num_rows > 0) {
                    while ($plan = $plans_result->fetch_assoc()) {
                        if ($plan['id'] > $current_plan_id) {
                            echo "<option value='" . $plan['id'] . "'>" . $plan['name'] . " - Available Templates: " . $plan['template_count'] . "</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Upgrade Plan</button>
    </form>

    <h4 class="mt-4">Available Templates for Your Plan</h4>
    <div class="row">
    <?php
    // Fetch available templates based on the user's plan
    $template_query = "SELECT * FROM templates WHERE plan_id <= $current_plan_id";
    $template_result = $conn->query($template_query);

    if ($template_result->num_rows > 0) {
        while ($template = $template_result->fetch_assoc()) {
            echo "<div class='col-md-4'>";
            echo "<div class='card mt-3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $template['template_name'] . "</h5>";
            echo "<a href='apply_template.php?template_id=" . $template['id'] . "' class='btn btn-success'>Apply Template</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No templates available for your current plan.</p>";
    }
    ?>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center mt-5 py-3">
    <p>&copy; 2024 ProGen. All Rights Reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
