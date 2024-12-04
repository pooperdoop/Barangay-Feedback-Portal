
<?php

session_start();
include("all_usersdb.php"); 
include_once("functions.php");
$user_data = check_login($con);
$user = $user_data['id'];

$changeView;

if(isset($_POST['all']) || isset($_POST['all_user'])  ){
    $sql = "UPDATE all_users SET feedback_view = '0' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
elseif(isset($_POST['comp']) || isset($_POST['sent'])){
    $sql = "UPDATE all_users SET feedback_view = '1' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
elseif(isset($_POST['req']) || isset($_POST['rec'])){
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
    <link rel="stylesheet" href="css/allFeedback.css?v=<?php echo time(); ?>"/>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" />
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
            <form action="allFeedbackAdmin.php" method="post">
            <div class="buttons">   

            <?php if(!checkUser($con)){
            echo' 
                <button name = "all" class="all_feed">All Feedbacks</button>
                <button name = "comp">Complaints</button>
                <button name = "req">Request</button>
                <button name = "sug">Suggestions</button>
                <button name = "open" class="all_feed">Open</button>
                <button name = "cld" class="all_feed">Closed</button>';}

                else{

            echo'
                  
                <button name = "all_user" class="all_feed">My Feedbacks</button>
                <button name = "sent" class="regular-button">Sent</button>
                <button name = "rec" class="regular-button">Received</button>
                <button type = "button" onclick = "addfeedback()"> Add Feedback</button>'
                ;}?>
            </div>
            </form>

            <section class="feedback-section">

            <form action="viewticketadmin.php" method="post">
                <table>
                    <thead>
                        <tr>
                            <th class="thtitle">Title</th>
                            <th class="thID">Ticket ID</th>
                            <th class= "thtype">Type</th>
                            <th class="thdate">Date</th>
                            <th class="thstat">Status</th>
                            <th class="thuser">User</th>
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
                $barangay = $feedbackView['barangay'];
if(!checkUser($con)){
                if($currentView == 0){
$sql = "SELECT * FROM all_feedback WHERE barangay = '$barangay'";
$result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_assoc($result)){

                echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["ticketID"].'</td>
                    <td class= "thtype">'.$row["type"].'</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">'.$row["status"].'</td>
                        <td class="thuser">'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
            }
            elseif($currentView == 1){

$sql2 = "SELECT * FROM all_feedback WHERE type = 'Complaint' AND barangay = '$barangay'";
$result2 = mysqli_query($con, $sql2);

            while($row = mysqli_fetch_assoc($result2)){
                echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["ticketID"].'</td>
                    <td class= "thtype">'.$row["type"].'</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">'.$row["status"].'</td>
                        <td class="thuser">'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
            }
            elseif($currentView == 2){
$sql3 = "SELECT * FROM all_feedback WHERE type = 'Request' AND barangay = '$barangay'";
$result3 = mysqli_query($con, $sql3);

            while($row = mysqli_fetch_assoc($result3)){

                echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["ticketID"].'</td>
                    <td class= "thtype">'.$row["type"].'</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">'.$row["status"].'</td>
                        <td class="thuser">'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
            }
            elseif($currentView == 3){
$sql4 = "SELECT * FROM all_feedback WHERE type = 'Suggestion' AND barangay = '$barangay'";
$result4 = mysqli_query($con, $sql4);

            while($row = mysqli_fetch_assoc($result4)){

                echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["ticketID"].'</td>
                    <td class= "thtype">'.$row["type"].'</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">'.$row["status"].'</td>
                        <td class="thuser">'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
            }
            elseif($currentView == 4){
$sql5 = "SELECT * FROM all_feedback WHERE status = 'Open' AND barangay = '$barangay'";
$result5 = mysqli_query($con, $sql5);

            while($row = mysqli_fetch_assoc($result5)){

                echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["ticketID"].'</td>
                    <td class= "thtype">'.$row["type"].'</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">'.$row["status"].'</td>
                        <td class="thuser">'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
            }
            elseif($currentView == 5){
$sql6 = "SELECT * FROM all_feedback WHERE status = 'Closed' AND barangay = '$barangay'";
$result6 = mysqli_query($con, $sql6);

            while($row = mysqli_fetch_assoc($result6)){
                echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["ticketID"].'</td>
                    <td class= "thtype">'.$row["type"].'</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">'.$row["status"].'</td>
                        <td class="thuser">'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
            }
        } else{
            if($currentView == 0){
                $sql = "SELECT * FROM all_feedback WHERE user_current = '$user'";
                $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){

                echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["ticketID"].'</td>
                    <td class= "thtype">'.$row["type"].'</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">'.$row["status"].'</td>
                        <td class="thuser">'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
            
                }
                $sql = "SELECT * FROM all_reply WHERE replyuser = '$user'";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)){

                    echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["replyID"].'</td>
                    <td class= "thtype">Reply</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">-</td>
                        <td class="thuser">'.$row["user"].'</td>        
                        <td><button value='.$row["replyID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
            }
            if($currentView == 1){

                $sql = "SELECT * FROM all_feedback WHERE user_current = '$user'";
                $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){

                echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["ticketID"].'</td>
                    <td class= "thtype">'.$row["type"].'</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">'.$row["status"].'</td>
                        <td class="thuser">'.$row["user"].'</td>
                        <td><button value='.$row["ticketID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
            }
            if($currentView == 2){
                $sql = "SELECT * FROM all_reply WHERE replyuser = '$user'";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo'<tr id="all_feedback" >
                    <td class="thtitle">'.$row["title"].'</td>
                    <td class="thID"> #'.$row["replyID"].'</td>
                    <td class= "thtype">Reply</td>
                    <td class="thdate">'.$row["date"].'</td>
                        <td class="thstat">-</td>
                        <td class="thuser">'.$row["user"].'</td>        
                        <td><button value='.$row["replyID"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                        </tr>';
                }
            
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