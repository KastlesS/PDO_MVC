let boton = document.getElementById("guardar");

boton.addEventListener("click",function(event){
    let usuario= document.getElementById("usuario").value;
    let nombre = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let error = "";
    let p = document.getElementById("error");

    if(!validarUsuario(usuario)){
        error+="Usuario introducido de manera errónea. \n";
        event.preventDefault();
        p.className="alert alert-danger visible";
    }else if(!validarNombre(nombre)){
        error+="Nombre introducido erróneo. \n";
        event.preventDefault();
        p.className="alert alert-danger visible";
    }else if(!validarEmail(email)){
        error+="Email incorrecto. \n";
        event.preventDefault();
        p.className="alert alert-danger visible";
    }
    p.innerHTML=error;
})

function validarUsuario(usuario){
    let exp = /^[A-Za-z0-9]{2,50}$/;
    return (exp.test(usuario));
}

function validarNombre(nombre){
    let exp = /^[A-Z][a-z]{1,20}/;
    return (exp.test(nombre)); 
}

function validarEmail(email){
    let exp = /^[A-Za-z0-9]+@gmail.com$/;
    return (exp.test(email));
}
