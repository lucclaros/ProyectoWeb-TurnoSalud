<?php
session_start();
include("conexion_bd.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtén el ID del doctor de la sesión
    $id_doctor = $_SESSION['id_doctor'];

    // Obtén los datos del formulario
    $precio = $_POST['precio'];
    $obras_sociales = $_POST['obra_social'];
    $dias = $_POST['dia'];
    $inicio_jornada = $_POST['inicio_jornada'];
    $fin_jornada = $_POST['fin_jornada'];
    $duracion_turno = $_POST['duracion_turno'];

    // Actualiza el precio del doctor
    $consulta_doctor = "UPDATE doctores SET precio=$precio WHERE id_doctor=$id_doctor";
    if ($conn->query($consulta_doctor) === TRUE) {
        echo "Precio actualizado correctamente.<br>";
    } else {
        echo "Error actualizando el precio: " . $conn->error . "<br>";
    }

    // Limpia las obras sociales actuales del doctor
    $consulta_limpiar_obras_sociales = "DELETE FROM doctores_obras_sociales WHERE id_doctor=$id_doctor";
    if ($conn->query($consulta_limpiar_obras_sociales) === TRUE) {
        echo "Obras sociales limpiadas correctamente.<br>";
    } else {
        echo "Error limpiando las obras sociales: " . $conn->error . "<br>";
    }

    // Inserta las nuevas obras sociales del doctor
    foreach ($obras_sociales as $id_obra_social) {
        $consulta_insertar_obra_social = "INSERT INTO doctores_obras_sociales (id_doctor, id_obra_social) VALUES ($id_doctor, $id_obra_social)";
        if ($conn->query($consulta_insertar_obra_social) === TRUE) {
            echo "Obra social $id_obra_social agregada correctamente.<br>";
        } else {
            echo "Error agregando la obra social $id_obra_social: " . $conn->error . "<br>";
        }
    }



    // Limpia la agenda actual del doctor
    $consulta_limpiar_agenda = "DELETE FROM agendas WHERE id_doctor=$id_doctor";
    if ($conn->query($consulta_limpiar_agenda) === TRUE) {
        echo "Agenda limpiada correctamente.<br>";
    } else {
        echo "Error limpiando la agenda: " . $conn->error . "<br>";
    }
    for ($mes = 1; $mes <= 12; $mes++) {
        // Inserta la nueva agenda del doctor
        foreach ($dias as $id_dia) {
            $consulta_insertar_agenda = "INSERT INTO agendas (id_doctor, id_dia, id_mes, inicio_jornada, fin_jornada, duracion_turno) 
                                     VALUES ($id_doctor, $id_dia, 1,'$inicio_jornada', '$fin_jornada', '$duracion_turno')";
            if ($conn->query($consulta_insertar_agenda) === TRUE) {
                echo "Agenda para el día $id_dia agregada correctamente.<br>";
            } else {
                echo "Error agregando la agenda para el día $id_dia: " . $conn->error . "<br>";
            }
        }
    }






    for ($mes = 1; $mes <= 12; $mes++) {
        foreach ($dias as $id_dia) {
            // Verificar si ya existe un horario para el médico en el mismo día y mes
            $stmt = $conn->prepare("SELECT id_agenda FROM agendas WHERE id_doctor = ? AND id_dia = ? AND id_mes = ?");
            $stmt->bind_param("iii", $id_doctor, $id_dia, $mes);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "Error: Ya existe un horario para el día $id_dia y el mes $mes.<br>";
            } else {
                // Calcular cantidad de turnos
                $cantidad_turnos = (strtotime($fin_jornada) - strtotime($inicio_jornada)) / (strtotime($duracion_turno) - strtotime('00:00:00'));

                // Insertar la nueva agenda
                $stmt_insert = $conn->prepare("INSERT INTO agendas (id_doctor, id_dia, id_mes, inicio_jornada, fin_jornada, duracion_turno) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt_insert->bind_param("iiisss", $id_doctor, $id_dia, $mes, $inicio_jornada, $fin_jornada, $duracion_turno);

                if ($stmt_insert->execute()) {
                    $message = "Datos actualizados";
                    echo "Horario para el día $id_dia del mes $mes agregado exitosamente.<br>";
                } else {
                    echo "Error: " . $stmt_insert->error . "<br>";
                    $message = "Error";
                }
                $stmt_insert->close();
            }
            $stmt->close();
        }
    }

















    echo "<html>
    <head>
        <script type='text/javascript'>
            function redirect() {
                alert('$message');
                window.location.href = './agenda_doctor.php';
            }
        </script>
    </head>
    <body onload='redirect()'>
    </body>
     </html>";
    exit();
    $conn->close();
} else {
    echo "Método no permitido.";
}
