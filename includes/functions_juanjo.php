<?php
include_once 'psl-config.php';
header('Content-Type: text/html; charset=iso-8859-1');
        

	function nombre_alumno($id_alumno,$mysqli) 
	{
		$sel_nom = "SELECT nombre_alumno FROM alumnos WHERE id_alumno='$id_alumno'";	
		$run_nom = mysqli_query($mysqli,$sel_nom);
		$rownom = mysqli_fetch_assoc($run_nom);
		return $rownom[nombre_alumno]; 
	}
	function nombre_nomitor($id_monitor,$mysqli) 
	{
		$sel_nom_mon = "SELECT nombre_monitor FROM monitores WHERE id_monitor='$id_monitor'";	
		$run_nom_mon = mysqli_query($mysqli,$sel_nom_mon);
		$rownommon = mysqli_fetch_assoc($run_nom_mon);
		return $rownommon[nombre_monitor]; 
	}
	function id_monitor($nombre_monitor,$mysqli) 
	{
		$sel_id_mon = "SELECT id_monitor FROM monitores WHERE nombre_monitor='$nombre_monitor'";	
		$run_id_mon = mysqli_query($mysqli,$sel_id_mon);
		$rowidmon = mysqli_fetch_assoc($run_id_mon);
		return $rowidmon[id_monitor]; 
	}
	function nombre_actividad($id_actividad,$mysqli) 
	{
		$sel_nom_act = "SELECT nombre_actividad FROM actividades WHERE id_actividad='$id_actividad'";	
		$run_nom_act = mysqli_query($mysqli,$sel_nom_act);
		$rownomact = mysqli_fetch_assoc($run_nom_act);
		return $rownomact[nombre_actividad]; 
	}
	function nombre_centros($id_centro,$mysqli) 
	{
		$sel_nom_cen = "SELECT nombre_centro FROM centros WHERE id_centro='$id_centro'";	
		$run_nom_cen = mysqli_query($mysqli,$sel_nom_cen);
		$rownomcen = mysqli_fetch_assoc($run_nom_cen);
		return $rownomcen[nombre_centro]; 
	}
	function num_alum_act_total($id_actividad,$mysqli)
	{
		$sel_alum_act = "SELECT COUNT(id_alumno) AS total FROM alumnos_actividades WHERE id_actividad='$id_actividad'";	
		$run_alum_act = mysqli_query($mysqli,$sel_alum_act);
		$rownumalumact = mysqli_fetch_assoc($run_alum_act);
		return $rownumalumact[total]; 
	}
	function num_alum_centro_total($id_centro,$mysqli)
	{
		$sel_alum_cent = "SELECT COUNT(id_centro) AS total FROM alumnos_actividades WHERE id_centro='$id_centro'";	
		$run_alum_cent = mysqli_query($mysqli,$sel_alum_cent);
		$rownumalumcent = mysqli_fetch_assoc($run_alum_cent);
		return $rownumalumcent[total]; 
	}
	function num_alum_act_centro($id_actividad,$id_centro,$mysqli)
	{
		$sel_alum_act_cent = "SELECT COUNT(id_alumno) AS total FROM alumnos_actividades WHERE id_actividad='$id_actividad' AND id_centro=$id_centro";	
		$run_alum_act_cent = mysqli_query($mysqli,$sel_alum_act_cent);
		$rownumalumactcentro = mysqli_fetch_assoc($run_alum_act_cent);
		return $rownumalumactcentro[total]; 
	}
	function actividades_centro_total($id_centro,$mysqli)
	{
		$sel_act_cent_tot = "SELECT COUNT(id_centro) AS total FROM centros_actividades WHERE id_centro='$id_centro'";	
		$run_act_cent_tot = mysqli_query($mysqli,$sel_act_cent_tot);
		$rowactcenttot = mysqli_fetch_assoc($run_act_cent_tot);
		return $rowactcenttot[total]; 
	}
	function actividades_alumno($id_alumno,$mysqli)
	{
		$sel_act_alum = "SELECT * FROM alumnos_actividades WHERE id_alumno='$id_alumno'";	
		$run_act_alum = mysqli_query($mysqli,$sel_act_alum);
		$rowactalum = mysqli_fetch_assoc($run_act_alum);
		return $rowactalum; 
	}
	function numero_monitores($mysqli) 
	{
		$sel_num_mon = "SELECT COUNT(id_monitor) AS total FROM monitores";	
		$run_num_mon = mysqli_query($mysqli,$sel_num_mon);
		$rownummon = mysqli_fetch_assoc($run_num_mon);
		return $rownummon[total]; 
	}
	function numero_alumnos($mysqli) 
	{
		$sel_num_alu = "SELECT COUNT(id_alumno) AS total FROM alumnos";	
		$run_num_alu = mysqli_query($mysqli,$sel_num_alu);
		$rownumalu = mysqli_fetch_assoc($run_num_alu);
		return $rownumalu[total]; 
	}
	function numero_actividades($mysqli) 
	{
		$sel_num_act = "SELECT COUNT(id_actividad) AS total FROM actividades";	
		$run_num_act = mysqli_query($mysqli,$sel_num_act);
		$rownumact = mysqli_fetch_assoc($run_num_act);
		return $rownumact[total]; 
	}
	function numero_centros($mysqli) 
	{
		$sel_num_cen = "SELECT COUNT(id_centro) AS total FROM centros";	
		$run_num_cen = mysqli_query($mysqli,$sel_num_cen);
		$rownumcen = mysqli_fetch_assoc($run_num_cen);
		return $rownumcen[total]; 
	}
	function numero_actividades_totales($mysqli) 
	{
		$sel_num_centot = "SELECT COUNT(id_centro) AS total FROM centros_actividades";	
		$run_num_centot = mysqli_query($mysqli,$sel_num_centot);
		$rownumcentot = mysqli_fetch_assoc($run_num_centot);
		return $rownumcentot[total]; 
	}
	function logee()
	{
		echo '<span class="error">No está autorizado para acceder a esta página.</span> Por favor, <a href="index.php">inicie sesión</a>.';
		
	}
	function menu()
	{
		echo '
			<a class="btn btn-info btn-sm btn-menu" href="index.php">Inicio</a>
			<a class="btn-menu btn btn-info btn-sm" href="clases.php">Clases</a>
			<a class="btn btn-warning btn-sm btn-menu" href="asistencia.php">Asistencia</a>
			<a class="btn btn-warning btn-sm btn-menu" href="actividades.php">Actividades</a>
			<a class="btn btn-warning btn-sm btn-menu" href="alumnos.php">Alumnos</a>
			<a class="btn btn-warning btn-sm btn-menu" href="monitores.php">Monitores</a>
			<a class="btn btn-warning btn-sm btn-menu" href="centros.php">Centros</a>
		';
	}
	function mes_anterior($mes) 
	{
		$mesNuevo = $mes;
		if ($mes=='Dic'){$mesNuevo = 'Nov';}
		if ($mes=='Nov'){$mesNuevo = 'Oct';}
		if ($mes=='Oct'){$mesNuevo = 'Sep';}
		if ($mes=='Sep'){$mesNuevo = 'Ago';}
		if ($mes=='Ago'){$mesNuevo = 'Jul';}
		if ($mes=='Jul'){$mesNuevo = 'Jun';}
		if ($mes=='Jun'){$mesNuevo = 'May';}
		if ($mes=='May'){$mesNuevo = 'Abr';}
		if ($mes=='Abr'){$mesNuevo = 'Mar';}
		if ($mes=='Mar'){$mesNuevo = 'Feb';}
		if ($mes=='Feb'){$mesNuevo = 'Ene';}
		if ($mes=='Ene'){$mesNuevo = 'Dic';}
		return $mesNuevo; 
	}
	function mes_siguiente($mes) 
	{
		$mesNuevo = $mes;
		if ($mes=='Dic'){$mesNuevo = 'Ene';}
		if ($mes=='Nov'){$mesNuevo = 'Dic';}
		if ($mes=='Oct'){$mesNuevo = 'Nov';}
		if ($mes=='Sep'){$mesNuevo = 'Oct';}
		if ($mes=='Ago'){$mesNuevo = 'Sep';}
		if ($mes=='Jul'){$mesNuevo = 'Ago';}
		if ($mes=='Jun'){$mesNuevo = 'Jul';}
		if ($mes=='May'){$mesNuevo = 'Jun';}
		if ($mes=='Abr'){$mesNuevo = 'May';}
		if ($mes=='Mar'){$mesNuevo = 'Abr';}
		if ($mes=='Feb'){$mesNuevo = 'Mar';}
		if ($mes=='Ene'){$mesNuevo = 'Feb';}
		return $mesNuevo; 
	}
 ?>