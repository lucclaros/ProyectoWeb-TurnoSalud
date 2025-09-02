<?php
session_start();
if (!isset($_SESSION['id_paciente'])) {
    // Redirigir a index.php si no está iniciada la sesión
    header("Location: index.html");
    exit();
}
$id_paciente =  $_SESSION['id_paciente'];

//echo $id_paciente;
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TurnoSalud | Mis turnos</title>
    <link rel="icon" type="image/svg+xml" href="../assets/Logos_Iconos/ts-icono.webp" />
    <link rel="stylesheet" href="../styles/tabla_turnos.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <link rel="stylesheet" href="../styles/index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet" />
    <link rel="scripts" href="../scripts/index.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!--
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
-->

</head>


<body>
    <!-- <div class="table-container">  -->
    <header>
        <nav>
            <ul class="menu">
                <li class="logo">
                    <a href="index.html"><img src="../assets/Logos_Iconos/logo-turnosalud.webp" alt="logo-turnosalud" class="logo-ts" /></a>
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
                <li class="item"><a href="../form_login.php"> Ir a mi perfil</a></li>
                <li class="item"><a href="../contacto/contacto.html">Contacto</a></li>
                <li class="toggle">
                    <a href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
        </nav>
    </header>






    <main>
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





            $sinTurnos = 0;
            // Preparar la declaración SQL para obtener los turnos del paciente
            /*
            $sqlDoctor="SELECT turnos.*, doctores.*
                    FROM turnos
                    JOIN doctores ON turnos.id_agenda = doctores.id_doctor
                     LIMIT $start_from, $limit";
                */
                    $sqlDoctor = "SELECT turnos.*, doctores.*, usuarios.nombre_usuario, nombre
                                    FROM turnos
                                    JOIN doctores ON turnos.id_agenda = doctores.id_doctor
                                    JOIN usuarios ON doctores.id_usuario = usuarios.id_usuario
                                    JOIN especialidades ON especialidades.id_especialidad = doctores.id_especialidad
                                    WHERE id_paciente = $id_paciente ORDER BY fecha_del_turno,hora_turno 
                                    LIMIT $start_from, $limit";

            
           /* $sqlDoctor = "SELECT * FROM turnos WHERE id_paciente = $id_paciente ORDER BY fecha_del_turno,hora_turno 
            LIMIT $start_from, $limit"; */
            $result = mysqli_query($conn, $sqlDoctor);

            if ($result) {
                if (mysqli_num_rows($result) > 0) { ?>


                    <div id="table-container">

                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Profesional</th>
                                    <th>Especialidad</th>
                                    <th>Lugar</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>




                                <?php



                                while ($row = mysqli_fetch_assoc($result)) {
                                    //$result2 = mysqli_query($conn, $IdentificarUsuario);
                                    //$row2=mysqli_fetch_row($result2);

                                ?>

                                    <tr>
                                        <td data-label="Fecha">
                                            <?= htmlspecialchars($row['fecha_del_turno']); ?>
                                        </td>
                                        <td data-label="Hora">
                                            <?= htmlspecialchars($row['hora_turno']); ?>
                                        </td>
                                        <td data-label="Profesional">
                                        <?= htmlspecialchars($row['nombre_usuario']); ?>

                                        </td>
                                        <td data-label="Especialidad">
                                        <?= htmlspecialchars($row['nombre']); ?>

                                        </td>

                                        <td data-label="Lugar">
                                            <?= htmlspecialchars($row['direccion']); ?>
                                        </td>
                                        <td class="status-confirmado" data-label="Estado">
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


            $total_pages = ceil($total_records / $limit);
          
            echo "<ul class='pagination'>";
           
            for ($i = 1; $i <= $total_pages; $i++) { ?>

                    <div class="div_paginas">
                        <li class="li_paginas"><a href='ver_turnos_paciente.php?page=<?= $i; ?>'> <?= $i; ?> </a></li>
                    </div>
                <?php }
            echo "</ul>";

          

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
</body>

</html>