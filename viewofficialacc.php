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
$user_data = mysqli_fetch_assoc($result);

$userID = $user_data['id'];
$full_name = $user_data['first_name']." ".$user_data['middle_name']." ".$user_data['last_name'];
$name = $user_data['first_name']." ".$user_data['last_name'];
$date = $user_data['date_time'];
$bday = $user_data['birthday'];
$address = $user_data['full_address'];
$barangay = $user_data['barangay'];
$type = $user_data['type'];
$pos = $user_data['position'];
$email = $user_data['email'];
$contact = $user_data['phonenumber'];
$validid = $user_data['valid_id_dir'];

if(isset($_POST['reject'])){
    
    $sql ="UPDATE all_users SET verified = 'inv' WHERE id = '$userID'";
    mysqli_query($con, $sql);
    header("Location: accountsadmin.php");
    die;
}

if(isset($_POST['accept'])){
    
    $sql ="UPDATE all_users SET verified = 'yes' WHERE id = '$userID'";
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
    <link rel="stylesheet" href="css/viewofficialacc.css">
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
                    <img src= <?php echo $validid?>>
                    <br>
                    
                    
                    <div class="rectangle-f">
                        <div class="status">
                            <span class="stat">Status</span>
                            <div class="see-status">
                                <input type="text" class="readonly-input" value="Unverified" readonly>
                            </div>
                        </div>
                        <form action="viewofficialacc.php" method="post">
                        <button onclick="return confirm('Are you sure?')" name ="reject" class="save-feedback-button">Reject</button>
                        <button onclick="return confirm('Are you sure?')" name ="accept"  class="reply-feedback-button">Accept</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>


    </div>
</body>
</html>