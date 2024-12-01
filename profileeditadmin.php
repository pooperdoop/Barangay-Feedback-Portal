<?php
session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);

$id = $user_data['id'];

$sql = "SELECT * FROM all_users WHERE id = '$id'";
$result = mysqli_query($con, $sql);

$current_user = mysqli_fetch_assoc($result);

$firstname = $current_user["first_name"];
$middlename = $current_user["middle_name"];
$lastname = $current_user["last_name"];
$email = $current_user["email"];
$password = $current_user["password"];
$position = $current_user["position"];
$phonenumber = $current_user["phonenumber"];
$username = $current_user["username"];
$fulladdress = $current_user["full_address"];
$barangay = $current_user["barangay"];
$sex = $current_user["sex"];
$birthday = $current_user["birthday"];
$profile = $current_user['user_profile_dir'];
$imageid = $current_user['profileid'];


if(isset($_POST['save_btn'])){
      
    if (file_exists($_FILES['submit_profile']['tmp_name']) || is_uploaded_file($_FILES['submit_profile']['tmp_name'])){
        if($profile == "Icons/profile.png"){

        }else{      
              
            unlink($profile);}
        $imageid ++;
        $profilpic = $_FILES['submit_profile'];
        $profilesplit = explode('.',$profilpic['name']);
        $profileext = strtolower(end($profilesplit));
        $profilenewname = "user".$id."profile".$imageid.".".$profileext; 
        $profiledir = 'profiles/'.$profilenewname;
        move_uploaded_file($profilpic['tmp_name'], $profiledir);
        
        $sqlprofileinsert = "UPDATE all_users SET user_profile_dir = '$profiledir', profileid = '$imageid' WHERE id = '$id'";
        mysqli_query($con, $sqlprofileinsert);
    
      }

    $new_firstname = $_POST["firstname"];
    $new_middlename = $_POST["middlename"];
    $new_lastname = $_POST["lastname"];
    $new_email = $_POST["email"];
    $new_password = $_POST["password"];
    $new_position = $_POST["position"];
    $new_phonenumber = $_POST["contact"];
    $new_username = $_POST["username"];
    $new_fulladdress = $_POST["address"];
    $new_barangay = $_POST["barangay"];
    $new_sex = $_POST["sex"];
    $new_birthday = $_POST["bday"];
    header("Refresh:0");        

      if(!checkUser($con)){
    $sql = "UPDATE all_users SET first_name = '$new_firstname', middle_name = '$new_middlename', last_name = '$new_lastname', email = '$email',
    password = '$new_password', position = '$new_position', phonenumber = '$new_phonenumber', username = '$new_username', full_address = '$new_fulladdress',
    barangay = '$new_barangay', sex = '$new_sex', birthday = '$new_birthday' WHERE id = $id";
    mysqli_query($con, $sql);
}else{
    $sql = "UPDATE all_users SET first_name = '$new_firstname', middle_name = '$new_middlename', last_name = '$new_lastname', email = '$email',
    password = '$new_password', phonenumber = '$new_phonenumber', username = '$new_username', full_address = '$new_fulladdress',
    barangay = '$new_barangay', sex = '$new_sex', birthday = '$new_birthday' WHERE id = $id";
    mysqli_query($con, $sql);
}

$new_user = $new_firstname." ".$new_lastname;
$sql = "UPDATE all_feedback SET user = '$new_user' WHERE user_current = '$id' ";
mysqli_query($con, $sql);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Portal - Settings</title>
    <link rel="stylesheet" href="profileeditadmin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
</head>
<body>
        
    <div class="wrapper">
        <div class="sidebar">
            <h2><img src="Icons/brgy icon.png" alt="brgy">Barangay Feedback Portal</h2>
            <ul>
            <li><img src="Icons/home1.png" alt="home"><a href="homeadmin.php"><i class="but home"></i>Home</a></li>
                <li><img src="Icons/transfer1.png" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
<?php if(!checkUser($con)){
               echo ' <li><img src="Icons/account1.png" alt="accounts"><a href="accountsadmin.php"><i class="but accounts"></i>Accounts</a></li>';
 }?>               
                <li><img src="Icons/settings1.png" alt="settings"><a href="profileeditadmin.php "><i class="but settings"></i>Settings</a></li>
                <li><img src="Icons/logout1.png" alt="logout"><a href="logout.php"><i class="but logout">Log Out</a></li>
            </ul>   
        </div>

        <div class="main_content">

            <div class="header">
                <div>
                    <h2>Feedbacks</h2>
                </div>
                <div>
                    <input class="search" type="text" placeholder="Search for something">
                </div>
                <div>
                    <p>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>
            
            <div class="rectangle-5">
                <div class="flex-row-c" style="margin-top: 7px;">
                    <div class="top">
                        <span class="title">Edit your personal information here</span>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="flex-container" style="display: flex;">
                    <div class="leftdiv" style="width: 200px; height: 568px;">
                    <form action="profileeditadmin.php" method="post" enctype="multipart/form-data">     
                        <div style="position: relative;">
                        
                            <img class="profile-image" src="<?php echo $profile ?>" id = "user_profile" alt="profile">
                            <div class="pencil-button">
                            <input type="file" name="submit_profile" id="submit_profile" accept=".jpg, .png, .jpeg|image/*" style="display: none;" >
                                <label id="submit_lbl"  class="pencil-icon"></label>
                            </div>
                        </div>
                        <button type="button" onclick="editUser()" class="edit-button" id = edit_button type="cancel">Edit </button>
                        <button type="button" onclick="cancelEdit()" class="cancel-button" id="cancel_btn" type="cancel" style="display: none;">Cancel</button>
                             <input type="submit" value="Save"  name = "save_btn" id="save_btn" class="save-button" type="save" style="display: none;">

                    </div>



                    <div class="rightdiv" style="flex-grow: 1; height: 568px;">
                        <div class="form-container">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input name ="firstname" id="firstname"  value="<?php echo $firstname ?>" type="text"  placeholder="Enter your first name" style="width: 225px; height: 40px; margin-right: 20px;" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name">Middle Name</label>
                                    <input name="middlename" id="middlename" value="<?php echo $middlename ?>" type="text" placeholder="Enter your middle name" style="width: 225px; height: 40px; margin-right: 20px;" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input name="lastname" id="lastname" value="<?php echo $lastname ?>" type="text"  placeholder="Enter your last name" style="width: 225px; height: 40px; margin-right: 20px;" readonly required>
                                </div>
                            </div>
            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input name="bday" id="bday" value=<?php echo $birthday ?> type="date" style="width: 225px; height: 40px; margin-right: 20px;"readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <select value="<?php echo $barangay?>" name="barangay" id="barangay" style="width: 225px; height: 40px; margin-right: 20px; background-image: url('Icons/droplist.png'); background-repeat: no-repeat; background-position: right 10px center; padding-right: 30px;" disabled required>
                                        <option value="<?php echo $barangay ?>"  selected><?php echo $barangay?> </option>
                                        <option value="Barangay 1">Barangay 1</option>
                                        <option value="Barangay 2">Barangay 2</option>
                                        <option value="Barangay 3">Barangay 3</option>
                                        <option value="Barangay 4">Barangay 4</option>
                                        <option value="Barangay 5">Barangay 5</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">Full Address</label>
                                    <input name="address" value='<?php echo $fulladdress ?>' type="text" id="address" placeholder="Enter your full address" style="width: 225px; height: 40px; margin-right: 20px;" readonly required>
                                </div>
                            </div>
            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <select  value="<?php echo $sex ?>" name="sex" id="sex" 
                                    style="width: 225px; height: 40px; margin-right: 20px; 
                                    background-image: url('Icons/droplist.png'); 
                                    background-repeat: no-repeat; background-position: right 10px center; padding-right: 30px;" disabled required>
                                        <option value="<?php echo $sex ?>" selected> <?php echo $sex ?> </option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" value=<?php echo $email ?> type="email" id="email" placeholder="Enter your email" style="width: 225px; height: 40px; margin-right: 20px;" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input name="contact" value=<?php echo $phonenumber ?> type="tel" id="contact" placeholder="Enter your phone number" style="width: 225px; height: 40px; margin-right: 20px;" readonly required>
                                </div>
                            </div>
            
                            <div class="form-row" style="width: 225px; height: 40px;">

                            <?php if(!checkUser($con)){ echo'
                                <div class="form-group">
                                    <label for="position">Barangay Position</label>
                                    <input type="text"  value="'.$position.'" name="position" id="position" style="width: 225px; height: 
                                    40px; margin-right: 20px; background-image: url("Icons/droplist.png"); 
                                    background-repeat: no-repeat; background-position: right 10px center; padding-right: 30px;" readonly required >
                                </div>'   ;} ?>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input name = "username" value=<?php echo $username ?> type="text" id="username" placeholder="Choose a username" style="width: 225px; height: 40px; margin-right: 20px;" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input name = "password"  value=<?php echo $password ?> type="password" id="password" placeholder="Enter your password" style="width: 225px; height: 40px; margin-right: 20px;"  required readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </form >  
                </div>
               
            </div>


        </div>
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

function cancelEdit(){
    document.getElementById('save_btn').style.display = "none";
    document.getElementById('cancel_btn').style.display = "none";
    document.getElementById('edit_button').style.display = "inline"
    makeReadOnly();
    removeEditted();
}

function editUser(){    
    document.getElementById('save_btn').style.display = "inline";
    document.getElementById('cancel_btn').style.display = "inline";
    document.getElementById('edit_button').style.display = "none";
    removeReadOnly();
}

function removeReadOnly(){
    document.getElementById('firstname').readOnly = false;
    document.getElementById('middlename').readOnly = false;
    document.getElementById('lastname').readOnly = false;
    document.getElementById('bday').readOnly = false;
    document.getElementById('barangay').disabled = false;
    document.getElementById('address').readOnly = false;
    document.getElementById('sex').disabled = false;
    document.getElementById('email').readOnly = false;
    document.getElementById('contact').readOnly = false;
    <?php if(!checkUser($con)){
    echo "document.getElementById('position').readOnly = false;";
    }?>
    document.getElementById('username').readOnly = false;
    document.getElementById('password').readOnly = false;
    document.getElementById('submit_lbl').htmlFor = 'submit_profile';
}

function makeReadOnly(){
    document.getElementById('firstname').readOnly = true;
    document.getElementById('middlename').readOnly = true;
    document.getElementById('lastname').readOnly = true;
    document.getElementById('bday').readOnly = true;
    document.getElementById('barangay').disabled = true;
    document.getElementById('address').readOnly = true;
    document.getElementById('sex').disabled = true;
    document.getElementById('email').readOnly = true;   
    document.getElementById('contact').readOnly = true;
<?php if(!checkUser($con)){
  echo  "document.getElementById('position').readOnly = true;";
}?>
    document.getElementById('username').readOnly = true;
    document.getElementById('password').readOnly = true;
    document.getElementById('submit_lbl').htmlFor = '';
}

function removeEditted(){
    document.getElementById('firstname').value ='<?php echo $firstname  ?>';
    document.getElementById('middlename').value ='<?php echo $middlename ?>';
    document.getElementById('lastname').value ='<?php echo $lastname ?>';
    document.getElementById('bday').value ='<?php echo $birthday ?>';
    document.getElementById('barangay').value ='<?php echo $barangay ?>';
    document.getElementById('address').value ='<?php echo $fulladdress ?>';
    document.getElementById('sex').value ='<?php echo $sex ?>';
    document.getElementById('email').value ='<?php echo $email ?>';
    document.getElementById('contact').value ='<?php echo $phonenumber ?>';
<?php if(!checkUser($con)){
    echo "document.getElementById('position').value ='".$position."';";
}?>
    document.getElementById('username').value ='<?php echo $username ?>';
    document.getElementById('password').value ='<?php echo $password ?>';
    document.getElementById('user_profile').src = '<?php echo $profile ?>';
}
 
</script>