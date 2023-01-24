import { API_LOGIN_URL } from "./config.js";

const formLogin = document.querySelector('#formLogin');



formLogin.addEventListener('submit', (e) => {
    e.preventDefault();

    const datosForm = new FormData(formLogin);
    const email = document.getElementById('email').value;
    localStorage.setItem('usuario', email );

    /*let request = */fetch(API_LOGIN_URL, {
        method: "POST",
        body: datosForm
    })
    .then(resp => resp.text())
    .then(data => {const val = JSON.parse(data);
    if (val.Resultado === true){
        console.log(val.Resultado);
        //sessionStorage.getItem('usuario');
        //document.querySelector('.mensaje').innerHTML = val.Mensaje;
        window.location.replace("inicio.html");
        

    } else{
        
        //alert(val.Mensaje);
        document.querySelector('.mensaje').innerHTML = val.Mensaje
    }
    
    })
    
})