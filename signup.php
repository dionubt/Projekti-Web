<?php
// Database connection
$host = 'localhost';
$dbname = 'flyhigh';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle sign-up
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user';  // Default role is 'user'

    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Username or email already exists');</script>";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role); // Insert the role

        if ($stmt->execute()) {
            echo "<script>alert('Sign-up successful!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Sign-up failed. Please try again.');</script>";
        }
    }
}
?>

<!-- Sign-Up Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <script src="script.js" defer></script>
    <title>FlyHigh - Sign Up</title>
</head>
<body>
    <header class="header">
        <div class="logo">FlyHigh</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            |<li><a href="login.php">Log In</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        </ul>
    </header>

    <div class="center-box">
        <form class="auth-form" action="signup.php" method="POST">
            <h2>Sign Up</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Log In</a></p>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2024 FlyHigh Tickets. All Rights Reserved.</p>
        <p>
            <a href="services.html">Services</a> | 
            <a href="contact.html">Contact Us</a>
        </p>
    </footer>
</body>
</html>
