function openPopup() {
    var popupContainer = document.getElementById("popupContainer");
    var overlay = document.getElementById("overlay");

    popupContainer.style.display = "block";
    overlay.style.display = "block";
}

function closePopup() {
    var popupContainer = document.getElementById("popupContainer");
    var overlay = document.getElementById("overlay");

    popupContainer.style.display = "none";
    overlay.style.display = "none";
}

function as(contentUrl) {
    var popupContent = document.getElementById("popupContent");

    var xhr = new XMLHttpRequest();
    xhr.open("GET", contentUrl, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            popupContent.innerHTML = xhr.responseText;

            executeScripts(popupContent);

            openPopup();
        }
    };
    xhr.send();
}
function loadPopupContentFromLink(contentUrl) {
    var popupContent = document.getElementById("popupContent");

    var xhr = new XMLHttpRequest();
    xhr.open("GET", contentUrl, false);  // Cambia a carga síncrona
    xhr.send();

    if (xhr.readyState === 4 && xhr.status === 200) {
        popupContent.innerHTML = xhr.responseText;

        executeScripts(popupContent);

        openPopup();
    }
}

function executeScripts(container) {
    var scripts = container.getElementsByTagName("script");
    for (var i = 0; i < scripts.length; i++) {
        var script = scripts[i];
        var newScript = document.createElement("script");
        if (script.src) {
            newScript.src = script.src;
        } else {
            newScript.innerHTML = script.innerHTML;
        }
        container.appendChild(newScript);
        script.parentNode.removeChild(script);
    }
}


function populateFieldsProductos() {
    var selectedProductId = $("#producto").val();

    $.ajax({
        type: "POST",
        url: "ajax.php", // Ruta real hacia tu archivo ajax.php
        data: { action: "getProducts", id: selectedProductId },
        dataType: "json",
        success: function (response) {
            if (response.length > 0) {
                var product = response[0];
                $("#codproducto").val(product.codproducto);
                $("#proveedor").val(product.proveedor);
                $("#precio").val(product.precio);
                $("#cantidad").val(product.cantidad);
            }
        }
    });
}

function populateFieldsClientes() {
    var selectedClienteId = $("#cliente").val();

    $.ajax({
        type: "POST",
        url: "ajax.php", // Ruta real hacia tu archivo ajax.php
        data: { action: "getClientes", id_cliente: selectedClienteId },
        dataType: "json",
        success: function (response) {
            if (response.length > 0) {
                var cliente = response[0];
                $("#id_cliente").val(cliente.id_cliente);
                $("#nombre").val(cliente.nombre);
                $("#cedula").val(cliente.cedula);
                $("#telefono").val(cliente.telefono);
                $("#direccion").val(cliente.direccion);
            }
        }
    });
}


function populateFieldsUsers() {
    console.log("populateFieldsUsers() called");

    var selectedUsuarioId = $("#selectedUsuarioId").val();
    console.log("Selected Usuario ID:", selectedUsuarioId);

    $.ajax({
        type: "POST",
        url: "ajax.php", // Ruta real hacia tu archivo ajax.php
        data: { action: "getUsers", idusuario: selectedUsuarioId },
        dataType: "json",
        success: function (response) {
            console.log("AJAX Success:", response);

                var usuario = response;
                console.log("Usuario Data:", usuario);

                $("#idusuario").val(usuario.idusuario);
                $("#usuario").val(usuario.usuario);
                $("#usuario_input").val(usuario.usuario);
                $("#nombre").val(usuario.nombre);
                $("#correo").val(usuario.correo);
                $("#cargo").val(usuario.cargo);
                
            
        },
        error: function (error) {
            console.log("AJAX Error:", error);
        }
    });
}
