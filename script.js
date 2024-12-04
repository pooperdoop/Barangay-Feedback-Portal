document.getElementById("homeli").addEventListener("click", () => {
   location.replace("homeadmin.php");
});

document.getElementById("feedbackli").addEventListener("click", () => {
    location.replace("allFeedbackAdmin.php");
});

document.getElementById("settingsli").addEventListener("click", () => {
    location.replace("profileeditadmin.php");
});

document.getElementById("logoutli").addEventListener("click", () => {
   if( confirm("Are you sure you want to Log-out?")){
    location.replace("logout.php");
   } else{
    
   }
   
});

if(document.getElementById("accountsli")){
    document.getElementById("accountsli").addEventListener("click", () => {
        location.replace("accountsadmin.php");
    });
    
}

