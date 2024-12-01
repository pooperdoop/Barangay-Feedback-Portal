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
    <link rel="stylesheet" href="css/addfeedbackuser.css"/>

</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2><img src="Icons/brgy icon.png" alt="brgy">Barangay Feedback Portal</h2>
            <ul>
            <li><img src="Icons/home1.png" alt="home"><a href="homeadmin.php"><i class="but home"></i>Home</a></li>
                <li><img src="Icons/transfer1.png" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
                <li><img src="Icons/settings1.png" alt="settings"><a href="profileeditadmin.php "><i class="but settings"></i>Settings</a></li>
                <li><img src="Icons/logout1.png" alt="logout"><a href="logout.php"><i class="but logout">Log Out</a></li>
            </ul>
        </div>

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
                <h1>Write your feedbacks here</h1>
                
                <div class="divider"></div>
                
                <span>Message</span>
            </div>
        </div>
 <form action="addfeedback.php" method="post"  enctype="multipart/form-data">
        <div class="flex-row-c" style="margin-top: 5px;">
            <div class="title-container">
                <span class="title">Title</span>
                <input type="text" name="feedback_title" id="feedback_title" maxlength="30" class="group-input" placeholder="Enter feedback title" required />
            </div>
            
            <div class="barangay-container" style="margin-left: 53px;">
                <span class="barangay">Barangay</span>
                <select name="barangay" id="barangay" class="group-input" style="width: 256px;" required    >
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
