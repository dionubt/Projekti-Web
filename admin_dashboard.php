<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit();
}

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>FlyHigh - Admin Dashboard</title>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">FlyHigh</div>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="#"><i class="fas fa-plane"></i> Flights</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header>
                <h1>Welcome, Admin <?php echo htmlspecialchars($user['username']); ?>!</h1>
            </header>

            <div class="quick-actions">
                <div class="action-card">
                    <i class="fas fa-users"></i>
                    <h3>Manage Users</h3>
                    <p>View and manage all users.</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-plane"></i>
                    <h3>Manage Flights</h3>
                    <p>Add, edit, or delete flights.</p>
                </div>
                <div class="action-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>View Reports</h3>
                    <p>Analyze booking trends.</p>
                </div>
            </div>

            <div class="chart-container">
                <canvas id="adminChart"></canvas>
            </div>

            <div class="recent-activity">
                <h2>Recent Activity</h2>
                <ul>
                    <li>User "JohnDoe" booked a flight to Paris.</li>
                    <li>New user "JaneDoe" registered.</li>
                    <li>Flight #1234 was updated.</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('adminChart').getContext('2d');
        const adminChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Bookings',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
