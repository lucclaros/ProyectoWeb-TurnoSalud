<?php
include 'conexion_bd.php';
session_start();
if (!isset($_SESSION['id_paciente'])) {
    // Redirigir a index.php si no está iniciada la sesión
    header("Location: index.html");
    exit();

// ID del médico preseleccionado (puede ser dinámico)
$id_doctor = $_POST['id_doctor']; // or any other way to get the doctor's ID
$id_paciente=2;
// Generar fechas desde hoy hasta 10 días después
$fechas = [];
for ($i = 0; $i <= 10; $i++) {
    $fechas[] = date('Y-m-d', strtotime("+$i days"));
}

// Obtener el mes actual
$mes_actual = date('n'); // Month number without leading zeros

// Obtener horarios del médico para el mes actual
$horarios_medicos = [];
$sql_horarios = "SELECT * FROM agendas WHERE id_doctor = $id_doctor AND id_mes = $mes_actual";
$result_horarios = $conn->query($sql_horarios);
while ($row = $result_horarios->fetch_assoc()) {
    $horarios_medicos[] = $row;
}

// Obtener turnos ya agendados del médico
$turnos_agendados = [];
$sql_turnos = "SELECT t.fecha_del_turno, t.hora_turno 
               FROM turnos t 
               JOIN agendas a ON t.id_agenda = a.id_agenda 
               WHERE a.id_doctor = $id_doctor AND t.estado_turno = 'Programado'";
$result_turnos = $conn->query($sql_turnos);
while ($row = $result_turnos->fetch_assoc()) {
    $turnos_agendados[] = $row['fecha_del_turno'] . ' ' . $row['hora_turno'];
}

// Mapeo de días de la semana
$dias_semana = [];
$sql_dias = "SELECT * FROM dias";
$result_dias = $conn->query($sql_dias);
while ($row = $result_dias->fetch_assoc()) {
    $dias_semana[$row['id_dia']] = $row['nombre_dia'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos Disponibles</title>
    <style>
        .fecha {
            margin-bottom: 20px;
        }
        .horarios button {
            margin-right: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Turnos Disponibles</h1>
    <form method="POST" action="elegir_turno.php">
        <div id="fechas-horarios">
            <?php
            foreach ($fechas as $fecha) {
                $dia_semana_ingles = date('l', strtotime($fecha));
                $dia_semana_espanol = date('N', strtotime($fecha)); // Número del día de la semana
                echo "<div class='fecha'>";
                echo "<h3>$fecha ({$dias_semana[$dia_semana_espanol]})</h3>";
                echo "<div class='horarios'>";
                foreach ($horarios_medicos as $horario) {
                    if ($dia_semana_espanol == $horario['id_dia']) {
                        $hora_inicio = strtotime($horario['inicio_jornada']);
                        $hora_fin = strtotime($horario['fin_jornada']);
                        $duracion_turno = strtotime($horario['duracion_turno']) - strtotime('00:00:00');
                        while ($hora_inicio < $hora_fin) {
                            $hora_turno = date('H:i', $hora_inicio);
                            $fecha_hora_turno = "$fecha $hora_turno";
                            
                            // Comprobar si el turno ya está agendado
                            $turno_ocupado = false;
                            foreach ($turnos_agendados as $turno) {
                                if ($turno == $fecha_hora_turno) {
                                    $turno_ocupado = true;
                                    break;
                                }
                            }
                            
                            // Mostrar el botón solo si el turno está libre
                            if (!$turno_ocupado) {
                                echo "<button type='button' onclick='seleccionarHorario(\"$fecha\", \"$hora_turno\")'>$hora_turno</button>";
                            }

                            $hora_inicio += $duracion_turno;
                        }
                    }
                }
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <div>
            <input type="hidden" id="fechaSeleccionada" name="fechaSeleccionada">
            <input type="hidden" id="horaSeleccionada" name="horaSeleccionada">
            <!--<input type="hidden" id="idPaciente" name="id_paciente" value="<?php echo $id_paciente; ?>">
             usare una variable session para el id_paciente       -->
            <input type="hidden" id="idDoctor" name="id_medico" value="<?php echo $id_doctor; ?>">
            <button type="submit">Agendar Turno</button>
        </div>
    </form>

    <script>
        function seleccionarHorario(fecha, horario) {
            document.getElementById('fechaSeleccionada').value = fecha;
            document.getElementById('horaSeleccionada').value = horario;
        }
    </script>
</body>
</html>
