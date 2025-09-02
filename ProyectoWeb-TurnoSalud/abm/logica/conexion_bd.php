<?php


$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "bd_turno_salud";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}



/*
$servidor = "bky7gnl3ylx3jeuwxjtu-mysql.services.clever-cloud.com";
$usuario = "usrwglaf60isxxs9";
$contrasena = "7D8T2evql1DPT559vWfH";
$base_datos = "bky7gnl3ylx3jeuwxjtu";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
*/