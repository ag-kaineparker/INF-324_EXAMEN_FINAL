<html>
<head>
	
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F09292;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-size: 18px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
                /* Estilo para los enlaces con la clase "boton-enlace" */
        .boton-enlace {
            font-size: 15px;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-bottom: 10px; /* Ajusta el margen inferior entre los botones */
        }

        /* Estilo para los enlaces con la clase "boton-enlace" al pasar el ratón */
        .boton-enlace:hover {
            background-color: #0056b3;
        }


        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

         tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Estilo para las filas impares */
        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
	<?php
if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo '<div style="color: red; margin-bottom: 10px;">Contraseña incorrecta. Por favor, inténtalo de nuevo.</div>';
}
?>

	<form action='validaingreso.php' method="GET">
		Usuario<input type="text" name="usuario" value=""/>
		<br/>
		Clave<input type="text" name="clave" value=""/>
		<br/>
		<input type="submit" name="Aceptar" value="Aceptar"/>
	</form>
</body>
</html>