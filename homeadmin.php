<?php

session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);

if(isset($_POST['view_btn'])){

    $notice = $_POST["view_btn"];
    $sql = "SELECT * FROM all_notice WHERE noticeID = '$notice'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0){

        $notice_data = mysqli_fetch_assoc($result);

        $ID = $notice_data['noticeID'];
        $title = $notice_data['title'];
        $link = $notice_data['link'];
        $barangay = $notice_data['barangay'];

        header("Location:".$link);
        die;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barangay Feedback Portal</title>
    <link rel="stylesheet" href="home.css"/>
    <link rel="stylesheet" href="addfeedbackuser.css"/>
    <link rel="stylesheet" href="settings.css"/>
    <link rel="stylesheet" href="homeadmin.css"/>

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

            <div class="buttons">
                <button class="notices-btn">Notices</button>
                <button id="add_notice" class="add-notices-btn" onclick="addNotice()">Add Notices</button>
            </div>
            

            <section class="feedback-section" style="margin-left: 20px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>User</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>         
                    <?php
                    $sql = "SELECT * FROM all_notice";
                    $result = mysqli_query($con, $sql);

                    while($row = mysqli_fetch_assoc($result)){

                        echo'<tr>
                        <td>'.$row["title"].'</td>
                           <td>'.$row["date"].'</td>
                            <td>'.$row["user"].'</td>

                             <td><form action = "homeadmin.php" method = "post" style = "display: inline-block">
                             <button value ='.$row["noticeID"].'  name ="view_btn" id="view_btn" class="view-btn">View</button>
                             </form>

                             <form action = "editnotice.php" method = "post" style = "display: inline-block"><button value ='.$row["noticeID"].' 
                             class="edit-btn" name = "edit_btn" id="edit_btn" >Edit</button>
                             </form>

                             </td>
                            </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </section>


    </div>

</body>
</html>


<script>

function addNotice(){

    window.location.href = 'addnotice.php';

}



</script>