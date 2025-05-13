<?php
session_start();
require_once 'db_config.php';


if ($_SESSION['role'] !== 'admin') {
    header("Location: random project.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM pets WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Pet deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
