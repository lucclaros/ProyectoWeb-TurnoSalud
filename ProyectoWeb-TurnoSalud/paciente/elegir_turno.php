<?php


session_start();
include 'conexion_bd.php';
if (!isset($_SESSION['id_paciente'])) {
    // Redirigir a index.php si no está iniciada la sesión
    header("Location: index.html");
    exit();
    }
$sacarTurno = 0;

// Si el paciente primero va al buscador, eligue el turno y luego se loguea entra acá.
if (isset($_SESSION['fecha-turno'])) {
    $fecha = $_SESSION['fecha-turno'];
    $hora = $_SESSION['hora-turno'];
    $id_doctor = $_SESSION['id_doctor_turno'];
    $id_paciente =  $_SESSION['id_paciente'];
    $sacarTurno = 1;
}

// Si el paciente se loguea, y luego va al buscador a sacar un turno entra acá.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente =  $_SESSION['id_paciente'];
    $fecha = $_POST['fechaSeleccionada'];
    $hora = $_POST['horaSeleccionada'];
    $id_doctor = $_POST['id_medico'];
    $sacarTurno = 1;
}


if ($sacarTurno == 1) {

    // Verificar si el turno ya está agendado para esa fecha y hora
    $sql_verificacion = "SELECT id_turno FROM turnos WHERE fecha_del_turno = '$fecha' AND hora_turno = '$hora' AND id_agenda = '$id_doctor'  AND estado_turno = 'Programado'";
    $result_verificacion = $conn->query($sql_verificacion);

    if ($result_verificacion->num_rows > 0) {
        echo "Error: Ya existe un turno agendado para esa fecha y hora.";
        $_SESSION['turno_agendado']=0;
        //header("Location: ./perfil_doctor_vista.php"); // el problema es que si no hay un turno me redirigue a perfil_doctor_vista, y da error
    } else {
        // Insertar el nuevo turno
        $estado_turno = 'Programado'; // Puedes cambiarlo según sea necesario
        $lugar = 'Consultorio'; // Puedes cambiarlo según sea necesario

        $sql_turno = "INSERT INTO turnos (id_paciente, id_agenda, fecha_del_turno, lugar, hora_turno, estado_turno) 
                      VALUES ($id_paciente, $id_doctor, '$fecha', '$lugar', '$hora', '$estado_turno')";

        if ($conn->query($sql_turno) === TRUE) {
           $message= "Turno agendado exitosamente.";
                //$_SESSION['turno_agendado']=1;
                //header("Location: ./perfil_paciente.php");
               // exit();
        } else {
            //$_SESSION['turno_agendado']=0;
            $message= "Error al agendar el turno: " . $conn->error;
            //exit();
        }
    }

    echo "<html>
    <head>
        <script type='text/javascript'>
            function redirect() {
                alert('$message');
                window.location.href = './ver_turnos_paciente.php';
            }
        </script>
    </head>
    <body onload='redirect()'>
    </body>
     </html>";
    exit();

    $conn->close();
}


