<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
 sec_session_start();
 
	///Borrar filas///
	if(isset($_GET['del_id'])){
		$del_sql = "DELETE FROM centros WHERE id_centro = '$_GET[del_id]'";
		$run_sql = mysqli_query($mysqli,$del_sql);
		
	}
 
 

?>
<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Otra página protegida</title>

		<script src="jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            <div class='container'>
			<div class="jumbotron">
				<h1> Administración </h1>
				<p>Conectado como: <?php echo htmlentities($_SESSION['username']); ?></p>
			</div>
			<table class='table table-striped'>
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Borrar</th> 
				</thead>
				<tbody>
					<?php 
					if ($resultado = mysqli_query($mysqli, "SELECT * FROM centros LIMIT 10")) 
					{
						if ($row = mysqli_fetch_array($resultado))
						{ 
						   do 
						   { 
							  echo '
							  <tr>
								  <td>'.$row['id_centro'].'</td>
								  <td>'.$row['nombre_centro'].'</td>
								  <td><a class="btn btn-danger btn-sm" href="prueba2.php?del_id='.$row['id_centro'].'">Borrar</a></td>
							  </tr>
							  '; 
						   } while ($row = mysqli_fetch_array($resultado)); 
						   echo "</table> \n";
						   printf("La selección devolvió %d filas.\n", $resultado->num_rows);

						} 
						else 
						{ 
							echo "¡ No se ha encontrado ningún registro !"; 
						} 
		-				mysqli_free_result($resultado);
					}
					?> 
				</tbody>
		<?php else : ?>
			<p>
				<span class="error">No está autorizado para acceder a esta página.</span> Please <a href="login.php">login</a>.
			</p>
		<?php endif; ?>
		</div>
    </body>
</html>