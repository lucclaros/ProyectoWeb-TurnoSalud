<?php
    session_start();
    /*  if (!isset($_SESSION['id_paciente']) || !isset($_SESSION['id_medico'])) {
            header('Location:./form_login.php');
            exit();
        } */

    include('../conexion_bd.php');


    $sql = "SELECT id_especialidad, nombre FROM especialidades";
    $especialidades = [];

    $resultadoEspecialidades = mysqli_query($conn, $sql);

    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_especialidad = $fila['id_especialidad'];
            $objEspecialidad->nombre = $fila['nombre'];

            array_push($especialidades, $objEspecialidad);
        }
    }

    $id = isset($_SESSION['id_doctor']) ? $_SESSION['id_doctor'] : 0;
    $sql = "SELECT id_especialidad FROM doctores WHERE id_usuario = $id";

    $id_especialidad = 0;

    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_especialidad = $fila['id_especialidad'];

            $id_especialidad = $objEspecialidad->id_especialidad;
        }
    }

    $objEspecialidades = new stdClass();
    $objEspecialidades->especialidades = $especialidades;
    $objEspecialidades->cantReg = count($especialidades);
    $objEspecialidades->id_especialidad = $id_especialidad;

    $salidaJson = json_encode($objEspecialidades);

    echo $salidaJson;
    mysqli_free_result($resultadoEspecialidades);

?>