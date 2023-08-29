function validar() {
    var validProveedor = validarProveedor();
    var validCedula = validarCedula();
    var validNombre = validarNombre();
    var validTelefono = validarTelefono();
    var validCorreo = validarCorreo();
    var validDireccion = validarDireccion();

    var submitButton = document.getElementById("btn_sb");
    submitButton.disabled = !(validProveedor && validCedula && validNombre && validTelefono && validCorreo && validDireccion);
}

function validarProveedor() {
    var proveedorInput = document.getElementById("proveedor");
    var mensajeErrorProveedor = document.getElementById("mensajeErrorProveedor");

    if (proveedorInput.value.trim() === "") {
        mensajeErrorProveedor.textContent = "El nombre del proveedor es obligatorio";
        return false;
    } else {
        mensajeErrorProveedor.textContent = "";
        return true;
    }
}

function validarCedula() {
    var cedulaInput = document.getElementById("cedula");
    var mensajeErrorCedula = document.getElementById("validationMessage");

    if (!/^[0-9]{7,10}$/.test(cedulaInput.value)) {
        mensajeErrorCedula.textContent = "El número de CI debe contener entre 7 y 10 dígitos";
        return false;
    } else {
        mensajeErrorCedula.textContent = "";
        return true;

    }
}

function validarNombre() {
    var nombreInput = document.getElementById("contacto");
    var mensajeErrorNombre = document.getElementById("mensajeErrorNombre");

    if (!/^[A-Za-z\s]+$/.test(nombreInput.value)) {
        mensajeErrorNombre.textContent = "Ingresa un nombre válido";
        return false;

    } else {
        mensajeErrorNombre.textContent = "";
        return true;

    }
}

function validarTelefono() {
    var telefonoInput = document.getElementById("telefono");
    var mensajeErrorTelefono = document.getElementById("mensajeErrorTelefono");

    if (!/^[0-9]+$/.test(telefonoInput.value)) {

        mensajeErrorTelefono.textContent = "Ingresa un número de teléfono válido";
        return false;
    } else {
        mensajeErrorTelefono.textContent = "";
        return true;

    }
}

function validarCorreo() {
    var correoInput = document.getElementById("correo");
    var mensajeErrorCorreo = document.getElementById("mensajeErrorCorreo");

    if (!/\S+@\S+\.\S+/.test(correoInput.value)) {
        mensajeErrorCorreo.textContent = "Ingresa un correo electrónico válido";
        return false;

    } else {
        mensajeErrorCorreo.textContent = "";
        return true;

    }
}

function validarDireccion() {
    var direccionInput = document.getElementById("direccion");
    var mensajeErrorDireccion = document.getElementById("mensajeErrorDireccion");

    if (direccionInput.value.trim() === "") {
        mensajeErrorDireccion.textContent = "La dirección es obligatoria";
        return false;

    } else {
        mensajeErrorDireccion.textContent = "";
        return true;

    }
}

validar();