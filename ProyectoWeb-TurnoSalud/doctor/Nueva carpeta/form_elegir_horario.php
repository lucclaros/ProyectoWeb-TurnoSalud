
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Horarios del Médico</title>
</head>
<body>

    <?php 
    session_start();
    if (!isset($_SESSION['id_doctor'])) {
        // Redirigir a index.php si no está iniciada la sesión
        header("Location: index.html");
        exit();
    }
    echo "id_medico: ". $_SESSION['id_medico']; ?>
    <h1>Configuración de Horarios del Médico</h1>
    <form method="POST" action="elegir_horarios.php">
        <!-- 
    <div>
            <label for="id_doctor">ID del Médico:</label>
            <input type="number" id="id_doctor" name="id_doctor" required>
        </div>
-->
         <input type="hidden" id="id_mes" name="id_mes" value="0">  <!-- Hidden field for id_mes -->
        <div>
            <label for="dia">Día:</label><br>
            <input type="checkbox" id="dia1" name="dia[]" value="1">
            <label for="dia1">Lunes</label><br>
            <input type="checkbox" id="dia2" name="dia[]" value="2">
            <label for="dia2">Martes</label><br>
            <input type="checkbox" id="dia3" name="dia[]" value="3">
            <label for="dia3">Miércoles</label><br>
            <input type="checkbox" id="dia4" name="dia[]" value="4">
            <label for="dia4">Jueves</label><br>
            <input type="checkbox" id="dia5" name="dia[]" value="5">
            <label for="dia5">Viernes</label><br>
            <input type="checkbox" id="dia6" name="dia[]" value="6">
            <label for="dia6">Sábado</label><br>
            <input type="checkbox" id="dia7" name="dia[]" value="7">
            <label for="dia7">Domingo</label><br>
        </div>
        <div>
            <label for="inicio_jornada">Inicio de Jornada:</label>
            <input type="time" id="inicio_jornada" name="inicio_jornada" required>
        </div>
        <div>
            <label for="fin_jornada">Fin de Jornada:</label>
            <input type="time" id="fin_jornada" name="fin_jornada" required>
        </div>
        <div>
            <label for="duracion_turno">Duración del Turno:</label>
            <input type="time" id="duracion_turno" name="duracion_turno" required>
        </div>
        <div>
            <button type="submit">Guardar Horarios</button>
        </div>
    </form>
</body>
</html>
