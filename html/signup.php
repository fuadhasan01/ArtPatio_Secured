<?php
require_once ('Confiq.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Create an Account</title>
</head>
<body>
<div>
<?php


// Function to sanitize input to prevent XSS and HTML Injection
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}


// Function to validate password strength
function validatePasswordStrength($password) {
    $errors = [];

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
        return $errors;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter.";
        return $errors;
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least one lowercase letter.";
        return $errors;
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one number.";
        return $errors;
    }

    if (!preg_match('/[\W]/', $password)) {
        $errors[] = "Password must contain at least one special character (e.g., @, #, $, etc.).";
        return $errors;
    }

    return $errors;
    
}

if(isset($_POST['create'])){

    //Upload File
    $filename = $_FILES["image-upload"]["name"];         
    $tmp_name = $_FILES["image-upload"]["tmp_name"];
    $img_ex = pathinfo($filename, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");
    if(in_array($img_ex_lc, $allowed_exs)){
        if ($_FILES['image-upload']['size'] < 2 * 1024 * 1024) {
            $unique_filename = uniqid() . '-' . basename(sanitizeInput($filename));
            $folder = "userDP/" . $unique_filename;
            move_uploaded_file($tmp_name, $folder); 

            // Sanitize input fields to prevent XSS and HTML Injection
            $name = sanitizeInput($_POST['name']);
            $email = sanitizeInput($_POST['email']);
            $password = sanitizeInput($_POST['password']);
            $cpassword = sanitizeInput($_POST['cpassword']);
            $address = sanitizeInput($_POST['address']);
            $contact = sanitizeInput($_POST['contact']);
            $user_type = sanitizeInput($_POST['user_type']);
            $description = sanitizeInput($_POST['description']);

            // Prepare SQL query to prevent SQL Injection
            $stmt = $conn->prepare("SELECT * FROM user_profile WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Email already exists!',
                    });
                </script>";
            } else {
                // Validate password strength
                $passwordErrors = validatePasswordStrength($password);
                if (!empty($passwordErrors)) {
                    foreach ($passwordErrors as $error) {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Weak Password',
                                text: '$error',
                            });
                        </script>";
                    }
                } else {
                    if ($password != $cpassword) {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Passwords do not match!',
                            });
                        </script>";
                    } else {

                        // Hash the password securely
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Use prepared statement to insert data and prevent SQL Injection
                        $stmt = $conn->prepare("INSERT INTO user_profile (name, email, password, address, category, dp, contact, description) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssssss", $name, $email, $hashed_password, $address, $user_type, $unique_filename, $contact, $description);

                        if ($stmt->execute()) {
                            echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Successfully signed up!',
                                    showCancelButton: false,
                                    confirmButtonText: 'Go to login',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'login.php';
                                    }
                                });
                            </script>";
                            exit;
                        } else {
                            echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                });
                            </script>";
                        }
                    }
                }
            }
        }
        else{
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'File size should be less than 2MB!',
            });
        </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid File Type',
                text: 'Only JPG, JPEG, and PNG files are allowed!',
            });
        </script>";
    }
}
?>

</div>
<form action="signup.php" method="post" class="container" enctype="multipart/form-data">
        <div class="left">
                    <img src="../images/logo1.png" alt=""  onclick="window.location.href='index.php'" style="cursor:pointer;">
                    <h1>Welcome to Art Patio!</h1>
                    <p>Already have an account?</p>
                    <a href="login.php">Sign in</a>
            
        </div>
        <div class="right">
            <h1>Create Account</h1>
            <div class="image">
                <img src="../images/facebook-f.svg" alt="">
                <img src="../images/google.svg" alt="">
                <img src="../images/linkedin-in.svg" alt="">
            </div>
         
            
            <input type="text" name="name"placeholder="Name" required>
            <input type="email" name="email"placeholder="Email" required>
            <input type="password" name="password"placeholder="Password"  required>
            <small style="color: gray;">Your password should be at least 8 characters long, include an uppercase letter, a number, and a special character (e.g., @, #, $).</small>
            <input type="password" name="cpassword"placeholder="Confirm password" required>
            <input type="text" name="address" placeholder="Address"required>
            <input type="text" name="contact" placeholder="Contact"required>
            <!-- <input type="text" name="description" placeholder="description (180 words)"required> -->
            <textarea name="description" id="" cols="60" rows="5" placeholder="description" ></textarea>
            

            <input type="file" id="image-upload" name="image-upload" required>
            

            <select name="user_type" style="   padding: 10px; width: 400px; border: 0px solid #ccc; box-sizing: border-box; font-size: 16px; margin: 10px 0; background-color: #e5f3f3;" >
            <option value="Customer">Customer</option>
             <option value="Artist">Artist</option>
             <option value="Gallery">Gallery</option>
            </select>
            <button type="submit" name="create">Sign Up</button>
           
         
        </div>
</form>
    <script src="https://kit.fontawesome.com/28e6d5bc0f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            const password = form.querySelector('[name="password"]').value;
            const confirmPassword = form.querySelector('[name="cpassword"]').value;

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'The password is not matched!',
                });

                event.preventDefault(); // Prevent the form from submitting
            }
        });
    });
</script>






<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital@0;1&family=Ubuntu:ital@0;1&family=Varela+Round&display=swap');
body{
    margin: 0;
    padding: 0;
}
.container{
    width: 100%;
    display: flex;
}
.container .left{
    font-family: 'Offside', cursive;
    background-image: url("../images/blackbg.jpg");
    background-size: cover;
    background-color: black;
    color: white;
    width: 42%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 0px 30px 30px 0px;
    box-shadow:0 0 30px #4b4b4d;
}
.left img{
    width: 340px;
    display: flex;
    
}
.container .left p{
    width: 70%;
    margin-top: 0;
    text-align: center;
}
.container .left h1{
    font-size: 35px;
}
.container .left a{
    text-decoration:none;
    background-color: transparent;
    background-repeat: no-repeat;
    border: 1px solid white;
    padding: 13px 50px;
    border-radius: 33px;
    cursor: pointer;
    color: white;
    margin-top: 20px;
    overflow: hidden;
    outline: none;
}
.left a:hover {
    background-color: white;
    color: black;
}
.container .right{
    width: 58%;
    font-family: 'Roboto', sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.container .right small{
    width: 400px;
}
input {
    padding: 10px;
    width: 400px;
    border: 0px solid #ccc;
    box-sizing: border-box; 
    font-size: 16px;
    margin: 10px 0;
    background-color: #e5f3f3;

  }
  
  .right .image{
    display: flex;
    gap: 10px;

  }
  .right .image img:nth-of-type(1){
    width: 10px;
    border: 1px solid gray;
    padding: 8px 10px;
    border-radius: 80%;
  }
  .right .image img:nth-of-type(1):hover{
    background-color: #5f9393;
  }
  .right .image img:nth-of-type(2){
    width: 15px;
    border: 1px solid gray;
    padding: 8.2px 8px;
    border-radius:90%;
  }
  .right .image img:nth-of-type(2):hover{
    background-color: #5f9393;
  }
  .right .image img:nth-of-type(3){
    width: 15px;
    border: 1px solid gray;
    padding: 8px 8px;
    border-radius: 80%;
  }
  .right .image img:nth-of-type(3):hover{
    background-color: #5f9393;
  }
  .right h1{
    color: #264747;
  }
  .right p{
    color: rgb(122, 121, 121);
    margin-top: 30px;
    font-size: 15px;
  }
  .right button {
    background-color: #000;
    background-repeat: no-repeat;
    border: 1px solid white;
    padding: 13px 50px;
    border-radius: 33px;
    cursor: pointer;
    color: white;
    margin-top: 20px;
    overflow: hidden;
    outline: none;
    border: none;
}
.right button:hover{
    background-color: #fff;
    border: 1px solid black;
    color: black;
}
select{
  padding: 10px;
  width: 400px;
  border: 0px solid #ccc;
  box-sizing: border-box; 
  font-size: 16px;
  margin: 10px 0;
  background-color: #e5f3f3;
}
/* .right a:hover{
  color: black;
  background-color: white;
} */

</style>