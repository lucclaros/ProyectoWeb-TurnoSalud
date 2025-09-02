<?php
session_start();


include("conexion_bd.php");



if (!isset($_SESSION['id_doctor'])) {
    echo "Debe iniciar sesión primero.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_turno'])) {
        $id_turno = $_POST['id_turno'];
        $estado = "Cancelado";
        
        // Actualizamos el precio en la tabla doctor
        $update_query = "UPDATE turnos SET estado_turno = '$estado' WHERE id_turno = $id_turno";
        $update_query;
        if ($conn->query($update_query) === TRUE) {
            $message="Exito al cancelar el turno.";
        } else {
            $message="Error al cancelar el turno: " . $conn->error;         
        }
    } else {
        echo "No se recibió el id_turno";
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
}

// Cierra la conexión
$conn->close();
?>
