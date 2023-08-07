    var correoInput = document.getElementById("correo");
    var mensajeError = document.getElementById("mensajeError");
    var botonEnviar = document.getElementById("btn_sb");
    var inputValido = false;

    correoInput.addEventListener("input", function () {
        var correo = correoInput.value;
        var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (regex.test(correo)) {
            var dominio = correo.split('@')[1];
            if (dominio === 'gmail.com' || dominio === 'hotmail.com') {
                inputValido = true;
                mensajeError.textContent = "";
                botonEnviar.disabled = false; // Habilitar el botón si el correo es válido
            } else {
                inputValido = false;
                mensajeError.textContent = "";
                botonEnviar.disabled = true; // Deshabilitar el botón si el dominio no es válido
            }
        } else {
            inputValido = false;
            mensajeError.textContent = "";
            botonEnviar.disabled = true; // Deshabilitar el botón si el formato de correo no es válido
        }
    });

    correoInput.addEventListener("blur", function () {
        if (!inputValido) {
            mensajeError.textContent = "Por favor, ingrese un correo válido.";
        }
    });


		function Letras(string) {//Solo letras
			var out = '';
			var filtro = 'qwertyuiopñlkjhgfdsazxcvbnmMNBVCXZÑLKJHGFDSAPOIUYTREWQáéíóúÁÉÍÓÚ ';//Caracteres validos

			//Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
			for (var i = 0; i < string.length; i++)
				if (filtro.indexOf(string.charAt(i)) != -1)
					//Se añaden a la salida los caracteres validos
					out += string.charAt(i);

			//Retornar valor filtrado
			return out;
		}

		function Caracteres(string) {//Solo numeros
			var out = '';
			var filtro = '1234567890qwertyuiopñlkjhgfdsazxcvbnm-_';//Caracteres validos

			//Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
			for (var i = 0; i < string.length; i++)
				if (filtro.indexOf(string.charAt(i)) != -1)
					//Se añaden a la salida los caracteres validos
					out += string.charAt(i);

			//Retornar valor filtrado
			return out;
		} 