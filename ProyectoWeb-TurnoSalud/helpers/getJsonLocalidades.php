<?php
    session_start();
    /*  if (!isset($_SESSION['id_paciente']) || !isset($_SESSION['id_medico'])) {
            header('Location:./form_login.php');
            exit();
        } */

        include('../conexion_bd.php');


    $sql = "SELECT id_codigo_postal, nombre_de_localidad FROM localidades";
    $especialidades = [];

    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_codigo_postal = $fila['id_codigo_postal'];
            $objEspecialidad->nombre_de_localidad = $fila['nombre_de_localidad'];

            array_push($especialidades, $objEspecialidad);
        }
    }

    $id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;
    $sql = "SELECT id_localidad FROM usuarios WHERE id_usuario = $id";

    $id_localidad = 0;

    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_localidad = $fila['id_localidad'];

            $id_localidad = $objEspecialidad->id_localidad;
        }
    }

    $objLocalidades = new stdClass();
    $objLocalidades->localidades = $especialidades;
    $objLocalidades->id_localidad = $id_localidad;
    $objLocalidades->cantReg = count($especialidades);
    $objLocalidades->id = $id;

    $salidaJson = json_encode($objLocalidades);
    $dbh = null;

    /*     sleep(1); */


    echo $salidaJson;
    mysqli_free_result($resultadoEspecialidades);

?>