<?php

session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['administrador'])) {
    // Redirigir a index.php si no está iniciada la sesión
    header("Location: index.html");
    exit();
}
   
include 'conexion_bd.php';

//$id_paciente =  $_SESSION['id_paciente'];

//echo $id_paciente;


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
  <link rel="stylesheet" href="../styles/tabla_turnos.css" />
  <link rel="scripts" href="../scripts/index.js" />

</head>


<body>
  <!-- <div class="table-container">  -->
  <header>
    <nav>
      <ul class="menu">
        <li class="logo">
          <a href="index.html"><img src="../assets/Logos_Iconos/logo-turnosalud.webp" alt="logo-turnosalud" class="logo-ts" /></a>
        </li>
        <li class="item"><a href="index.html">Inicio</a></li>
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
        <li class="item"><a href="../cerrar_sesion.php"> Cerrar sesion </a></li>
        <li class="item"><a href="../contacto/contacto.html">Contacto</a></li>
        <li class="toggle">
          <a href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>
    </nav>
  </header>






  <main>


    <div id="div_titulo">
      <p> Elegir tabla: </p>
    </div>
    <form action="index.php" method="POST">
      <select class="campo-registro" name="tabla" id="id_localidad" required>
        <option value="turnos" required>Turnos</option>
        <option value="provincias" required>Provincias</option>
        <option value="especialidades" required>Especialidad</option>
      </select>
      <label> Busqueda por id</label>
      <input type="number" name="id" class="campo-busqueda">
      <label> Busqueda por nombre</label>
      <input type="text" name="nombre" class="campo-busqueda">
      <input type="submit" value="Consultar" class="boton" />

    </form>

    <?php
    //$nombre = 'Buenos aires';
    if (isset($_POST['tabla'])) {
      $tabla = $_POST['tabla'];
      $id = isset($_POST['id']) ? $_POST['id'] : '';
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';




    ?>


      <form action="nuevo_registro.php" method="POST">
        <input type="hidden" name="tabla" value="<?= $tabla; ?>" />
        <input id="btn_agregar_registro" type="submit" value="Agregar registro" class="" />
      </form>
      </td>



      <?php
      include 'conexion_bd.php';
      // Preparar la declaración SQL para obtener los turnos del paciente




      /* 
        if ($tabla == "usuarios") {
          $sql = "SELECT * FROM usuarios";
          if (!empty($id)){
            $sql.= "and usuarios.id = $id";
          }
          if (!empty($nombre)){
            $sql.= "and usuarios.nombre like "$nombre"";
          }
          $arrayCabeceras= array("tipo documento","Provincia","Localidad","nombre","apellido");
          $arrayColumnas= array("id_usuario","id_tipo_documento","id_provincia","id_localidad","nombre_usuario","apellido_usuario");

        }
          */



      if ($tabla == "turnos") {
        $sql = "SELECT * FROM turnos";
        if (!empty($id)) {
          $sql .= " WHERE id_turno= $id";
        }
        $arrayCabeceras = array("id", "Fecha", "Hora", "Lugar");
        $arrayColumnas = array("id_turno", "fecha_del_turno", "hora_turno", "lugar");
      }

      if ($tabla == "provincias") {
        $sql = "SELECT * FROM provincias";
        if (!empty($id)) {
          $sql .= " WHERE id_provincia= $id";
        }
        if (!empty($nombre)) {

          $sql .= " WHERE nombre like '%$nombre%'";
        }

        $arrayCabeceras = array("id", "nombre");
        $arrayColumnas = array("id_provincia", "nombre");
      }


      if ($tabla == "especialidades") {
        $sql = "SELECT * FROM especialidades";
        if (!empty($id)) {
          $sql .= " WHERE id_especialidad= $id";
        }
        if (!empty($nombre)) {

          $sql .= " WHERE nombre like '%$nombre%'";
        }
        $arrayCabeceras = array("id", "nombre");
        $arrayColumnas = array("id_especialidad", "nombre");
      }
      ?>




      <br> <br>
      <div id="table-container">

        <table class="responsive-table">
          <thead>
            <tr>
              <?php
              for ($i = 0; $i < count($arrayCabeceras); $i++) {
              ?>
                <th><?= htmlspecialchars($arrayCabeceras[$i]); ?></th>
              <?php } ?>
            </tr>

          </thead>
          <tbody>

            <tr>
              <?php


              $result = mysqli_query($conn, $sql);

              if ($result) {
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    //$result2 = mysqli_query($conn, $IdentificarUsuario);
                    //$row2=mysqli_fetch_row($result2);
              ?>
                    <form action="logica/eliminar.php" method="POST">
                      <?php
                      for ($i = 0; $i < count($arrayColumnas); $i++) { ?>
                        <td data-label="Fecha">
                          <?= htmlspecialchars($row[$arrayColumnas[$i]]); ?>
                        </td>
                      <?php }
                      ?>
                      <!-- ELIMINAR -->
                      <input type="hidden" value="<?= htmlspecialchars($tabla); ?>" name="tabla" />
                      <input type="hidden" value="<?= htmlspecialchars($row[$arrayColumnas[0]]); ?>" name="<?= $arrayColumnas[0]; ?>" />
                      <td> <input type="submit" value="Eliminar" /></td>
                      <!-- MODIFICAR -->
                       <!-- 
                      <input type="hidden" value="<?= htmlspecialchars($tabla); ?>" name="tabla" />
                      <input type="hidden" value="<?= htmlspecialchars($row[$arrayColumnas[0]]); ?>" name="<?= $arrayColumnas[0]; ?>" />
                      <td> <input type="submit" value="Modificar" /></td>
                      -->
                    </form>
            </tr>

          </tbody>
  <?php

                  }
                } 
              } else {
                echo "Error: " . mysqli_error($conn);
              }

              mysqli_close($conn);
            }
  ?>
        </table>

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
        <img src="../assets/Logos_Iconos/logo-turnosalud.webp" alt="logo-turnosalud" />
      </a>
    </div>
    <p>Copyright &copy; 2024 TurnoSalud / Todos los derechos reservados</p>
  </footer>
    

</body>

</html>