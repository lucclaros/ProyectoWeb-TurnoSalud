<?php
    session_start();
    if (!isset($_SESSION['id_doctor'])) {
        // Redirigir a index.php si no está iniciada la sesión
        header("Location: index.html");
        exit();
    }
    include('./conexion_bd.php');

    $usuario = $_POST['id_usuario'];
    $email = $_POST['id_email']; 
    $nombre = $_POST['id_name'];
    $apellido = $_POST['id_apellido'];
    $id_provincia = $_POST['provincia'];
    $id_localidad = $_POST['localidad'];
    $id_tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['id_numero_documento'];
    $id_especialidad = $_POST['especialidad'];

    

    $id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;

    $sql = "UPDATE usuarios 
    SET 
        id_tipo_documento=$id_tipo_documento,
        id_provincia=$id_provincia,
        id_localidad=$id_localidad,
        nombre_usuario='$nombre',
        apellido_usuario='$apellido',
        documento_usuario='$numero_documento',
        usuario='$usuario',
        email='$email'
    WHERE 
        id_usuario=$id";
    
    $respuesta = mysqli_query($conn, $sql);

    if($respuesta){
        echo 'Registro en usuarios actualizado exitósamente';
    }
    else{
        echo 'Error en la consulta: ' . $conn->error;
    }
     
    $sql = "UPDATE doctores
    SET 
        id_especialidad = $id_especialidad
    WHERE 
        id_usuario=$id";

    $respuesta = mysqli_query($conn, $sql);

    if($respuesta){
        echo 'Registro en doctores actualizado exitósamente';
    }
    else{
        echo 'Error en la consulta: ' . $conn->error;
    }

    include('../subir_imagen.php');

?>