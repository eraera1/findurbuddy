<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}

$result = $conn->query("SELECT id, name, email, role, status, last_login FROM users");

if ($result->num_rows > 0) {
    echo "<h2>User Management</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Last Login</th><th>Action</th></tr>";

    while ($user = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $user['name'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
        echo "<td>" . $user['role'] . "</td>";
        echo "<td>" . $user['status'] . "</td>";
        echo "<td>" . $user['last_login'] . "</td>";
        echo "<td>";
        
        if ($user['role'] !== 'admin') {
            echo "<a href='assign_role.php?id=" . $user['id'] . "&role=admin'>Make Admin</a>";
        } else {
            echo "Already Admin";
        }

        echo "</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p>No users found</p>";
}
?>
