<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_GET['id'];
$conn->query("UPDATE users SET status='approved' WHERE id = $user_id");

header("Location: users.php");
exit();
?>
