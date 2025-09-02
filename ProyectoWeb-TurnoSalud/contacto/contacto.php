<?php
include("../conexion_bd.php");
    session_start();

	$nombre = $_POST['nombre'];
	$email= $_POST['email'];
    $comentario = $_POST['comentario'];
    $repuesta = "Error al intentar enviar contacto";
    
    
    $consulta = mysqli_query($conn, "INSERT INTO contactos 
    (nombre, email, comentario) 
    VALUES
    ('$nombre', '$email','$comentario')");

    if($consulta)
    {
        $respuesta = "Su solicitud fue enviada con exito";
    }

    mysqli_close($conn);

    $destino="contactos@turnosalud.com.ar";
    $asunto="Contacto desde el sitio";
    $mensaje="Nombre: ".$nombre." Email: ".$email." Mensaje: ".$comentario;

    $header="From: ".$nombre."<".$email.">";

    /* mail($destino,$asunto,$mensaje,$header); */
    echo $respuesta;
 ?>