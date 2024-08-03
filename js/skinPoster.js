const addSkinForm = document.getElementById("formAddSkin");
const addSkinInputs = document.querySelectorAll("[AddSkinInputs = '']");

const inputNameSkin = document.getElementById("nameSkin");
const inputRadioSteve = document.getElementById("radioSteve");
const inputRadioAlex = document.getElementById("radioAlex");

const inputFileSkin = document.getElementById("inputSkin");
let divOR = document.getElementById("divOR");
const inputNickName = document.getElementById("inputNick");

const patText = /^[a-zA-Z0-9_' "][a-zA-Z0-9-_\.' "]{1,14}$/;
const patNickName = /^[a-zA-Z0-9_][a-zA-Z0-9-_]{2,14}$/;


window.onload = function(e) {
    addSkinForm.reset();
    document.getElementById("formDelSkin").reset();
    document.getElementById("formApi").reset();
}
    


function ValidationWithPtrn(elem, pattern) {
    return pattern.test(elem.value);
}



inputFileSkin.addEventListener("change", (e) => {
    inputNickName.removeAttribute("validError");
    divOR.removeAttribute("validError");
})


inputNameSkin.addEventListener("blur", (e) => {
    if(!(ValidationWithPtrn(e.target, patText))) {
        console.log("failed validation inputNameSkin");
        inputNameSkin.setAttribute("validError", "");
    }
})


inputNameSkin.addEventListener("focus", (e) => {
    inputNameSkin.removeAttribute("validError");
})


inputNickName.addEventListener("blur", (e) => {
    if(!(ValidationWithPtrn(e.target, patNickName))) {
        console.log("failed validation inputNickName");
        inputNickName.setAttribute("validError", "");
    }
})


inputNickName.addEventListener("focus", (e) => {
    inputNickName.removeAttribute("validError");
})

addSkinForm.addEventListener("submit", (e) => {
    let divSelect = document.querySelector(".divSelectForm")
    divSelect.setAttribute("validError", "");
    divOR.removeAttribute("validError");
    let validRadio = false;
    for (let elem of addSkinInputs) {

        if (elem.id == "nameSkin") {
            if (!(ValidationWithPtrn(elem, patText))) {
                inputNameSkin.setAttribute("validError", "");
                console.log("failed validation inputNameSkin");
                e.preventDefault();
            } else {
                inputNameSkin.removeAttribute("validError");
                console.log("success validation inputNameSkin");
            }
        } else if (elem.className == "radioChoiceForm") {
            if (elem.checked) {
                divSelect.removeAttribute("validError");     
                validRadio = true; 
            }
        } else if (inputFileSkin.value == "" && !(ValidationWithPtrn(inputNickName, patNickName)) ) {
            e.preventDefault();
            divOR.setAttribute("validError", "");
            console.log("failed inputFile or inputNick validation");
        }
        

    }
    if (!(validRadio)) {
        e.preventDefault();
        console.log("failed radio inputs validation")
    }
})
