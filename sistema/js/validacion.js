var correoInput = document.getElementById("correo");
var mensajeError = document.getElementById("mensajeError");
var inputValido = false;

correoInput.addEventListener("input", function () {
    var correo = correoInput.value;
    var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (regex.test(correo)) {
        var dominio = correo.split('@')[1];
        if (dominio === 'gmail.com' || dominio === 'hotmail.com') {
            inputValido = true;
            mensajeError.textContent = "";
        } else {
            inputValido = false;
            mensajeError.textContent = "Por favor, ingrese un correo válido.";
        }
    } else {
        inputValido = false;
        mensajeError.textContent = "";
    }
});

correoInput.addEventListener("blur", function () {
    if (!inputValido) {
        mensajeError.textContent = "Por favor, ingrese un correo válido.";
    }
});
