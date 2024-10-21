<?php
// Incluye el archivo de conexión a la base de datos
include("conexion.php");

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT); // Se utiliza password_hash para almacenar la contraseña de manera segura

    // Prepara la consulta SQL para insertar datos
    $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $nombre, $correo, $contraseña);

        if ($stmt->execute()) {
            echo "Registro exitoso. ¡Ahora puedes iniciar sesión!";
        } else {
            echo "Error al registrar datos: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WatchWisely - Registro</title>

    <!-- Agregamos jQuery para manejar el formulario de registro de manera más interactiva -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/styles.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" id="bg-image" style="background-image: url('images/movie-frame.png'); background-size: cover; background-position: center;"></div>
                            <script>
                                var bgImage = document.getElementById("bg-image");
                                var bgImages = [
                                    "images/movie-frame.png",
                                    "images/frame2.png",
                                    "images/tv.png"
                                ];
                                var currentImageIndex = 0;
                                function changeBackground() {
                                    currentImageIndex++;
                                    if (currentImageIndex >= bgImages.length) {
                                        currentImageIndex = 0;
                                    }
                                    bgImage.style.backgroundImage = "url('" + bgImages[currentImageIndex] + "')";
                                }
                                setInterval(changeBackground, 5000);
                            </script>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-secondary">¡Crea una cuenta con nosotros!</h1>
                                    </div>
                                    <form class="user" id="registroForm">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="nombre" placeholder="Ingresa tu nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="correo" placeholder="Ingresa un correo electrónico" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="contraseña" placeholder="Contraseña" minlength="12" >
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-user btn-block">Registrar cuenta</button>
                                    </form>
                                    <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i>Registrar con Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i>Registrar con Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            <div id="registroExitoso" style="display: none;">
                <div class="text-center">
                <h1 class="h4 text-success">¡Cuenta registrada con éxito!</h1>
                <p>Ahora puedes <a href="login.php">iniciar sesión</a>.</p>
                </div>
            </div>

            <script>
        $(document).ready(function() {
            $('#registroForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "registro.php", // Ruta al archivo PHP para procesar el registro
                    data: $(this).serialize(),
                    success: function(response) {
                        // Mostrar mensaje de registro exitoso
                        $('#registroExitoso').show();
                    }
                });
            });
        });
    </script>
            </div>
        </div>
    </div>

    <!-- Agregamos un script para manejar el envío del formulario de registro de manera asincrónica -->
    <script>
        $(document).ready(function() {
            $('#registroForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "registro.php", // Ruta al archivo PHP para procesar el registro
                    data: $(this).serialize(),
                    success: function(response) {
                        // Mostrar mensaje de registro exitoso o error en algún lugar de la página
                        console.log(response);
                    }
                });
            });
        });
    </script>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
