<?php
session_start();

include("conexion_bd.php");


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TurnoSalud | Mi agenda</title>
    <link rel="icon" type="image/svg+xml" href="../assets/Logos_Iconos/ts-icono.webp" />
    <link rel="stylesheet" href="../styles/agenda_doctor.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <link rel="stylesheet" href="../styles/tabla_turnos.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet" />
    <link rel="scripts" href="../scripts/index.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>


<body>
    <!-- <div class="table-container">  -->
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
                <li class="item"><a href="../form_login.php">Mi perfil</a></li>
                <li class="item"><a href="../contacto/contacto.html">Contacto</a></li>
                <li class="toggle">
                    <a href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
    </header>


    <?php

// Asegúrate de tener el ID del doctor disponible
$id_doctor = $_SESSION['id_doctor']; // Suponiendo que el ID del doctor está almacenado en la sesión

// Consulta para obtener el precio del doctor
$consulta_doctor = "SELECT precio FROM doctores WHERE id_doctor=$id_doctor";
$resultado_doctor = $conn->query($consulta_doctor);
$precio = $resultado_doctor->fetch_assoc()['precio'];

// Consulta para obtener las obras sociales del doctor
$consulta_obras_sociales = "SELECT id_obra_social FROM doctores_obras_sociales WHERE id_doctor=$id_doctor";
$resultado_obras_sociales = $conn->query($consulta_obras_sociales);
$obras_sociales = [];
while ($row = $resultado_obras_sociales->fetch_assoc()) {
    $obras_sociales[] = $row['id_obra_social'];
}

// Consulta para obtener los días de atención del doctor
$consulta_agenda = "SELECT id_dia, inicio_jornada, fin_jornada, duracion_turno FROM agendas WHERE id_doctor=$id_doctor";
$resultado_agenda = $conn->query($consulta_agenda);
$dias_atencion = [];
$duracion="00:00";
while ($row = $resultado_agenda->fetch_assoc()) {
    $dias_atencion[] = $row['id_dia'];
    $duracion= $row['duracion_turno'];
    $inicio_jornada=  $row['inicio_jornada'];
    $fin_jornada=  $row['fin_jornada'];
}
$agenda = $resultado_agenda->fetch_assoc(); // Asigna el último resultado de la agenda
?>






    <main>


        <section>
            <div id="table-container">

       
<form action="elegir_obra_social.php" class="form-informacion" method="POST">
    <label for="precio">Precio de Consulta:</label>
    <input type="text" name="precio" value="<?php echo $precio; ?>" required>
    <br> <br>

    <!-- Obras sociales que atiende el especialista-->
    <label for="">Obra social:</label>
    <div class="contenedor-obrasocial">
        <input type="checkbox" name="obra_social[]" value="1" <?php if (in_array(1, $obras_sociales)) echo 'checked'; ?>>
        <label for="">Sanidad</label>
        <input type="checkbox" name="obra_social[]" value="2" <?php if (in_array(2, $obras_sociales)) echo 'checked'; ?>>
        <label for="">Osde</label>
        <input type="checkbox" name="obra_social[]" value="3" <?php if (in_array(3, $obras_sociales)) echo 'checked'; ?>>
        <label for="">Ospe</label>
        <input type="checkbox" name="obra_social[]" value="4" <?php if (in_array(4, $obras_sociales)) echo 'checked'; ?>>
        <label for="">Salud</label>
    </div>

    <label for="">Dias de atencion:</label>
    <div class="contenedor-dias">
        <input type="checkbox" id="dia1" name="dia[]" value="1" <?php if (in_array(1, $dias_atencion)) echo 'checked'; ?>>
        <label for="dia1">Lunes</label>
        <input type="checkbox" id="dia2" name="dia[]" value="2" <?php if (in_array(2, $dias_atencion)) echo 'checked'; ?>>
        <label for="dia2">Martes</label>
        <input type="checkbox" id="dia3" name="dia[]" value="3" <?php if (in_array(3, $dias_atencion)) echo 'checked'; ?>>
        <label for="dia3">Miércoles</label>
        <input type="checkbox" id="dia4" name="dia[]" value="4" <?php if (in_array(4, $dias_atencion)) echo 'checked'; ?>>
        <label for="dia4">Jueves</label>
        <input type="checkbox" id="dia5" name="dia[]" value="5" <?php if (in_array(5, $dias_atencion)) echo 'checked'; ?>>
        <label for="dia5">Viernes</label>
        <input type="checkbox" id="dia6" name="dia[]" value="6" <?php if (in_array(6, $dias_atencion)) echo 'checked'; ?>>
        <label for="dia6">Sábado</label>
        <input type="checkbox" id="dia7" name="dia[]" value="7" <?php if (in_array(7, $dias_atencion)) echo 'checked'; ?>>
        <label for="dia7">Domingo</label>
    </div>

    <div class="jornada-inicio">
        <label for="inicio_jornada">Inicio de Jornada:</label>
        <input type="time" id="inicio_jornada" name="inicio_jornada" value="<?php echo $inicio_jornada?>" required>
    </div>

    <div class="jornada-fin">
        <label for="fin_jornada">Fin de Jornada:</label>
        <input type="time" id="fin_jornada" name="fin_jornada" value="<?php echo $fin_jornada?>" required>
    </div>

    <div class="duracion">
        <label for="duracion_turno">Duración del Turno </label>
        <div>
            <select class="campo-registro" name="duracion_turno" id="duracion_turno" required>
            <option value=<?php echo $duracion?>><?php echo $duracion ?></option>
                <option value="00:15:00">15 minutos</option>
                <option value="00:30:00"?>30 minutos</option>
                <option value="00:45:00"?>45 minutos</option>
                <option value="01:00:00"?>60 minutos</option>
                <option value="01:30:00"?>90 minutos</option>
            </select>
        </div>
    </div>

    <input type="submit" value="Modificar"/>
</form>



            </div>

        </section>



        <section id="seccion-buscador">

            <div>
                <div id="div_titulo">
                    <h1> Mis turnos: </h1>
                </div>
                <!-- 
                <div class="div_boton_turnos">
                    <div class="">
                        
                        <input type="submit" value="Vigentes" class="btn-filtro" />
                    </div>
                    <div class="">
                        <input type="submit" value="Antiguos" class="btn-filtro" />
                    </div>
                </div>
                <form action="procesar_filtro.php" method="GET">
                    <div class="div_filtro">

                        <label for="fecha_inicio"> Desde: </label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                    </div>

                    <div class="div_filtro">
                        <label for="fecha_fin">Hasta:</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" required>
                    </div>

                    <div class="div_filtro">
                        <input type="submit" value="Buscar" class="btn-filtro" />
                    </div>

                </form>
-->
            </div>
            <br> <br>


            <?php

            include 'conexion_bd.php';
            $sinTurnos = 0;
            // Preparar la declaración SQL para obtener los turnos del paciente




            // PAginacion
            $sql = "SELECT COUNT(*) AS total FROM turnos";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_records = $row['total'];

            $limit = 5;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $start_from = ($page - 1) * $limit;


            // filtro turnos vigentes o antiguos.
            $sqlDoctor = "SELECT t.id_turno, t.id_paciente, t.fecha_del_turno, t.lugar, t.hora_turno, t.estado_turno, u.nombre_usuario, u.apellido_usuario, u.email
              FROM turnos t 
              join pacientes p on t.id_paciente = p.id_paciente
              join usuarios u on p.id_usuario = u.id_usuario
              WHERE id_agenda = $id_doctor ORDER BY fecha_del_turno,hora_turno LIMIT $start_from, $limit";


            //$sqlDoctor = "SELECT * FROM turnos WHERE id_agenda= $id_doctor ORDER BY fecha_del_turno, hora_turno";
            $result = mysqli_query($conn, $sqlDoctor);


            //$result2 = mysqli_query($conn, $sql);

            /*
              $fecha_actual = date('Y-m-d'); //yyyy-mm-dd    
              if {
                  $sql =."where $fecha_actual > t._fecha_del_turno" 
              }
              
              if{
                  $sql =."where $fecha_actual <= t._fecha_del_turno" 
              }
                  */

            if ($result) {
                if (mysqli_num_rows($result) > 0) { ?>


                    <div id="table-container">

                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['estado_turno'] == 'Programado') {
                                        $estado = "status-confirmado";
                                    } else {
                                        $estado = "status-cancelado";
                                    }

                                ?>

                                    <tr>
                                        <td data-label="Fecha">
                                            <?= htmlspecialchars($row['fecha_del_turno']); ?>
                                        </td>
                                        <td data-label="Hora">
                                            <?= htmlspecialchars($row['hora_turno']); ?>
                                        </td>
                                        <td data-label="">
                                            <?= htmlspecialchars($row['nombre_usuario']); ?>

                                        </td>

                                        <td data-label="">
                                            <?= htmlspecialchars($row['email']); ?>
                                        </td>

                                        <td class="<?= htmlspecialchars($estado); ?>" data-label="Estado">
                                            <?= htmlspecialchars($row['estado_turno']); ?>
                                        </td>
                                        <td>
                                            <form action="cancelar_turno.php" method="POST">
                                                <input type="hidden" value="<?= $row['id_turno']; ?>" name="id_turno" />
                                                <input id="boton-cancelar" type="submit" value="X" />
                                            </form>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php
                                }
                        ?>
                        </table>
                    <?php
                } else {
                    $sinTurnos = 1;
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_close($conn);


            $total_pages = ceil($total_records / $limit);

            echo "<ul class='pagination'>";

            for ($i = 1; $i <= $total_pages; $i++) { ?>

                    <div class="div_paginas">
                        <li class="li_paginas"><a href='agenda_doctor.php?page=<?= $i; ?>'> <?= $i; ?> </a></li>
                    </div>
                <?php }
            echo "</ul>";


                ?>
                    </div>
        </section>
    </main>
    <br> <br>
    <div id="div_sin_turnos">
        <?php
        if ($sinTurnos == 1) { ?>
            <?= "No se encontraron turnos"; ?>
        <?php
        }
        ?>
    </div>
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

    <script src="../scripts/index.js" type="text/javascript"></script>
</body>

</html>