<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/functions_juanjo.php';
 
sec_session_start();


if(isset($_GET['id_alum'])){
	$sel_alum = "SELECT * FROM alumnos WHERE id_alumno='$_GET[id_alum]'";
	$run_alum = mysqli_query($mysqli,$sel_alum);
	
}
?>
<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Datos alumno</title>
		<meta name="viewport" content="user-scalable=no, width=device-width, maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="styles/responsive.css" />
		<link rel="stylesheet" href="styles/style.css" />
		<link rel="stylesheet" href="styles/style.min.css" />
		<link rel="stylesheet" href="styles/juanjo.css" />
		<script src="jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    </head>
    <body>
		 <div class='container'>
			<img src="http://www.acyda.es/wp-content/uploads/Cabecera-ACYDA-app.png" alt="ACYDA: Asociación Cultural y Deportiva Albacete">			
			
        <?php if (login_check($mysqli) == true) : ?>
		
				<?php // Nombre del monitor y cerrar sesión
				include'includes/nombre_monitor.php';?>
			
				<?php // Botones del menú
				include'includes/menu.php';?>
				
		<?php if (!empty($run_alum)) : 
				while ($rows = mysqli_fetch_assoc($run_alum)){
					$col_name = nombre_centros($rows[id_colegio],$mysqli);
					echo '
					<a class="btn btn-danger btn-sm btn-100" href="asistencia.php?fecha='.$_GET['fecha'].'">Atrás</a>
						
					<div id="todo">
						<div id="datosizq" style="width:59%; margin-top: -20px; float:left">
							
							<table class="table table-striped">
								<tr>
									<td>Id </td>
									<td>'.$rows['id_alumno'].'</td>
								</tr>
								<tr>
									<td>Nombre </td>									 
									<td>'.$rows['nombre_alumno'].'</td>
								</tr>
								<tr>
									<td>Curso </td>
									<td>'.$rows['curso'].'</td>
								</tr>
								<tr>
									<td>telefono: </td>
									<td>'.$rows['telefono'].'</td>
								</tr>
								<tr>
									<td>Colegio </td>
									<td>'.$col_name.'</td>
								</tr>
								<tr>
									<td>Imagen </td>
									<td>'.$rows['imagen'].'</td>
								</tr>
								<tr>
									<td>AMPA </td>
									<td>'.$rows['ampa'].'</td>
								</tr>
								
							</table>
						</div>
						<div id="fotoder" style="width:39%; float:right">
							<img src="http://www.acyda.es/wp-content/uploads/User_Avatar-512.png" height="150" width="150">
							</div>
					</div>
					<table class="table table-striped">
					<tr>
									<td>Otros </td>
					</tr>
					<tr>
									<td>'.$rows['otros'].'</td>
					</tr>
					</table>
				';
				}
			else :
					echo 'No hay alumno';
			endif;
		else : 
            include 'includes/loguear.php';
        endif; ?>
		</div>
    </body>
</html>