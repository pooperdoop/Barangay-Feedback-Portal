// Get the list items
const homeLi = document.getElementById("home");
const feedbackLi = document.getElementById("feedback");
const accountsLi = document.getElementById("accounts");
const settingsLi = document.getElementById("settings");
const logoutLi = document.getElementById("logout");

// Get the images by their IDs
const homeImg = document.getElementById("home-img");
const feedbackImg = document.getElementById("feedback-img");
const accountsImg = document.getElementById("accounts-img");
const settingsImg = document.getElementById("settings-img");
const logoutImg = document.getElementById("logout-img");

// Define the hover images
const homeHover = "Icons/home2.png";
const feedbackHover = "Icons/transfer2.png";
const accountsHover = "Icons/account2.png";
const settingsHover = "Icons/settings2.png";
const logoutHover = "Icons/logout2.png";

// Add event listeners for hover effect on each li
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

accountsLi.addEventListener("mouseenter", () => {
    accountsImg.src = accountsHover; // Change the image on hover
});
accountsLi.addEventListener("mouseleave", () => {
    accountsImg.src = "Icons/account1.png"; // Reset image when hover ends
});

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
