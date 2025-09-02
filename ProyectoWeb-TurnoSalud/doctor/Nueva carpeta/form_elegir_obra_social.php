<?php
include("conexion_bd.php");

// Verificamos si el usuario tiene una sesión iniciada y es un médico
session_start();
if (!isset($_SESSION['id_medico'])) {
    echo "Debe iniciar sesión primero.";
    exit;
}


// Obtenemos todas las obras sociales
$query_obras_sociales = "SELECT id_obra_social, nombre FROM obras_sociales";
$result_obras_sociales = $conn->query($query_obras_sociales);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Obras Sociales</title>
</head>
<body>
    <h1>Seleccionar Obras Sociales</h1>
    <form action="elegir_obra_social.php" method="POST">
        <label for="obras_sociales">Obras Sociales:</label>
        <select name="obras_sociales[]" id="obras_sociales">
            <?php while ($obra_social = $result_obras_sociales->fetch_assoc()): ?>
                <option value="<?php echo $obra_social['id_obra_social']; ?>">
                    <?php echo $obra_social['nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
