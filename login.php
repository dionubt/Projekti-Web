<?php
// login.php

// Database connection
$host = 'localhost';
$db   = 'flyhigh';
$user = 'root'; // default username for XAMPP
$pass = '';     // default password for XAMPP
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database
    $stmt = $pdo->prepare('SELECT * FROM clients WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Start a session and store user data
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];

        // Redirect based on user role
        if ($user['is_admin'] == 1) {
            header('Location: admin_dashboard.php'); // Redirect to admin dashboard
        } else {
            header('Location: user_dashboard.php'); // Redirect to user dashboard
        }
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <script src="script.js" defer></script>
    <title>FlyHigh - Login</title>
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

    <div class="center-box">
        <form class="auth-form" action="login.php" method="POST">
            <h2>Log In</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
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