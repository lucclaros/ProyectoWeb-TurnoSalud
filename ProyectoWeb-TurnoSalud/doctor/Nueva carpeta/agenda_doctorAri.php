<?php
session_start();

//$_SESSION["turno_cancelado"]= 3; // Esto se debe agregar en perfil_doctor.php para evitar un erro del alert

$id_doctor =  $_SESSION['id_doctor'];

//echo $id_paciente;


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
                    <a href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
    </header>





    <main>
        <section >
            <div id="table-container">

                    <form class="form-informacion">
                        <label for="precio">Precio de Consulta:</label>
                        <input type="text" name="precio" required>
                        <br> <br>

                        <!-- Obras sociales que atiende el especialista-->
                        <label for="">Obra social:</label>
                    <div class = "contenedor-obrasocial">
                        <input type="checkbox" name="obra social" value="1">
                        <label for="">Sanidad</label>
                        <input type="checkbox" name="obra social" value="2">
                        <label for="">Osde</label>
                        <input type="checkbox" name="obra social" value="3">
                        <label for="">Ospe</label>
                        <input type="checkbox" name="obra social" value="4">
                        <label for="">Salud</label>
                    </div>

                        <label for="">Dias de atencion:</label>
                    <div class = "contenedor-dias">
                        <input type="checkbox" id="dia1" name="dia[]" value="1">
                        <label for="dia1">Lunes</label>
                        <input type="checkbox" id="dia2" name="dia[]" value="2">
                        <label for="dia2">Martes</label>
                        <input type="checkbox" id="dia3" name="dia[]" value="3">
                        <label for="dia3">Miércoles</label>
                        <input type="checkbox" id="dia4" name="dia[]" value="4">
                        <label for="dia4">Jueves</label>
                        <input type="checkbox" id="dia5" name="dia[]" value="5">
                        <label for="dia5">Viernes</label>
                        <input type="checkbox" id="dia6" name="dia[]" value="6">
                        <label for="dia6">Sábado</label>
                        <input type="checkbox" id="dia7" name="dia[]" value="7">
                        <label for="dia7">Domingo</label>
                    </div >

                    <div class = "jornada-inicio">
                        <label for="inicio_jornada">Inicio de Jornada:</label>
                        <input type="time" id="inicio_jornada" name="inicio_jornada" required> 
                    </div>

                    <div class = "jornada-fin">
                        <label for="fin_jornada">Fin de Jornada:</label>
                        <input type="time" id="fin_jornada" name="fin_jornada" required>
                    </div>

                    <div class = "duracion">
                        <label for="duracion_turno">Duración del Turno:</label>
                
                        <div>
                            <select class="campo-registro" name="id_tipo_documento" id="id_tipo_documento" required>
                              <option value="15" required> 15 minutos </option>
                               <option value="30" required> 30 minutos </option>
                               <option value="45" required> 45 minutos </option>
                               <option value="60" selected required> 60 minutos </option>
                               <option value="90" required> 90 minutos </option>
                            </select>
                        </div>
                    </div>
                    </form>

                
            </div>

        </section>

        <section id="seccion-buscador">

            <div class = "contenedor-mis-turnos">
                <div id="div_titulo">
                    <h1> Mis turnos: </h1>
                </div>
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
            </div>
            <br> <br>


            <?php

            include 'conexion_bd.php';
            $sinTurnos = 0;
            // Preparar la declaración SQL para obtener los turnos del paciente
            $sqlDoctor = "SELECT * FROM turnos WHERE id_agenda= $id_doctor ORDER BY fecha_del_turno, hora_turno";
            $result = mysqli_query($conn, $sqlDoctor);

            if ($result) {
                if (mysqli_num_rows($result) > 0) { ?>


                    <div id="table-container">

                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <!-- <th>Especialidad</th> no va ya que el medico ya sabe la especialidad y la direccion en que atiende-->
                                    <!--  <th>Lugar</th> -->
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>




                                <?php



                                while ($row = mysqli_fetch_assoc($result)) {
                                    //$result2 = mysqli_query($conn, $IdentificarUsuario);
                                    //$row2=mysqli_fetch_row($result2);

                                    if ($row['estado_turno'] == 'Programado') {
                                        $estado = "status-confirmado";
                                    }
                                    else 
                                        {
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
                                            A completar

                                        </td>

                                        <td data-label="">
                                            A completar

                                        </td>

                                        <td data-label="">
                                            A completar

                                        </td>
                                        <!--
                                        <td data-label="Especialidad">
                                            Cardiologia

                                        </td>

                                       
                                        <td data-label="Lugar">
                                            <?= htmlspecialchars($row['lugar']); ?>
                                        </td>
                                        -->
                                        

                                        <td class="<?=htmlspecialchars($estado);?>" data-label="Estado">
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
    <?php

    if ($_SESSION["turno_cancelado"] == 1) {  ?>
        <script>
            alert("Turno cancelado");
        </script> <?php
                    $_SESSION["turno_cancelado"] = 3; //PAra que al recargar la pagina no envie el alert;

                }
                    ?>
    <?php
    if ($_SESSION["turno_cancelado"] == 0) { ?>
        <script>
            alert("Error al cancelar el turno");
        </script> <?php
                    $_SESSION["turno_cancelado"] = 3; //PAra que al recargar la pagina no envie el alert;
                }

                    ?>






    <script src="../scripts/index.js" type="text/javascript"></script>
</body>

</html>