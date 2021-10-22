let btnConnect = document.querySelector('#btnConnect');
let logDiv = document.getElementById('loginDiv');
let btnDisconnect =document.getElementById('btnDisconnect');

btnConnect.addEventListener("click", startConnect);
btnDisconnect.addEventListener("click",disconnect);

/* Display form connection */
function startConnect() {
    logDiv.style.display = "flex";
}

/* Hide button disconnect */
function disconnect(){
   btnDisconnect.style.display = "none";
}