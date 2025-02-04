<?php

$host = 'localhost';
$db   = 'flyhigh';
$user = 'root'; 
$pass = '';    
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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    
    $stmt = $pdo->prepare('INSERT INTO clients (username, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $password]);

    echo "Registration successful!";
}
?>

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