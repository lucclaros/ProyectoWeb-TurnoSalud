<?php
    session_start();
    /*  if (!isset($_SESSION['id_paciente']) || !isset($_SESSION['id_medico'])) {
            header('Location:./form_login.php');
            exit();
        } */

    include('../conexion_bd.php');

    $id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;

    $sql = "";

    if(isset($_SESSION['id_doctor'])){
        $sql = "SELECT u.nombre_usuario, u.apellido_usuario, u.documento_usuario, u.email, u.usuario, u.imagen, p.direccion 
        FROM usuarios u JOIN doctores p
        ON u.id_usuario=p.id_usuario 
        WHERE u.id_usuario = $id";
    }
    else{
        $sql = "SELECT u.nombre_usuario, u.apellido_usuario, u.documento_usuario, u.email, u.usuario, u.imagen, p.numero_afiliado 
        FROM usuarios u JOIN pacientes p
        ON u.id_usuario=p.id_usuario 
        WHERE u.id_usuario = $id";
    }

    
    $resultadoEspecialidades = mysqli_query($conn, $sql);


    if ($resultadoEspecialidades) {
        while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
            $objUsuario = new stdClass();
            $objUsuario->documento = $fila['documento_usuario'];
            $objUsuario->nombre = $fila['nombre_usuario'];
            $objUsuario->apellido = $fila['apellido_usuario'];
            $objUsuario->email = $fila['email'];
            $objUsuario->usuario = $fila['usuario'];
            
            if(isset($_SESSION['id_doctor'])){
                $objUsuario->direccion = $fila['direccion'];
            }
            else{
                $objUsuario->numero_afiliado = $fila['numero_afiliado'];
            }
            
            $objUsuario->imagen = $fila['imagen'];
        }
    }

    $salidaJson = json_encode($objUsuario);

/*     sleep(1); */


    echo $salidaJson;
    mysqli_free_result($resultadoEspecialidades);

?>