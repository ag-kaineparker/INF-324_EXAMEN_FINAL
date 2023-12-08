<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 50px;
    }

    h2 {
        text-align: center;
        text-decoration: underline;
        color: #333;
    }

    p {
        margin-bottom: 10px;
        color: #555;
    }

    strong {
        font-weight: bold;
    }

    .certificado {
        text-align: center;
        margin-top: 20px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }

    .btn-container {
        text-align: center;
        margin-top: 20px;
    }

    .btn-container input {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<?php 
session_start();
$ci = $_SESSION["ci"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow2");
?>
<?php

$ci = $_SESSION["ci"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow2");

// Obtener información sobre el estado de verificación de documentos
$resultado = mysqli_query($link, "SELECT * FROM academico.alumno WHERE ci='$ci'");
$datosAlumno = mysqli_fetch_array($resultado);

// Obtener información del usuario desde la tabla academico.usuario
$resultadoUsuario = mysqli_query($link, "SELECT ci, Email, Direccion, Telefono FROM academico.usuario WHERE ci='$ci'");
$datosUsuario = mysqli_fetch_array($resultadoUsuario);

$nombre = $datosAlumno["nombre"];
$departamento = $datosAlumno["departamento"];
$email = $datosUsuario["Email"];
$direccion = $datosUsuario["Direccion"];
$telefono = $datosUsuario["Telefono"];

// Verificar si se ha enviado el formulario de elección de materia
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["elegirMateria"])) {
    $materiaSeleccionada = mysqli_real_escape_string($link, $_GET["materiaSeleccionada"]);

    // Obtener información sobre la materia seleccionada
    $resultMateria = mysqli_query($link, "SELECT * FROM academico.materias WHERE codigo='$materiaSeleccionada'");
    $filaMateria = mysqli_fetch_array($resultMateria);

    // Verificar si hay espacio disponible para inscribirse en la materia
    if ($filaMateria["numero_inscritos"] < $filaMateria["maximo_inscritos"]) {
        // Actualizar la columna materia_elegida en la tabla academico.alumno
        $actualizarMateria = "UPDATE academico.alumno SET materia_elegida='$materiaSeleccionada' WHERE ci='$ci'";
        mysqli_query($link, $actualizarMateria);

        // Incrementar el contador de inscritos en la materia
        $nuevoInscritos = $filaMateria["numero_inscritos"] + 1;
        mysqli_query($link, "UPDATE academico.materias SET numero_inscritos=$nuevoInscritos WHERE codigo='$materiaSeleccionada'");
        echo "MATERIA ELEGIDA";
        header("Location: motor.php?flujo=F1&procesosiguiente=P6");
        exit();
    } else {
        // Si no hay espacio disponible, mostrar un mensaje
        $mensaje = "No hay espacio disponible en la materia seleccionada.";
    }
}

// Obtener la lista de materias disponibles
$resultMaterias = mysqli_query($link, "SELECT codigo FROM academico.materias");
$materiasDisponibles = mysqli_fetch_all($resultMaterias, MYSQLI_ASSOC);

// Obtener información sobre el estado de verificación de documentos
$actualizado = $datosAlumno["Docuactualizado"];
?>
<div class="container">
    <h2>Certificado de Egreso</h2>
    <p>Por la presente, se certifica que:</p>
    <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
    <p><strong>CI:</strong> <?php echo $ci; ?></p>
    <p><strong>Departamento:</strong> <?php echo $departamento; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Dirección:</strong> <?php echo $direccion; ?></p>
    <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
    <p>ha completado satisfactoriamente los requisitos para obtener el título de <strong>EGRESADO en Informática</strong>.</p>
</div>
<br>
<br>
<br>

