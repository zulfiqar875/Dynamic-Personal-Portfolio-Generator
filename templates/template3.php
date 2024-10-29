<?php
include '../db.php';
// session_start();

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
} else {
    echo "<div class='alert alert-warning'>No portfolio found. Please create one first.</div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Link your custom CSS file if needed -->
    <title><?php echo htmlspecialchars($portfolio['name']); ?>'s CV</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
        }
        .print-button {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            color: #fff;
            border-radius: 5px;
            font-weight: 600;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
        h2, h5 {
            color: #333;
            font-weight: 600;
        }
        h2 {
            font-size: 28px;
        }
        h5 {
            font-size: 18px;
        }
        .border-bottom {
            border-bottom: 2px solid #dee2e6;
        }
        p, ul {
            font-size: 16px;
            line-height: 1.7;
        }
        ul {
            padding-left: 20px;
        }
        .text-muted {
            color: #6c757d !important;
        }
        /* Custom styles for printing */
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<script>
    // JavaScript function to trigger print
    function printPage() {
        window.print();
    }
</script>
<body>

<div class="container">
    <!-- Print Button -->
    <button class="print-button mb-4" onclick="printPage()">Print this page</button>

    <!-- Header Section -->
    <div class="text-center border-bottom pb-3">
        <h2><?php echo htmlspecialchars($portfolio['name']); ?></h2>
        <p class="text-muted"><?php echo htmlspecialchars($portfolio['about']); ?></p>
        <span>Email: <?php echo htmlspecialchars($portfolio['email']); ?></span> | 
        <span>LinkedIn: <?php echo htmlspecialchars($portfolio['social_media_links']); ?></span>
    </div>

    <!-- Content Sections -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h5>About Me</h5>
            <p><?php echo nl2br(htmlspecialchars($portfolio['about'])); ?></p>
        </div>
        <div class="col-md-6">
            <h5>Skills</h5>
            <ul>
                <?php
                $skills = explode(',', $portfolio['skills']);
                foreach ($skills as $skill) {
                    echo "<li>" . htmlspecialchars($skill) . "</li>";
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- Experience Section -->
    <div class="mt-3">
        <h5>Experience</h5>
        <p><?php echo nl2br(htmlspecialchars($portfolio['experience'])); ?></p>
    </div>

    <!-- Education Section -->
    <div class="mt-3">
        <h5>Education</h5>
        <p><?php echo nl2br(htmlspecialchars($portfolio['education'])); ?></p>
    </div>
</div>

</body>
</html>
