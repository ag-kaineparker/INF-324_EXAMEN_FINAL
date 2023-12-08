<?php
session_start();
$ci = $_SESSION["ci"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow2");

// Obtener los datos actualizados
$resultadou = mysqli_query($link, "select * from academico.usuario where ci='$ci'");
$filau = mysqli_fetch_array($resultadou);
$nuevoEmail = $filau["Email"];
$nuevaDireccion = $filau["Direccion"];
$nuevoTelefono = $filau["Telefono"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Datos</title>
</head>
<body>
    <h1>Datos Actualizados</h1>
    <p>CI: <?php echo $ci; ?></p>
    <p>Email: <?php echo $nuevoEmail; ?></p>
    <p>Dirección: <?php echo $nuevaDireccion; ?></p>
    <p>Teléfono: <?php echo $nuevoTelefono; ?></p>

    <p>¡Datos actualizados con éxito!</p>

    <!-- Puedes agregar enlaces o botones adicionales según tus necesidades -->
    <a href="index.php">Salir/Cerrar sesion </a>
    <br>
    <br>
</body>
</html>
