var campos = [
    { input: document.querySelector('input[name="nombre"]'), regex: /^[A-Za-z]+\s[A-Za-z]+$/, mensajeError: document.getElementById("mensajeErrorNombre") },
    { input: document.querySelector('input[name="correo"]'), regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, mensajeError: document.getElementById("mensajeError") },
    { input: document.querySelector('input[name="password'), regex: }
];

var botonEnviar = document.getElementById("btn_sb");
var inputValido = {};

function validarCampo(inputData) {
    var valor = inputData.input.value;

    if (inputData.regex.test(valor)) {
        inputData.mensajeError.textContent = "";
        inputValido[inputData.input.name] = true;
    } else {
        inputData.mensajeError.textContent = "Formato incorrecto.";
        inputValido[inputData.input.name] = false;
    }
}

function mostrarMensajeError(inputData) {
    if (!inputValido[inputData.input.name]) {
        inputData.mensajeError.textContent = "Por favor, ingrese un valor válido.";
    } else {
        inputData.mensajeError.textContent = "";
    }
}

function validarFormulario() {
    var formularioValido = Object.values(inputValido).every(function (valido) {
        return valido;
    });

    botonEnviar.disabled = !formularioValido;
}

campos.forEach(function (campo) {
    campo.input.addEventListener("input", function () {
        validarCampo(campo);
        validarFormulario();
    });

    campo.input.addEventListener("blur", function () {
        mostrarMensajeError(campo);
    });
});

campos.forEach(function (campo) {
    campo.input.addEventListener("blur", function () {
        mostrarMensajeError(campo);
    });
});
