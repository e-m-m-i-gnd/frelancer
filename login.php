<?php
// Incluye el archivo de conexión a la base de datos
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($contraseña, $row["contraseña"])) {
            echo "Éxito";
        } else {
            echo "Error";
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
                        <!-- ... (código anterior) ... -->
                        <form class="user" id="loginForm">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="correo" placeholder="Correo electrónico" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="contraseña" placeholder="Contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Iniciar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ... (código posterior) ... -->

    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "login.php", // Ruta al archivo PHP para validar el inicio de sesión
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === "Éxito") {
                            window.location.href = "index.html"; // Redirige a la página de inicio después del inicio de sesión exitoso
                        } else {
                            alert("Error al iniciar sesión. Por favor, verifica tus credenciales.");
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
