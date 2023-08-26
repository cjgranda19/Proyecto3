function submitForm() {
    var form = document.getElementById('popupForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'registro_producto.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                console.log(response);

                var popupResultado = document.getElementById('popupResultado');
                var popupContent = popupResultado.querySelector('.popup-content');

                if (response.trim() === 'Éxito') {
                    popupContent.innerHTML = 'Producto guardado correctamente.';
                } else if (response.trim() === 'Error') {
                    popupContent.innerHTML = 'Error al guardar el producto.';
                } else {
                    popupContent.innerHTML = 'Respuesta inesperada';
                }

                openPopup('popupResultado');

                // Cerrar automáticamente el pop-up después de 3 segundos
                setTimeout(function () {
                    closePopup('popupResultado');
                }, 3000);
            } else {
                // Manejar errores aquí
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };
    xhr.send(formData);
}