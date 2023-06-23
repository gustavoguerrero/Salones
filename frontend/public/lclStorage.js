const lclStorage = localStorage.getItem('usuario'); 
if (localStorage.getItem('usuario')) window.location.replace("inicio.html");


const session = document.querySelector("#session");
console.log(session);

function cerrarSession(session) {
    
    session.localStorage.removeItem('usuario');
    window.location.replace("/");
}