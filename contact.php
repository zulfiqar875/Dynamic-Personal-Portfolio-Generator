<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $query = "INSERT INTO messages (user_id, name, email, subject, message) VALUES ($user_id, '$name', '$email', '$subject', '$message')";
    $conn->query($query);
    echo "Message sent!";
}
?>
<form action="contact.php" method="POST">
    <input type="email" name="email" placeholder="Your Email" required><br>
    <input type="text" name="subject" placeholder="Subject" required><br>
    <textarea name="message" placeholder="Your Message" required></textarea><br>
    <button type="submit">Send Message</button>
</form>