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
    <link rel="stylesheet" href="styles.css"> <!-- Link your custom CSS file -->
    <title><?php echo htmlspecialchars($portfolio['name']); ?>'s CV</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .cv-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .print-button {
            margin-bottom: 20px;
        }
        h1, h5 {
            color: #343a40;
        }
        h1 {
            font-size: 32px;
            font-weight: bold;
        }
        h5 {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }
        .skills-list ul {
            padding-left: 20px;
        }
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

<div class="container my-5">
    <!-- Print Button -->
    <button class="btn btn-primary print-button" onclick="printPage()">Print this page</button>

    <!-- CV Container -->
    <div class="cv-container">
        <div class="text-center">
            <h1><?php echo htmlspecialchars($portfolio['name']); ?></h1>
            <p><?php echo htmlspecialchars($portfolio['about']); ?></p>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h5>Personal Details</h5>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($portfolio['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($portfolio['phone']); ?></p>
                <p><strong>LinkedIn:</strong> <?php echo htmlspecialchars($portfolio['social_media_links']); ?></p>
                <hr>
                <h5>Education</h5>
                <p><?php echo nl2br(htmlspecialchars($portfolio['education'])); ?></p>
            </div>

            <div class="col-md-8">
                <h5>Profile</h5>
                <p><?php echo nl2br(htmlspecialchars($portfolio['about'])); ?></p>
                <hr>
                <h5>Experience</h5>
                <p><?php echo nl2br(htmlspecialchars($portfolio['experience'])); ?></p>
                <hr>
                <h5>Skills</h5>
                <div class="row skills-list">
                    <div class="col-6">
                        <ul>
                            <?php
                            $skills = explode(',', $portfolio['skills']);
                            $half = ceil(count($skills) / 2);
                            foreach (array_slice($skills, 0, $half) as $skill) {
                                echo "<li>" . htmlspecialchars($skill) . "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul>
                            <?php
                            foreach (array_slice($skills, $half) as $skill) {
                                echo "<li>" . htmlspecialchars($skill) . "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
