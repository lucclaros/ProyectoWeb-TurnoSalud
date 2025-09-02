<?php
    include("./conexion_bd.php");
    session_start();

    $email= $_POST['email'];
    $repuesta = "Error al enviar la solicitud";
    
    
    $consulta = mysqli_query($conn, "INSERT INTO suscriptores
    (email)
    VALUES
    ('$email')");

    if($consulta)
    {
        $respuesta = "Su solicitud fue enviada con éxito";
    }

    mysqli_close($conn);

    $destino=$email;
    $asunto="Suscripcion a las novedades de TurnoSalud";
    $mensaje="Bienvenido a la comunidad de TurnoSalud. Recibiras novedades a partir de ahora por este medio";

    /* mail($destino,$asunto,$mensaje); */
    echo $respuesta;
?>