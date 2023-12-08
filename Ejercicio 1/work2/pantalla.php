<?php
// http://localhost/work/pantalla.php?flujo=F1&proceso=P1
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];
$link = mysqli_connect("localhost", "infu324", "123456", "workflow2");

$resultado = mysqli_query($link, "select * from flujo where flujo='$flujo' and proceso='$proceso'");
$fila = mysqli_fetch_array($resultado);
$proceso = $fila["proceso"];
$procesosiguiente = $fila["procesosiguiente"];
$pantalla = $fila["pantalla"];
$archivo = $fila["pantalla"] . ".vista.inc.php";
?>



<?php if ($proceso == "P1"||$proceso=="P4"): ?>
    <?php include $archivo; ?>
    <form action="motor.php" method="GET">
        <input type="hidden" name="pantalla" value="<?php echo $pantalla; ?>"/>
        <input type="hidden" name="flujo" value="<?php echo $flujo; ?>"/>
        <input type="hidden" name="proceso" value="<?php echo $proceso; ?>"/>
        <input type="hidden" name="procesosiguiente" value="<?php echo $procesosiguiente; ?>"/>
        <!-- Ajusta el texto del botón según la condición -->
        <input type="submit" name="Anterior" value="Anterior">
        <input type="submit" name="Siguiente" value="Siguiente">
    </form>
<?php else: ?>
    <form action="motor.php" method="GET">
        <input type="hidden" name="pantalla" value="<?php echo $pantalla; ?>"/>
        <input type="hidden" name="flujo" value="<?php echo $flujo; ?>"/>
        <input type="hidden" name="proceso" value="<?php echo $proceso; ?>"/>
        <input type="hidden" name="procesosiguiente" value="<?php echo $procesosiguiente; ?>"/>

        <!-- Ajusta el texto del botón según la condición -->
        <?php include $archivo; ?>
        <input type="submit" name="Anterior" value="Anterior">
        <input type="submit" name="Siguiente" value="Siguiente">
    </form>
<?php endif; ?>
