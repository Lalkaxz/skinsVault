const submitApi = document.querySelector("submitApi");
const inputToken = document.getElementById("inputToken");
const formApi = document.getElementById("formApi");


function getCookie(name) {
    let cookie = document.cookie.split('; ').find(row => row.startsWith(name + '='));
    return cookie ? cookie.split('=')[1] : null;
}

function tokenNonEntered() {
    alert("Вы не ввели токен, сделать это можно в профиле");
}

function changeSkin(src) {

    tokenCookie = getCookie("token");
    if(tokenCookie == "null") {
        tokenNonEntered();
        return;
    }    
    fetch("https://fdapi.frogdream.xyz/skin", {
        method: 'PUT',
        headers: {
          'Content-Type': 'text/plain',
          'Authorization': `Bearer ${tokenCookie}`
        },
        body: `${src}`,
            }
        )

}



