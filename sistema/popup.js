
function openPopup() {
    var popupContainer = document.getElementById("popupNuevoProducto");
    var overlay = document.getElementById("overlay");

    popupContainer.style.display = "block";
    overlay.style.display = "block";
}

function closePopup() {
    var popupContainer = document.getElementById("popupNuevoProducto");
    var overlay = document.getElementById("overlay");

    popupContainer.style.display = "none";
    overlay.style.display = "none";
}

function loadNuevoProductoPopup() {
    
    var popupContainer = document.getElementById("popupNuevoProducto");
    var popupContent = popupContainer.querySelector(".popup-content");

    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "registro_producto.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            popupContent.innerHTML = xhr.responseText;
            popupContainer.style.display = "block";
        }
    };
    xhr.send();
}

function loadIngresoProductoPopup() {
    var popupContainer = document.getElementById("popupIngresoProducto");
    var popupContent = popupContainer.querySelector(".popup-content");

    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "ingreso_producto.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            popupContent.innerHTML = xhr.responseText;
            popupContainer.style.display = "block";
        }
    };
    xhr.send();
}