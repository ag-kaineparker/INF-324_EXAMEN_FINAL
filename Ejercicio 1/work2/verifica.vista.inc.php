<?php
session_start();
$ci = $_SESSION["ci"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow2");

// Obtener información sobre el alumno y las materias aprobadas
$resultAlumno = mysqli_query($link, "SELECT * FROM academico.alumno WHERE ci='$ci'");
$filaAlumno = mysqli_fetch_array($resultAlumno);

// Número total de materias requeridas
$totalMaterias = 15;

// Verificar el número de materias aprobadas
$materiasAprobadas = $filaAlumno["materias_aprobadas"];

if ($materiasAprobadas < $totalMaterias) {
    // Mostrar mensaje si faltan materias
    $mensaje = "MATERIAS NO APROBADAS, te faltan " . ($totalMaterias - $materiasAprobadas) . " MATERIAS";
    $formularioOculto = "no";
} else {
    // Mostrar mensaje si todas las materias están aprobadas
    $mensaje = "TODAS LAS MATERIAS APROBADAS $totalMaterias de $totalMaterias, puede retirar su certificado";
    $formularioOculto = "si";
}
?>

<label for="pregunta"><?php echo $mensaje; ?></label><br>
<input type="hidden" value="<?php echo $formularioOculto; ?>" name="pregunta" id="pregunta"/>
<br>
