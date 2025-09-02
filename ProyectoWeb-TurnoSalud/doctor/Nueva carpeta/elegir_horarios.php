<?php
session_start();
include 'conexion_bd.php';

if (!isset($_SESSION['id_doctor'])) {
        // Redirigir a index.php si no está iniciada la sesión
        header("Location: index.html");
        exit();
}

echo $_SESSION['id_doctor'];

//$id_doctor = $_POST['id_doctor'];
$id_doctor = $_SESSION['id_doctor'];
$dias = $_POST['dia'];
$inicio_jornada = $_POST['inicio_jornada'];
$fin_jornada = $_POST['fin_jornada'];
$duracion_turno = $_POST['duracion_turno'];

for ($mes = 1; $mes <= 12; $mes++) {
    foreach ($dias as $id_dia) {
        // Verificar si ya existe un horario para el médico en el mismo día y mes
        $stmt = $conn->prepare("SELECT id_agenda FROM agendas WHERE id_doctor = ? AND id_dia = ? AND id_mes = ?");
        $stmt->bind_param("iii", $id_doctor, $id_dia, $mes);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Error: Ya existe un horario para el día $id_dia y el mes $mes.<br>";
        } else {
            // Calcular cantidad de turnos
            $cantidad_turnos = (strtotime($fin_jornada) - strtotime($inicio_jornada)) / (strtotime($duracion_turno) - strtotime('00:00:00'));

            // Insertar la nueva agenda
            $stmt_insert = $conn->prepare("INSERT INTO agendas (id_doctor, id_dia, id_mes, inicio_jornada, fin_jornada, duracion_turno) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt_insert->bind_param("iiisss", $id_doctor, $id_dia, $mes, $inicio_jornada, $fin_jornada, $duracion_turno);

            if ($stmt_insert->execute()) {
                echo "Horario para el día $id_dia del mes $mes agregado exitosamente.<br>";
            } else {
                echo "Error: " . $stmt_insert->error . "<br>";
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }
}

$conn->close();
?>
