<?php 
$link=mysqli_connect("localhost","infu324","123456","workflow");
session_start();
$rol=$_SESSION["rol"];
$usuario=$_SESSION["ci"];
$sql="SELECT * FROM seguimiento where usuario='".$usuario."' order by fechahorainicio";
$resultado=mysqli_query($link, $sql);
echo "<table>";
echo "<tr>";
echo "<td>flujo</td>";
echo "<td>proceso</td>";
echo "<td>fecha inicio</td>";
echo "<td>Accion</td>";
echo "</tr>";
while ($fila=mysqli_fetch_array($resultado))
{
	echo "<tr>";
	echo "<td>$fila[flujo]</td>";
	echo "<td>$fila[proceso]</td>";
	echo "<td>$fila[fechahorainicio]</td>";
	echo "<td><a href='pantalla.php?flujo=$fila[flujo]&proceso=$fila[proceso]'>Ver</a></td>";
	echo "</tr>";
}

?>