<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link your custom CSS file -->
    <title><?php echo $portfolio['name']; ?>'s CV</title>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h5 {
            color: #343a40;
            font-weight: 700;
        }
        h1 {
            font-size: 32px;
        }
        h5 {
            margin-bottom: 15px;
        }
        p, li {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
        ul {
            padding-left: 20px;
        }
        .print-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
        /* Hide the button when printing */
        @media print {
            .print-button {
                display: none;
            }
        }
        .border {
            border: 1px solid #dee2e6 !important;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .text-center h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        hr {
            border: 1px solid #dee2e6;
        }
        .icon {
            margin-right: 8px;
            color: #007bff;
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
<div class="container">
    <!-- Print Button at the top -->
    <button class="btn print-button mb-4" onclick="printPage()"><i class="fas fa-print"></i> Print this page</button>

    <div class="border p-4">
        <div class="text-center">
            <h1><?php echo $portfolio['name']; ?></h1>
            <p><?php echo $portfolio['about']; ?></p>
            <hr>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <h5><i class="fas fa-info-circle icon"></i> Contact Information</h5>
                <p><strong>Email:</strong> <?php echo $portfolio['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $portfolio['phone']; ?></p>
                <p><strong>LinkedIn:</strong> <?php echo $portfolio['social_media_links']; ?></p>
            </div>
            <div class="col-md-8">
                <h5><i class="fas fa-user icon"></i> About Me</h5>
                <p><?php echo nl2br($portfolio['about']); ?></p>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <h5><i class="fas fa-lightbulb icon"></i> Skills</h5>
                <ul>
                    <?php
                    $skills = explode(',', $portfolio['skills']);
                    foreach ($skills as $skill) {
                        echo "<li>" . htmlspecialchars($skill) . "</li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-6">
                <h5><i class="fas fa-tools icon"></i> Tools</h5>
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
        <hr>

        <h5><i class="fas fa-briefcase icon"></i> Experience</h5>
        <p><?php echo nl2br($portfolio['experience']); ?></p>
        <hr>

        <h5><i class="fas fa-graduation-cap icon"></i> Education</h5>
        <p><?php echo nl2br($portfolio['education']); ?></p>
    </div>
</div>
</body>
</html>
