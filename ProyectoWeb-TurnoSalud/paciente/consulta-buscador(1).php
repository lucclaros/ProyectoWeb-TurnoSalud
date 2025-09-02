
<?php

session_start(); 

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TurnoSalud | Resultados de búsqueda</title>
    <link rel="icon" type="image/svg+xml" href="../assets/Logos_Iconos/ts-icono.webp" />
    <link rel="stylesheet" href="../styles/consulta_buscador.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/footer.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet" />
    <link rel="scripts" href="../scripts/index.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.7.2.js" integrity="sha256-FxfqH96M63WENBok78hchTCDxmChGFlo+/lFIPcZPeI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        /*AJAX*/
        $(document).ready(function() {
            getEspecialidades();
            getObrasSociales();
        });

        function getEspecialidades() {
            var objAjax = $.ajax({
                type: "post",
                url: "../helpers/getJsonEspecialidades.php",
                data: {},
                success: function(respuestaDelServer, estado) {
                    objJson = JSON.parse(respuestaDelServer);
                    objJson.especialidades.forEach(function(value) {
                        var objOption = document.createElement("option");
                        objOption.innerHTML = value.nombre.toUpperCase();
                        objOption.value = value.id_especialidad;

                        document.getElementById("especialidad").appendChild(objOption);
                    });
                },
            });
        }

        function getObrasSociales() {
            var objAjax = $.ajax({
                type: "post",
                url: "../helpers/getJsonObrasSociales.php",
                data: {},
                success: function(respuestaDelServer, estado) {
                    objJson = JSON.parse(respuestaDelServer);
                    objJson.obrasSociales.forEach(function(value) {
                        var objOption = document.createElement("option");
                        objOption.innerHTML = value.nombre.toUpperCase();
                        objOption.value = value.id_obra_social;

                        document.getElementById("obra_social").appendChild(objOption);
                    });
                },
            });
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <ul class="menu">
                <li class="logo">
                    <a href="../index.html"><img src="../assets/Logos_Iconos/logo-turnosalud.webp" alt="logo-turnosalud" class="logo-ts" /></a>
                </li>
                <li class="item"><a href="../index.html">Inicio</a></li>
                <li class="item has-submenu">
                    <a tabindex="0">Registrarme</a>
                    <ul class="submenu">
                        <li class="subitem">
                            <a href="../registrarme_dr.html">Soy especialista</a>
                        </li>
                        <li class="subitem">
                            <a href="../registrarme_paciente.html">Soy Paciente</a>
                        </li>
                    </ul>
                </li>
                <li class="item"><a href="../form_login.php">Ingresar</a></li>
                <li class="item"><a href="../contacto/contacto.html">Contacto</a></li>
                <li class="toggle">
                    <a href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="seccion-buscador" class="seccion-buscador">
            <form method="POST" action="./consulta-buscador.php" class="buscador-form">
                <div class="buscador-contenedor">
                    <select name="especialidad" id="especialidad" placeholder="Especialidad">
                        <option value="" disabled selected required>
                            Seleccione especialidad
                        </option>
                    </select>
                    <select name="obra_social" id="obra_social">
                        <option value="" disabled selected required>
                            Seleccione obra social
                        </option>
                    </select>
                </div>
                <div class="buscador-contenedor">
                    <input type="number" name="precio_minimo" id="precio_minimo" min="0"  placeholder="Precio mínimo" />

                    <input type="number" name="precio_maximo" id="precio_maximo" min="0"  placeholder="Precio máximo" />
                </div>
                <input type="submit" value="Buscar" class="boton-buscador" />
            </form>
        </section>

        <section>
            <div class="contenedor-cards">
                <?php
                include("conexion_bd.php");

                // Paso 1: Recopilar datos de búsqueda desde el formulario
                $especialidad = isset($_POST['especialidad']) ? $_POST['especialidad'] : '';
                $obra_social = isset($_POST['obra_social']) ? $_POST['obra_social'] : '';
                $precio_minimo = isset($_POST['precio_minimo']) ? $_POST['precio_minimo'] : '';
                $precio_maximo = isset($_POST['precio_maximo']) ? $_POST['precio_maximo'] : '';

                // Paso 3: Construir la consulta SQL con filtros
                $sql = "SELECT d.id_doctor, d.direccion, d.id_usuario, d.precio, u.imagen, u.nombre_usuario, u.apellido_usuario FROM doctores d INNER JOIN usuarios u ON d.id_usuario=u.id_usuario WHERE 1";
                
                if (!empty($especialidad)) {
                    $sql .= " AND id_especialidad = $especialidad";
                }


               

                if ($precio_minimo == 0) {
                    $precio_minimo = 10; // Sino no entra al proximo if
                }
                if (!empty($precio_minimo) && !empty($precio_maximo)) {
                    $sql .= " AND precio BETWEEN $precio_minimo AND $precio_maximo";
                }

                if (!empty($obra_social)) {
                    $sql .= " AND id_doctor IN 
                            (SELECT dob.id_doctor 
                            FROM doctores_obras_sociales dob
                            INNER JOIN obras_sociales ob ON dob.id_obra_social = ob.id_obra_social
                            WHERE ob.id_obra_social = '$obra_social')";
                }

                //echo $sql; //depuracion
                $resultado = mysqli_query($conn, $sql);    

                if ($resultado) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $texto = '<div class="card">';
                        $texto .= '<div class="head">';
                        $texto .= '<div class="circle"></div>';
                        $texto .= '<div class="img-medico">';
                        $texto .= '<img src="../uploads/' . $fila["imagen"] . '" alt="foto perfil" />';
                        $texto .= '</div>';
                        $texto .= '</div>';
                        $texto .= '<div class="descripcion">';
                        $texto .= '<h3>' . ucfirst($fila['nombre_usuario']) ." ".  ucfirst($fila["apellido_usuario"]) . '</h3>';
                        $texto .= '<h4>' . "ARS ".ucfirst($fila['precio']) . '</h4>';
                        $texto .= '</div>';
                        $texto .= '<form action="perfil_doctor_vista.php" method="post">';
                        $texto .= '<div class="contact">';
                        $texto .= '<input type="hidden" value="'.$fila['imagen'].'" name="imagen_doctor">';
                        $texto .= '<input type="hidden" value="'.$fila['id_doctor'].'" name="id_doctor">';
                        $texto .= '<input type="hidden" value="'.$fila['id_usuario'].'" name="id_usuario">';
                        $texto .= '<input type="hidden" value="'.$fila['nombre_usuario'].'" name="nombre_usuario">';
                        $texto .= '<input type="hidden" value="'.$fila['apellido_usuario'].'" name="apellido_usuario">';
                        $texto .= '<input type="hidden" value="'.$fila['direccion'].'" name="direccion">';
                        $texto .= '<input type="hidden" value="'.$fila['precio'].'" name="precio">';
                        $texto .= '<input class="boton-buscador" type="submit" value="Solicitar turno">';
                        $texto .= '</div>';
                        $texto .= '</form>';
                        $texto .= '</div>';
                        echo $texto;
                    }
                } else {
                    echo "Error al ejecutar la consulta: " . mysqli_error($conn);
                }
                //doctor_obra_social es una tabla ente droctor y obra social para marcar que un doctor puede tener varias obras socials asociadas

                ?>
            </div>
            </div>
        </section>
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
            <a href="../index.html">
                <img src="../assets/Logos_Iconos/logo-turnosalud.webp" alt="logo-turnosalud" />
            </a>
        </div>
        <p>Copyright &copy; 2024 TurnoSalud / Todos los derechos reservados</p>
    </footer>
    <script src="../scripts/index.js" type="text/javascript"></script>
</body>

</html>