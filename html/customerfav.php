<?php
     require_once ('Confiq.php');
     session_start();
     if(!isset($_SESSION['id'])){
      header("Location:login.php");
      exit();
  }
     $sql11= "SELECT * FROM user_profile WHERE id=".$_SESSION['id'];
     $result11= mysqli_query($conn,$sql11);
     $row11= mysqli_fetch_assoc($result11);
     $currancy= $row11['currancy'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/28e6d5bc0f.js" crossorigin="anonymous"></script>
  <title>Customer Favourite</title>
</head>
<body>
   <!-- Starts Nav code -->
   <nav>
    <div class="nav">
      <div class="left">
      <a href="index4.php"> <img src="6.png" alt=""></a>
            <span onclick="window.location.href='customerPage.php'">Home</span>
            <span onclick="window.location.href='art.php'">Arts</span>
            <span onclick="window.location.href='Artists.php'">Artists</span>
            <span onclick="window.location.href='gallery.php'">Gallery</span>
            <span onclick="window.location.href='event.php'">Events</span>
            <span onclick="window.location.href='ongoinevent.php'">On Going Events</span>
            <!-- <span>Higher Designers</span> -->
        </div>
        <div class="right">
          
            <!-- <div class="search-area">
                <span class="search-icon" style="padding-top: 5px;"><i class="fas fa-search" style="color: #b1b1b1;"></i></span>
                <input type="search" name="" id="" placeholder="Search">
            </div> -->
            <a href="addFunds.php"  style="text-decoration:none;"><span>$<?php echo $currancy ?></span></a>
            <div style="position: relative;">
                <img src="userDP/<?php echo $_SESSION['dp'] ?> " alt="" onclick=showDropdown()>
                <div id="myDropdown" class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <a href="customerfav.php">Favoutites</a>
                    <a href="purchasedarts.php">Purchased Items</a>
                    <a href="purchasedtickets.php">Purchased Tickets</a>
                    <a href="logout.php" style="color:tomato;">Logout</a>
                </div>
            </div>
            
            <!-- <span>Sign in</span>
            <button>Sign up</button> -->
        </div>
    </div>
    <!-- <hr style="position: relative; margin: 0; color: rgb(238, 235, 235)"> -->
</nav>

<main class="" >

        <div>
            <h1><?php echo $_SESSION['name'] ?>'s Favourite Section</h1>
            
        </div>
        <hr>

</main>




  <div class="container">
   
  <?php
     
         $query1="SELECT * FROM favourite WHERE user_id={$_SESSION['id']}";
         $result1=mysqli_query($conn,$query1);
         if($result1){
            
           while ($row = mysqli_fetch_array($result1)) {
            $artid=$row['art_id'];
         
         $query="SELECT * FROM arts where artID=$artid";
         $result = mysqli_query($conn, $query);
         $check_images= mysqli_num_rows($result);
          if($check_images>0){
            $row=mysqli_fetch_array($result)

           ?>   
              <div class="card">
              <img src="arts/<?php echo $row['img'];?>"width="260px" height="200px" class="card-img-top" alt="">
              <div class="overlay">
                <h1><?php echo $row['title']?></h1>
                <p>$<?php echo $row['price']?></p>
                <p><?php echo $row['description'];?></p>
                <div style="width: fit-content; margin: auto">
                <a href="art_detail.php? artID=<?php echo $row['artID']  ?>" style="text-decoration:none;"><button>Art Details</button></a>
                </div>
            </div>
          </div>
    <?php
          }
            

          }
        }
          else{
            echo "No image found";
          }
        
        ?>
   
    
   
    
  </div>



  <footer>
        <div class="logo">
            <img src="../images/logo1.png" alt="" class="logoPic">
            <span>Dribbble is the world’s leading community for creatives to share, grow, and get hired. </span>
            <div style="display: flex; flex-direction:column; gap:10px; align-items:center;">
                <div>
                    <h2 style="margin:0; color:white; font-size:17px">Connected Us With</h2>
                </div>
                <div style="display: flex; gap: 20px; align-items: center;">
                    <a href="facebook.com"><img src="../images/facebook-f.svg" alt="" style="width: 8px; background-color: white; padding:8px 12px;"></a> 
                    <img src="../images/linkedin-in.svg" alt="" >
                    <img src="../images/google.svg" alt="">
                    <img src="../images/linkedin-in.svg" alt="" >
                </div>
            </div>
        </div>
        
    </footer>




</body>
</html>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:ital@0;1&family=Ubuntu:ital@0;1&family=Varela+Round&display=swap');
  body{
    margin: 0;
    padding: 0;
    font-family: 'Offside', cursive;
    background-color: #f2efef;
    position: relative;
  }

  
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





    main{
        margin: 40px 0 60px;
        /* background-color: white; */
    }

    main div{
      width: 80%;
      margin: auto;
    }
    main div h1{
      text-align: center;
      font-size: 28px;
      color: #444;
    }



  .container{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 30px;
    width: 90%;
    margin: auto;
    background-color: white;
    padding: 50px 70px;
  }
  .card{
    position: relative;
    width: 90%;
    cursor: pointer;
    height: 400px;
    

  }
  .card img{
    display: block;
    width: 100%;
    height: 100%;
    border-radius: 10px;
    box-shadow:0 0 15px #1e1d1d;
  }
  .overlay{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, .75);
    overflow: hidden;
    width: 100%;
    height: 0;
    transition: .5s ease;
  }
  .card:hover .overlay{
    height: 100%;
  }
  .card h1{
    width: 100%;
    color: white;
    font-size: 2vw;
    position: absolute;
    text-align: center;

  }
  .card p{
    text-align: center;
    color: white;
    font-size: 1.2vw;
    margin-top: 20%;
    margin-bottom: 10%;
    width: 100%;
    letter-spacing: 2px;
    line-height: 1.5em;
  }
  .card button{
        border: none;
        padding: 10px 40px;
        border-radius: 10px;
        color: #000;
        cursor: pointer;
        font-size: 1rem;
        background-color: #fff;
        display: flex;
        justify-content: center;
    }
    .card button:hover{
      background-color: #000;
      color: white;
    }




    footer{
        background-color: #000;
        padding: 20px 0;
        display: flex;
        gap: 50px;
        width: 100%;
        justify-content: center;
        bottom: 0;
        margin-top: 60px;
        
    }
    footer .logo{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 80%;
        gap: 20px;
        margin-left: 20px;
    }
    footer .logoPic{
        width: 200px;
        cursor: pointer;
    }
    footer .logo div img{
        width: 10px;
        cursor: pointer;
        background-color: white; 
        padding:8px 12px;
        border-radius: 12px;
    }
    footer .logo span{
        color: rgb(222, 219, 219);
        margin-bottom: 10px;
    }
    
</style>


<script>

function showDropdown() {
        var dropdown = document.getElementById("myDropdown");
        if (dropdown.style.display === "flex") {
            dropdown.style.display = "none";
        } 
        else {
            dropdown.style.display = "flex";
            dropdown.style.flexDirection = "column";
            dropdown.style.gap = "0px";
        }
    }

</script>