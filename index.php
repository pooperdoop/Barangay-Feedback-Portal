<!DOCTYPE html> 
<html lang="en">
  <head>
    <title>Barangay Feedback Portal</title>
    <link rel="stylesheet" href="login_register.css?v=<?php echo time(); ?>">

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" />
  </head>
  <body>

    <div class="main-container">

      <div class="group">
        <div class="logo">
          <span class="barangay-feedback-portal"
            >Barangay<br />Feedback<br />Portal</span
          >
          <div class="iconfinder-vector"></div>
        </div>

      <form action="index.php" method="post">

            <div class="group-1">
              <span class="username_lbl"><b>User Name</b></span>
              <input type = "text"class="username_input" name = "username_input" placeholder="Enter Username" required/>
            </div>

            <div class="group-3">
              <span class="password_lbl"><b>Password</b></span>
              <input type = "password" class="password_input" name ="password_input" placeholder="*********" required/>
            </div>

            <input type="submit" class="login_btn" value="Log In" >

      </form>

        <div class="rectangle-8">
          
        </div>
  
        <button onclick="gotoRegisterUser()" class="register"><b>Register</b></button>
        <button onclick="gotoRegisterOfficial()" class="register-officialbtn"><b>Register as an Official</b></button>

      </div>

      <div class="rectangle-e"></div>

    </div>

  </body>
</html>

<script>

function gotoRegisterUser(){
  location.replace("register-page.php");
}

function gotoRegisterOfficial(){
  location.replace("register-official.php");
}
</script>

<?php
include("all_usersdb.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username_input"];
    $password = $_POST["password_input"];

    if(empty($username) || empty($password)){
        echo '<script>alert("enter all fields") </script>';
    } 
    else{
        $sql = "SELECT * FROM all_users WHERE username ='$username'";

        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){

          $user_data = mysqli_fetch_assoc($result);

            if($user_data['password'] == $password){
              $_SESSION['id'] = $user_data['id'];
              if($user_data['type'] == "Official"){
              if($user_data['verified'] == "yes" ){
              header('Location: homeadmin.php');}
              else{
                echo"<script>alert('Account not verified, wait for verification!')</script>";
              }
            } else{
              header('Location: homeadmin.php');}
            
         
            }
            else{
              echo'<script>alert("incorrect password") </script>';
          }
        }
        else{
            echo'<script>alert("acc does not exist") </script>';
        }
    }
}
?>