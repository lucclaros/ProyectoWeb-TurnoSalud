<?php
session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['id_paciente'])) {
    // Redirigir a index.php si no está iniciada la sesión
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> TurnoSalud | Mi Perfil</title>
    <link rel="icon" type="image/svg+xml" href="../assets/Logos_Iconos/ts-icono.webp" />
    <link rel="stylesheet" href="../styles/miPerfil.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.7.2.js" integrity="sha256-FxfqH96M63WENBok78hchTCDxmChGFlo+/lFIPcZPeI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        /*AJAX*/
        $(document).ready(function() {
            getTiposDeDocumento();
            getProvincias();
            getLocalidades();
            getObrasSociales();
            getDatosUsuario();
            deshabilitarFormulario();

            const selectObrasSociales = document.getElementById("id_obra_social");
            const inputAfiliado = document.getElementById("numero_afiliado");

            $("#id_obra_social").change(function() {
                /* selectObrasSociales.addEventListener("change", (event) => { */
                if ($("#id_obra_social option:selected").val() == "0") {
                    inputAfiliado.style.display = "none";
                    inputAfiliado.required = !inputAfiliado.required;
                } else {
                    inputAfiliado.style.display = "block";
                    inputAfiliado.required = !inputAfiliado.required;
                }
                /* }); */
            });

            function deshabilitarFormulario() {
                let form = document.getElementById('form-informacion');
                for (let i = 0; i < form.elements.length; i++) {
                    if (form.elements[i].tagName.toLowerCase() === 'select') {
                        form.elements[i].disabled = true;
                    } else {
                        form.elements[i].readOnly = true;
                    }
                }
                document.getElementById("file-input").disabled = true;
            }

            function habilitarFormulario() {
                let form = document.getElementById('form-informacion');
                for (let i = 0; i < form.elements.length; i++) {
                    if (form.elements[i].tagName.toLowerCase() === 'select') {
                        form.elements[i].disabled = false;
                    } else {
                        form.elements[i].readOnly = false;
                    }
                }
                document.getElementById("file-input").disabled = false;
            }

            $('#botonModificar').click(function() {
                document.getElementById("botonGuardar").disabled = false;
                document.getElementById("botonCancelar").disabled = false;
                document.getElementById("botonModificar").disabled = true;
                habilitarFormulario();
            });

            $('#botonCancelar').click(function() {
                document.getElementById("botonGuardar").disabled = true;
                document.getElementById("botonCancelar").disabled = true;
                document.getElementById("botonModificar").disabled = false;
                deshabilitarFormulario();
                location.reload();
            });

            var form = document.getElementById("form-informacion");

            form.addEventListener("submit", function(event) {
                event.preventDefault();
                
                var data = new FormData(form);

                $.ajax({
                    type: "POST", // Especifica el método POST
                    url: "./updateDatosPaciente.php",
                    processData: false,
                    contentType: false,
                    enctype: "multipart/form-data",
                    cache: false,
                    data: data,
                    success: function(respuestaDelServer) {
                    
                        deshabilitarFormulario();
                        document.getElementById('file-input').value="";
                        alert(respuestaDelServer);
                        /* form.reset(); */

                    },
                    error: function(error) {
                        alert("Ocurrió un error: " + error.statusText);
                    },
                });

            });

            $('#botonGuardar').click(function() {
                document.getElementById('form-informacion').requestSubmit();
            });

        });

        function getTiposDeDocumento() {
            var objAjax = $.ajax({
                type: "post",
                url: "../helpers/getJsonTiposDocumento.php",
                data: {},
                success: function(respuestaDelServer, estado) {
                    objJson = JSON.parse(respuestaDelServer);
                    objJson.especialidades.forEach(function(value) {
                        var objOption = document.createElement("option");
                        objOption.innerHTML = value.nombre.toUpperCase();
                        objOption.value = value.id_tipo_documento;

                        document
                            .getElementById("id_tipo_documento")
                            .appendChild(objOption);
                    });
                    document.getElementById("id_tipo_documento").value = objJson.id_tipo_documento;
                },
            });
        }

        function getLocalidades() {
            var objAjax = $.ajax({
                type: "post",
                url: "../helpers/getJsonLocalidades.php",
                data: {},
                success: function(respuestaDelServer, estado) {
                    objJson = JSON.parse(respuestaDelServer);
                    objJson.localidades.forEach(function(value) {
                        var objOption = document.createElement("option");
                        objOption.innerHTML = value.nombre_de_localidad.toUpperCase();
                        objOption.value = value.id_codigo_postal;

                        document.getElementById("id_localidad").appendChild(objOption);
                    });
                    document.getElementById("id_localidad").value = objJson.id_localidad;
                },
            });
        }

        function getProvincias() {
            var objAjax = $.ajax({
                type: "post",
                url: "../helpers/getJsonProvincias.php",
                data: {},
                success: function(respuestaDelServer, estado) {
                    objJson = JSON.parse(respuestaDelServer);
                    objJson.especialidades.forEach(function(value) {
                        var objOption = document.createElement("option");
                        objOption.innerHTML = value.nombre.toUpperCase();
                        objOption.value = value.id_provincia;

                        document.getElementById("id_provincia").appendChild(objOption);
                    });
                    document.getElementById("id_provincia").value = objJson.id_provincia;
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

                        document.getElementById("id_obra_social").appendChild(objOption);
                    });
                    document.getElementById("id_obra_social").value = objJson.id_obra_social;

                },
            });
        }

        function getDatosUsuario() {
            var objAjax = $.ajax({
                type: "post",
                url: "../helpers/getJsonUsuario.php",
                data: {},
                success: function(respuestaDelServer) {
                    console.log(respuestaDelServer);
                    objJson = JSON.parse(respuestaDelServer);
                    document.getElementById("div_nom_usuario").innerHTML = objJson.nombre.toUpperCase();
                    document.getElementById("id_usuario").value = objJson.usuario;
                    document.getElementById("id_email").value = objJson.email;
                    document.getElementById("id_nombre").value = objJson.nombre;
                    document.getElementById("id_apellido").value = objJson.apellido;
                    document.getElementById("id_numero_documento").value = objJson.documento;
                    document.getElementById("id_numero_afiliado").value = objJson.numero_afiliado;
                    document.getElementById("userFoto").src = objJson.imagen  ? objJson.imagen : document.getElementById("userFoto").src;

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
        <div class="tarjeta">
         <img id="userFoto" src="../assets/img/foto-perfil.jpg" alt="Perfil" class="fotoPerfil" />
            <div class="usuario" id="div_nom_usuario"></div>

            <div class="contenedor">
                <a href="./ver_turnos_paciente.php"><img src="" alt="" class="icono">&ensp;Mis turnos</a>
                <br>
                <a href="../cerrar_sesion.php"><img src="" alt="" class="icono">&ensp;Cerrar sesion</a>
            </div>
        </div>

        <form class="form-informacion" id="form-informacion">
            <div class="grupo">
                <label for="">Usuario:</label>
                <input type="text" id="id_usuario" name="id_usuario">
            </div>
            <div class="grupo">
                <label for="">Email:</label>
                <input type="email" id="id_email" name="id_email">
            </div>
            <div class="grupo">
                <label for="">Nombre:</label>
                <input type="text" id="id_nombre" name="id_name">
            </div>
            <div class="grupo">
                <label for="">Apellido:</label>
                <input type="text" id="id_apellido" name="id_apellido">
            </div>
            <div class="grupo">
                <label for="provincia">Provincia:</label>
                <select name="provincia" id="id_provincia">
                    <option value="" disabled selected required>
                        Seleccione provincia
                    </option>
                </select>
            </div>
            <div class="grupo">
                <label for="localidad">Localidad:</label>
                <select name="localidad" id="id_localidad">
                    <option value="" disabled selected required>
                        Seleccione localidad
                    </option>
                </select>
            </div>
            <div class="grupo">
                <label for="tipo_documento">Tipo de documento:</label>
                <select name="tipo_documento" id="id_tipo_documento">
                    <option value="" disabled selected required>
                        Seleccione tipo de documento
                    </option>
                </select>
            </div>
            <div class="grupo">
                <label for="">Número Documento:</label>
                <input type="text" pattern="^\d{2}.\d{3}.\d{3}$" placeholder="NN.NNN.NNN" id="id_numero_documento" name="id_numero_documento" />
            </div>
            <div class="grupo">
                <label for="obra_social">Obra social:</label>
                <select name="obra_social" id="id_obra_social">
                    <option value="" disabled selected required>
                        Seleccione obra social
                    </option>
                </select>
            </div>
            <div class="grupo">
                <label for="numero_afiliado">Número de afiliado:</label>
                <input class="campo-registro" id="id_numero_afiliado" name="id_numero_afiliado" type="text" maxlength="12" />
            </div>
            <div class="grupo">
                <!-- <form action="../subir_imagen.php" method="post" enctype="multipart/form-data"> -->
                <input type="file" name="imagen" accept="image/*" class="file-input" id="file-input">
            </div>
        </form>
        <button id="botonModificar">Modificar</button>
        <button id="botonGuardar" type="submit" disabled>Guardar</button>
        <button id="botonCancelar" disabled>Cancelar</button>
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