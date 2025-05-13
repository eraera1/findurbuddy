<?php
session_start();

if (isset($_SESSION['user_id'])) {
    require_once 'db_config.php';

    try {
        $stmt = $conn->prepare("UPDATE users SET status = 'inactive' WHERE id = :id");
        $stmt->execute([':id' => $_SESSION['user_id']]);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }

    session_unset();
    session_destroy();

    header("Location: loginn.php");
    exit();
} else {
    header("Location: loginn.php");
    exit();
}
?>
