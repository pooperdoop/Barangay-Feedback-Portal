<?php

session_start();
include("all_usersdb.php"); 
include_once("functions.php");
$user_data = check_login($con);
$user = $user_data['id'];

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
    <link rel="stylesheet" href="css/homeadmin.css?v=<?php echo time(); ?>"/>   

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" />

</head>
<body>
    
    <div class="wrapper">
    <?php  if(!checkUser($con)){ 
                echo'   
                <button id="add_notice" class="add-notices-btn" onclick="addNotice()"></button>';}      
                 ?>
        <div class= "filler"></div>
        <div class="sidebar">
        <div class="sidebar-header">
                <img src="Icons/brgy icon.png" alt="Barangay Icon" class="sidebar-icon">
                <h2>Barangay <br> Feedback <br> Portal</h2>
            </div>
            <ul>
            <li id="homeli" class="homeli"><img src="Icons/home2.png" id='home-img' alt="home"><a style="color:#1814F3;" href="homeadmin.php"><i class="buthome"></i>Home</a></li>
                <li id="feedbackli" class="feedbackli"><img src="Icons/transfer1.png" id="feedback-img" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
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
                    <h2 id='secret_switch' name="homes">Home</h2>
                </div>
                <div>
                    <p id='secret_logout'>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>

            <div class="buttons">
                <button class="notices-btn">Notices</button>


              </div>
            

            <section class="feedback-section">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="thtitle">Title</th>
                            <th class ="thdate">Date</th>
                            <th class = "thuser">User</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>         
                    <?php
                              $sql1 = "SELECT * FROM all_users WHERE ID = '$user'";
                              $result1 = mysqli_query($con, $sql1);
                              $row = mysqli_fetch_assoc($result1);
                              $barangay = $row['barangay'];
                              $type = $row['type'];
                              if($type == "SuperAdmin"){
                                $sql = "SELECT * FROM all_notice";
                                $result = mysqli_query($con, $sql);
                              } else{
                    $sql = "SELECT * FROM all_notice WHERE barangay = '$barangay'";
                    $result = mysqli_query($con, $sql);
                              }
                    while($row = mysqli_fetch_assoc($result)){

                        echo'<tr>
                        <td class="thtitle">'.$row["title"].'</td>
                           <td class ="thdate">'.$row["date"].'</td>
                            <td class = "thuser">'.$row["user"].'</td>

                             <td><form action = "homeadmin.php" method = "post" style = "display: inline-block">
                             <button value ='.$row["noticeID"].'  name ="view_btn" id="view_btn" class="view-btn">View</button>
                             </form>

                             <form action = "editnotice.php" method = "post" style = "display: inline-block">';
                             
                             if(!checkUser($con)){ 
                             echo '
                             <button value ='.$row["noticeID"].' 
                             class="edit-btn" name = "edit_btn" id="edit_btn" >Edit</button>';
                            }

                             echo'
                             </form>

                             </td>
                            </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </section>


    </div>
    </div>
</body>
</html>
<script src = "script.js"></script>
<script>

function addNotice(){

    window.location.href = 'addnotice.php';

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

// Add event listeners for hover effect on each li
// homeLi.addEventListener("mouseenter", () => {
//     homeImg.src = homeHover; // Change the image on hover
// });
// homeLi.addEventListener("mouseleave", () => {
//     homeImg.src = "Icons/home1.png"; // Reset image when hover ends
// });

feedbackLi.addEventListener("mouseenter", () => {
    feedbackImg.src = feedbackHover; // Change the image on hover
});
feedbackLi.addEventListener("mouseleave", () => {
    feedbackImg.src = "Icons/transfer1.png"; // Reset image when hover ends
});

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