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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Link your custom CSS file if needed -->
    <title><?php echo htmlspecialchars($portfolio['name']); ?>'s CV</title>
    <style>
        body {
            background-color: #fdf6e3;
            font-family: 'Roboto', sans-serif;
            color: #4a4a4a;
        }
        .header {
            background-color: #8d6748;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            color: #8d6748;
            font-weight: bold;
            border-bottom: 2px solid #8d6748;
            padding-bottom: 5px;
        }
        .info-section {
            padding: 15px 0;
            margin-bottom: 15px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        ul li::before {
            content: '• ';
            color: #8d6748;
            font-weight: bold;
        }
        .print-button {
            background-color: #8d6748;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
        }
        .print-button:hover {
            background-color: #704d3a;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
    <script>
        // JavaScript function to trigger print
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>

<div class="container mt-5">
    <button class="btn print-button mb-4" onclick="printPage()">Print this page</button>

    <!-- Header Section -->
    <div class="header">
        <h1><?php echo htmlspecialchars($portfolio['name']); ?></h1>
        <p><?php echo htmlspecialchars($portfolio['about']); ?></p>
    </div>

    <!-- Content Sections -->
    <div class="row mt-4">
        <div class="col-md-4 info-section">
            <h5 class="section-title">Contact Information</h5>
            <ul>
                <li>Email: <?php echo htmlspecialchars($portfolio['email']); ?></li>
                <li>Phone: <?php echo htmlspecialchars($portfolio['phone']); ?></li>
                <li>LinkedIn: <?php echo htmlspecialchars($portfolio['social_media_links']); ?></li>
            </ul>
        </div>
        <div class="col-md-8 info-section">
            <h5 class="section-title">About Me</h5>
            <p><?php echo nl2br(htmlspecialchars($portfolio['about'])); ?></p>
        </div>
    </div>

    <!-- Skills and Tools Section -->
    <div class="row mt-3">
        <div class="col-md-6 info-section">
            <h5 class="section-title">Skills</h5>
            <ul>
                <?php
                $skills = explode(',', $portfolio['skills']);
                foreach ($skills as $skill) {
                    echo "<li>" . htmlspecialchars($skill) . "</li>";
                }
                ?>
            </ul>
        </div>
        <div class="col-md-6 info-section">
            <h5 class="section-title">Tools</h5>
            <ul>
                <?php
                $tools = explode(',', $portfolio['tools']);
                foreach ($tools as $tool) {
                    echo "<li>" . htmlspecialchars($tool) . "</li>";
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- Experience Section -->
    <div class="info-section">
        <h5 class="section-title">Experience</h5>
        <p><?php echo nl2br(htmlspecialchars($portfolio['experience'])); ?></p>
    </div>

    <!-- Education Section -->
    <div class="info-section">
        <h5 class="section-title">Education</h5>
        <p><?php echo nl2br(htmlspecialchars($portfolio['education'])); ?></p>
    </div>
</div>

</body>
</html>
