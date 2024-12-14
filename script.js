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

document.getElementById("secret_switch").addEventListener("click", () => {

    var value = document.getElementById("secret_switch").getAttribute("name");

    if(value == "homes"){
        location.replace("allFeedbackAdmin.php");
    }
    if (value == "feedbacks") {
        if(document.getElementById("accountsli")){
            location.replace("accountsadmin.php");
        } else{
            location.replace("profileeditadmin.php");
        }
    } 
    if(document.getElementById("accountsli")){
    if(value == "accounts"){
        location.replace("profileeditadmin.php");
    }
}
if(value == "settings"){
    location.replace("homeadmin.php");
}

});



if(document.getElementById("accountsli")){
    document.getElementById("accountsli").addEventListener("click", () => {
        location.replace("accountsadmin.php");
    });
    
}

document.getElementById("secret_logout").addEventListener("click", () => {
    if( confirm("Are you sure you want to Log-out?")){
        location.replace("logout.php");
       } else{
        
       }
});


