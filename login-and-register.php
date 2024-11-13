<?php

include("all_usersdb.php");
?>

<!DOCTYPE html> 
<html lang="en">
  <head>
    <title>Barangay Feedback Portal</title>
    <link rel="stylesheet" href="login_register.css">

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

      <form action="login-and-register.php" method="post">
        <div class="group-1">
          <span class="username_lbl">User Name</span>
            <input type = "text"class="username_input" name = "username_input" placeholder="Charlene Reed"/>
        </div>


        <div class="group-3">
          <span class="password_lbl">Password</span>
            <input type = "password" class="password_input" name ="password_input" placeholder="*********"/>
        </div>


        <button class="login_btn">Log In</span></button>


        <div class="rectangle-8"></div>
  
            <button class="register">Register</button>


        <button class="register-officialbtn">Register as an Official </button>
      </form>
      </div>

      <div class="rectangle-e"></div>

    </div>

  </body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username_input"];
    $password = $_POST["password_input"];

    if(empty($username) || empty($password)){
        echo "enter all fields";
    } 
    else{
        $sql = "SELECT * FROM all_users WHERE username ='$username'";

        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){
            echo "you son of a bitch";
            header('Location: usersdb.php');
            die;
        }
        else{
            echo"doesnt exist";
        }
    }
}
?>
