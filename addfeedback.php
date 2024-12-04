<?php
session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);

if(isset($_POST['send_feedback'])){ 

$title = $_POST['feedback_title'];
$user = $user_data['first_name']." ".$user_data['last_name'];
$type = $_POST['complaint_type'];
$message = $_POST['description'];
$barangay = $_POST['barangay'];
$current_user = $_SESSION['id'];


$sql = "INSERT INTO all_feedback(user_current, title, message, type, status, user, barangay) 
        VALUE('$current_user', '$title', '$message', '$type', 'Open', '$user','$barangay')";
 mysqli_query($con, $sql);

if (file_exists($_FILES['feedback_file']['tmp_name']) || is_uploaded_file($_FILES['feedback_file']['tmp_name'])){
    $sql = "SELECT * FROM all_feedback WHERE title = '$title' AND message = '$message' AND user_current = '$current_user'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0){
        
    $feedbackID = mysqli_fetch_assoc($result);

    $attachment = $_FILES['feedback_file'];
    $imageid = $feedbackID['ticketID'];
    $imgsplit = explode('.',$attachment['name']);
    $imgext = strtolower(end($imgsplit));
    $imgnewname = "feedback".$imageid."attachment".".".$imgext; 
    $imgdir = 'images/'.$imgnewname;
    move_uploaded_file($attachment['tmp_name'], $imgdir);

    $sqlprofileinsert = "UPDATE all_feedback SET attachments = '$imgdir' WHERE title = '$title' AND message = '$message' AND user_current = '$current_user'";
    mysqli_query($con, $sqlprofileinsert);
    }
}

 header("Location: allFeedbackAdmin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Porta - Enter Feedback</title>
    <link rel="stylesheet" href="css/addfeedbackuser.css?v=<?php echo time(); ?>"/>
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


    
    <div class="feedback_write_page ">
        <div class="flex-row-c" style="margin-top: 7px;">
            <div class="top">
                <span>Write your feedbacks here</span>
                <button onclick="ReturnPage()" class="return">
                            <div class="arrow-back"></div>
                            Return
                        </button>
            </div>
        </div>
                        
        <hr>
                
                <span class="msg_span">Message</span>
 <form action="addfeedback.php" method="post"  enctype="multipart/form-data">
        <div class="flex-row-c" style="margin-top: 5px;">
            <div class="title-container">
                <span class="title">Title</span>
                <input type="text" name="feedback_title" id="feedback_title" maxlength="30" class="group-input" placeholder="Enter feedback title" required />
            </div>
            
            <div class="barangay-container">
                <span class="barangay">Barangay</span>
                <select name="barangay" id="barangay" class="group-input"    required    >
                    <option value="" disabled selected>Select Barangay</option>
                    <option value="Barangay 1">Barangay 1</option>  
                    <option value="Barangay 2">Barangay 2</option>
                    <option value="Barangay 3">Barangay 3</option>
                </select>
            </div>
        </div>
    
        <span class="message">Description</span>
        <textarea name="description" id="description" class="group-input" placeholder="Enter your description here" required></textarea>

        <div class="rectangle-f">
            <div class="complaint-type-container">
                <span class="complaint">Type of Feedback</span>
                <select name="complaint_type" id="complaint_type" class="complaint-type-dropdown">
                    <option value="Complaint">Complaint</option>
                    <option value="Suggestion">Suggestion</option>
                    <option value="Request">Request</option>
                </select>
            </div>
            
            <div class="file-upload-container">
                <label for="feedback_file" class="file-upload-label">
                    <label type="button" for="feedback_file" class="attach-files-button">Attach Files</label>
                    <input type="file" name="feedback_file" class="group-input-e" id="feedback_file" accept="image/*" style="display: none;" />
                </label>
            </div>
            
            <button type="submit" name ="send_feedback" id="send_feedback" class="send-feedback-button">Send</button>
        </div>
        </form>   
    </div>
</div>
</body>
</html>

<script src="script.js"></script>
<script>

    function ReturnPage(){
        location.replace("allFeedbackAdmin.php")
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