<?php

function logAudit($userId, $action, $description) {
    global $conn; // Use your database connection variable
    $stmt = $conn->prepare("INSERT INTO audit_logs (user_id, action, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $action, $description);
    $stmt->execute();
}

?>
