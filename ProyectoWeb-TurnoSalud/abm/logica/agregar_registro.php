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




    if ($tabla == "turnos") {
        $fecha_del_turno = $_POST['fecha_del_turno'];
        $hora_turno = $_POST['hora_turno'];
        $lugar = $_POST['lugar'];
        $sql = "INSERT INTO turnos (fecha_del_turno,hora_turno,lugar)  VALUES ('$fecha_del_turno',' $hora_turno','$lugar')";

        //$sql = "insert into articulos(codArt,familia,um,fechaAlta,saldoStock)values(:codArt,:familia,:um,:fechaAlta,:saldoStock);";

        $result = $conn->query($sql);
        if ($result === TRUE) {
            $message="Registro insertado exitosamente.";
        } else {
            $message="Error al insertar el registro: " . $conn->error;
        }
    }

    if ($tabla == "especialidades") {
        $nombre = $_POST['nombre'];
        $sql = "INSERT INTO especialidades (nombre)  VALUES ('$nombre')";

        //$sql = "insert into articulos(codArt,familia,um,fechaAlta,saldoStock)values(:codArt,:familia,:um,:fechaAlta,:saldoStock);";

        $result = $conn->query($sql);
        if ($result === TRUE) {
            $message="Registro insertado exitosamente.";
        } else {
            $message="Error al insertar el registro: " . $conn->error;
        }
    }

    if ($tabla == "provincias") {
        $nombre = $_POST['nombre'];
        $sql = "INSERT INTO provincias (nombre)  VALUES ('$nombre')";

        //$sql = "insert into articulos(codArt,familia,um,fechaAlta,saldoStock)values(:codArt,:familia,:um,:fechaAlta,:saldoStock);";

        $result = $conn->query($sql);
        if ($result === TRUE) {
            $message="Registro insertado exitosamente.";
        } else {
            $message="Error al insertar el registro: " . $conn->error;
        }
    }



    if ($tabla == "usuarios") {
        $nombre = $_POST['nombre_usuario'];
        $apellido = $_POST['apellido_usuario'];
        $id_tipo_documento = $_POST['id_tipo_documento'];
        $id_provincia = $_POST['id_provincia'];
        $id_localidad = $_POST['id_localidad'];
        $sql = "INSERT INTO usuarios (id_tipo_documento,id_provincia,id_localidad,nombre_usuario,apellido_usuario)  VALUES ('$id_tipo_documento','$id_provincia','$id_localidad','$nombre','$apellido')";

        //$sql = "insert into articulos(codArt,familia,um,fechaAlta,saldoStock)values(:codArt,:familia,:um,:fechaAlta,:saldoStock);";

        $result = $conn->query($sql);
        if ($result === TRUE) {
            $message="Registro insertado exitosamente.";
        } else {
            $message="Error al insertar el registro: " . $conn->error;
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
