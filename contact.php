<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection settings
    $servername = "localhost";
    $username = "root"; // Default XAMPP username
    $password = ""; // Default XAMPP password
    $dbname = "flyhigh";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert into database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        $feedback = "Message sent successfully!";
    } else {
        $feedback = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="about.css">
    <title>Contact Us - FlyHigh</title>
</head>
<body>
<header class="header">
    <div class="logo">FlyHigh</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="login.php">Log In</a></li>
        <li><a href="signup.php">Sign Up</a></li>
    </ul>
</header>

<section class="contact-section">
    <div class="contact-image">
        <img src="img/giza-pyramids-cairo-egypt-with-palm.webp" alt="Pyramids" class="airplane-img">
    </div>
    <div class="contact-form">
        <h2>Contact Us</h2>
        <?php if (!empty($feedback)): ?>
            <p style="color: green; font-weight: bold;"><?php echo $feedback; ?></p>
        <?php endif; ?>
        <form action="contact.php" method="post">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your Name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your Email" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="4" placeholder="Your Message" required></textarea>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
</section>
</body>
</html>
