<?php


session_start();
// Verificar si la sesión está iniciada
if (!isset($_SESSION['administrador'])) {
    // Redirigir a index.php si no está iniciada la sesión
    header("Location: index.html");
    exit();
}

include 'conexion_bd.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TurnoSalud | Turnos</title>
  <link rel="icon" type="image/svg+xml" href="../assets/Logos_Iconos/ts-icono.webp" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../styles/index.css" />
  <link rel="stylesheet" href="../styles/header.css" />
  <link rel="stylesheet" href="../styles/footer.css" />
  <link rel="stylesheet" href="../styles/registrarme.css" />
  <link rel="scripts" href="../scripts/index.js" />

</head>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
      /*AJAX*/
      $(document).ready(function () {
        getTiposDeDocumento();
        getProvincias();
        getLocalidades();
        getObrasSociales();

        const selectObrasSociales = document.getElementById("id_obra_social");
        const inputAfiliado = document.getElementById("numero_afiliado");

        $("#id_obra_social").change(function () {
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
      });

      function getTiposDeDocumento() {
        var objAjax = $.ajax({
          type: "post",
          url: "./helpers/getJsonTiposDocumento.php",
          data: {},
          success: function (respuestaDelServer, estado) {
            objJson = JSON.parse(respuestaDelServer);
            objJson.especialidades.forEach(function (value) {
              var objOption = document.createElement("option");
              objOption.innerHTML = value.nombre.toUpperCase();
              objOption.value = value.id_tipo_documento;

              document
                .getElementById("id_tipo_documento")
                .appendChild(objOption);
            });
          },
        });
      }

      function getLocalidades() {
        var objAjax = $.ajax({
          type: "post",
          url: "./helpers/getJsonLocalidades.php",
          data: {},
          success: function (respuestaDelServer, estado) {
            objJson = JSON.parse(respuestaDelServer);
            objJson.localidades.forEach(function (value) {
              var objOption = document.createElement("option");
              objOption.innerHTML = value.nombre_de_localidad.toUpperCase();
              objOption.value = value.id_codigo_postal;

              document.getElementById("id_localidad").appendChild(objOption);
            });
          },
        });
      }

      function getProvincias() {
        var objAjax = $.ajax({
          type: "post",
          url: "./helpers/getJsonProvincias.php",
          data: {},
          success: function (respuestaDelServer, estado) {
            objJson = JSON.parse(respuestaDelServer);
            objJson.especialidades.forEach(function (value) {
              var objOption = document.createElement("option");
              objOption.innerHTML = value.nombre.toUpperCase();
              objOption.value = value.id_provincia;

              document.getElementById("id_provincia").appendChild(objOption);
            });
          },
        });
      }

      function getObrasSociales() {
        var objAjax = $.ajax({
          type: "post",
          url: "./helpers/getJsonObrasSociales.php",
          data: {},
          success: function (respuestaDelServer, estado) {
            objJson = JSON.parse(respuestaDelServer);
            objJson.obrasSociales.forEach(function (value) {
              var objOption = document.createElement("option");
              objOption.innerHTML = value.nombre.toUpperCase();
              objOption.value = value.id_obra_social;

              document.getElementById("id_obra_social").appendChild(objOption);
            });
          },
        });
      }
      /* 
      document.addEventListener("DOMContentLoaded", (event) => {
        
      }); */
    </script>
  </head>












  <body>
    <header>
      <nav>
        <ul class="menu">
          <li class="logo">
            <a href="index.html"
              ><img
                src="../assets/Logos_Iconos/logo-turnosalud.webp"
                alt="logo-turnosalud"
                class="logo-ts"
            /></a>
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
            <a href="#"><i class="fa fa-bars"></i></a>
          </li>
        </ul>
      </nav>
    </header>
    <main>
      <section class="registro-medico">
      

        <div class="registro-contenedor">
          



        <?php


                if (isset($_POST['tabla'])) {
                $tabla = $_POST['tabla'];
                }

                include 'conexion_bd.php';
                // Preparar la declaración SQL para obtener los turnos del paciente

                if ($tabla == "turnos") {
                $sql = "SELECT * FROM turnos";
                $arrayCabeceras= array("Fecha","Hora","Lugar");
                $arrayColumnas= array("fecha_del_turno","hora_turno","lugar");
                }

                if ($tabla == "usuarios") {
                $sql = "SELECT * FROM usuario";
                $arrayCabeceras= array("tipo documento","Provincia","Localidad","nombre","apellido");
                $arrayColumnas= array("id_tipo_documento","id_provincia","id_localidad","nombre_usuario","apellido_usuario");

                }

                if ($tabla == "provincias") {
                $sql = "SELECT * FROM provincia";
                $arrayCabeceras= array("nombre");
                $arrayColumnas= array("nombre");

                }

                if ($tabla == "especialidades") {
                $sql = "SELECT * FROM especialidad";
                $arrayCabeceras= array("nombre");
                $arrayColumnas= array("nombre");

                }


                echo "<h2> Tabla " . $tabla . "</h2>" ;
                
                ?>


                <br> <br>
                <form action="logica/agregar_registro.php" method="POST">
                <?php
                for($i=0; $i<count($arrayColumnas); $i++) { 
                ?>
                <label for="input_registro"> <?=ucfirst($arrayCabeceras[$i]);?> </label>
                <br><br>
                    
                <input id="input_registro" class="campo-registro" type="text" name="<?=$arrayColumnas[$i];?>"/>
                 
                <input type="hidden" name="tabla" value="<?=$tabla;?>"/>
               

                                
<?php
                                }
                                
                                ?>
                                 <input id ="btn_agregar_registro"type="submit" value="Agregar registro" class="boton" />
                                 <!-- <button id¨="boton_volver"class="boton" type="submit" value="Volver"></button>-->

            
          </form>
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
        <a href="index.html">
          <img
            src="./assets/Logos_Iconos/logo-turnosalud.webp"
            alt="logo-turnosalud"
          />
        </a>
      </div>
      <p>Copyright &copy; 2024 TurnoSalud / Todos los derechos reservados</p>
    </footer>
    <script src="../scripts/index.js" type="text/javascript"></script>
  </body>
</html>
