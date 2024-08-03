const OpenProfileBtn = document.getElementById("ProfileButton");
const profileContainer = document.querySelector(".profileContainer");
const profileClose = document.querySelector(".profileClose");


window.addEventListener("click", (e) => {
    if(profileContainer.style.display == "block") {
        if(e.target != OpenProfileBtn) {
            if (!(e.target).closest(".profileContainer")) {
                profileContainer.style.display = "none";
            }
        }
    }
})

OpenProfileBtn.addEventListener("click", (e) => {
    profileContainer.style.display = "block";
})

profileClose.addEventListener("click", (e) => {
    profileContainer.style.display = "none";
})


