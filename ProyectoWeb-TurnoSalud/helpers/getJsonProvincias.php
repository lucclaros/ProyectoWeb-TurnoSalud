<?php
    session_start();
    /*  if (!isset($_SESSION['id_paciente']) || !isset($_SESSION['id_medico'])) {
            header('Location:./form_login.php');
            exit();
        } */

    include('../conexion_bd.php');


    $sql = "SELECT id_provincia, nombre FROM provincias";
    $especialidades = [];

    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_provincia = $fila['id_provincia'];
            $objEspecialidad->nombre = $fila['nombre'];

            array_push($especialidades, $objEspecialidad);
        }
    }

    $id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;
    $sql = "SELECT id_provincia FROM usuarios WHERE id_usuario = $id";

    $id_provincia = 0;

    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_provincia = $fila['id_provincia'];

            $id_provincia = $objEspecialidad->id_provincia;
        }
    }

    $objEspecialidades = new stdClass();
    $objEspecialidades->especialidades = $especialidades;
    $objEspecialidades->cantReg = count($especialidades);
    $objEspecialidades->id_provincia = $id_provincia;

    $salidaJson = json_encode($objEspecialidades);
    $dbh = null;

/*     sleep(1); */


    echo $salidaJson;
    mysqli_free_result($resultadoEspecialidades);

?>