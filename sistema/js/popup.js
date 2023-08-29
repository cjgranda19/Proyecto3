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

function loadPopupContent(contentUrl) {
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