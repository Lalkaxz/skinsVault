const delModal = document.querySelector(".delSkinContainer");
const RemoveButton = document.getElementById("delSkinButton");
const delInputID = document.getElementById("inputID");
const delForm = document.getElementById("formDelSkin");

const patID = /^[0-9]{1,9}$/;


function validWithPtrn(elem, ptrn) {
    return ptrn.test(elem.value);
}


window.addEventListener("click", (e) => {
    if(delModal.style.display == "block") {
        if(e.target != RemoveButton) {
            if (!(e.target).closest(".delSkinContainer")) {
                delModal.style.display = "none";
            }
        }
    }
})


RemoveButton.addEventListener("click", (e) => {
    delModal.style.display = "block";
})


const closeBtn = document.querySelector(".delSkinClose");
closeBtn.addEventListener("click", (e) => {
    delModal.style.display = "none";
})

delForm.addEventListener("submit", (e) => {
    if(!validWithPtrn(delInputID, patID)) {
        e.preventDefault();
        delInputID.setAttribute("validErr", "");
        console.log("error validation");
    } else {
        delInputID.removeAttribute("validErr");
    }
})