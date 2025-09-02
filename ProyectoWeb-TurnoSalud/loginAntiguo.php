<?php
session_start();
include("conexion_bd.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreUsuario = $_POST['usuario'];
    $password = $_POST['password'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $consulta = "SELECT id_usuario, nombre_usuario, imagen FROM usuarios WHERE usuario=? AND password=md5(?)";
    $stmt = $conn->prepare($consulta);
    $stmt->bind_param('ss', $nombreUsuario, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado === false) {
        echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $conn->error]);
    } else {
        if ($resultado->num_rows == 0) {
            echo json_encode(['success' => false, 'message' => 'No es un usuario registrado, registrese primero.']);
        } else {

            $respuesta = $resultado->fetch_assoc();
            $_SESSION['nombre'] = $respuesta['nombre_usuario'];
            $_SESSION['id_usuario'] = $respuesta['id_usuario'];
            $_SESSION['imagen'] = $respuesta['imagen'];

            // Verifica si el usuario es un médico
            $consulta_medico = "SELECT id_doctor FROM doctores WHERE id_usuario=?";
            $stmt_medico = $conn->prepare($consulta_medico);
            $stmt_medico->bind_param('i', $_SESSION['id_usuario']);
            $stmt_medico->execute();
            $resultado_medico = $stmt_medico->get_result();

             // Verifica si la consulta fue exitosa
            if ($resultado_medico === false) {
                echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $conn->error]);
            } else {
                if ($resultado_medico->num_rows > 0 && !isset($_SESSION['id_paciente'])) {
                    $respuesta_medico = $resultado_medico->fetch_assoc();
                    $_SESSION['id_doctor'] = $respuesta_medico['id_doctor'];
                    echo json_encode(['success' => true, 'redirect' => './doctor/perfil_doctor.php']);
                } else {
                     // Verifica si el usuario es un paciente
                    $consulta_paciente = "SELECT id_paciente FROM pacientes WHERE id_usuario=?";
                    $stmt_paciente = $conn->prepare($consulta_paciente);
                    $stmt_paciente->bind_param('i', $_SESSION['id_usuario']);
                    $stmt_paciente->execute();
                    $resultado_paciente = $stmt_paciente->get_result();

                    if ($resultado_paciente === false) {
                        echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $conn->error]);
                    } else {
                        if ($resultado_paciente->num_rows > 0) {
                            $respuesta_paciente = $resultado_paciente->fetch_assoc();
                            $_SESSION['id_paciente'] = $respuesta_paciente['id_paciente'];

                            if (isset($_SESSION['fecha-turno'])) {
                                echo json_encode(['success' => true, 'redirect' => './paciente/elegir_turno.php']);
                            } else {
                                echo json_encode(['success' => true, 'redirect' => './paciente/perfil_paciente.php']);
                            }
                        } else {
                            echo json_encode(['success' => false, 'message' => 'No se pudo determinar el rol del usuario']);
                        }
                    }
                }
            }
        }
    }

    $stmt->close();
    $conn->close();
}
