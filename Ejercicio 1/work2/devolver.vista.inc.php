<?php 
session_start();
$ci = $_SESSION["ci"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow");

// Verificar si el usuario tiene una materia elegida
$resultado = mysqli_query($link, "SELECT * FROM academico.alumno WHERE ci='$ci'");
$datosAlumno = mysqli_fetch_array($resultado);

if ($datosAlumno["materia_elegida"] !== null) {
    echo '<label for="pregunta">¿DESEA RETIRAR SU MATERIA ELEGIDA?</label><br>';
    echo '<input type="text" value="no" name="pregunta" id="pregunta"/><br>';
} else {
    echo "NO SE ELIGIÓ MATERIA";
    echo "<br>";

}
?>
