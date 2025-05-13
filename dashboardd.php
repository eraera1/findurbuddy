<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

echo "<h2>Welcome!</h2>";
echo "<p>You are logged in as <strong>" . $_SESSION['role'] . "</strong>.</p>";

if ($_SESSION['role'] === 'admin') {
    echo "<a href='manage_animals.php'>Manage Animals</a><br>";
}
echo "<a href='adopt.php'>Adopt Pets</a><br>";
echo "<a href='logout.php'>Logout</a>";
?>
