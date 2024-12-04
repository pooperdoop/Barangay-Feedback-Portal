<?php

session_start();
include("all_usersdb.php"); 
include_once("functions.php");
$user_data = check_login($con);

if(isset($_POST['view_btn'])){

    $feedback = $_POST['view_btn'];

    $sql = "SELECT * FROM all_feedback WHERE ticketID = '$feedback' limit 1";
    $result = mysqli_query($con, $sql);

    
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        $ticketID = $data['ticketID'];
        $title = $data['title'];
        $message = $data['message'];
        $status = $data['status'];
        $date = $data['date'];
        $type = $data['type'];
        $attachment = $data['attachments'];
        $_SESSION['ticketID'] = $ticketID;
        $_SESSION['ticketType'] = $type;
        $Isfeedback = 'yes';
        $user = $data['user_current'];
    $sqlUser = "SELECT * FROM all_users WHERE id = '$user' limit 1";
    $resultUser = mysqli_query($con, $sqlUser);
   
    if(mysqli_num_rows($resultUser) > 0){
        
        $data = mysqli_fetch_assoc($resultUser);

        $fullname = $data['first_name']." ".$data['middle_name']." ".$data['last_name'];
        $bday = $data['birthday'];
        $address = $data['full_address'];
        $email = $data['email'];
        $contact = $data['phonenumber'];


      }
    }   
}

if(isset($_POST['view_btn_rep'])){
    //   echo "<script>alert('what')</script>";
       $reply = $_POST['view_btn_rep'];
   
       $sql = "SELECT * FROM all_reply WHERE replyID = '$reply' limit 1";
       $result = mysqli_query($con, $sql);
   
       
       if(mysqli_num_rows($result) > 0){
           $data = mysqli_fetch_assoc($result);
           $ticketID = $data['replyID'];
           $title = $data['title'];
           $message = $data['message'];
           $Isfeedback = 'no';

         }
   }

if(isset($_POST['save_btn'])){
    $changeStatus = $_POST['status_chg'];
    $ticket_val = $_POST['ticket_value'];
    $sql = "UPDATE all_feedback SET status = '$changeStatus' WHERE ticketID =  '$ticket_val'";
    mysqli_query($con, $sql);
    header("Location: allFeedbackAdmin.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Portal - Settings</title>
    <link rel="stylesheet" href="css/viewticketadmin.css?v=<?php echo time(); ?>">
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
            
            <div class="rectangle-5">
                <div class="flex-row-c" style="margin-top: 7px; margin-bottom:7px">
                    <div class="top">
                        <span class="title"><?php echo "#".$ticketID." - ".$title;   ?></span>
                        <button onclick="ReturnPage()"  class="return">
                            <div class="arrow-back"></div>
                            Return
                        </button>
                    </div>
                </div>
                <hr>
                <div class='centerdiv'>
            <?php 

                if(checkIfReply($con, $Isfeedback)){
                    echo "
                        <p><strong>Ticket No:</strong>". $ticketID  ."</p>
                        <p><strong>Date:</strong>".  $date  ."</p>
                        <br>
                        <p><strong>Name:</strong>" . $fullname ." </p>
                        <p><strong>Birthday:</strong>".  $bday . "</p>
                        <p><strong>Address:</strong>" . $address ." </p>
                        <p><strong>Feedback Type:</strong>".  $type . "</p>
                        <p><strong>Email:</strong> ". $email . "</p>
                        <p><strong>Contact No:</strong>" . $contact  ."</p>
                        <br>
                        <br>
                        <p><strong>Title:</strong>" .  $title. " </p>
                        <br>";} ?>
                        <p><strong>Description:</strong></p>
                        <p><?php echo $message?></p>
                        <br>
                        <?php
                         if(checkIfReply($con,$Isfeedback)){
                    echo "
                        <p><strong>Attachments: </strong></p>
                        <img class='attach' style ='max-width:800px'  src=". $attachment." >
                        ";}


                    ?>
                    <?php 
                            if(checkUser($con)){
                            } 
                            else{
                                echo '
                    <div class="rectangle-f">
                        <div class="set-status">
                            <span class="status">Set Status</span>
                            <div class="dropdown-container">';}
                             ?>   
                 <form action="viewticketadmin.php" method="post">
                 <?php 
                            if(checkUser($con)){
                            } 
                            else{
                                echo '<select id="status" name="status_chg" class="status-dropdown">
                                    <option value="' .$status.'" >'.$status.'</option>
                                    <option value="Open">Open</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                        </div> ';}
                                    
                        ?>

                        <input type='text' name="ticket_value" style="display: none;" value= '<?php echo $ticketID ?>'>
                        <?php 
                            if(checkUser($con)){
                            }
                            else{

                                echo '<button type="button" onclick="ReplyPage()" class="reply-feedback-button">Reply</button>';
                                echo ' <button  name="save_btn" class="save-feedback-button">Save Changes</button>';
                            }
                            ?>
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
function ReturnPage(){

window.location.href = 'allFeedbackAdmin.php';

}

function ReplyPage(){
    
    location.replace('replyticket.php') ;
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