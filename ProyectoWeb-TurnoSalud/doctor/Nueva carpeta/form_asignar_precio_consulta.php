<?php
include("conexion_bd.php");

session_start();
if (!isset($_SESSION['id_doctor'])) {
    echo "Debe iniciar sesión primero.";
    exit;
}

$id_doctor = $_SESSION['id_doctor'];

// Obtenemos el precio actual del doctor logueado
$query_doctor = "SELECT precio FROM doctores WHERE id_doctor=$id_doctor";
$result_doctor = $conn->query($query_doctor);

if ($result_doctor->num_rows > 0) {
    $doctor = $result_doctor->fetch_assoc();
    $precio_actual = $doctor['precio'];
} else {
    echo "No se encontró el médico.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Precio de Consulta</title>
</head>
<body>
    <h1>Actualizar Precio de Consulta</h1>
    <form action="asignar_precio_consulta.php" method="POST">
        <label for="precio">Precio de Consulta:</label>
        <input type="text" name="precio" id="precio" value="<?php echo htmlspecialchars($precio_actual); ?>" required>
        <br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
