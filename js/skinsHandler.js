const modal = document.querySelector(".container");
const popUpContainer = document.querySelector("#popUpContainer")
const close = document.querySelector("button.close");
const addSkinButton = document.getElementById("addSkinButton");
const divSteve = document.getElementById("choiceSteve");
const divAlex = document.getElementById("choiceAlex");
const radioSteve = document.getElementById("radioSteve");
const radioAlex = document.getElementById("radioAlex");
const navigationBar = document.querySelector(".navigation");
const inputNick = document.getElementById("inputNick");
const clearBtn = document.querySelector(".clearFile");
const realInput = document.getElementById('inputSkin');



window.addEventListener("click", (e) => {
    if(modal.style.display == "block") {
        if(e.target != addSkinButton) {
            if (!(e.target).closest(".container")) {
                modal.style.display = "none";
                console.log("try close")
            }
        }
    }
})

const divSelect = document.querySelector(".divSelectForm");

divSteve.addEventListener("click", (e) => {
    radioSteve.checked = "True";
    divSelect.removeAttribute("validError");
})

divAlex.addEventListener("click", (e) => {
    radioAlex.checked = "True";
    divSelect.removeAttribute("validError");
})

addSkinButton.addEventListener("mouseenter", (e) => {
    e.target.style.backgroundColor = "rgb(29, 124, 93)";
})

addSkinButton.addEventListener("mouseleave", (e) => {
    e.target.style.backgroundColor = "rgb(30, 189, 136)";
})

addSkinButton.addEventListener("click", (e) => {
    modal.style.display = 'block';
    console.log("try open")
})

close.addEventListener("click", (e) => {
    modal.style.display = "none";
})


function showImageSkin(inp) {
    const showImg = document.getElementById("showImg");
    const divShowImg = document.getElementById("divShowImg");
    if(inp.files && inp.files[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
            showImg.src = e.target.result;
            divShowImg.style.display = "inline";
            
        }
        reader.readAsDataURL(inp.files[0]);
    } else {
        showImg.src = "";
        divShowImg.style.display = "none";
    }
}

function removeImageSkin() {
    const divShowImg = document.getElementById("divShowImg");
    const showImg = document.getElementById("showImg");
    
    realInput.value = "";
    showImg.src = "";
    divShowImg.style.display = "none";
    const fileName = realInput.value.split('\\').pop();
    document.querySelector('.input-file span').textContent = fileName || 'Upload skin';

}

clearBtn.addEventListener("click", (e) => {
    removeImageSkin();
})





realInput.addEventListener('change', (e) => {
    const fileName = realInput.value.split('\\').pop();
    if (realInput.value) {
        inputNick.setAttribute("disabled", "");
        inputNick.value = "";
        showImageSkin(realInput);
        } else {
            inputNick.removeAttribute("disabled");
            removeImageSkin();
        }
        document.querySelector('.input-file span').textContent = fileName || 'Upload skin';
        console.log(realInput.value);

})

inputNick.addEventListener("blur", (e) => {
    const inputBtn = document.querySelector(".input-file #inputSkin");
    if (inputNick.value.length != 0) {
        inputBtn.setAttribute("disabled", "");
        inputBtn.value = "";
    } else {
        inputBtn.removeAttribute("disabled");
    }
})




