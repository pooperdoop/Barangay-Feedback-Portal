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

if(isset($_POST['sub_btn'])){

    $currentUser = $_SESSION['id'];
    $title = $_POST['title'];
    $desc  = $_POST['description'];

    $sql = "INSERT INTO all_reply(replyTo, user, message, title) VALUES('$ticketID','$currentUser','$desc', '$title')";
    mysqli_query($con, $sql);
    echo'<script>alert("Replay Successful")</script>';
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
    <link rel="stylesheet" href="replyticket.css?v=<?php echo time(); ?>"/>

</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2><img src="Icons/brgy icon.png" alt="brgy">Barangay Feedback Portal</h2>
            <ul>
            <li><img src="Icons/home1.png" alt="home"><a href="homeadmin.php"><i class="but home"></i>Home</a></li>
                <li><img src="Icons/transfer1.png" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
                <li><img src="Icons/account1.png" alt="accounts"><a href="#"><i class="but accounts"></i>Accounts</a></li>
                <li><img src="Icons/settings1.png" alt="settings"><a href="profileeditadmin.php"><i class="but settings"></i>Settings</a></li>
                <li><img src="Icons/logout1.png" alt="logout"><a href="#"><i class="but logout">Log Out</a></li>
            </ul>
        </div>
        <form action="replyticket.php" method="post">  
        <div class="main_content">

            <div class="header">
                <div class="header-content">
                    <h2>Feedbacks</h2>
                    <input class="search" type="text" placeholder="Search for something">
                    <p>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>
    
    <div class="feedback_write_page ">
        <div class="flex-row-c" style="margin-top: 7px;">
            <div class="top">
                <h1>Replying to: #<?php echo $ticketID ?> - <?php echo $ticketTitle ?></h1>
                <div class="divider"></div>
                <span>Write your reply here</span>
            </div>
        </div>
      
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
        </form>
    </div>
</div>
</body>
</html>