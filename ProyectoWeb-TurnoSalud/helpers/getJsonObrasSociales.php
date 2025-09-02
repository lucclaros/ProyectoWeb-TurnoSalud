<?php
    session_start();
    /*  if (!isset($_SESSION['id_paciente']) || !isset($_SESSION['id_medico'])) {
            header('Location:./form_login.php');
            exit();
        } */

    include('../conexion_bd.php');
    /* $dbname = 'bky7gnl3ylx3jeuwxjtu';
        $dbhost = 'bky7gnl3ylx3jeuwxjtu-mysql.services.clever-cloud.com';
        $dbuser = 'usrwglaf60isxxs9';
        $dbpass = '7D8T2evql1DPT559vWfH'; */


    /* $dsn = "mysql:host=$dbhost;dbname=$dbname";
            $dbh = new PDO($dsn, $dbuser, $dbpass); */


    $sql = "SELECT id_obra_social, nombre FROM obras_sociales";
    $obrasSociales = [];

    /*  $stmt = $dbh->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute(); */

    $resultadoObrasSociales = mysqli_query($conn, $sql);

    if ($resultadoObrasSociales) {
        while ($fila = mysqli_fetch_assoc($resultadoObrasSociales)) {
            $objObraSocial = new stdClass();
            $objObraSocial->id_obra_social = $fila['id_obra_social'];
            $objObraSocial->nombre = $fila['nombre'];

            array_push($obrasSociales, $objObraSocial);
        }
    }

    if( isset($_SESSION['id_usuario']) ){
        if( isset($_SESSION['id_paciente']) ) {
            $id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;
            $sql = "SELECT id_obra_social FROM pacientes WHERE id_usuario = $id";
        }
        else{
            $id = isset($_SESSION['id_medico']) ? $_SESSION['id_medico'] : 0;
            $sql = "SELECT id_obra_social FROM doctores_obras_sociales WHERE id_doctor = $id";
        }
    }

    $id_obra_social = 0;

    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objEspecialidad = new stdClass();
            $objEspecialidad->id_obra_social = $fila['id_obra_social'];

            $id_obra_social= $objEspecialidad->id_obra_social;
        }
    }

    $objObraSociales = new stdClass();
    $objObraSociales->obrasSociales = $obrasSociales;
    $objObraSociales->cantReg = count($obrasSociales);
    $objObraSociales->id_obra_social = $id_obra_social;

    $salidaJson = json_encode($objObraSociales);
    $dbh = null;

/*     sleep(1);
 */

    echo $salidaJson;
    mysqli_free_result($resultadoObrasSociales);

?>