<?php
require_once('Confiq.php');
session_start();

// Constants
$MAX_ATTEMPTS = 3; // Maximum number of failed login attempts
$LOCKOUT_DURATION = 1 * 60; // Lockout duration in seconds (15 minutes)

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <title>Digital Art Gallery - Login</title>
  <!-- <link rel="stylesheet" href="../css/login.css"> -->
  
</head>
<body>

<div>
<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

if (isset($_POST['create'])) {
    // Sanitize user input to prevent XSS and SQL injection
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    // Prepare the SQL statement to prevent SQL injection
    $select = $conn->prepare("SELECT * FROM user_profile WHERE email = ?");
    $select->bind_param("s", $email);
    $select->execute();
    $result = $select->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($row['lockout_time'] && time() < strtotime($row['lockout_time'])) {
            $remainingTime = strtotime($row['lockout_time']) - time();
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Account Locked',
                    text: 'Your account is locked. Try again in " . gmdate('H:i:s', $remainingTime) . ".',
                });
            </script>";
        } else {

            if($row['category'] == 'Admin'){
                $stmt = $conn->prepare("UPDATE user_profile SET failed_attempts = 0, lockout_time = NULL WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();

                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);
                $_SESSION['email'] = htmlspecialchars($row['email']);
                $_SESSION['category'] = htmlspecialchars($row['category']);
                header('Location: Admin/admin.php');
            }
            else{
                // Verify the password using password_verify()
                if (password_verify($password, $row['password'])) {
                    // Reset failed attempts and lockout time on successful login
                    $stmt = $conn->prepare("UPDATE user_profile SET failed_attempts = 0, lockout_time = NULL WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
    
                    // Regenerate session ID to prevent session fixation
                    session_regenerate_id(true);
    
                    // Start session and redirect based on user category
                    $_SESSION['email'] = htmlspecialchars($row['email']);
                    $_SESSION['id'] = htmlspecialchars($row['id']);
                    $_SESSION['name'] = htmlspecialchars($row['name']);
                    $_SESSION['category'] = htmlspecialchars($row['category']);
                    $_SESSION['currancy'] = htmlspecialchars($row['currancy']);
                    $_SESSION['requestedCurrency'] = htmlspecialchars($row['requestedCurrency']);
                    $_SESSION['dp'] = htmlspecialchars($row['dp']);
                    $_SESSION['address'] = htmlspecialchars($row['address']);
                    $_SESSION['contact'] = htmlspecialchars($row['contact']);
                    $_SESSION['followers'] = htmlspecialchars($row['followers']);
                    $_SESSION['description'] = htmlspecialchars($row['description']);
    
                    // Redirect based on user category
                    if ($row['category'] == 'Customer') {
                        header('Location: customerpage.php');
                    } elseif ($row['category'] == 'Artist') {
                        header('Location: Artist/artistpage.php');
                    } elseif ($row['category'] == 'Gallery') {
                        header('Location: Gallery/gallerypage.php');
                    }  // elseif ($row['category'] == 'Admin') {
                    //     header('Location: Admin/admin.php');
                    // }
                } else {
                    // Increment failed attempts and check if account should be locked
                    $failedAttempts = $row['failed_attempts'] + 1;
                    $lockoutTime = ($failedAttempts >= $MAX_ATTEMPTS) ? date('Y-m-d H:i:s', time() + $LOCKOUT_DURATION) : NULL;
    
                    $stmt = $conn->prepare("UPDATE user_profile SET failed_attempts = ?, lockout_time = ? WHERE email = ?");
                    $stmt->bind_param("iss", $failedAttempts, $lockoutTime, $email);
                    $stmt->execute();
    
                    $errorMessage = ($failedAttempts >= $MAX_ATTEMPTS) ? 'Your account is locked due to too many failed login attempts. Please try again later.' : 'Password is incorrect!';
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: '$errorMessage',
                        });
                    </script>";
                }
            }
            
            
        }
    } else {
        // User not found
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Email not found!',
                confirmButtonColor: '#d33333',
                confirmButtonText: 'Try Again'
            });
        </script>";
    }

    $select->close();
    $conn->close();
}
?>


</div>
  <div class="loginPart" >
    
    <div class="leftLogin">
        <div style="width: 70%;">
            <div class="imageDiv">
                <img src="../images/logo1.png" alt="" onclick="window.location.href='index.php'" style="cursor:pointer">
            </div>
            <h2 style="text-align: center;">Creativity takes courage</h2>
            <p>Creativity is allowing yourself to make mistakes. Art is knowing which ones to keep. <br>
                -Scott Adams</p>
            <div style="width: fit-content; margin: auto; margin-top: 50px;">
                <a href="signup.php"><button>Sign Up</button></a>
            </div>
        </div>
    </div>
    
    <div class="rightLogin">
        <h1>Sign in to Art Patio</h1>
        <!-- <p>or do it via email</p> -->
        
        <div style="width: fit-content; margin: auto;">
        <form action="" method="post">
            <span>E-mail</span><br>
            <input type="email" name="email" id="email" placeholder="@mail.com" class="input" required><br>
            <span>Password</span><br>
            <input type="password" name="password" id="password" placeholder="Password" class="input" required><br>
            <span style="color: rgb(155, 155, 155); font-size: 15px;" >Must be 8 character atleast</span><br>
            <div class="checkbox">
            <div >
                <input type="checkbox" name="" id=""> <span>Remember me</span>
            </div>
                
            <div>
                <a href="#">Forgot Password?</a>
            </div>
        </div>
            <br>      
        <button type="submit" name="create">Sign in</button>
        </form>
      
        <br>
        <!-- <span style="text-align: center; color: rgb(116, 116, 116); font-size: 15px;">@2023 All Rights Reserved</span> -->
    </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/28e6d5bc0f.js" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
</body>
</html>


<style>
    
@import url('https://fonts.googleapis.com/css2?family=Offside&display=swap');
  *{
    font-family: 'Offside', cursive;
  }

body{
    margin: 0;
    padding: 0;
    
    /* font-family: 'Ubuntu', sans-serif;
    font-family: 'Varela Round', sans-serif;
    font-family: 'Roboto', sans-serif; */
}
.loginPart{
    
    font-family: 'Offside', cursive;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
}
.leftLogin{
    background: url("../images/blackbg.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #000;
    width: 100%;
    color: white;
    height: 700px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 0px 30px 30px 0px;
    box-shadow:0 0 30px #4b4b4d;
}
.leftLogin span{
    margin: 50px 20px;
    background-color: #d3d3d3; 
    border-radius: 33px;
    padding: 10px;
    color: black;
}
.imageDiv{
    width: fit-content;
    margin: auto;
}
.leftLogin img{
    width: 350px;
}
.leftLogin button{
    border:1px solid white; 
    padding:15px 44px; 
    background-color:transparent;
    border-radius:33px; 
    color:white; 
    font-size:16px
}
.leftLogin button:hover{
    background-color: white;
    color: black;
    cursor: pointer;
}
.rightLogin{
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
}
.rightLogin h1,p{
    text-align: center;
}
.input {
    padding: 10px;
    width: 400px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; 
    font-size: 16px;
    margin: 10px 0;
  }
  
  .input:focus {
    border-color: #007bff;
    outline: none;
  }
  .rightLogin button{
    text-align: center;
    display: inline-block;
    width: 400px;
    padding: 10px 20px;
    background-color: #000;
    color: #fff;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    margin: 50px 0;
    border: none;
  }
  .rightLogin button:hover {
    background-color: #fff;
    color: #000;
    border: 1px solid black;
  }
  
  .rightLogin button:active {
    background-color: #1c2a29;
  }
  .checkbox{
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
  
</style>