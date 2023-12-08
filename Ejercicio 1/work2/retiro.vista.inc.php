<?php
session_start();
$ci = $_SESSION["ci"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow");

// Actualizar la columna materia_elegida en la tabla academico.alumno a NULL
$resultado = mysqli_query($link, "UPDATE academico.alumno SET materia_elegida=NULL WHERE ci='$ci'");
$resultado2 = mysqli_query($link, "SELECT * FROM academico.alumno WHERE ci='$ci'");

$datosAlumno = mysqli_fetch_array($resultado2);


if ($datosAlumno["materia_elegida"] !== null) {
    if ($resultado) {
        echo "MATERIA ELIMINADA";
        echo "<br>";
    }
    
} else {
    echo "ALUMNO SIN MATERIA";
    header('Location: salida.php');
    echo "<br>";
}

?>





