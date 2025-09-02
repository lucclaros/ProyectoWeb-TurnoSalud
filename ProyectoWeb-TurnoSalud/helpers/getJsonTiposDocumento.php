<?php
    session_start();
    /*  if (!isset($_SESSION['id_paciente']) || !isset($_SESSION['id_medico'])) {
            header('Location:./form_login.php');
            exit();
        } */

    include('../conexion_bd.php');


    $sql = "SELECT id_tipo_documento, nombre FROM tipos_documentos";
    $especialidades = [];

    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_tipo_documento = $fila['id_tipo_documento'];
            $objEspecialidad->nombre = $fila['nombre'];

            array_push($especialidades, $objEspecialidad);
        }
    }

    $id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0 ;
    $sql = "SELECT id_tipo_documento FROM usuarios WHERE id_usuario = $id";

    $id_tipo_documento = 0;

    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_tipo_documento = $fila['id_tipo_documento'];

            $id_tipo_documento = $objEspecialidad->id_tipo_documento;
        }
    }

    $objEspecialidades = new stdClass();
    $objEspecialidades->especialidades = $especialidades;
    $objEspecialidades->cantReg = count($especialidades);
    $objEspecialidades->id_tipo_documento = $id_tipo_documento;

    $salidaJson = json_encode($objEspecialidades);
    $dbh = null;

/*     sleep(1); */


    echo $salidaJson;
    mysqli_free_result($resultadoEspecialidades);

?>