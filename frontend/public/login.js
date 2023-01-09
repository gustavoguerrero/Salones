import { API_LOGIN_URL } from "./config.js";
const formLogin = document.querySelector('#formLogin');


formLogin.addEventListener('submit', (e) => {
    e.preventDefault();

    const datosForm = new FormData(formLogin);

    /*let request = */fetch(API_LOGIN_URL, {
        method: "POST",
        body: datosForm
    })
    .then(resp => resp.text())
    .then(data => {
        console.log(data);
    })
})


/*
window.onload = iniciar;

function iniciar(){
    let btnAgregar = document.getElementById("btnAgregar");
    btnAgregar.addEventListener("click", clickBtnAgregar)
}

function clickBtnAgregar() {
    let txtNota = document.getElementById("txtNota");

    localStorage.nota = txtNota.value;
    let divNotas = document.getElementById("divNotas");
    divNotas.innerHTML = txtNota.value;
    
}
*/