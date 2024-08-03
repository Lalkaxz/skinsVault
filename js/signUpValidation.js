let registerForm =  document.getElementById("signUpForm");
let signUpInputs = document.querySelectorAll("[signUpInput = '']");

let signUpName = document.getElementById("inputname");
let signUpMail = document.getElementById("inputemail");
let signUpPass = document.getElementById("inputpass");
let signUpRepPass = document.getElementById("repeatpass");
let Spname = document.getElementById("NameErr");
let Spmail = document.getElementById("mailErr");
let Sppass = document.getElementById("PassErr");
let SpRepPass = document.getElementById("repeatPassErr");

function PatternValidation(element) {
    const patName = /^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/;
    const patPass = /^[a-zA-Z0-9_]{3,20}$/;
    const patMail = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

    if(element.id == "repeatpass") {
        console.log("start comparing passwords");
        if(element.value == "") return false;
        
        if(element.value != signUpPass.value) {
            return false;
        } else {
            return true;
        }
    } else if (element.id == "inputname") {
        console.log("start valid name")
        return patName.test(element.value)
    } else if (element.id == "inputemail") {
        console.log("start valid mail")
        return patMail.test(element.value) 
    } else if (element.id == "inputpass") {
        console.log("start valid password")
        return patPass.test(element.value)
    }
}


signUpName.addEventListener("blur", (e) => {
    if(!(PatternValidation(e.target))) {
        console.log(`Error ptrn valid input: ${e.target.placeholder}`)
        Spname.style.display = "block";
        e.target.setAttribute("signUpErrInput", "");
    } else {
        Spname.style.display = "none";
        e.target.removeAttribute("signUpErrInput");
    }
})


signUpName.addEventListener("focus", (e) => {
    Spname.style.display = "none";
    e.target.removeAttribute("signUpErrInput");
})



signUpMail.addEventListener("blur", (e) => {
    if(!(PatternValidation(e.target))) {
        console.log(`Error ptrn valid input: ${e.target.placeholder}`)
        Spmail.style.display = "block";
        e.target.setAttribute("signUpErrInput", "");
    } else {
        Spmail.style.display = "none";
        e.target.removeAttribute("signUpErrInput");
    }
})


signUpMail.addEventListener("focus", (e) => {
    Spmail.style.display = "none";
    e.target.removeAttribute("signUpErrInput");
})



signUpPass.addEventListener("blur", (e) => {
    if(!(PatternValidation(e.target))) {
        console.log(`Error ptrn valid input: ${e.target.placeholder}`);
        Sppass.style.display = "block";
        e.target.setAttribute("signUpErrInput", "");
    } else {
        Sppass.style.display = "none";
        e.target.removeAttribute("signUpErrInput");
        signUpRepPass.removeAttribute("disabled")
    }
})


signUpPass.addEventListener("focus", (e) => {
    Sppass.style.display = "none";
    e.target.removeAttribute("signUpErrInput");
    signUpRepPass.setAttribute("disabled", "")
})



signUpRepPass.addEventListener("blur", (e) => {
    if(!(PatternValidation(e.target))) {
        console.log(`Error comparing passwords`);
        SpRepPass.style.display = "block";
        e.target.setAttribute("signUpErrInput", "");
    } else {
        SpRepPass.style.display = "none";
        e.target.removeAttribute("signUpErrInput");
    }
})


signUpRepPass.addEventListener("focus", (e) => {
    SpRepPass.style.display = "none";
    e.target.removeAttribute("signUpErrInput")
})




registerForm.addEventListener("submit", (e) => {
    for (let elem of signUpInputs) {
        console.log(`Input value: ${elem.value} \n Input length: ${elem.value.length}`);
        if(!(PatternValidation(elem))) {
            e.preventDefault()
            console.log(`Инпут ${elem.placeholder} не прошёл валидацию!`);
            switch (elem.id) {
                case "inputname":
                    Spname.style.display = "block";
                    elem.setAttribute("signUpErrInput", "");
                    break;
                case "inputemail":
                    Spmail.style.display = "block";
                    elem.setAttribute("signUpErrInput", "");
                    break;
                case "inputpass":
                    Sppass.style.display = "block";
                    elem.setAttribute("signUpErrInput", "");
                    break;
                case "repeatpass":
                    SpRepPass.style.display = "block";
                    elem.setAttribute("signUpErrInput", "");
                    break;
            }
        } else {
            console.log(`Валидация инпута ${elem.placeholder} произошла успешна`);

        }
    }
})



