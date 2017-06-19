<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/functions_juanjo.php';
sec_session_start();

	$nom_monitor= htmlentities($_SESSION['username']);
	$id_monitor = id_monitor($nom_monitor,$mysqli); 
	$hoy = date("Y-m-d");
	$sel_alum = "SELECT id_alumno FROM alumnos WHERE id_alumno IN (SELECT id_alumno FROM alumnos_actividades WHERE id_actividad='$_COOKIE[actividad]')";
	$run_alum = mysqli_query($mysqli,$sel_alum);
	while ($row = mysqli_fetch_array($run_alum))
	{
		$id_alumno=$row['id_alumno'];
		 if (array_key_exists($id_alumno,$_POST["check"])){
            $ischecked=$_POST["check"][$id_alumno];
            /* See if this has a value of 1.  If it does, it means it has been checked */
            if ($ischecked==1) {
                /* It is checked, so now in this area you can finish the code to retrieve the data from the row and save it however you like */
				//INSERT INTO `156626wordpress20140817144214`.`asistencia` (`id_alumno`, `id_actividad`, `id_monitor`, `fecha`) VALUES ('1', '16', '3', '2016-10-03');
				$sel_asist = "INSERT INTO asistencia (id_alumno, id_actividad, id_monitor, fecha) VALUES ('$id_alumno', '$_COOKIE[actividad]', '$id_monitor', '$hoy');";
				$run_asist = mysqli_query($mysqli,$sel_asist);
            }
        }
	}
	header('Location: ../index.php');
////guardar la asistencia de los alumnos, falta monitor, guarda 0 por algun error
?>