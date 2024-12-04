<?php

session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);
if(checkUser($con)){
    header("Location: allFeedbackAdmin");
}


if(isset($_POST['post_button'])){

$title = $_POST['notice_title'];
$barangay = $_POST['barangay'];
$url = $_POST['link'];
$user = $user_data['first_name']." ".$user_data['last_name'];
$current_user = $_SESSION['id'];

$sql = "INSERT INTO all_notice(title, link, barangay, user, user_current) VALUE('$title', '$url', '$barangay', '$user', '$current_user')";

mysqli_query($con, $sql);
header("Location: homeadmin.php");
}

if(isset($_POST['rtn_btn'])){

    header("Location: homeadmin.php");
    die;
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Portal - Settings</title>
    <link rel="stylesheet" href="css/addnotice.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">

</head>
<body>
     
<div class="wrapper">
        <div class= "filler"></div>
        <div class="sidebar">
        <div class="sidebar-header">
                <img src="Icons/brgy icon.png" alt="Barangay Icon" class="sidebar-icon">
                <h2>Barangay <br> Feedback <br> Portal</h2>
            </div>
            <ul>
            <li id="homeli" class="homeli"><img src="Icons/home2.png" id='home-img' alt="home"><a style="color:#1814F3;" href="homeadmin.php"><i class="buthome"></i>Home</a></li>
                <li id="feedbackli" class="feedbackli"><img src="Icons/transfer1.png" id="feedback-img" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
<?php
if(!checkUser($con)){echo'
                <li id="accountsli"  class="accountsli"><img src="Icons/account1.png" id="accounts-img" alt="accounts"><a href="accountsadmin.php"><i class="but accounts"></i>Accounts</a></li>';
            }
?>
                <li id="settingsli" class="settingsli"><img src="Icons/settings1.png" id="settings-img" alt="settings"><a href="profileeditadmin.php "><i class="but settings"></i>Settings</a></li>
                <li id ="logoutli" class ="logoutli"><img src="Icons/logout1.png" id="logout-img" alt="logout"><a><i class="but logout">Log Out</a></li>
           

            </ul>
        </div>
        <div class="main_content">

            <div class="header">
                <div>
                    <h2>Home</h2>
                </div>
                <div>
                    <p>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>

            <div class="rectangle-5">
                <div class="flex-row-c" style="margin-top: 7px;">
                    <div class="top">
                        <span class="posttitle">Post your notice</span>
                        <button onclick="ReturnPage()" class="return">
                            <div class="arrow-back"></div>
                            Return
                        </button>
                    </div>
                </div>
                <hr>
                <span class="subtitle">Notice</span>
                <form action="addnotice.php" method="post"> 
                <div class="flex-row-c" style="margin-top: 5px;">
                    <div class="title-container" style="margin-right: 45px;">
                        <span class="title">Title</span>
                        <input type="text" name="notice_title" id="notice_title" class="group-input" placeholder="Enter notice title" required />
                    </div>
                    <div class="barangay-container">
                        <span class="barangay">Barangay</span>
                        <select name="barangay" id="barangay" class="group-input" required>
                            <option value="" disabled selected>Select Barangay</option>
                            <option value="Barangay 1">Barangay 1</option>
                            <option value="Barangay 2">Barangay 2</option>
                            <option value="Barangay 3">Barangay 3</option>
                        </select>
                    </div>  
                </div>


                <div class="description-container">
                    <span class="description">Link</span>
                    <input type="url" name="link" id="link" class="group-input" placeholder="Enter a link here" style="margin-bottom: 19px;" required />
                </div>
                
                <button type="submit" id="post_button" name="post_button" class="post-button">Post</button>
                </form> 
            </div>
        </div>


    </div>
</body>
</html>
<script src = "script.js"></script>
<script>

function ReturnPage(){

    window.location.href = 'homeadmin.php';
}

const homeLi = document.getElementById("homeli");
const feedbackLi = document.getElementById("feedbackli");
const accountsLi = document.getElementById("accountsli");
const settingsLi = document.getElementById("settingsli")
const logoutLi = document.getElementById("logoutli");

const homeImg = document.getElementById("home-img");
const feedbackImg = document.getElementById("feedback-img");
const accountsImg = document.getElementById("accounts-img");
const settingsImg = document.getElementById("settings-img")
const logoutImg = document.getElementById("logout-img");

const homeHover = "Icons/home2.png";
const feedbackHover = "Icons/transfer2.png";
const accountsHover = "Icons/account2.png";
const settingsHover = "Icons/settingssolid1.png"
const logoutHover = "Icons/logout2.png";

// Add event listeners for hover effect on each li
// homeLi.addEventListener("mouseenter", () => {
//     homeImg.src = homeHover; // Change the image on hover
// });
// homeLi.addEventListener("mouseleave", () => {
//     homeImg.src = "Icons/home1.png"; // Reset image when hover ends
// });

feedbackLi.addEventListener("mouseenter", () => {
    feedbackImg.src = feedbackHover; // Change the image on hover
});
feedbackLi.addEventListener("mouseleave", () => {
    feedbackImg.src = "Icons/transfer1.png"; // Reset image when hover ends
});

accountsLi.addEventListener("mouseenter", () => {
    accountsImg.src = accountsHover; // Change the image on hover
});
accountsLi.addEventListener("mouseleave", () => {
    accountsImg.src = "Icons/account1.png"; // Reset image when hover ends
});

settingsLi.addEventListener("mouseenter", () => {
    settingsImg.src = settingsHover; // Change the image on hover
});
settingsLi.addEventListener("mouseleave", () => {
    settingsImg.src = "Icons/settings1.png"; // Reset image when hover ends
});

logoutLi.addEventListener("mouseenter", () => {
    logoutImg.src = logoutHover; // Change the image on hover
});
logoutLi.addEventListener("mouseleave", () => {
    logoutImg.src = "Icons/logout1.png"; // Reset image when hover ends
});


</script>