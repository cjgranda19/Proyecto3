const elements = {
    nombre: {
        input: document.querySelector('input[name="nombre"]'),
        regex: /^[A-Za-z]+\s[A-Za-z]+$/,
        mensajeError: document.getElementById("mensajeErrorNombre"),
        errorMessages: {
            regex: "Formato incorrecto."
        }
    },
    correo: {
        input: document.querySelector('input[name="correo"]'),
        regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/,
        mensajeError: document.getElementById("mensajeError"),
        errorMessages: {
            regex: "Formato incorrecto."
        }
    },
    usuario: {
        input: document.querySelector('input[name="usuario"]'),
        regex: /^[a-z]+$/,
        mensajeError: document.getElementById("mensajeErrorUsuario"),
        errorMessages: {
            regex: "El usuario debe estar compuesto únicamente por letras minúsculas."
        }
    },
    clave: {
        input: document.querySelector('input[name="clave"]'),
        regex: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&.]{8,}$/,
        mensajeError: document.getElementById("mensajeErrorPassword"),
        errorMessages: {
            regex: "La contraseña debe tener al menos 8 caracteres y contener al menos una letra, un número y un carácter especial (@, $, !, %, *, #, ?, &, .)."
        }
    },
    proveedor: {
        input: document.querySelector('input[name="proveedor"]'),
        regex: /^[A-Za-z]+\s[A-Za-z]+$/,
        mensajeError: document.getElementById("mensajeErrorProveedor"),
        errorMessages: {
            regex: "La contraseña debe tener al menos 8 caracteres y contener al menos una letra, un número y un carácter especial (@, $, !, %, *, #, ?, &, .)."
        }
    }
};

const botonEnviar = document.getElementById("btn_sb");
const inputValido = {};

function validarCampo(inputData) {
    const valor = inputData.input.value;

    if (inputData.regex.test(valor)) {
        inputData.mensajeError.textContent = "";
        inputValido[inputData.input.name] = true;
    } else {
        inputData.mensajeError.textContent = inputData.errorMessages.regex;
        inputValido[inputData.input.name] = false;
    }
}

function mostrarMensajeError(inputData) {
    inputData.mensajeError.textContent = inputValido[inputData.input.name] ? "" : "Por favor, ingrese un valor válido.";
}

function validarFormulario() {
    const formularioValido = Object.values(inputValido).every(valido => valido);
    botonEnviar.disabled = !formularioValido;
}

Object.values(elements).forEach(campo => {
    campo.input.addEventListener("input", () => {
        validarCampo(campo);
        validarFormulario();
    });

    campo.input.addEventListener("blur", () => {
        mostrarMensajeError(campo);
    });
});
