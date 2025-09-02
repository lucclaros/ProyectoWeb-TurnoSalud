<?php

session_start();
include 'conexion_bd.php';


$duracion_turno1 =0; // Para evitar error si no lleno los datos el medico
$id_doctor = $_POST['id_doctor'];
$id_usuario = $_POST['id_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$apellido_usuario = $_POST['apellido_usuario'];
$direccion = $_POST['direccion'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen_doctor'];

$_SESSION['id_doctor_turno'] = $id_doctor;
$_SESSION['id_turno_doctor'] = $id_usuario;
$_SESSION['nombre_turno_doctor'] = $nombre_usuario;
$_SESSION['apellido_turno_doctor'] = $apellido_usuario;
$_SESSION['direccion_turno_doctor'] = $direccion;
$_SESSION['precio_turno_doctor'] = $precio;
$_SESSION['imagen'] = $imagen;

/*
if (isset($_SESSION['id_doctor_turno'])) {
  $id_usuario = $_SESSION['id_turno_doctor'];
  $nombre_usuario = $_SESSION['nombre_turno_doctor'];
  $apellido_usuario = $_SESSION['apellido_turno_doctor'];
  $direccion = $_SESSION['direccion_turno_doctor'];
  $precio = $_SESSION['precio_turno_doctor'];
}
*/


// determinar especialidad medico:
$sql = "SELECT e.nombre
                 FROM especialidades e
                 JOIN doctores d ON e.id_especialidad = d.id_especialidad
                 WHERE d.id_doctor = $id_doctor";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $especialidad = $row['nombre'];
}


// determinar localidad y provincia medico:
$sql = "SELECT l.nombre_de_localidad AS localidad, p.nombre AS provincia
        FROM usuarios u
        JOIN localidades l ON u.id_localidad = l.id_codigo_postal
        JOIN provincias p ON u.id_provincia = p.id_provincia
        WHERE u.id_usuario = $id_usuario";


// Ejecutar la consulta
$resultado = $conn->query($sql);



// Verificar si se encontró un resultado
if ($fila = $resultado->fetch_assoc()) {
  $localidad = $fila['localidad'];
  $provincia = $fila['provincia'];
} else {
  echo "No se encontró la localidad y provincia para el usuario con ID $id_usuario";
}



// Generar fechas desde hoy hasta 10 días después
$fechas = [];
for ($i = 0; $i <= 10; $i++) {
  $fechas[] = date('Y-m-d', strtotime("+$i days"));
}

// Obtener el mes actual
$mes_actual = date('n'); // Número del mes sin ceros iniciales

// Obtener horarios del médico para el mes actual
$horarios_medicos = [];
$sql_horarios = "SELECT * FROM agendas WHERE id_doctor = $id_doctor AND id_mes = $mes_actual";
$result_horarios = $conn->query($sql_horarios);
while ($row = $result_horarios->fetch_assoc()) {
  $horarios_medicos[] = $row;
  $duracion_turno1 = $row['duracion_turno'];
}

// Obtener turnos ya agendados del médico
$turnos_agendados = [];
$sql_turnos = "SELECT t.fecha_del_turno, t.hora_turno
               FROM turnos t 
               JOIN agendas a ON t.id_agenda = a.id_agenda 
               WHERE a.id_doctor = $id_doctor AND t.estado_turno = 'Programado'";
$result_turnos = $conn->query($sql_turnos);


//echo "Consulta SQL: $sql_turnos<br>";

$result_turnos = $conn->query($sql_turnos);

if (!$result_turnos) {
  echo "Error en la consulta: " . $conn->error;
} else {
  while ($row = $result_turnos->fetch_assoc()) {
    $turnos_agendados[] = $row['fecha_del_turno'] . ' ' . $row['hora_turno'];
  }
}
// Verificar turnos agendados
/*
echo 'turnos agendados: <pre>';
print_r($turnos_agendados);
echo '</pre>';
*/

// Mapeo de días de la semana
$dias_semana = [];
$sql_dias = "SELECT * FROM dias";
$result_dias = $conn->query($sql_dias);
while ($row = $result_dias->fetch_assoc()) {
  $dias_semana[$row['id_dia']] = $row['nombre_dia'];
}






?>



<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TurnoSalud | Resultados de búsqueda</title>
  <link rel="icon" type="image/svg+xml" href="../assets/Logos_Iconos/ts-icono.webp" />
  <link rel="stylesheet" href="../styles/perfil_doctor_vista.css" />
  <link rel="stylesheet" href="../styles/header.css" />
  <link rel="stylesheet" href="../styles/footer.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet" />
  <link rel="scripts" href="../scripts/index.js" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
        <li class="item"><a href="../form_login.php">Ingresar</a></li>
        <li class="item"><a href="../contacto/contacto.html">Contacto</a></li>
        <li class="toggle">
          <a href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>
    </nav>
  </header>
  <main>

    <section>
      <div id="volver">
        <a href="consulta-buscador.php"> Volver </a>
      </div>
      <div class="perfil-doctor">


        <div class="imagen-doctor">

          <img src="../uploads/<?=$imagen;?>" alt="foto perfil"/>

        </div>

        <div class="info-doctor">
          <h2><?= ucfirst($nombre_usuario) . " " .   ucfirst($apellido_usuario); ?></h2>
          <h3><?= ucfirst($especialidad); ?></h3>
          <!--<h4> Matricula: </h4>-->
        </div>

        <div class="info-doctor2">

          <h3>Provincia: <?= ucfirst($provincia); ?></h3>
          <h3>Localidad: <?= ucfirst($localidad); ?></h3>
          <h3>Dirección consultorio: <?= ucfirst($direccion); ?></h3>
          <h3>Costo de la consulta: ARS <?= $precio; ?></h3>
          <?php if ($duracion_turno1 != 0) { ?>
          <h3>Duración de la consulta: <?= convertirTiempoADecimales($duracion_turno1) . " minutos"; ?></h3>
          <?php } ?>
        </div>

      </div>









      <div class="perfil-doctor">

        <div class="info-doctor4" id="div-agenda">
        <div id="agenda-doctor">
          <div>
            <h2 id="titulo_turnos"> Turnos disponibles </h2>
            <?php
            if (isset($_SESSION['id_paciente'])) {
              $action = "elegir_turno.php";
            } else {
              $action = "../form_login.php";
            }
            ?>
            <form method="POST" action=<?= $action; ?>>
              <?php
              foreach ($fechas as $fecha) {
                $dia_semana_espanol = date('N', strtotime($fecha)); // Número del día de la semana
              ?>
                <div class="turnos">
                  <span><?= $fecha ?> (<?= $dias_semana[$dia_semana_espanol]; ?>)</span>
                </div>
                <div class="turnos">
                  <?php
                  foreach ($horarios_medicos as $horario) {
                    if ($dia_semana_espanol == $horario['id_dia']) {
                      $hora_inicio = strtotime($horario['inicio_jornada']);
                      $hora_fin = strtotime($horario['fin_jornada']);
                      $duracion_turno = strtotime($horario['duracion_turno']) - strtotime('00:00:00');
                      while ($hora_inicio < $hora_fin) {
                        $hora_turno = date('H:i', $hora_inicio);
                        $fecha_hora_turno = $fecha . " " . convertirHora($hora_turno);

                        // Comprobar si el turno ya está agendado              
                        $turno_ocupado = in_array($fecha_hora_turno, $turnos_agendados);
                        //Mostrar el botón solo si el turno está libre
                        if (!$turno_ocupado) {


                          echo "<button type='button' id='btn-turno' class='btn-horario' onclick='seleccionarHorario(\"$fecha\", \"$hora_turno\")'>$hora_turno</button>";
                        }

                        $hora_inicio += $duracion_turno;
                      }
                    }
                  }
                  ?>
                </div>
              <?php
              }
              ?>
              <div>
                <input type="hidden" id="fechaSeleccionada" name="fechaSeleccionada">
                <input type="hidden" id="horaSeleccionada" name="horaSeleccionada">
                <input type="hidden" id="idDoctor" name="id_medico" value="<?php echo $id_doctor; ?>">
                <button type="submit" class="btn-sacar-turno">Ingresar para solicitar turno</button>
              </div>
            </form>
          </div>
          </div>
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
      <a href="./index.html">
        <img src="../assets/Logos_Iconos/logo-turnosalud.webp" alt="logo-turnosalud" />
      </a>
    </div>
    <p>Copyright &copy; 2024 TurnoSalud / Todos los derechos reservados</p>
  </footer>
  <script src="../scripts/index.js" type="text/javascript"></script>
</body>


<?php



function convertirHora($hora)
{
  // Agregar los segundos ":00" a la hora
  $hora_con_segundos = date('H:i:s', strtotime($hora));

  return $hora_con_segundos;
}

function convertirTiempoADecimales($tiempo)
{
  // Dividir el tiempo en horas, minutos y segundos
  list($horas, $minutos, $segundos) = explode(':', $tiempo);

  // Convertir las horas, minutos y segundos a enteros
  $horas = (int)$horas;
  $minutos = (int)$minutos;
  $segundos = (int)$segundos;

  // Convertir todo a minutos
  $minutosTotales = ($horas * 60) + $minutos + ($segundos / 60);

  return $minutosTotales;
}

?>

<script>
  function irAlFinal() {
    var contenedor = document.getElementById('div-agenda');
    contenedor.scrollTop = contenedor.scrollHeight;
  }

  function seleccionarHorario(fecha, horario) {
    document.getElementById('fechaSeleccionada').value = fecha;
    document.getElementById('horaSeleccionada').value = horario;
    irAlFinal();
  }
</script>

</html>