<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
setlocale (LC_ALL, "es_ES");
 sec_session_start();
 
	///Borrar filas///
	if(isset($_GET['del_id'])){
		$del_sql = "DELETE FROM centros WHERE id_centro = '$_GET[del_id]'";
		$run_sql = mysqli_query($mysqli,$del_sql);
	}
 

	if(isset($_GET['act'])){
		//ya no hay actividad en alumnos, ahora está en alumnos_actividades
		//hacer una consulta anidada
		$sel_alum = "SELECT id_alumno,nombre_alumno FROM alumnos WHERE id_alumno IN (SELECT id_alumno FROM alumnos_actividades WHERE id_actividad='$_GET[act]')";
		$int=1000000;
		setcookie("actividad",$_GET['act'],time()+$int);
		$run_alum = mysqli_query($mysqli,$sel_alum);
		
		/*name is your cookie's name
		value is cookie's value
		$int is time of cookie expires*/
	}
?>
<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Seleccion de tabla</title>
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
		<a href="index.php"><img src="http://www.acyda.es/wp-content/uploads/Cabecera-ACYDA-app.png" alt="ACYDA: Asociación Cultural y Deportiva Albacete"></a>		
        <?php if (login_check($mysqli) == true) : ?>
		
				<?php // Nombre del monitor y cerrar sesión
				include'includes/nombre_monitor.php';?>

				<?php // Botones del menú
				include'includes/menu.php';?>
			
			<!-- INICIO SI EXITE TABLA -->
			<?php if (!empty($run_alum)) : ?>
			<a class="btn btn-danger btn-sm btn-100" href="clases.php">Atrás</a><p><p>
			
			<?php 
			$columnas = $run_alum->field_count;
			
			$sel_acti = "SELECT nombre_actividad FROM actividades WHERE id_actividad='$_GET[act]'";
			$run_acti = mysqli_query($mysqli,$sel_acti);
			$row1 = mysqli_fetch_assoc($run_acti);
			echo '<b>Actividad: </b>'.$row1['nombre_actividad'].'<br><b>Fecha actual: </b>'.strftime("%A, %d de %B de %Y");
			?>
			<form action="guardar_asist.php" method="post" class="form-horizontal" >
			<table class='table table-striped'>
				<thead>
				<?php 
				echo '<th width=20%>Identificador</th>';
				echo '<th>Nombre</th>';
				echo '<th>Asistencia</th>';
				?>
				</thead>
				<tbody>
					<?php 
						///por cada una de las filas
						if ($row = mysqli_fetch_array($run_alum))
						{ 
						   do 
						   { 
							echo '<tr>';
							for($u=0;$u<$columnas;$u++)
								{
									
									echo '<td>'.$row[$u].'</td>';
									
								}
								
								echo '<td><label class="checkbox-inline checkboxjuanjo"><input type="checkbox" name="check['.$row[0].']" value="1">Sí</label></td>
							</tr>
							'; 
							} while ($row = mysqli_fetch_array($run_alum)); 
							echo "</table> \n";
							?>
    
								<div class="form-group">
									<div class="col-sm-5">
										<input type="submit" class="btn btn-info btn-sm btn-100" value="Guardar asistencia">
									</div>
								</div>
							</form>
							
							<?php
						} 
						else 
						{ 
							echo "¡ No se ha encontrado ningún registro !"; 
						} 
						//mysqli_free_result($run_alum);
					?>
				</tbody>
			<!-- FIN SI EXITE TABLA -->
			<?php else : ?>
			<!-- INICIO SELECCION DE TABLA -->
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="tabla" class="control-label col-sm-2">Selecciona la actividad</label>
						<div class="col-sm-5">
							<select class="form-control" name="act" required>
								<option value=""> Actividad </option>
								<?php
									$sel_act = "SELECT id_actividad FROM centros_actividades WHERE id_monitor=".$_SESSION['id_monitor'];
									$run_act = mysqli_query($mysqli,$sel_act);
									while($rows = mysqli_fetch_assoc($run_act)){
										$sel_act2 = "SELECT nombre_actividad FROM actividades WHERE id_actividad=".$rows['id_actividad'];
										$run_act2 = mysqli_query($mysqli,$sel_act2);
										$rows2 = mysqli_fetch_assoc($run_act2);
										// Si solo tiene una actividad, estará seleccionada por defecto
										if ($run_act == 1)
										{
											echo '<option value="'.$rows['id_actividad'].'"selected="selected">'.$rows2['nombre_actividad'].'</option>';	
										}else{
											echo '<option value="'.$rows['id_actividad'].'">'.$rows2['nombre_actividad'].'</option>';
										}
									}
								?>
						</div>
					</div>
					<div class="form-group">
					<label class="control-label col-sm-2">Aceptar</label>
						<div class="col-sm-5">
							<input type="submit" class="btn btn-info btn-sm btn-100" value="Aceptar">
						</div>
					</div>
				</form>
				
			<!-- FIN SELECCION DE TABLA -->	
			<?php endif; ?>	
		<?php 	else : 
					include 'includes/loguear.php';
				endif; ?>
		</div>
    </body>
</html>