<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.html"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - FindUrBuddy</title>
    <link rel="stylesheet" href="styleus.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Welcome, <?= $_SESSION['user_name']; ?>!</h1>
            <p>Your user dashboard is ready. Here you can view your profile, manage pets, and more!</p>
        </header>
        
        <div class="user-controls">
            <a href="view_profile.php" class="btn">View Profile</a>
            <a href="pets.php" class="btn">View Pets</a>
            <a href="logout.php" class="btn logout">Logout</a>
        </div>

        <?php
        if ($_SESSION['role'] !== 'admin') {
            echo '<div class="admin-request">
                    <p>If you would like to be considered for admin access, please click below:</p>
                    <a href="request_admin.php" class="btn request-admin">Request Admin Access</a>
                  </div>';
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2025 FindUrBuddy - All Rights Reserved</p>
    </footer>
</body>
</html>

