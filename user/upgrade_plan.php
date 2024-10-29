<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['plan_id'])) {
    echo "Error: No plan selected.";
    exit();
}

$plan_id = $_GET['plan_id'];

// Update the user's portfolio with the new plan_id
$update_query = "UPDATE portfolios SET plan_id = $plan_id WHERE user_id = $user_id";

if ($conn->query($update_query) === TRUE) {
    echo "Your plan has been upgraded successfully.";
} else {
    echo "Error upgrading your plan: " . $conn->error;
}

// Redirect back to view_portfolio.php
header("Location: view_portfolio.php");
exit();
?>
