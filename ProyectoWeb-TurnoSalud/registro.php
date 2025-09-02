<?php
include("conexion_bd.php");
    session_start();

	$nombre = $_POST['nombre'];
	$apellido= $_POST['apellido'];
    $id_tipo_documento = $_POST['id_tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $id_provincia = $_POST['id_provincia'];
    $id_localidad = $_POST['id_localidad'];     
	$usuario = $_POST['usuario'];
	$password = md5($_POST['password']);
    $email = $_POST['email'];
    $tipo_registro = $_POST['tipo_registro'];
    $tiene_obra_social = isset($_POST['id_obra_social']) && $_POST['id_obra_social'] != 0 ? 'si' : 'no'; 
    $id_obra_social = NULL; // se establece como NULL 

    
    if ($tiene_obra_social == 'si') {
        $id_obra_social = $_POST['id_obra_social']; // solo si tiene obra soical
    }
    $numero_afiliado = $tiene_obra_social == 'si' ? $_POST['numero_afiliado'] : NULL;
    $id_especialidad = $tipo_registro == 'doctor' ? $_POST['id_especialidad'] : NULL;
    $direccion = $tipo_registro == 'doctor' ? $_POST['direccion'] : NULL;

    $numero_matricula = $tipo_registro == 'doctor' ? $_POST['numero_matricula'] : NULL; // num_matricula

    $_SESSION['nombre'] = $nombre;

   // validar que la matricula ingresada este en la base de datos "matricula"
    if ($tipo_registro == 'doctor') {
    $check_matricula = mysqli_query($conn, "SELECT * FROM matriculas WHERE numero_matricula = '$numero_matricula'");
        if (mysqli_num_rows($check_matricula) == 0) {
            echo "La matrícula ingresada no es válida. <a href='form_registro_doctor.php'>Volver a la página de registro</a>";
            exit();
        }
    }
	
    // si usuario o email ya existen
    $check_usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario = '$usuario' OR email = '$email'");
    if (mysqli_num_rows($check_usuario) > 0) {
        echo "El nombre de usuario o el email ya están en uso. <a href='form_login.php'>Volver a la página de registro</a>";
    } 
    else {
        $consulta = mysqli_query($conn, "INSERT INTO usuarios 
        (nombre_usuario, apellido_usuario, id_tipo_documento, documento_usuario, id_provincia, id_localidad, usuario, password, email) 
        VALUES
        ('$nombre', '$apellido','$id_tipo_documento', '$numero_documento', '$id_provincia', '$id_localidad', '$usuario', '$password','$email')");


        if ($consulta) {
            $id_usuario = mysqli_insert_id($conn);
            // consulta sql para insertar el paciente
            $consulta_sql = "INSERT INTO pacientes 
            (id_usuario, id_obra_social, numero_afiliado) 
            VALUES
            ('$id_usuario', " . ($id_obra_social !== NULL ? "'$id_obra_social'" : "NULL") . ", " . ($numero_afiliado !== NULL ? "'$numero_afiliado'" : "NULL") . ")";
            // quizas consultar con el profe de labo, si es recomendable tener estos NULL en la bdd, porque creo que con un if id obra social es null, solo insertar paciente e id usuario, pero
            // el codigo seria un poco mas largo
            if ($tipo_registro == 'paciente') {
                // se inserta la consulta
                $consulta_paciente = mysqli_query($conn, $consulta_sql);
            echo "Consulta SQL: " . $consulta_sql . "<br>";
            }
            
            elseif ($tipo_registro == 'doctor') {
                $consulta_doctor = mysqli_query($conn, "INSERT INTO doctores 
                    (id_usuario, id_especialidad, direccion) 
                    VALUES
                    ('$id_usuario', '$id_especialidad', '$direccion')");
                    $id_doctor = mysqli_insert_id($conn);
                    // actualiza tabla matricula en id doctor
                    $update_matricula = mysqli_query($conn, "UPDATE matriculas SET id_doctor = '$id_doctor' WHERE numero_matricula = '$numero_matricula'");
                    echo "Consulta SQL: " . $consulta_sql . "<br>";
            }
           

            header("Location:form_login.php");
        } 
      
        else {
            echo "Error en el registro: " . mysqli_error($conn);
        }
       
    }

    mysqli_close($conn);
 ?>