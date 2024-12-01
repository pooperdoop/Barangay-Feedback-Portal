<?php
include("all_usersdb.php");
include("functions.php");

if (isset($_POST["register_button"])){

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

    if (file_exists($_FILES['submit_id']['tmp_name']) || is_uploaded_file($_FILES['submit_id']['tmp_name'])) {    
    $img = $_FILES['submit_id'];
    $imgsplit = explode('.',$img['name']);
    $imgext = strtolower(end($imgsplit));


    if(empty($firstname) || empty($middlename) ||  empty($lastname) ||  empty($email) || empty($password) || empty($position) || 
    empty($phonenumber) || empty($username) || empty($fulladdress) || empty($barangay) || empty($sex) || empty($birthday) ){
      echo '<script>alert("enter all fields")</script>';  
    }
  else{

    
    $checkEmail = "SELECT * FROM all_users WHERE email = '$email'";
    $result = mysqli_query($con, $checkEmail);

    if(mysqli_num_rows($result)>0){
    
      echo '<script>alert("User Email Already Taken!")</script>';  

    }
    else{
    $sql = "INSERT INTO all_users(username, email, password, first_name, middle_name, last_name, birthday, full_address, type, position, barangay, sex, phonenumber, verified) 
                        VALUE ('$username', '$email', '$password', '$firstname', '$middlename', '$lastname', '$birthday', '$fulladdress', 'Official', '$position', '$barangay', '$sex', 
                        '$phonenumber', 'no')";
  mysqli_query($con, $sql);

  $sqlImgName = "SELECT * FROM all_users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($con, $sqlImgName);

  if(mysqli_num_rows($result)>0){

    $currentid = mysqli_fetch_assoc($result);
   
    $imgnewname = "user".$currentid['id']."id".".".$imgext; 
    $valididdir = 'images/'.$imgnewname;
    move_uploaded_file($img['tmp_name'], $valididdir);

    $sqlimginsert = "UPDATE all_users SET valid_id_dir = '$valididdir' WHERE email = '$email' AND password = '$password'";
    mysqli_query($con, $sqlimginsert);  

      if (file_exists($_FILES['submit_profile']['tmp_name']) || is_uploaded_file($_FILES['submit_profile']['tmp_name'])){
        $imageid = $currentid['profileid'];
        $profile = $_FILES['submit_profile'];
        $profilesplit = explode('.',$profile['name']);
        $profileext = strtolower(end($profilesplit));
        $profilenewname = "user".$currentid['id']."profile".$imageid.".".$profileext; 
        $profiledir = 'profiles/'.$profilenewname;
        move_uploaded_file($profile['tmp_name'], $profiledir);

        $sqlprofileinsert = "UPDATE all_users SET user_profile_dir = '$profiledir' WHERE email = '$email' AND password = '$password'";
        mysqli_query($con, $sqlprofileinsert);
    
      }

      else{

        $sqlprofileinsert = "UPDATE all_users SET user_profile_dir = 'Icons/profile.png' WHERE email = '$email' AND password = '$password'";
        mysqli_query($con, $sqlprofileinsert);

      }
  }


   after_signup();
   die;
}
  }
    } else{
      echo '<script>alert("Please upload an image")</script>';  
    }

  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Barangay Feedback Portal</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

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


        <a href ="index.php"  class="return">Return</a>

        

  <form action="register-official.php" method="post" enctype="multipart/form-data">


  <div class="group-1">
          <span class="first-name">First Name</span>
            <input type="text" name = "first_name" class="group-input-c" placeholder="Charlene" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"
             style="transform: translatey(20px);" required/>
        </div>


        <div class="group-4">
          <span class="middle-name">Middle Name</span>
          <input name = "middle_name"type="text" class="group-input-c" placeholder="Fernandez" value="<?php if (isset($_POST['middle_name'])) echo $_POST['middle_name']; ?>"
          style="transform: translatey(20px);" required/>
        </div>

        <div class="group-9">
          <span class="last-name">Last Name</span>
            <input type="text" name = "last_name" class="group-input-c" placeholder="De Leon" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"
             style="transform: translatey(20px);" required />
        </div>


        <div class="group-d">
          <span class="date-of-birth">Date of Birth</span>
          <input name = "birthday" type="date" class="group-input-c" value="<?php if (isset($_POST['birthday'])) echo $_POST['birthday']; ?>" 
          style="transform: translatey(20px);" required/>
        </div>


        <div class="group-10">
          <label class="button" for="submit_id">Attach Valid ID</label>
            <input type="file" name="submit_id" id="submit_id" accept=".jpg, .png, .jpeg|image/*" style="display: none;">
            <input type="submit" class="group-12" name = "register_button" id="register_button" value="Register as an Official" >
        </div>


        <div class="group-14">
          <span class="full-address">Full Address</span>
          <input type="text" name="full_address" class="group-input-c" placeholder="Mangga 2 Matatalaib Tarlac City" value="<?php if (isset($_POST['full_address'])) echo $_POST['full_address']; ?>"
           style="transform: translatey(20px);" required />
        </div>


        <div class="group-17">
          <span class="barangay">Barangay</span>
          <select name="barangay" class="group-input-c" placeholder="Matatalaib" value="<?php if (isset($_POST['barangay'])) echo $_POST['barangay']; ?>"
           style="transform: translatey(20px);" required>
          <option value="Barangay 1">Barangay 1</option>
          <option value="Barangay 2">Barangay 2</option>
          <option value="Barangay 3">Barangay 3</option>
          <option value="Barangay 4">Barangay 4</option>
          <option value="Barangay 5">Barangay 5</option>
          </select>
        </div>


        <div class="group-1b">
          <span class="email">Email</span>
            <input type="email" name="email" id="email" class="group-input-c" placeholder="asdasd@gmail.com" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"
            style="transform: translatey(20px);" required/>
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
          <input type="text" name="username" class="group-input-c" placeholder="CHFerde" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"
           style="transform: translatey(20px);" required/>
        </div>


        <div class="group-27">
          <span class="password">Password</span>
          <input type="password" name="password" class="group-input-c" placeholder="**********" style="transform: translatey(20px);"  required/> 
        </div>


        <div class="group-2b">
          <span class="phone-number">Phone Number</span>
          <input type="number" minlength="11" maxlength="11" name="phone_number" class="group-input-c" placeholder="0239203902" value="<?php if (isset($_POST['phone_number'])) echo $_POST['phone_number']; ?>"
           style="transform: translatey(20px);" required /> 
        </div>


        <div class="group-2f">
          <span class="barangay-position">Barangay Position</span>
          <input type="text" name="position" class="group-input-c" placeholder="Captain" value="<?php if (isset($_POST['position'])) echo $_POST['position']; ?>"
           style="transform: translatey(20px);" required/> 
      </div>

      <div class="group-7">
          <img src = "Icons/profile.png" class="mask-group" id = "user_profile">
            <input type="file" name="submit_profile" id="submit_profile" accept=".jpg, .png, .jpeg|image/*" style="display: none;" >
            <label class="ellipse"  for = "submit_profile"><img src="Icons/pencil.png" class ="pencil" alt="x"></label>
        </div>
        
      </form>
    </div>    
  </body>
</html>

<script>
submit_profile.onchange = evt => {
    const [file] = submit_profile.files;
    if(file){
      user_profile.src = URL.createObjectURL(file);
    }
}
</script>