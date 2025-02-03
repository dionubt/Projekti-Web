<?php
// Start the session
session_start();

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

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Fetch user from the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $user);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($pass, $result['password'])) {
        // Successful login, start session and store user data
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['role'] = $result['role'];  // Store the role in the session

        // Redirect based on user role
        if ($result['role'] === 'admin') {
            header("Location: admin_dashboard.php"); // Admin dashboard
        } else {
            header("Location: user_dashboard.php"); // Regular user dashboard
        }
        exit;
    } else {
        // Failed login
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!-- Login Page HTML -->
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
            |<li><a href="login.php">Log In</a></li>
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
