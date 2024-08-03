let signUpForm = document.querySelector(".SignUp");
let logInForm = document.querySelector(".LogIn")

let linkLogin = document.getElementById("LoginAccount");
let linkSignUp = document.getElementById("SignUpAccount");

linkLogin.addEventListener("click", (e) => {
    e.preventDefault();
    if (signUpForm.style.display == "block") {
        signUpForm.style.display = "none";
        logInForm.style.display = "block";
    } else {
        signUpForm.style.display = "block";
        logInForm.style.display = "none";
    }
})

linkSignUp.addEventListener("click", (e) => {
    e.preventDefault();
    if (logInForm.style.display == "block") {
        logInForm.style.display = "none";
        signUpForm.style.display = "block";
    } else {
        logInForm.style.display = "block";
        signUpForm.style.display = "none";
    }
})

