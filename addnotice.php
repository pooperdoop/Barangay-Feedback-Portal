<?php

session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);

if(isset($_POST['post_button'])){

$title = $_POST['notice_title'];
$barangay = $_POST['barangay'];
$url = $_POST['link'];
$user = $user_data['first_name']." ".$user_data['last_name'];
$current_user = $_SESSION['id'];

$sql = "INSERT INTO all_notice(title, link, barangay, user, user_current) VALUE('$title', '$url', '$barangay', '$user', '$current_user')";

mysqli_query($con, $sql);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Portal - Settings</title>
    <link rel="stylesheet" href="addnotice.css">
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
</head>
<body>
        
    <div class="wrapper">
        <div class="sidebar">
            <h2><img src="Icons/brgy icon.png" alt="brgy">Barangay Feedback Portal</h2>
            <ul>
                <li><img src="Icons/home1.png" alt="home"><a href="homeadmin.php"><i class="but home"></i>Home</a></li>
                <li><img src="Icons/transfer1.png" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
                <li><img src="Icons/account1.png" alt="accounts"><a href="#"><i class="but accounts"></i>Accounts</a></li>
                <li><img src="Icons/settings1.png" alt="settings"><a href="profileeditadmin.php "><i class="but settings"></i>Settings</a></li>
                <li><img src="Icons/logout1.png" alt="logout"><a href="#"><i class="but logout">Log Out</a></li>
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
                    <p>Welcome, Username</p>
                </div>
            </div>
            
            <div class="rectangle-5">
                <div class="flex-row-c" style="margin-top: 7px;">
                    <div class="top">
                        <span class="title">Post your notice</span>
                        <button class="return">
                            <div class="arrow-back"></div>
                            Return
                        </button>
                    </div>
                </div>
                <div class="divider"></div>
                <span class="subtitle">Notice</span>
                <form action="addnotice.php" method="post">
                <div class="flex-row-c" style="margin-top: 5px;">
                    <div class="title-container" style="margin-right: 53px;">
                        <span class="title">Title</span>
                        <input type="text" name="notice_title" id="notice_title" class="group-input" placeholder="Enter notice title" required />
                    </div>
                    
                    <div class="barangay-container" style="margin-right: 53px;">
                        <span class="barangay">Barangay</span>
                        <select name="barangay" id="barangay" class="group-input" style="width: 256px;" required>
                            <option value="" disabled selected>Select Barangay</option>
                            <option value="Barangay 1">Barangay 1</option>
                            <option value="Barangay 2">Barangay 2</option>
                            <option value="Barangay 3">Barangay 3</option>
                        </select>
                    </div>
                </div>

                <div class="description-container">
                    <span class="description">Link</span>
                    <input type="url" name="link" id="link" class="group-input" placeholder="Enter a link here" required />
                </div>
                
                <button type="submit" id="post_button" name="post_button" class="post-button">Post</button>
                </form> 
            </div>
        </div>


    </div>
</body>
</html>
