<?php

@include 'Confiq.php';

// Start the session (if it's not already started)
session_start();
// Regenerate session ID to prevent session fixation attacks
if (session_status() == PHP_SESSION_ACTIVE) {
    session_regenerate_id(true); // Regenerate session ID and delete the old one
}
// Unset all session variables
session_unset();
// Destroy the session
session_destroy();
// Clear the session cookie to ensure the session is fully terminated on the client-side
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
// Redirect to the login page after logging out
header('Location: login.php');
exit();

?>
