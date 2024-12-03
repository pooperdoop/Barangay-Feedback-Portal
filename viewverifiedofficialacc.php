<?php

session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);
if(checkUser($con)){
    header("Location: allFeedbackAdmin");
}

$user_account = $_SESSION['account_view'];

$sql = "SELECT * FROM all_users WHERE id = '$user_account' limit 1";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

$userID = $user['id'];
$full_name = $user['first_name']." ".$user['middle_name']." ".$user['last_name'];
$name = $user['first_name']." ".$user['last_name'];
$date = $user['date_time'];
$bday = $user['birthday'];
$address = $user['full_address'];
$barangay = $user['barangay'];
$type = $user['type'];
$pos = $user['position'];
$email = $user['email'];
$contact = $user['phonenumber'];

if(isset($_POST['delete'])){

    $sql = "DELETE FROM all_users WHERE id = $userID";
    mysqli_query($con, $sql);
    header("Location: accountsadmin.php");
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Portal - Settings</title>
    <link rel="stylesheet" href="css/viewverifiedofficialacc.css?v=<?php echo time(); ?>">
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
            <li id="homeli" class="homeli"><img src="Icons/home1.png" id='home-img' alt="home"><a  href="homeadmin.php"><i class="buthome"></i>Home</a></li>
                <li id="feedbackli" class="feedbackli"><img src="Icons/transfer1.png" id="feedback-img" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
<?php
if(!checkUser($con)){echo'
                <li id="accountsli"  class="accountsli"><img src="Icons/account2.png" id="accounts-img" alt="accounts"><a style="color:#1814F3;" href="accountsadmin.php"><i class="but accounts"></i>Accounts</a></li>';
            }
?>
                <li id="settingsli" class="settingsli"><img src="Icons/settings1.png" id="settings-img" alt="settings"><a href="profileeditadmin.php "><i class="but settings"></i>Settings</a></li>
                <li id ="logoutli" class ="logoutli"><img src="Icons/logout1.png" id="logout-img" alt="logout"><a href="logout.php"><i class="but logout">Log Out</a></li>
           

            </ul>
        </div>
        <div class="main_content">

            <div class="header">
                <div>
                    <h2>Accounts</h2>
                </div>

                <div>
                    <p>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>
            
            <div class="rectangle-5">
                <div class="flex-row-c" style="margin-top: 7px;">
                    <div class="top">
                        <span class="title">#<?php echo $userID ?> - <?php echo $name  ?></span>
                        <button onclick="return window.location.href = 'accountsadmin.php'"  class="return">
                            <div class="arrow-back"></div>
                            Return
                        </button>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="centerdiv">
                    <p><strong>User No: #<?php echo $userID ?></strong></p>
                    <p><strong>Date: <?php echo $date ?></strong</p>
                    <br>
                    <p><strong>Name: <?php echo $full_name ?></strong></p>
                    <p><strong>Birthday: <?php echo $bday ?></strong></p>
                    <p><strong>Address: <?php echo $address ?></strong></p>
                    <p><strong>Barangay: <?php echo $barangay ?></strong></p>
                    <p><strong>Type: <?php echo $type ?></strong></p>
                    <p><strong>Official Position: <?php echo $pos ?></strong></p>
                    <p><strong>Email: <?php echo $email ?></strong></p>
                    <p><strong>Contact No.: <?php echo $contact ?></strong></p>
                    <br>
                    <div class="rectangle-f">
                        <div class="status">
                            <span class="stat">Status</span>
                            <div class="see-status">
                                <input type="text" class="readonly-input" value="Verified" readonly>
                            </div>
                        </div>

                        <form action="viewuseraccadmin.php" method="post">
                    <button onclick = 'return confirm("Are you sure?")' name='delete' class="reply-feedback-button">Delete Account</button>
                    </form> 
                    </div>

                </div>

            </div>
        </div>


    </div>
</body>
</html>
<script src = "script.js"></script>
<script>
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

homeLi.addEventListener("mouseenter", () => {
    homeImg.src = homeHover; // Change the image on hover
});
homeLi.addEventListener("mouseleave", () => {
    homeImg.src = "Icons/home1.png"; // Reset image when hover ends
});

feedbackLi.addEventListener("mouseenter", () => {
    feedbackImg.src = feedbackHover; // Change the image on hover
});
feedbackLi.addEventListener("mouseleave", () => {
    feedbackImg.src = "Icons/transfer1.png"; // Reset image when hover ends
});

// accountsLi.addEventListener("mouseenter", () => {
//     accountsImg.src = accountsHover; // Change the image on hover
// });
// accountsLi.addEventListener("mouseleave", () => {
//     accountsImg.src = "Icons/account1.png"; // Reset image when hover ends
// });

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