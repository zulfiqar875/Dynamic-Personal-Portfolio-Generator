<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user portfolio data
$portfolio_query = "SELECT * FROM portfolios WHERE user_id = $user_id";
$portfolio_result = $conn->query($portfolio_query);

if ($portfolio_result->num_rows > 0) {
    $portfolio = $portfolio_result->fetch_assoc();
    $current_template_id = $portfolio['design_template'];
} else {
    echo "<div class='alert alert-warning'>No portfolio found. Please create one first.</div>";
    exit();
}

// Load the corresponding template based on the current template ID
switch ($current_template_id) {
    case 1:
        include '../templates/template1.php';
        break;
    case 2:
        include '../templates/template2.php';
        break;
    case 3:
        include '../templates/template3.php';
        break;
    case 4:
        include '../templates/template4.php';
        break;
    case 5:
        include '../templates/template5.php';
        break;
    case 6:
        include '../templates/template6.php';
        break;
    // Add more cases for other templates as needed
    default:
        echo "Invalid template.";
        break;
}
?>
