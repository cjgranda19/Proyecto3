function validarCliente() {
    var validNombre = validarNombre();
    var validCedula = validarCedula();
    var validTelefono = validarTelefono();
    var validDireccion = validarDireccion();

    var submitButton = document.getElementById("btn_sb");
    submitButton.disabled = !(validNombre && validCedula && validTelefono && validDireccion);
}


function validarNombre() {
    var nombreInput = document.getElementById("nombre");
    var mensajeErrorNombre = document.getElementById("mensajeErrorNombre");

    var nombreRegExp = /^^[A-Za-z]+\s[A-Za-z]+$/;

    if (!nombreRegExp.test(nombreInput.value)) {
        mensajeErrorNombre.textContent = "Ingresa un nombre válido";
        return false;
    } else {
        mensajeErrorNombre.textContent = "";
        return true;
    }
}

function validarCedula() {
    var cedulaInput = document.getElementById("cedula");
    var mensajeErrorCedula = document.getElementById("mensajeErrorCedula");

    var cedulaRegExp = /^[0-9]{1,10}$/;

    if (!cedulaRegExp .test(cedulaInput.value)) {
        mensajeErrorCedula.textContent = "Ingresa una cédula valida";
        return false;
    } else {
        mensajeErrorCedula.textContent = "";
        return true;
    }
}

function validarTelefono() {
    var telefonoInput = document.getElementById("telefono");
    var mensajeErrorTelefono = document.getElementById("mensajeErrorTelefono");

    var telefonoRegExp = /^[0-9]{1,10}$/;


    if (!telefonoRegExp.test(telefonoInput.value)) {
        mensajeErrorTelefono.textContent = "Ingresa un número de teléfono válido";
        return false;
    } else {
        mensajeErrorTelefono.textContent = "";
        return true;
    }
}

function validarDireccion() {
    var direccionInput = document.getElementById("direccion");
    var mensajeErrorDireccion = document.getElementById("mensajeErrorDireccion");

    var direccionRegExp = /^^[A-Za-z]+\s$/;

    if (!direccionRegExp.test(direccionInput.value)) {
        mensajeErrorDireccion.textContent = "Ingresa una dirección válido";
        return false;
    } else {
        mensajeErrorDireccion.textContent = "";
        return true;
    }
}


validar();