<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch existing portfolio data
$query = "SELECT * FROM portfolios WHERE user_id = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $portfolio = $result->fetch_assoc();
} else {
    echo "<div class='alert alert-warning'>You haven't created a portfolio yet. <a href='create_portfolio.php'>Create Now</a></div>";
    exit();
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $about = $_POST['about'];
    $skills = $_POST['skills'];
    $tools = $_POST['tools'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $projects = $_POST['projects'];
    $services = $_POST['services'];
    $social_media_links = $_POST['social_media_links'];

    // Update the portfolio
    $update_query = "UPDATE portfolios 
                     SET name = '$name', about = '$about', skills = '$skills', tools = '$tools', 
                         education = '$education', experience = '$experience', projects = '$projects', 
                         services = '$services', social_media_links = '$social_media_links'
                     WHERE user_id = $user_id";

    if ($conn->query($update_query) === TRUE) {
        echo "<div class='alert alert-success'>Portfolio updated successfully!</div>";
        header("Refresh:2; url=view_portfolio.php"); // Redirect to view page after 2 seconds
    } else {
        echo "<div class='alert alert-danger'>Error updating portfolio: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css"> <!-- Link your custom CSS file if needed -->
    <title>Edit Portfolio</title>
    <style>
        .custom-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }
        .custom-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">ProGen</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_portfolio.php">View Portfolio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger text-white" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Your Portfolio</h2>
    <div class="card custom-card p-4">
        <form action="edit_portfolio.php" method="POST">
            <div class="form-group">
                <label for="name">Portfolio Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $portfolio['name']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="about">About You</label>
                <textarea class="form-control" name="about" id="about" rows="3" required><?php echo $portfolio['about']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="skills">Skills</label>
                <input type="text" class="form-control" name="skills" id="skills" value="<?php echo $portfolio['skills']; ?>" required>
            </div>

            <div class="form-group">
                <label for="tools">Tools</label>
                <input type="text" class="form-control" name="tools" id="tools" value="<?php echo $portfolio['tools']; ?>" required>
            </div>

            <div class="form-group">
                <label for="education">Education</label>
                <input type="text" class="form-control" name="education" id="education" value="<?php echo $portfolio['education']; ?>" required>
            </div>

            <div class="form-group">
                <label for="experience">Experience</label>
                <textarea class="form-control" name="experience" id="experience" rows="3" required><?php echo $portfolio['experience']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="projects">Projects</label>
                <textarea class="form-control" name="projects" id="projects" rows="3" required><?php echo $portfolio['projects']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="services">Services</label>
                <textarea class="form-control" name="services" id="services" rows="3" required><?php echo $portfolio['services']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="social_media_links">Social Media Links</label>
                <input type="text" class="form-control" name="social_media_links" id="social_media_links" value="<?php echo $portfolio['social_media_links']; ?>" required>
            </div>

            <button type="submit" class="btn btn-success btn-block">Update Portfolio</button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3 mt-5">
    <p>&copy; 2024 ProGen. All Rights Reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
