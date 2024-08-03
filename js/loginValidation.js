let logininputs = document.querySelectorAll("[LoginInput = '']");
let loginform = document.getElementById("loginForm");
let loginName = document.getElementById("loginname");
let loginPass = document.getElementById("loginpass");
let pname = document.getElementById("LoginErrValidName");
let ppass = document.getElementById("LoginErrValidPass");

function loginPatternValidation(element) {
    const patText = /^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/;
    const patPass = /^[a-zA-Z0-9_]{3,20}$/;
if (element.id == "loginname") {
    console.log("start valid name")
    return patText.test(element.value);
} else if (element.id == "loginpass") {
    console.log("start valid")
    return patPass.test(element.value);
} }


loginName.addEventListener("blur", (e) => {

    if(!(loginPatternValidation(e.target))) {
        console.log(`Error pattern validation input: ${e.target.placeholder}`);
        pname.style.display = "block";
        e.target.setAttribute("LoginErrInput", "");
        
    } else {
        pname.style.display = "none";
        e.target.removeAttribute("LoginErrInput");
    }
})


loginName.addEventListener("focus", (e) => {
    pname.style.display = "none";
    e.target.removeAttribute("LoginErrInput");
})



loginPass.addEventListener("blur", (e) => {
    if(!(loginPatternValidation(e.target))) {
        console.log(`Error pattern validation input: ${e.target.placeholder}`);
        ppass.style.display = "block";
        e.target.setAttribute("LoginErrInput", "");
    } else {
        ppass.style.display = "none";
        e.target.removeAttribute("LoginErrInput");
    }
})


loginPass.addEventListener("focus", (e) => {
    ppass.style.display = "none";
    e.target.removeAttribute("LoginErrInput");
})


loginform.addEventListener("submit", (e) => {


    let pname = document.getElementById("LoginErrValidName");
    let ppass = document.getElementById("LoginErrValidPass");
    
    
    for (let elem of logininputs) {
        console.log(`Input value: ${elem.value} \n Input length: ${elem.value.length}`);
        if (!(loginPatternValidation(elem))) {
            e.preventDefault()
            console.log(`Инпут ${elem.placeholder} не прошёл валидацию!`);
            if (elem.id == "loginname") {
                pname.style.display = "block";
                elem.setAttribute("LoginErrInput", "");
            } else if (elem.id == "loginpass") {
                ppass.style.display = "block";
                elem.setAttribute("LoginErrInput", ""); 
            }
        } else {
            console.log(`Валидация инпута ${elem.placeholder} произошла успешна`)
            if (elem.id == "loginname") {
                pname.style.display = "none";
                elem.removeAttribute("LoginErrInput");
            } else if (elem.id == "loginpass") {
                ppass.style.display = "none";
                elem.removeAttribute("LoginErrInput");
            }
        }
    }
})



