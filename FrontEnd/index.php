

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>

    // Función para manejar el formulario
    async function handleLogin(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de forma tradicional

          // Crear un objeto FormData con los datos del formulario
          const formData = new FormData(document.getElementById("loginForm"));

        console.log(formData);
        try {
            // Enviar datos al servidor con fetch
            const response = await fetch("http://localhost/Proyecto_bd_1/backEnd/login", {
                method: "POST",                
                body:formData,
            });

            // Obtener el JSON de la respuesta
            const data = await response.json(); 

            // Evaluar el status de la respuesta
            switch (data.status) {
                case 200:
                    alert("Inicio de sesión exitoso.");
                    // Redirigir a otra página (cambia la URL de acuerdo con tu necesidad)
                    window.location.href = "http://localhost/Proyecto_bd_1/FrontEnd/clientes.php"; // Cambia la URL de destino
                    break;

                case 401:
                    alert("Credenciales inválidas. Por favor, verifica tu usuario y contraseña.");
                    break;

                case 400:
                    alert("Faltan datos de inicio de sesión o los datos son incorrectos.");
                    break;

                case 405:
                    alert("Método no permitido. Por favor, utiliza el método adecuado.");
                    break;

                default:
                    alert("Error desconocido. Intenta nuevamente.");
                    break;
            }
        } catch (error) {
            // Manejo de errores en la conexión o en el código
            alert("Ocurrió un error al intentar iniciar sesión. Intenta nuevamente.");
            console.error(error);
        }
    }
</script>
    
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form id="loginForm">
        <label for="nombreUsuario">Usuario:</label>
        <input type="text" name="nombreUsuario" id="nombreUsuario" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <br>
        <button type="submit">Ingresar</button>
    </form>

    <script>
        // Asociar el evento submit al formulario
        document.getElementById("loginForm").addEventListener("submit", handleLogin);
    </script>
</body>
</html>
