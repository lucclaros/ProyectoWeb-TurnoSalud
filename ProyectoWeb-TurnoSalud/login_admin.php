
<?php
$consulta_administrador = "SELECT id_usuario FROM usuarios WHERE id_usuario=? AND administrador=1";
$stmt_administrador = $conn->prepare($consulta_administrador);
$stmt_administrador->bind_param('i', $_SESSION['id_usuario']);
$stmt_administrador->execute();
$resultado_administrador = $stmt_administrador->get_result();

// Verificar si la consulta tuvo algún error
if ($resultado_administrador === false) {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $stmt_administrador->error]);
} else {
    // Verificar si se encontró algún administrador y si no hay sesión de administrador
    if ($resultado_administrador->num_rows > 0 /*&& !isset($_SESSION['administrador'])*/) {
        // Obtener el resultado del administrador
        $respuesta_administrador = $resultado_administrador->fetch_assoc();
        
        // Almacenar la sesión de administrador si es administrador
        $_SESSION['administrador'] = 1;

        // Redirigir al panel de administración si es administrador
        echo json_encode(['success' => true, 'redirect' => './abm/index.php']);
    } else {
        // Redirigir a otro lugar si no es administrador
        echo json_encode(['success' => true, 'redirect' => './index.html']);
    }
}

?>

