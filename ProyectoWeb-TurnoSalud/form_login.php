<?php
session_start();

// Predefinir variables de sesión para prueba


if (isset($_POST['fechaSeleccionada'])) {
    $_SESSION['fecha-turno'] = $_POST['fechaSeleccionada'];
    $_SESSION['hora-turno'] = $_POST['horaSeleccionada'];
}

if (isset($_SESSION['id_paciente']) && !isset($_POST['fechaSeleccionada'])) {
    header("Location: ./paciente/perfil_paciente.php");
    exit();
}

if (isset($_SESSION['id_doctor']) && !isset($_POST['fechaSeleccionada'])) {
    header("Location: ./doctor/perfil_doctor.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TurnoSalud | Ingresar</title>
    <link rel="icon" type="image/svg+xml" href="./assets/Logos_Iconos/ts-icono.webp" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/login.css" />
    <link rel="stylesheet" href="./styles/header.css" />
    <link rel="stylesheet" href="./styles/footer.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#form-login").on("submit", function(event) {
                event.preventDefault();
                var data = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "./login.php",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    success: function(respuestaDelServer) {
                        var objJson = JSON.parse(respuestaDelServer);
                        if (objJson.success) {
                            window.location.href = objJson.redirect;
                        } else {
                            alert(objJson.message);
                            $("#form-login")[0].reset();
                        }
                    },
                    error: function(error) {
                        alert("Ocurrió un error: " + error.statusText);
                    }
                });
            });
        });
    </script>
</head>


<body>
    <header>
        <nav>
            <ul class="menu">
                <li class="logo">
                    <a href="index.html"><img src="./assets/Logos_Iconos/logo-turnosalud.webp" alt="logo-turnosalud" class="logo-ts" /></a>
                </li>
                <li class="item"><a href="index.html">Inicio</a></li>
                <li class="item has-submenu">
                    <a tabindex="0">Registrarme</a>
                    <ul class="submenu">
                        <li class="subitem">
                            <a href="./registrarme_dr.html">Soy especialista</a>
                        </li>
                        <li class="subitem">
                            <a href="./registrarme_paciente.html">Soy Paciente</a>
                        </li>
                    </ul>
                </li>
                <li class="item"><a href="./form_login.php">Ingresar</a></li>
                <li class="item"><a href="./contacto/contacto.html">Contacto</a></li>
                <li class="toggle">
                    <a href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="contenedor-login">
            <p class="subtitulo">Ingresá a tu cuenta</p>
            <form id="form-login" method="post">
                <div class="grupo">
                    <label for="usuario"> Nombre de usuario </label>
                    <input type="text" name="usuario" required placeholder="Ingresá tu usuario" />
                </div>
                <div class="grupo">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" required placeholder="Ingresá tu contraseña" />
                    <a class="link" href="">Olvidé mi contraseña</a>
                </div>
                <button id="botonIngresar" type="submit">Ingresar</button>
                <button id="botonRegistrarmePaciente" type="button" onclick="window.location.href='registrarme_paciente.html';">Registrarme paciente</button>
                <button id="botonRegistrarme" type="button" onclick="window.location.href='registrarme_dr.html';">Registrarme especialista</button>
            </form>
        </div>
    </main>
    <footer>
        <div class="contenedor-footer">
            <h3>Acerca de nosotros</h3>
            <a href="#">Sobre Nosotros</a>
            <a href="#">Términos y condiciones</a>
            <a href="#">Protección de datos</a>
        </div>
        <div class="contenedor-footer">
            <h3>Especialidades</h3>
            <a href="#">Terapias alternativas</a>
            <a href="#">Medicina Tradicional</a>
            <a href="#">Protección de datos</a>
        </div>
        <div class="contenedor-footer">
            <h3>Contacto</h3>
            <a href="tel:1122334455">11 22334455</a>
            <a href="mailto:info@turnosalud.com.ar">info@turnosalud.com.ar</a>
        </div>
        <div class="footer-logo">
            <a href="index.html">
                <img src="./assets/Logos_Iconos/logo-turnosalud.webp" alt="logo-turnosalud" />
            </a>
        </div>
        <p>Copyright &copy; 2024 TurnoSalud / Todos los derechos reservados</p>
    </footer>
    <script src="./scripts/index.js" type="text/javascript"></script>
</body>

</html>