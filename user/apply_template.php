<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['template_id'])) {
    echo "Error: No template selected.";
    exit();
}

$template_id = $_GET['template_id'];

// Check if the template ID exists in the database
$template_check_query = "SELECT * FROM templates WHERE id = $template_id";
$template_check_result = $conn->query($template_check_query);

if ($template_check_result->num_rows == 0) {
    echo "Error: Invalid template selected.";
    exit();
}

// Update the user's portfolio with the selected template
$update_query = "UPDATE portfolios SET design_template = $template_id WHERE user_id = $user_id";

if ($conn->query($update_query) === TRUE) {
    echo "Template has been applied successfully.";
    // Redirect back to view_portfolio.php after successful application
    header("Location: view_portfolio.php?success=template_applied");
    exit();
} else {
    echo "Error applying template: " . $conn->error;
    exit();
}
?>
