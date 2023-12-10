<?php
	include 'conexion.php';
	
	$pdo = new Conexion();
	
	//Listar registros y consultar registro
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if (isset($_GET["id"]))
		{
			$sqlp="SELECT * FROM alumno1 where id=:id";
			$sql = $pdo->prepare($sqlp);
			$sql->bindValue(':id', $_GET["id"]);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			echo json_encode($sql->fetchAll());
			header("HTTP/1.1 200 hay datos");		
			exit;		
		}
		else
		{
			$sqlp="SELECT * FROM alumno1";
			$sql = $pdo->prepare($sqlp);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			echo json_encode($sql->fetchAll());
			header("HTTP/1.1 200 hay datos");
			exit;		
		}
			
	}
	
	//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sqlp="insert into alumno1 values(:id,:nombre,:paterno)";
		$sql = $pdo->prepare($sqlp);
		$sql->bindValue(':id', $_GET["id"]);
		$sql->bindValue(':nombre', $_GET["nombre"]);
		$sql->bindValue(':paterno', $_GET["paterno"]);
		$sql->execute();
		echo json_encode('realizado');
		header("HTTP/1.1 200 ejecucion correcta");
		exit;
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'PUT')
	{		
		$sqlp="update alumno1 set nombre=:nombre,paterno=:paterno where id=:id";
		$sql = $pdo->prepare($sqlp);
		$sql->bindValue(':id', $_GET["id"]);
		$sql->bindValue(':nombre', $_GET["nombre"]);
		$sql->bindValue(':paterno', $_GET["paterno"]);
		$sql->execute();
		echo json_encode('realizado');
		header("HTTP/1.1 200 ejecucion correcta");
		exit;
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    // Verificamos si se proporcionó un ID para eliminar
    if (isset($_GET["id"])) {
        // Preparamos la consulta para eliminar el registro
        $sqlp = "DELETE FROM alumno1 WHERE id=:id";
        $sql = $pdo->prepare($sqlp);
        $sql->bindValue(':id', $_GET["id"]);

        // Ejecutamos la consulta
        $sql->execute();

        // Verificamos si se eliminó algún registro
        if ($sql->rowCount() > 0) {
            echo json_encode('Registro eliminado correctamente');
            header("HTTP/1.1 200 ejecucion correcta");
            exit;
        } else {
            echo json_encode('No se encontró el registro con el ID proporcionado');
            header("HTTP/1.1 404 Not Found");
            exit;
        }
    } else {
        echo json_encode('Falta el parámetro ID para realizar la eliminación');
        header("HTTP/1.1 400 Bad Request");
        exit;
    }
}

	
	header("HTTP/1.1 400 Bad Request");
?>