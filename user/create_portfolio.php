<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Create Portfolio</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        .form-group label {
            font-weight: 600;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px;
            font-size: 14px;
        }
        h2 {
            font-size: 28px;
            color: #343a40;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }
        .fa-linkedin {
            color: #0077b5;
        }
        .mt-4 {
            margin-top: 1.5rem !important;
        }
    </style>
</head>
<body>
<div class="container">
    <h2><i class="fas fa-id-card"></i> Create Your Portfolio</h2>
    <form action="create_portfolio.php" method="POST" class="mt-4">
        <input type="hidden" name="plan_id" value="<?php echo $plan_id; ?>"> <!-- Hidden input for plan_id -->

        <div class="form-group">
            <label for="name"><i class="fas fa-user"></i> Portfolio Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Portfolio Name" required>
        </div>

        <div class="form-group">
            <label for="about"><i class="fas fa-address-card"></i> About You</label>
            <textarea class="form-control" name="about" id="about" rows="3" placeholder="Write about yourself" required></textarea>
        </div>

        <div class="form-group">
            <label for="skills"><i class="fas fa-code"></i> Skills</label>
            <input type="text" class="form-control" name="skills" id="skills" placeholder="Your skills (e.g., HTML, CSS, JavaScript)" required>
        </div>

        <div class="form-group">
            <label for="tools"><i class="fas fa-tools"></i> Tools</label>
            <input type="text" class="form-control" name="tools" id="tools" placeholder="Tools you are proficient in (e.g., VSCode, Git)" required>
        </div>

        <div class="form-group">
            <label for="education"><i class="fas fa-graduation-cap"></i> Education</label>
            <input type="text" class="form-control" name="education" id="education" placeholder="Your education (e.g., Bachelor's in Computer Science)" required>
        </div>

        <div class="form-group">
            <label for="experience"><i class="fas fa-briefcase"></i> Experience</label>
            <textarea class="form-control" name="experience" id="experience" rows="3" placeholder="Your experience (e.g., 3 years in web development)" required></textarea>
        </div>

        <div class="form-group">
            <label for="projects"><i class="fas fa-project-diagram"></i> Projects</label>
            <textarea class="form-control" name="projects" id="projects" rows="3" placeholder="Projects you've worked on (e.g., E-commerce website, Blogging platform)" required></textarea>
        </div>

        <div class="form-group">
            <label for="services"><i class="fas fa-cogs"></i> Services</label>
            <textarea class="form-control" name="services" id="services" rows="3" placeholder="Services you can provide (e.g., Web development, SEO optimization)" required></textarea>
        </div>

        <div class="form-group">
            <label for="social_media_links"><i class="fab fa-linkedin"></i> LinkedIn Links</label>
            <input type="text" class="form-control" name="social_media_links" id="social_media_links" placeholder="LinkedIn, Twitter, GitHub URLs" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Create Portfolio</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
