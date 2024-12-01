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
$user= mysqli_fetch_assoc($result);

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
    $sql2 = "DELETE FROM all_feedback WHERE user_current = $userID";
    mysqli_query($con, $sql2);
    $sql3 = "DELETE FROM all_reply WHERE replyuser = $userID";
    mysqli_query($con, $sql3);
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
    <link rel="stylesheet" href="css/viewuseraccadmin.css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
</head>
<body>
        
    <div class="wrapper">
        <div class="sidebar">
            <h2><img src="Icons/brgy icon.png" alt="brgy">Barangay Feedback Portal</h2>
            <ul>
                <li><img src="Icons/home1.png" alt="home"><a href="homeadmin.php"><i class="but home"></i>Home</a></li>
                <li><img src="Icons/transfer1.png" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
                <li><img src="Icons/account1.png" alt="accounts"><a href="accountsadmin.php"><i class="but accounts"></i>Accounts</a></li>
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
                        <span class="title">#<?php echo $userID ?> - <?php echo $name  ?></span>
                        <button onclick="return window.location.href = 'accountsadmin.php'" class="return">
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
                    <p><strong>Official Position:  <?php echo $pos ?></strong></p>
                    <p><strong>Email: <?php echo $email ?></strong></p>
                    <p><strong>Contact No.: <?php echo $contact ?></strong></p>
                    <br>
                    
                    <form action="viewuseraccadmin.php" method="post">
                    <button onclick = 'return confirm("Are you sure?")' name='delete' class="reply-feedback-button">Delete Account</button>
                    </form>
                </div>

            </div>
        </div>


    </div>
</body>
</html>