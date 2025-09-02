<?php
session_start();
require "conexion_bd.php";

if (isset($_FILES['imagen'])) {
    $fileTmpPath = $_FILES['imagen']['tmp_name'];
    $fileName = $_FILES['imagen']['name'];
    $fileType = $_FILES['imagen']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $image = $newFileName;

    $allowedFileExtensions = array('png', 'jpg', 'jpeg');

    if (in_array($fileExtension, $allowedFileExtensions)) {
        // Ruta donde se guardará la imagen
        $uploadFileDir = 'uploads/';
        
        // verifica si la carpeta existe, si no, la crea
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }
        
        $dest_path = $uploadFileDir . $newFileName;

        // Comprimir la imagen (si es necesario)
        $calidad = 40;
        $originalImage = null;
        if ($fileExtension == 'png') {
            $originalImage = imagecreatefrompng($fileTmpPath);
        } else {
            $originalImage = imagecreatefromjpeg($fileTmpPath);
        }

        if (imagejpeg($originalImage, $dest_path, $calidad)) {
            // Actualizar la ruta de la imagen en la tabla usuario
            $userId = $_SESSION['id_usuario'];
            $sqlUpdate = "UPDATE usuarios SET imagen = ? WHERE id_usuario = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            if ($stmtUpdate) {
                $stmtUpdate->bind_param("si", $dest_path, $userId);
                if ($stmtUpdate->execute()) {
                    // Actualizar la sesión con la nueva ruta de imagen
                    $_SESSION['ruta_imagen'] = $dest_path;
                    // Determinar si el usuario es doctor o paciente
                    $sql = "SELECT COUNT(*) AS count_doctor FROM doctores WHERE id_usuario = ?";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->bind_param("i", $userId);
                        $stmt->execute();
                        $stmt->bind_result($countDoctor);
                        $stmt->fetch();
                        $stmt->close();

                        if ($countDoctor > 0) {
                            // El usuario es doctor
                            header("Location: perfil_doctor.php");
                        } else {
                            // El usuario es paciente
                            header("Location: perfil_paciente.php");
                        }
                    } else {
                        echo "Error en la preparación de la consulta de verificación.";
                    }
                } else {
                    echo "Error al guardar la ruta en la base de datos.";
                }
                $stmtUpdate->close();
            } else {
                echo "Error en la preparación de la consulta de actualización.";
            }
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Tipo de archivo no permitido.";
    }
} else {
    echo "No se ha recibido ningún archivo.";
}
?>