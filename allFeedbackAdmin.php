
<?php

session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);
$user = $user_data['id'];

$changeView;

if(isset($_POST['all'])){
    $sql = "UPDATE all_users SET feedback_view = '0' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
elseif(isset($_POST['comp'])){
    $sql = "UPDATE all_users SET feedback_view = '1' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
elseif(isset($_POST['req'])){
    $sql = "UPDATE all_users SET feedback_view = '2' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
elseif(isset($_POST['sug'])){
    $sql = "UPDATE all_users SET feedback_view = '3' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
elseif(isset($_POST['open'])){
    $sql = "UPDATE all_users SET feedback_view = '4' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
elseif(isset($_POST['cld'])){
    $sql = "UPDATE all_users SET feedback_view = '5' WHERE id = '$user'";
    mysqli_query($con, $sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barangay Feedback Portal</title>
    <link rel="stylesheet" href="home.css"/>
    <link rel="stylesheet" href="addfeedbackuser.css"/>
    <link rel="stylesheet" href="settings.css"/>
    <link rel="stylesheet" href="allFeedback.css"/>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" />
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
            <form action="allFeedbackAdmin.php" method="post">
            <div class="buttons" style="margin-left: 20px;">   
                <button name = "all">All Feedbacks</button>
                <button name = "comp">Complaints</button>
                <button name = "req">Request</button>
                <button name = "sug">Suggestions</button>
                <button name = "open">Open</button>
                <button name = "cld">Closed</button>
            </div>
            </form>

            <section class="feedback-section" style="margin-left: 20px;">

            <form action="viewticketadmin.php" method="post">
                <table>
                    <thead>
                        <tr>
                            <th id="test">Title</th>
                            <th>Ticket ID</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php

            
            $initalcheck = "SELECT * FROM all_users WHERE id = '$user'";
            $initialresult = mysqli_query($con, $initalcheck);

            if(mysqli_num_rows($initialresult)>0){

                $feedbackView = mysqli_fetch_assoc($initialresult);
                $currentView = $feedbackView['feedback_view'];

                if($currentView == 0){
$sql = "SELECT * FROM all_feedback";
$result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_assoc($result)){

                echo'<tr id="all_feedback" >
                    <td>'.$row["title"].'</td>
                    <td> #'.$row["ticketID"].'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["date"].'</td>
                        <td>'.$row["status"].'</td>
                        <td>'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            }
            elseif($currentView == 1){

$sql2 = "SELECT * FROM all_feedback WHERE type = 'Complaint'";
$result2 = mysqli_query($con, $sql2);

            while($row = mysqli_fetch_assoc($result2)){

                echo'<tr id="complaints">
                    <td>'.$row["title"].'</td>
                    <td> #'.$row["ticketID"].'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["date"].'</td>
                        <td>'.$row["status"].'</td>
                        <td>'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            }
            elseif($currentView == 2){
$sql3 = "SELECT * FROM all_feedback WHERE type = 'Request'";
$result3 = mysqli_query($con, $sql3);

            while($row = mysqli_fetch_assoc($result3)){

                echo'<tr id="requests">
                    <td>'.$row["title"].'</td>
                    <td> #'.$row["ticketID"].'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["date"].'</td>
                        <td>'.$row["status"].'</td>
                        <td>'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            }
            elseif($currentView == 3){
$sql4 = "SELECT * FROM all_feedback WHERE type = 'Suggestion'";
$result4 = mysqli_query($con, $sql4);

            while($row = mysqli_fetch_assoc($result4)){

                echo'<tr id="suggestions">
                    <td>'.$row["title"].'</td>
                    <td> #'.$row["ticketID"].'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["date"].'</td>
                        <td>'.$row["status"].'</td>
                        <td>'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            }
            elseif($currentView == 4){
$sql5 = "SELECT * FROM all_feedback WHERE status = 'Open'";
$result5 = mysqli_query($con, $sql5);

            while($row = mysqli_fetch_assoc($result5)){

                echo'<tr id="open">
                    <td>'.$row["title"].'</td>
                    <td> #'.$row["ticketID"].'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["date"].'</td>
                        <td>'.$row["status"].'</td>
                        <td>'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            }
            elseif($currentView == 5){
$sql6 = "SELECT * FROM all_feedback WHERE status = 'Closed'";
$result6 = mysqli_query($con, $sql6);

            while($row = mysqli_fetch_assoc($result6)){

                echo'<tr id="closed">
                    <td>'.$row["title"].'</td>
                    <td> #'.$row["ticketID"].'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["date"].'</td>
                        <td>'.$row["status"].'</td>
                        <td>'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            }

            }
                ?>

                    </tbody>
                </table>
                </form>
            </section>
    </div>

</body>
</html>