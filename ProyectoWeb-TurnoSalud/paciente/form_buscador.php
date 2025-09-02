
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscador de Médicos</title>
</head>
<body>
    <div id="buscador">
    <h1>Buscador de Médicos</h1>
    <form method="POST" action="consulta-buscador.php">
        <label for="especialidad">Especialidad:</label>
        <select name="especialidad" id="especialidad">
            <option value="">Seleccione una especialidad</option>
            <?php
            include("conexion_bd.php");

            // Consulta para obtener las especialidades
            $consultaEspecialidades = "SELECT id_especialidad, nombre FROM especialidades";
            $resultadoEspecialidades = mysqli_query($conn, $consultaEspecialidades);

            if ($resultadoEspecialidades) {
                while ($fila = mysqli_fetch_assoc($resultadoEspecialidades)) {
                    echo "<option value='" . $fila['id_especialidad'] . "'>" . $fila['nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>Error al cargar especialidades</option>";
            }

            mysqli_free_result($resultadoEspecialidades);
            ?>
        </select>
        <br>

        <br>
        <label for="obra_social">Obra Social:</label>
        <select name="obra_social" id="obra_social">
            <option value="">Seleccione una obra social</option>
            <?php
            // Consulta para obtener las obras sociales
            $consultaObrasSociales = "SELECT id_obra_social, nombre FROM obras_sociales";
            $resultadoObrasSociales = mysqli_query($conn, $consultaObrasSociales);

            if ($resultadoObrasSociales) {
                while ($fila = mysqli_fetch_assoc($resultadoObrasSociales)) {
                    echo "<option value='" . $fila['id_obra_social'] . "'>" . $fila['nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>Error al cargar obras sociales</option>";
            }

            mysqli_free_result($resultadoObrasSociales);
            mysqli_close($conn);
            ?>
        </select>
        <br>
        <label for="precio_minimo">Precio Mínimo:</label>
        <input type="text" name="precio_minimo" id="precio_minimo">
        <br>
        <label for="precio_maximo">Precio Máximo:</label>
        <input type="text" name="precio_maximo" id="precio_maximo">
        <br>
        <input type="submit" value="Buscar">
    </form>
        </div>
</body>
</html>
