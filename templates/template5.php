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
    <link rel="stylesheet" href="styles.css"> <!-- Link your custom CSS file -->
    <title><?php echo htmlspecialchars($portfolio['name']); ?>'s Premium CV</title>
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: auto;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
        }
        .header p {
            font-size: 1.2rem;
            color: #666;
        }
        .section-title {
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 20px auto;
            display: block;
        }
        .contact-info p {
            font-size: 1.1rem;
            margin: 5px 0;
        }
        .section {
            margin-top: 30px;
        }
        .section ul {
            list-style: none;
            padding-left: 0;
        }
        .section ul li::before {
            content: "\2022";
            color: #007bff;
            font-weight: bold;
            display: inline-block; 
            width: 1em;
            margin-left: -1em;
        }
        /* Print Button */
        .print-button {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
        /* Hiding print button when printing */
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
    <button class="btn print-button" onclick="printPage()">Print this page</button>

    <!-- Header Section with User Image -->
    <div class="header">
        <img src="https://static.vecteezy.com/system/resources/previews/019/879/186/non_2x/user-icon-on-transparent-background-free-png.png" alt="User Image" class="profile-img">
        <h1><?php echo htmlspecialchars($portfolio['name']); ?></h1>
        <p><?php echo htmlspecialchars($portfolio['about']); ?></p>
    </div>

    <!-- Contact Information -->
    <div class="section contact-info">
        <h4 class="section-title">Contact Information</h4>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($portfolio['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($portfolio['phone']); ?></p>
        <p><strong>LinkedIn:</strong> <?php echo htmlspecialchars($portfolio['social_media_links']); ?></p>
    </div>

    <!-- About Me -->
    <div class="section">
        <h4 class="section-title">About Me</h4>
        <p><?php echo nl2br(htmlspecialchars($portfolio['about'])); ?></p>
    </div>

    <!-- Skills Section -->
    <div class="section">
        <h4 class="section-title">Skills</h4>
        <ul>
            <?php
            $skills = explode(',', $portfolio['skills']);
            foreach ($skills as $skill) {
                echo "<li>" . htmlspecialchars($skill) . "</li>";
            }
            ?>
        </ul>
    </div>

    <!-- Experience Section -->
    <div class="section">
        <h4 class="section-title">Experience</h4>
        <p><?php echo nl2br(htmlspecialchars($portfolio['experience'])); ?></p>
    </div>

    <!-- Education Section -->
    <div class="section">
        <h4 class="section-title">Education</h4>
        <p><?php echo nl2br(htmlspecialchars($portfolio['education'])); ?></p>
    </div>
</div>
</body>
</html>
