<?php
session_start();
// Verificar si la sesión está iniciada
if (!isset($_SESSION['administrador'])) {
    // Redirigir a index.php si no está iniciada la sesión
    header("Location: index.html");
    exit();
}

include 'conexion_bd.php';

  if (isset($_POST['tabla'])) {

    $tabla = $_POST['tabla'];

    
    if ($tabla == "especialidades") {
        $id_especialidad= $_POST['id_especialidad'];
        
        $sql =  "DELETE from especialidades where id_especialidad='$id_especialidad'";

        $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            echo "Registro eliminado exitosamente.";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }

    }

    if ($tabla == "turnos") {
        $id_turno= $_POST['id_turno'];
        
        $sql =  "DELETE from turnos where id_turno='$id_turno'";

        $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
           
            $message="Registro eliminado exitosamente.";
            
           
        } else {
           
            $message="Error al eliminar el registro: " . $conn->error;
        
        }
       

    }

    if ($tabla == "provincias") {
        $id_provincia= $_POST['id_provincia'];
        
        $sql =  "DELETE from provincias where id_provincia='$id_provincia'";

        $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            echo "Registro eliminado exitosamente.";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }

    }

    echo "<html>
            <head>
                <script type='text/javascript'>
                    function redirect() {
                        alert('$message');
                        window.location.href = '../index.php';
                    }
                </script>
            </head>
            <body onload='redirect()'>
            </body>
          </html>";
    exit();
    }
?>