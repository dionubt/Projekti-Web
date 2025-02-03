<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // If not an admin, redirect to login
    exit;
}

echo "<h1>Welcome to the Admin Dashboard</h1>";
// Admin-specific content goes here (e.g., user management, content moderation, etc.)
?>

<!-- Admin Dashboard HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <header class="header">
        <div class="logo">FlyHigh Admin</div>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </header>

    <div class="center-box">
        <h2>Admin Functionalities</h2>
        <p>Here you can manage users, view reports, and more.</p>
        <!-- Example of admin controls -->
        <ul>
            <li><a href="user_management.php">User Management</a></li>
            <li><a href="report_management.php">Reports</a></li>
            <!-- Add more admin actions as needed -->
        </ul>
    </div>

    <footer class="footer">
        <p>&copy; 2024 FlyHigh Tickets. All Rights Reserved.</p>
    </footer>
</body>
</html>
