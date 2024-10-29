<?php
require('fpdf/fpdf.php');
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM portfolios WHERE user_id = $user_id";
$result = $conn->query($query);
$portfolio = $result->fetch_assoc();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(40, 10, 'Curriculum Vitae');
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(40, 10, 'Name: ' . $portfolio['name']);
$pdf->Ln();
$pdf->Cell(40, 10, 'About: ' . $portfolio['about']);
$pdf->Ln();
$pdf->Cell(40, 10, 'Skills: ' . $portfolio['skills']);
$pdf->Ln();
$pdf->Cell(40, 10, 'Education: ' . $portfolio['education']);
$pdf->Ln();

$pdf->Output('D', 'CV_' . $portfolio['name'] . '.pdf');
?>
