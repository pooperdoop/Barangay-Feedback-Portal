<?php
session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);
$ticketID = $_SESSION['ticketID'];

$sql = "SELECT * FROM all_feedback WHERE ticketID = '$ticketID' limit 1";
$result = mysqli_query($con, $sql);
$currentTicket = mysqli_fetch_assoc($result);
$ticketTitle = $currentTicket['title'];
$ticketWriter = $currentTicket['user_current'];
$respondent = $user_data['first_name']." ".$user_data['last_name'];

if(isset($_POST['sub_btn'])){

    $currentUser = $_SESSION['id'];
    $title = $_POST['title'];
    $desc  = $_POST['description'];

    $sql = "INSERT INTO all_reply(replyTo, user, message, title, replyuser, respondent) VALUES('$ticketID','$currentUser','$desc', '$title', '$ticketWriter', '$respondent')";
    mysqli_query($con, $sql);
    echo'<script>alert("Reply Successful")</script>';
    header('Location: allFeedbackAdmin.php');
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Porta - Enter Feedback</title>
    <link rel="stylesheet" href="css/replyticket.css?v=<?php echo time(); ?>"/>
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
                <li id="feedbackli" class="feedbackli"><img src="Icons/transfer2.png" id="feedback-img" alt="feedback"><a style="color:#1814F3;" href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
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
                    <h2>Feedbacks</h2>
                </div>
                <div>
                    <p>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>

            <form action="replyticket.php" method="post">   
                
    <div class="feedback_write_page ">
        <div class="flex-row-c" style="margin-top: 7px;">
            <div class="top">
                <h1>Replying to: #<?php echo $ticketID ?> - <?php echo $ticketTitle ?></h1>
              
            </div>
        </div>

      <hr>
      <span>Write your reply here</span>
        <div class="flex-row-c" style="margin-top: 5px;">
            <div class="title-container">
                <span class="title">Title</span>
                <input name ="title" type="text" name="feedback_title" class="group-input" placeholder="Enter feedback title" required />
            </div>
        </div>
    
        <span class="message">Description</span>
        <textarea name="description" class="group-input" placeholder="Enter your description here" required></textarea>

        <div class="rectangle-f">
            <button name = "sub_btn" type="submit" class="send-feedback-button">Send</button>
        </div>
    </div>
        </form>
    </div>
</div>
</body>
</html>
<script src = "script.js?v=<?php echo time(); ?>"></script>
<script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

    function addfeedback(){
        location.replace("addfeedback.php");
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

homeLi.addEventListener("mouseenter", () => {
    homeImg.src = homeHover; // Change the image on hover
});
homeLi.addEventListener("mouseleave", () => {
    homeImg.src = "Icons/home1.png"; // Reset image when hover ends
});

// feedbackLi.addEventListener("mouseenter", () => {
//     feedbackImg.src = feedbackHover; // Change the image on hover
// });
// feedbackLi.addEventListener("mouseleave", () => {
//     feedbackImg.src = "Icons/transfer1.png"; // Reset image when hover ends
// });

<?php
if(!checkUser($con)){echo'
    accountsLi.addEventListener("mouseenter", () => {
    accountsImg.src = accountsHover; // Change the image on hover
});
accountsLi.addEventListener("mouseleave", () => {
    accountsImg.src = "Icons/account1.png"; // Reset image when hover ends
});        ';}
?>



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