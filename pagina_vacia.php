<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Página vacía</title>
		<link rel="stylesheet" href="styles/responsive.css" />
		<link rel="stylesheet" href="styles/style.css" />
		<link rel="stylesheet" href="styles/style.min.css" />
		<script src="jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    </head>
    <body>
		 <div class='container'>
			<img src="http://www.acyda.es/wp-content/uploads/Cabecera-ACYDA-app.png" alt="ACYDA: Asociación Cultural y Deportiva Albacete">			
			<div class="jumbotron">
				<p>Conectado como: <?php echo htmlentities($_SESSION['username']); ?></p>
				<a style="float:right" href="includes/logout.php">Cerrar sesión</a>
				<p>Id monitor: <?php echo htmlentities($_SESSION['id_monitor']); ?></p>
				<a class="btn btn-info btn-sm" href="index.php">Inicio</a><a class="btn btn-info btn-sm" href="clases.php">Clases</a><a class="btn btn-warning btn-sm" href="asistencia.php">Asistencia</a>
				<!-- <p>Prueba: <?php echo $sel_bbdd; ?></p> -->
			</div>
	
        <?php if (login_check($mysqli) == true) : ?>
			<?php 
 
			
			?> 
			
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>
		</div>
    </body>
</html>