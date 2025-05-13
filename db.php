<?php

require_once 'db_config.php';


try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE status = 'active'");
    $stmt->execute();

   
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        echo "User ID: " . $user['id'] . "<br>";
        echo "Name: " . $user['name'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Role: " . $user['role'] . "<br><br>";
    }

} catch (PDOException $e) {
   
    echo "Error: " . $e->getMessage();
}
?>
