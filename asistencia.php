<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/functions_juanjo.php';
 sec_session_start();
 
	///Borrar filas///
	if(isset($_GET['del_id'])and(isset($_GET['fecha']))){
		$del_sql = "DELETE FROM asistencia WHERE id_alumno='$_GET[del_id]' AND fecha='$_GET[fecha]'";
		$run_sql = mysqli_query($mysqli,$del_sql);
		
	}
	if(isset($_GET['act'])){
		$sel_fecha = "SELECT DISTINCT fecha FROM asistencia WHERE id_actividad='$_GET[act]' ORDER BY fecha";
		//$sel_alum = "SELECT * FROM alumnos WHERE actividad='$_GET[act]'";
		$run_fecha = mysqli_query($mysqli,$sel_fecha);
		$int=1000000;
		setcookie("actividad",$_GET['act'],time()+$int);
		/*name is your cookie's name
		value is cookie's value
		$int is time of cookie expires*/
	}
 
	if(isset($_GET['fecha'])){
		$sel_fecha_act = "SELECT * FROM asistencia WHERE id_actividad='$_COOKIE[actividad]' AND fecha='$_GET[fecha]'";
		$run_fecha_act = mysqli_query($mysqli,$sel_fecha_act);
	}

?>
<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="viewport" content="user-scalable=no, width=device-width, maximum-scale=1, minimum-scale=1">
        <title>Seleccion de tabla</title>
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
			<?php if (!empty($run_fecha)) : ?>
			<br>
			<a class="btn btn-danger btn-sm btn-100" href="asistencia.php">Atrás</a>

			<form class="form-horizontal" role="form">
					<div class="form-group">
					<?php
					$sel_acti = "SELECT nombre_actividad FROM actividades WHERE id_actividad='$_GET[act]'";
					$run_acti = mysqli_query($mysqli,$sel_acti);
					$row1 = mysqli_fetch_assoc($run_acti);
					echo '<b class="control-label col-sm-2">Actividad: </b>'.$row1['nombre_actividad'].'<br>';
					?>
						<label for="tabla" class="control-label col-sm-2">Selecciona una fecha</label>
						<div class="col-sm-5">
							<select class="form-control" name="fecha" required>
								<option value=""> Fecha </option>
								<?php
									while($rows = mysqli_fetch_assoc($run_fecha)){
										echo '<option value="'.$rows['fecha'].'">'.$rows['fecha'].'</option>';
									}
								?>
						</div>
					</div>
					<div class="form-group">
					
						<div class="col-sm-5">
							<input type="submit" class="btn btn-info btn-sm btn-100" value="Consultar">
						</div>
					</div>
					<?php mysqli_free_result($run_fecha);?>
				</form>
			<!-- FIN SI EXISTE TABLA
			<?php elseif (!empty($run_fecha_act)) : ?>
			<!-- INICIO SI EXITE FECHA Y ACTIVIDAD -->
				<?php echo '<a class="btn btn-danger btn-sm btn-100" href="asistencia.php?act='.$_COOKIE['actividad'].'>">Atrás</a><p><p>';?>	
				
				<div id="actanddate">
				<?php
					$nom_act_func = nombre_actividad($_COOKIE['actividad'],$mysqli);										
					echo '<b>Actividad2: </b>'.$nom_act_func.'<br><b>Fecha: </b>'.$_GET['fecha'];
				?>
				</div>
				<?php
					
	
				$columnas = $run_fecha_act->field_count;
				?>
				
				<tbody>
					<?php 
						if ($row = mysqli_fetch_array($run_fecha_act))
						{ 
						   ?>
						   <table class='table table-striped'>
								<thead>
									<th>Alumno</th>
									<th style="width: 25%;text-align: center;">Borrar</th>
								</thead>
							<?php
						   do 
						   { 
							echo '<tr>';
							for($u=0;$u<$columnas-3;$u++)
								{
									if ($u == 0)
									{	
										$nom_alum_func = nombre_alumno($row[$u],$mysqli);
										$col_name = $rowcol[nombre_centro];
										echo '<td><a href="datos_alumno.php?id_alum='.$row[$u].'&fecha='.$_GET['fecha'].'">'.$nom_alum_func.'</a></td>';
										//echo '<td>'.$row[$u].'</td>';
									}	
									else
									{
										echo '<td>'.$row[$u].'</td>';
									}
								}
								echo '<td><a class="btn btn-danger btn-sm btn-100" href="asistencia.php?del_id='.$row['id_alumno'].'&fecha='.$row['fecha'].'">Borrar</a></td>
							</tr>
							'; 
							} while ($row = mysqli_fetch_array($run_fecha_act)); 
							echo "</table> \n";
			
						} 
						else 
						{ 
							echo "¡ No se ha encontrado ningún registro !"; 
						} 
						mysqli_free_result($run_fecha_act);
					?>
				</tbody>
			
			
			<!-- FIN SI EXISTE FECHA Y ACTIVIDAD -->
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
							<input type="submit" class="btn btn-info btn-100" value="Continuar">
						</div>
					</div>
				</form>
				
			<!-- FIN SELECCION DE TABLA -->	
			<?php endif; ?>	
		<?php else : 
			include 'includes/loguear.php';
		endif; ?>
		</div>
    </body>
</html>