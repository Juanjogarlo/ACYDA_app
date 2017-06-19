<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
	echo $_COOKIE["id_monitor"];
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
		<title>ACYDA Login</title>
		<meta name="viewport" content="user-scalable=no, width=device-width, maximum-scale=1, minimum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="styles/responsive.css" />
		<link rel="stylesheet" href="styles/style.css" />
		<link rel="stylesheet" href="styles/style.min.css" />
        <link rel="stylesheet" href="styles/juanjo.css" />
		<script src="jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
			
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>
        
			<div class='container'>
			<a href="index.php"><img src="http://www.acyda.es/wp-content/uploads/Cabecera-ACYDA-app.png" alt="ACYDA: Asociación Cultural y Deportiva Albacete"></a>
				<?php if (login_check($mysqli) == true) 
				{?>
						<?php // Nombre del monitor y cerrar sesión
						include'includes/nombre_monitor.php';?>
					
						<?php // Botones del menú
						include'includes/menu.php';?>
						
					<div class="jumbotron jumbotronjuanjo" style="margin-top: 20px;">
						<p style="float:left; left: 35%;position: relative;">Noticias</p>
					</div>
					<table class="table table-striped" style="min-height:150px ;height: 10px;margin-top: -10px;">
								<tr>
									<td>
									<?php
										$sel_noti = "SELECT noticia FROM noticias ORDER BY id_noticia DESC LIMIT 1";
										$run_noti = mysqli_query($mysqli,$sel_noti);
										$row1 = mysqli_fetch_assoc($run_noti);
										echo $row1['noticia'];						
									?>
									</td>
								</tr>
					</table>
				
				<?php
				}
				else // Función de loguin
				{ 
					include'includes/loguear.php';
				}?>
		</div>
    </body>
</html>