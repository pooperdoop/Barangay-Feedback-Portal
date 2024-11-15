<?php

include("all_usersdb.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Barangay Feedback Portal</title>
    <link rel="stylesheet" href="register_official_style.css?v=<?php echo time(); ?>"/>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" />
  </head>
  <body>
        <div class="rectangle">
        <div class="logo">
          <div class="vector-icon"></div>
          <span class="feedback-portal">Barangay Feedback Portal</span>
        </div>


        <a href ="login-and-register.php"  class="return">Return</a>

  <form action="register-official.php" method="post">
        <div class="group-4">
          <span class="middle-name">Middle Name</span>
          <input name = "middle_name"type="text" class="group-input-c" placeholder="Fernandez" style="transform: translatey(20px);"/>
        </div>


        <div class="group-7">
          <div class="mask-group"></div>
          <div class="group-8">
            <div class="pencil-alt"><div class="vector"></div></div>
            <div class="ellipse"></div>
          </div>
        </div>

        <div class="group-1">
          <span class="first-name">First Name</span>
            <input type="text" name = "first_name" class="group-input-c" placeholder="Charlene" style="transform: translatey(20px);"/>
        </div>


        <div class="group-9">
          <span class="last-name">Last Name</span>
            <input type="text" name = "last_name" class="group-input-c" placeholder="De Leon" style="transform: translatey(20px);" />
        </div>


        <div class="group-d">
          <span class="date-of-birth">Date of Birth</span>
          <input name = "birthday" type="date" class="group-input-c" placeholder="Charlene" style="transform: translatey(20px);"/>
        </div>


        <div class="group-10">
          <button class="button">Attach Valid ID</button>
            <button class="group-12">Register as an Official </button>
        </div>


        <div class="group-14">
          <span class="full-address">Full Address</span>
          <input type="text" name="full_address" class="group-input-c" placeholder="Mangga 2 Matatalaib Tarlac City" style="transform: translatey(20px);" />
        </div>


        <div class="group-17">
          <span class="barangay">Barangay</span>
          <input type="text" name="barangay" class="group-input-c" placeholder="Matatalaib" style="transform: translatey(20px);" />
        </div>


        <div class="group-1b">
          <span class="email">Email</span>
            <input type="text" name="email" class="group-input-c" placeholder="asdasd@gmail.com" style="transform: translatey(20px);" />
        </div>


        <div class="group-20">
          <span class="sex">Sex</span>
          <select name="sex_choice" style="border: none; transform: translatey(20px); width:100%">
                <option value="Female">Female</option>
                <option value="Male">Male</option>
                <option value="Other">Other</option>
          </select>
        </div>


        <div class="group-23">
          <span class="username">Username</span>
          <input type="text" name="username" class="group-input-c" placeholder="CHFerde" style="transform: translatey(20px);"/>
        </div>


        <div class="group-27">
          <span class="password">Password</span>
          <input type="password" name="password" class="group-input-c" placeholder="**********" style="transform: translatey(20px);" /> 
        </div>


        <div class="group-2b">
          <span class="phone-number">Phone Number</span>
          <input type="text" name="phone_number" class="group-input-c" placeholder="0239203902" style="transform: translatey(20px);" /> 
        </div>


        <div class="group-2f">
          <span class="barangay-position">Barangay Position</span>
          <input type="text" name="position" class="group-input-c" placeholder="Captain" style="transform: translatey(20px);" /> 
      </div>
      </form>
    </div>
    
  </body>
</html>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $firstname = $_POST["first_name"];
  $middlename = $_POST["middle_name"];
  $lastname = $_POST["last_name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $position = $_POST["position"];
  $phonenumber = $_POST["phone_number"];
  $username = $_POST["username"];
  $fulladdress = $_POST["full_address"];
  $barangay = $_POST["barangay"];
  $sex = $_POST["sex_choice"];
  $birthday = $_POST["birthday"];

  if(empty($firstname) || empty($middlename) ||  empty($lastname) ||  empty($email) || empty($password) || empty($position) || empty($phonenumber) || empty($username) || empty($fulladdress) || empty($barangay) || empty($sex) || empty($birthday) ){

    echo '<script>alert("enter all fields") </script>';
  }
else{
  $sql = "INSERT INTO all_users(username, email, password, first_name, middle_name, last_name, birthday, full_address, type, position, barangay, sex, phonenumber) 
                      VALUE ('$username', '$email', '$password', '$firstname', '$middlename', '$lastname', '$birthday', '$fulladdress', 'Official', '$position', '$barangay', '$sex', 
                      '$phonenumber')";
 mysqli_query($con, $sql);
  //ayaw ng header find fix
  die;
                   

}
}
?>