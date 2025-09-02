<?php
include("conexion_bd.php");

session_start();
if (!isset($_SESSION['id_medico'])) {
    echo "Debe iniciar sesión primero.";
    exit;
}

$id_doctor = $_SESSION['id_medico'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['precio'])) {
        $precio = $_POST['precio'];
        
        // Actualizamos el precio en la tabla doctor
        $update_query = "UPDATE doctores SET precio=$precio WHERE id_doctor=$id_doctor";
        if ($conn->query($update_query) === TRUE) {
            echo "Precio actualizado correctamente.";
        } else {
            echo "Error al actualizar el precio: " . $conn->error;
        }
    } else {
        echo "No se recibió el precio.";
    }
}

// Cierra la conexión
$conn->close();
?>
