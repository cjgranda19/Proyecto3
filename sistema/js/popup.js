function openPopup() {
    console.log("Opening popup");
    var popupContainer = document.getElementById("popupContainer");
    var overlay = document.getElementById("overlay");

    popupContainer.style.display = "block";
    overlay.style.display = "block";
}

function closePopup() {
    console.log("Closing popup");
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
            openPopup();
        }
    };
    xhr.send();
}

function populateFields() {
    var selectedProductId = $("#producto").val();

    $.ajax({
        type: "POST",
        url: "ajax.php", // Replace with the actual path to your ajax.php file
        data: { action: "getProducts", id: selectedProductId },
        dataType: "json",
        success: function (response) {
            if (response.length > 0) {
                var product = response[0];
                $("#codproducto").val(product.codproducto);
                $("#proveedor").val(product.proveedor); // Corrected this line
                $("#precio").val(product.precio);
                $("#cantidad").val(product.cantidad);
            }
        }
    });
}