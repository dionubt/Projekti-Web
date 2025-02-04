<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$host = 'localhost';
$db = 'flyhigh';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$stmt = $pdo->prepare('SELECT * FROM clients WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>FlyHigh - User Dashboard</title>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">FlyHigh</div>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="services.php"><i class="fas fa-ticket-alt"></i> My Bookings</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header>
                <h1>Welcome, <?= htmlspecialchars($user['username']); ?>!</h1>
            </header>

            <div class="quick-actions">
                <div class="action-card">
                    <i class="fas fa-search"></i>
                    <h3>Search Flights</h3>
                    <p>Find your next adventure.</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-ticket-alt"></i>
                    <h3>My Bookings</h3>
                    <p>View your flight bookings.</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-user"></i>
                    <h3>Profile</h3>
                    <p>Update your account details.</p>
                </div>
            </div>

            <div class="recent-bookings">
                <h2>Recent Bookings</h2>
                <ul>
                    <li>Flight to Paris on 2024-01-15.</li>
                    <li>Flight to New York on 2024-02-20.</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
