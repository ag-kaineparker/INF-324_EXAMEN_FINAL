<?php
session_start();
$ci = $_SESSION["ci"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow2");

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["update"])) {
    // Recoger los datos de la URL
    $nuevoEmail = mysqli_real_escape_string($link, $_GET["nuevoEmail"]);
    $nuevaDireccion = mysqli_real_escape_string($link, $_GET["nuevaDireccion"]);
    $nuevoTelefono = mysqli_real_escape_string($link, $_GET["nuevoTelefono"]);

    // Actualizar los datos en la tabla academico.usuario
    $actualizarDatos = "UPDATE academico.usuario SET Email='$nuevoEmail', Direccion='$nuevaDireccion', Telefono='$nuevoTelefono' WHERE ci='$ci'";
    mysqli_query($link, $actualizarDatos);

    $resultadoac = "UPDATE academico.alumno SET Docuactualizado=1 where ci='$ci'";
	mysqli_query($link, $resultadoac);
    // Redirigir a la página que contiene el flujo y proceso específicos
    header("Location: motor.php?flujo=F1&procesosiguiente=P2");
        exit();

 }
 
$resultadof = mysqli_query($link, "select * from academico.alumno where ci='$ci'");
$filaf = mysqli_fetch_array($resultadof);
$ci = $filaf["ci"];
$nombre = $filaf["nombre"];
$actualizado = $filaf["Docuactualizado"];
$resultadou = mysqli_query($link, "select * from academico.usuario where ci='$ci'");
$filau = mysqli_fetch_array($resultadou);
// Inicializar variables para evitar advertencias
$email = isset($filau["Email"]) ? $filau["Email"] : "";
$direccion = isset($filau["Direccion"]) ? $filau["Direccion"] : "";
$telefono = isset($filau["Telefono"]) ? $filau["Telefono"] : "";
?>

<?php if ($actualizado == 0): ?>
    USUARIO: <?php echo "$nombre" ?> CI: <?php echo "$ci" ?><br>
    DEBE REALIZAR VERIFICACION DE DOCUMENTOS:<br>
    -EMAIL<br>
    -DIRECCION<br>
    -TELEFONO<br>

    <!-- Formulario para actualizar los datos -->
    <form action="anuncio.vista.inc.php" method="GET">
        Email: <input type="text" name="nuevoEmail" value="<?php echo $email; ?>"><br>
        Dirección: <input type="text" name="nuevaDireccion" value="<?php echo $direccion; ?>"><br>
        Teléfono: <input type="text" name="nuevoTelefono" value="<?php echo $telefono; ?>"><br>
        <input type="hidden" name="update" value="1">
        <input type="hidden" name="flujo" value="<?php echo $_GET["flujo"]; ?>">
        <input type="hidden" name="proceso" value="<?php echo $_GET["proceso"]; ?>">
        <input type="submit" value="Actualizar">
    </form>


<?php else: ?>
    <!-- Aquí va el contenido para el caso contrario -->
    <!-- Puedes mostrar un mensaje, contenido adicional, etc. -->
    <p>Los documentos ya han sido verificados. No es necesario realizar actualizaciones.</p>
<?php endif ?>