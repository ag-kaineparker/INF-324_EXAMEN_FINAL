<?php
$ci=$_GET["ci"];
$nombre=$_GET["nombre"];

$link=mysqli_connect("localhost","infu324","123456","workflow"); 

$resultadof=mysqli_query($link, "update academico.alumno set nombre='$nombre' where ci='$ci'");
?>

