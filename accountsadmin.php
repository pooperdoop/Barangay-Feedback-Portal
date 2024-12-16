<?php

session_start();
include("all_usersdb.php"); 
include_once("functions.php");
$user_data = check_login($con);

if(checkUser($con)){
    header("Location: allFeedbackAdmin");
}

$user = $user_data['id'];
if(isset($_POST['view_btn'])){

    $value = $_POST['view_btn'];
    $_SESSION['account_view'] = $value;
    switchTab($value, $con);

}

if(isset($_POST['all'])){
    $sql = "UPDATE all_users SET acc_view = '0' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
if(isset($_POST['verifiedoff'])){
    $sql = "UPDATE all_users SET acc_view = '1' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
if(isset($_POST['users'])){
    $sql = "UPDATE all_users SET acc_view = '2' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
if(isset($_POST['unverifiedoff'])){
    $sql = "UPDATE all_users SET acc_view = '3' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
if(isset($_POST['unverifieduser'])){
    $sql = "UPDATE all_users SET acc_view = '4' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
if(isset($_POST['verifieduser'])){
    $sql = "UPDATE all_users SET acc_view = '5' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
if(isset($_POST['official'])){
    $sql = "UPDATE all_users SET acc_view = '6' WHERE id = '$user'";
    mysqli_query($con, $sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barangay Feedback Portal</title>
    <link rel="stylesheet" href="css/accountsadmin.css?v=<?php echo time(); ?>"/>

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
                <li id="feedbackli" class="feedbackli"><img src="Icons/transfer1.png" id="feedback-img" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
<?php
if(!checkUser($con)){echo'
                <li id="accountsli"  class="accountsli"><img src="Icons/account2.png" id="accounts-img" alt="accounts"><a style="color:#1814F3;" href="accountsadmin.php"><i class="but accounts"></i>Accounts</a></li>';
            }
?>
                <li id="settingsli" class="settingsli"><img src="Icons/settings1.png" id="settings-img" alt="settings"><a href="profileeditadmin.php "><i class="but settings"></i>Settings</a></li>
                <li id ="logoutli" class ="logoutli"><img src="Icons/logout1.png" id="logout-img" alt="logout"><a><i class="but logout">Log Out</a></li>
           

            </ul>
        </div>
        <div class="main_content">

            <div class="header">
                <div>
                    <h2 id='secret_switch' name="accounts">Accounts</h2>
                </div>

                <div>
                    <p id='secret_logout'>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>

            <div>
                <form action="accountsadmin.php" method="post">
                <div class="buttons" style="margin-left: 20px;">   
                    <button name = 'all'>All Accounts</button>
                    <button name = 'verifiedoff'>Verified Officials</button>
                    <button name = 'unverifiedoff'>Unverified Officials</button>
                    <button name = 'verifieduser'>Verified Residents</button>
                    <button name = 'unverifieduser'>Unverified Residents</button>
                    <button name = 'users'>Users</button>
                    <button name = 'official'>Officials</button>
                </div>
                </form>
                
                <section class="feedback-section" >
                    <form action="accountsadmin.php" method="post">
                    <table>
                        <thead>
                            <tr>
                                <th class = "thname">Name</th>
                                <th  class = "thuser">User No.</th>
                                <th class = "thtype">Type</th>
                                <th class = "thpos">Position</th>
                                <th class = "date">Date</th>
                                <th class = "thbarangay">Barangay</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php

            
                        $initalcheck = "SELECT * FROM all_users WHERE id = '$user'";
                        $initialresult = mysqli_query($con, $initalcheck);

                        if(mysqli_num_rows($initialresult)>0){

                            $feedbackView = mysqli_fetch_assoc($initialresult);
                            $currentView = $feedbackView['acc_view'];
                            $barangay = $feedbackView['barangay'];
                            $type = $feedbackView['type'];

                            if(  $currentView == 0){
                                if($type == "SuperAdmin"){
                            $sql = "SELECT * FROM all_users";
                            $result = mysqli_query($con, $sql);
                        }    else{
                                $sql = "SELECT * FROM all_users WHERE barangay = '$barangay'";
                                $result = mysqli_query($con, $sql);
                            }
                            while($row = mysqli_fetch_assoc($result)){
                            
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                               echo'<tr>
                               <td class ="thname">'.$name.'</td>
                               <td class = "thuser">'.$user_num.'</td>
                               <td class = "thtype">'.$row["type"].'</td>
                               <td class = "thpos">'.$row["position"].'</td>
                               <td class = "date">'.$row["date_time"].'</td>
                                   <td class = "thbarangay">'.$row["barangay"].'</td>
                                   <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                               </tr>';
                            }
                        }
                        if(  $currentView == 1){
                            if($type == "SuperAdmin"){
                                $sql = "SELECT * FROM all_users WHERE verified = 'yes' AND type = 'Official'";
                                $result = mysqli_query($con, $sql);
                            }    else{
                            $sql = "SELECT * FROM all_users WHERE verified = 'yes' AND barangay ='$barangay' AND type = 'Official'";
                            $result = mysqli_query($con, $sql); 
                        }
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                                echo'<tr>
                                <td class ="thname">'.$name.'</td>
                                <td class = "thuser">'.$user_num.'</td>
                                <td class = "thtype">'.$row["type"].'</td>
                                <td class = "thpos">'.$row["position"].'</td>
                                <td class = "date">'.$row["date_time"].'</td>
                                    <td class = "thbarangay">'.$row["barangay"].'</td>
                                    <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                                </tr>';
                             }
                        }
                        if(  $currentView == 2){
                            
                            if($type == "SuperAdmin"){
                                $sql = "SELECT * FROM all_users WHERE type = 'User'";
                                $result = mysqli_query($con, $sql);
                            }    else{
                            $sql = "SELECT * FROM all_users WHERE type = 'User' AND barangay = '$barangay'";
                            $result = mysqli_query($con, $sql);
                            }
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                                echo'<tr>
                                <td class ="thname">'.$name.'</td>
                                <td class = "thuser">'.$user_num.'</td>
                                <td class = "thtype">'.$row["type"].'</td>
                                <td class = "thpos">'.$row["position"].'</td>
                                <td class = "date">'.$row["date_time"].'</td>
                                    <td class = "thbarangay">'.$row["barangay"].'</td>
                                    <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                                </tr>';
                             }
                        }
                        if(  $currentView == 3){
                            
                            if($type == "SuperAdmin"){
                                $sql = "SELECT * FROM all_users WHERE verified = 'no' AND type = 'Official'";
                                $result = mysqli_query($con, $sql);
                            }    else{
                            $sql = "SELECT * FROM all_users WHERE verified = 'no' AND barangay ='$barangay' AND type = 'Official'";
                            $result = mysqli_query($con, $sql);
                            }
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                                echo'<tr>
                                <td class ="thname">'.$name.'</td>
                                <td class = "thuser">'.$user_num.'</td>
                                <td class = "thtype">'.$row["type"].'</td>
                                <td class = "thpos">'.$row["position"].'</td>
                                <td class = "date">'.$row["date_time"].'</td>
                                    <td class = "thbarangay">'.$row["barangay"].'</td>
                                    <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                                </tr>';
                             }
                        }
                        if(  $currentView == 4){
                            
                            if($type == "SuperAdmin"){
                                $sql = "SELECT * FROM all_users WHERE verified = 'yes' AND type = 'User'";
                                $result = mysqli_query($con, $sql);
                            }    else{
                            $sql = "SELECT * FROM all_users WHERE verified = 'no' AND barangay ='$barangay' AND type = 'User'";
                            $result = mysqli_query($con, $sql);
                            }
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                                echo'<tr>
                                <td class ="thname">'.$name.'</td>
                                <td class = "thuser">'.$user_num.'</td>
                                <td class = "thtype">'.$row["type"].'</td>
                                <td class = "thpos">'.$row["position"].'</td>
                                <td class = "date">'.$row["date_time"].'</td>
                                    <td class = "thbarangay">'.$row["barangay"].'</td>
                                    <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                                </tr>';
                             }
                        }
                        if(  $currentView == 5){
                            
                            if($type == "SuperAdmin"){
                                $sql = "SELECT * FROM all_users WHERE verified = 'no' AND type = 'User'";
                                $result = mysqli_query($con, $sql);
                            }    else{
                            $sql = "SELECT * FROM all_users WHERE verified = 'no' AND barangay ='$barangay' AND type = 'User'";
                            $result = mysqli_query($con, $sql);
                            }
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                                echo'<tr>
                                <td class ="thname">'.$name.'</td>
                                <td class = "thuser">'.$user_num.'</td>
                                <td class = "thtype">'.$row["type"].'</td>
                                <td class = "thpos">'.$row["position"].'</td>
                                <td class = "date">'.$row["date_time"].'</td>
                                    <td class = "thbarangay">'.$row["barangay"].'</td>
                                    <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                                </tr>';
                             }
                        }
                        if(  $currentView == 6){
                            
                            if($type == "SuperAdmin"){
                                $sql = "SELECT * FROM all_users WHERE type = 'official'";
                                $result = mysqli_query($con, $sql);
                            }    else{
                            $sql = "SELECT * FROM all_users WHERE type = 'official' AND barangay ='$barangay'";
                            $result = mysqli_query($con, $sql);
                            }
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                                echo'<tr>
                                <td class ="thname">'.$name.'</td>
                                <td class = "thuser">'.$user_num.'</td>
                                <td class = "thtype">'.$row["type"].'</td>
                                <td class = "thpos">'.$row["position"].'</td>
                                <td class = "date">'.$row["date_time"].'</td>
                                    <td class = "thbarangay">'.$row["barangay"].'</td>
                                    <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
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

            
    </div>

</body>
</html>
<script src = "script.js"></script>
<script>

<?php
if(!checkUser($con))
{echo'
    const accountsLi = document.getElementById("accountsli");
const accountsImg = document.getElementById("accounts-img");';
}
?>


const homeLi = document.getElementById("homeli");
const feedbackLi = document.getElementById("feedbackli");

const settingsLi = document.getElementById("settingsli")
const logoutLi = document.getElementById("logoutli");

const homeImg = document.getElementById("home-img");
const feedbackImg = document.getElementById("feedback-img");

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

feedbackLi.addEventListener("mouseenter", () => {
    feedbackImg.src = feedbackHover; // Change the image on hover
});
feedbackLi.addEventListener("mouseleave", () => {
    feedbackImg.src = "Icons/transfer1.png"; // Reset image when hover ends
});

// accountsLi.addEventListener("mouseenter", () => {
//     accountsImg.src = accountsHover; // Change the image on hover
// });
// accountsLi.addEventListener("mouseleave", () => {
//     accountsImg.src = "Icons/account1.png"; // Reset image when hover ends
// });

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