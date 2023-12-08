<?php
$link=mysqli_connect("localhost","infu324","123456","workflow2"); 
$flujo=$_GET["flujo"];
$proceso=$_GET["proceso"];
$pregunta=$_GET["pregunta"];
$procesosiguiente=$_GET["procesosiguiente"];

$pantalla=$_GET["pantalla"];
include $pantalla.".back.inc.php";

if (isset($_GET["Anterior"])) {
    if ($proceso === "P2") {
        // Si el proceso actual es P2, retrocede a P1
        $resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and proceso='P1'");
    } elseif ($proceso === "P3") {
        // Si el proceso actual es P3, retrocede a P2
        $resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and proceso='P2'");
    } elseif ($proceso === "P4") {
        // Si el proceso actual es P4, retrocede a P3
        $resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and proceso='P3'");
    } elseif ($proceso === "P6") {
        // Si el proceso actual es P4, retrocede a P3
        $resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and proceso='P4'");
    } elseif ($proceso === "P7") {
        // Si el proceso actual es P4, retrocede a P3
        $resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and proceso='P6'");
    } elseif ($proceso === "P8") {
        // Si el proceso actual es P4, retrocede a P3
        $resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and proceso='P6'");
    } else {
        // En otros casos, retrocede al proceso anterior por defecto
        $resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and procesosiguiente='$proceso'");
    }

    $fila = mysqli_fetch_array($resultado);
    $procesosiguiente = $fila["proceso"];
}
if (isset($_GET["pregunta"]))
{
  $resultado=mysqli_query($link, "select * from flujopregunta where flujo='$flujo' and proceso='$proceso'");
  
  $fila=mysqli_fetch_array($resultado);
  if ($_GET["pregunta"]=='si')
  {
    $procesosiguiente=$fila["si"];
  }
  elseif ($_GET["pregunta"]=='no') 
  {
     $procesosiguiente=$fila["no"];
  }

}


if (isset($_GET["Anterior"]) && isset($_GET["pregunta"]))
{
  $resultado=mysqli_query($link, "select * from flujo where flujo='$flujo' and procesosiguiente='$proceso'");
  $fila=mysqli_fetch_array($resultado);
  $procesosiguiente=$fila["proceso"];
}
if (empty($procesosiguiente)&&$proceso=="P6") {
    // Redirige a index.php
    header("Location: pantalla.php?flujo=F1&proceso=P7");
    exit;
}
// Verifica si el valor de "proceso" es vacío
if (empty($procesosiguiente)) {
    // Redirige a index.php
    header("Location: index.php");
    exit;
}

header("Location: pantalla.php?flujo=$flujo&proceso=$procesosiguiente");
exit; // Asegúrate de salir después de redirigir.
?>