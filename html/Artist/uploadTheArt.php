<?php
require_once ('Confiq.php');
require_once ('ErrorLogger.php'); // Include the error logger
include '../utils.php';

session_start();
if(!isset($_SESSION['id'])){
    header("Location:../login.php");
    exit();
}

$logger = new ErrorLogger(); // Create an instance of the ErrorLogger class

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <title>Upload The Art</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<nav>
    <div class="nav">
        <div class="left">
        <a href="../index2.php"> <img src="logo1.png" alt=""></a>
            <span onclick="window.location.href='artistpage.php'">Home</span>
            <span onclick="window.location.href='art.php'">Arts</span>
            <span onclick="window.location.href='Artists.php'">Artists</span>
            <span onclick="window.location.href='gallery.php'">Gallery</span>
            <span onclick="window.location.href='event.php'">Events</span>
            <span onclick="window.location.href='ongoinevent.php'">On Going Events</span>
        </div>
        <div class="right">
            <a href="addFunds.php"  style="text-decoration:none;"><span>$<?php echo $_SESSION['currancy'] ?></span></a>
            <div style="position: relative;">
            <img src="../userDP/<?php echo $_SESSION['dp'] ?>" alt="" onclick=showDropdown()>
                <div id="myDropdown" class="dropdown-content">
                <a href="artistprofile.php">Profile</a>
                    <a href="artistrfav.php">Favourite</a>
                    <a href="purchasedarts.php">Purchased Arts</a>
                    <a href="purchasedtickets.php">Purchased Tickets</a>
                    <a href="uploadTheArt.php">Upload Arts</a>
                    <a href="withdraw1.php">Withdraw Coin</a>
                    <a href="../logout.php" style="color:tomato;">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- File Upload PHP Code -->
<?php
if ($_SESSION['email'] == FALSE) {
    header("Location: login.php");
}

$ownerID = $_SESSION['id'];
if (isset($_POST['create'])) {
    $filename = $_FILES["image-upload"]["name"];
    $temp_name = $_FILES["image-upload"]["tmp_name"];
    $img_ex = pathinfo($filename, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);


    $allowed_exs = array("jpg", "jpeg", "png");
    $max_file_size = 2 * 1024 * 1024; // 2MB

    if ($_FILES["image-upload"]["size"] > $max_file_size) {
        $errorMessage = "File size exceeds 2MB limit.";
        $logger->logError($errorMessage); // Log the error
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'File size exceeds 2MB limit.',
            });
        </script>";

    } else if (in_array($img_ex_lc, $allowed_exs)) {
        // Validate MIME type
        $mimeType = mime_content_type($temp_name);
        if (!in_array($mimeType, ['image/jpeg', 'image/png'])) {
            // Invalid MIME type, handle error
            $errorMessage = "Invalid file type. Only JPG and PNG files are allowed.";
            $logger->logError($errorMessage);
            // Show error message
        }
        else{
          $unique_filename = uniqid() . '-' . basename($filename);
          $folder = "../arts/" . $unique_filename;
          move_uploaded_file($temp_name, $folder);
          $title = $_POST['title'];
          $type = $_POST['type'];
          $material = $_POST['material'];
          $price = $_POST['price'];
          $initialbid = $_POST['initialbid'];
          $bidamount = $_POST['bidamount'];
          $description = $_POST['description'];
          $height = $_POST['height'];
          $width = $_POST['width'];
          $approval = 0;
          $status = "Available";
          $sql = "INSERT INTO arts (user_id, title, type, material, price, initalbid, description, img, approval, status, height, width, bid_amount)
                  VALUES ('$ownerID', '$title', '$type', '$material', '$price', '$initialbid', '$description', '$unique_filename', '$approval', '$status', '$height', '$width', '$bidamount')";

          $result = mysqli_query($conn, $sql);
          if ($result) {
              // Log successful upload
              logAudit($ownerID, "Upload Art", "Successfully uploaded art: $title");
              header("Location: artistpage.php");
          } 
          
          else {
              $errorMessage = "Failed to upload the artwork.";
              $logger->logError($errorMessage); // Log the error
              echo "<script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'Failed to upload the artwork.',
                  });
              </script>";
          }
        }
        
    } else {
      $errorMessage = "Failed to move uploaded file.";
      $logger->logError($errorMessage); // Log the error
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'You cannot upload files of this type.',
            });
        </script>";
    }
}

?>

<form action="uploadTheArt.php" method="post" style="width: 80%; margin:30px auto; background-color: #EFEAEA; padding: 15px;" enctype="multipart/form-data">
    <div class="uploadField">
        <div class="uploadArt">
            <div style="width: fit-content; margin: auto;">
                <img src="../../images/upload.png" alt="" id="uploaded-image" style="border: none; border-radius:0">
            </div>
            <div>
                <label for="image-upload" class="upload">Upload Art</label>
                <input type="file" id="image-upload" name="image-upload" required>
            </div>
        </div>
        <div class="artDetail">
            <table>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" required></td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td><input type="text" name="type" required></td>
                </tr>
                <tr>
                    <td>Material:</td>
                    <td>
                        <select name="material" required>
                            <option value="Pencil">Pencil</option>
                            <option value="Oil">Oil</option>
                            <option value="Watercolor">Watercolor</option>
                            <option value="Acrylic">Acrylic</option>
                            <option value="Pastel">Pastel</option>
                            <option value="Charcoal">Charcoal</option>
                            <option value="Ink">Ink</option>
                            <option value="Enamel">Enamel</option>
                            <option value="Spray Paint">Spray Paint</option>
                            <option value="Tempera">Tempera</option>
                            <option value="Digital">Digital</option>
                            <option value="Mixed Media">Mixed Media</option>
                            <option value="Charcoal">Charcoal</option>
                            <option value="Crayon">Crayon</option>
                            <option value="Other">Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" name="price" required></td>
                </tr>
                <tr>
                    <td>Initial Bid:</td>
                    <td><input type="text" name="initialbid" required></td>
                </tr>
                <tr>
                    <td>Bid Amount:</td>
                    <td><input type="text" name="bidamount" required></td>
                </tr>
                <tr>
                    <td>Height:</td>
                    <td><input type="text" name="height" required></td>
                </tr>
                <tr>
                    <td>Width:</td>
                    <td><input type="text" name="width" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="description" cols="30" rows="10" style="width: 100%; border: none; background-color: #D9D9D9; font-size: 15px;" placeholder="Short Description Of Art (200 Words max)" required></textarea>
                    </td>
                </tr>
            </table>
            <button type="submit" name="create" class="post">Post</button>
        </div>
    </div>
</form>



<?php include '../footer.php'; ?>

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
    background-color: #f2efef;
    position: relative;
  }

  
    /* Starts Nav Code */

    .nav{
        width: 100%;
        height: 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #000;
        box-shadow:0 0 15px #a5a5a5;
        
    }
    nav .left, .right{
        display: flex;
        gap: 18px;
        align-items: center;
        margin-right: 15px;
    }
    .right{
      margin-right: 60px;
    }
    nav .left img{
        width: 200px;
    }
    nav .right img{
        width: 35px;
        height: 35px;
        cursor: pointer;
        border-radius: 50px;
    }
    nav .left span, .right span{
        color: rgb(237, 234, 234);
        cursor: pointer;
        font-weight: 600;
        padding: 0 20px;
    }
    nav .left span:hover, .right span:hover{
        color: white;
        text-decoration:underline;
    }
    nav .right .search-area{
        display: flex;
        align-items: center;
        position: relative;
    }
    nav .right .search-area span{
        position: absolute;
        left: .8rem;
    }
    nav .right .search-area input{
        padding: 12px;
        padding-left: 40px;
        width: 15vw;
        border: none;
        border-radius: 10px;
        background-color: #f2efef;
        font-size: 17px;
    }
    nav .right .search-area input:hover{
        background-color: #fff;
        border: 4px solid rgba(248, 178, 166, 0.2);
    }
    nav .right button{
        border: none;
        padding: 10px 22px;
        border-radius: 10px;
        background-color: white;
        color: #5FB090;
        font-size: 1rem;
        cursor: pointer;
    }
    nav .right button:hover{
        background-color: #5FB090;
        color: white;
        border: 2px solid black;
        margin: 0;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 52px;
        left: -50px;
        z-index: 1;
        width: fit-content;
        background-color: black;
    }

    .dropdown-content a{
        color: white;
        text-decoration: none;
        width: 100%;
        padding: 10px 20px;
        margin: 0px 0;
        background-color: black;
    }
    .dropdown-content a:hover{
        background-color: white;
        color: black;
    }

    /* Ends Nav code */



.uploadField{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.uploadArt{
    width: 50%;
    display: flex;
    flex-direction: column;
    margin-left: 20px;
}
#uploaded-image{
    width: 100%;
    height: 400px;
    margin: auto;
}
form div{
    width: fit-content;
    margin: auto;
}
input[type="file"] {
    display: none;
  }
  
.upload {
    display: inline-block;
    padding: 10px;
    background-color: #000;
    border-radius: 10px;
    margin: auto;
    color: white;
    cursor: pointer;
  }
  .post{
    display: inline-block;
    padding: 10px 30px;
    border: none;
    background-color: #000;
    border-radius: 10px;
    margin: 20px auto;
    color: white;
    cursor: pointer;
  }
  
  .upload:hover , .post:hover{
    background-color: #fff;
    color: black;
  }
  
  input[type="file"]:focus + .upload {
    outline: 1px dotted #000;
    outline: -webkit-focus-ring-color auto 5px;     
  }
  
  input[type="file"]:valid + .upload {
    background-color: #5cb85c;
    color: #fff;
  }
.artDetail{
    width: 50%;
}
table {
    border-collapse: collapse;
    width: 50%;
    margin: auto;
  }
  td{
    font-size: 20px;
    font-weight: bold;
    padding-right: 10px;
  }
   th {
    border: none;
    text-align: center;
  }
  
  input{
    padding: 10px;
    width: 300px;
    background-color: #D9D9D9;
    border: none;
    height: 30px;
    border-radius: 20px;
    margin: 10px 0;
  }
  select{
    padding: 25px;
    width: 320px;
    background-color: #D9D9D9;
    border: none;
    height: 30px;
    border-radius: 20px;
    margin: 10px 0;
  }
  
</style>
<script>
function showDropdown() {
    var dropdown = document.getElementById("myDropdown");
    dropdown.style.display = (dropdown.style.display === "flex") ? "none" : "flex";
    dropdown.style.flexDirection = "column";
    dropdown.style.gap = "0px";
}

const input = document.querySelector('#image-upload');
const image = document.querySelector('#uploaded-image');

input.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener('load', function() {
            image.setAttribute('src', reader.result);
        });
        reader.readAsDataURL(file);
    }
});
</script>