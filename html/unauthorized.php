<?php
session_start(); // Start the session if not already started

// Optionally, you could log unauthorized access attempts here

// Set a message to inform the user
$message = "You do not have permission to access this page.";

// Optionally, you can add a link to go back or redirect after a few seconds
$redirectUrl = 'login.php'; // Change this to the page you want to redirect to
$redirectDelay = 5; // Delay in seconds
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Access Denied</h1>
    <p><?php echo $message; ?></p>
    <p>You will be redirected to the login page in <?php echo $redirectDelay; ?> seconds.</p>
</div>

<script>
    // Redirect after a delay
    setTimeout(function() {
        window.location.href = "<?php echo $redirectUrl; ?>";
    }, <?php echo $redirectDelay * 1000; ?>);
</script>

</body>
</html>
