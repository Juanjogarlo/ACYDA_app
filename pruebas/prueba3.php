<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Otra página protegida</title>
        <link rel="stylesheet" href="styles/responsive.css" />
		<link rel="stylesheet" href="styles/style.css" />
		<link rel="stylesheet" href="styles/style.min.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            
			<?php 
 
			if ($resultado = mysqli_query($mysqli, "SELECT * FROM centros LIMIT 10")) 
			{
				printf("La selección devolvió %d filas.\n", $resultado->num_rows);
	
				if ($row = mysqli_fetch_array($resultado))
				{ 
				   echo "<table border = '1'> \n"; 
				   echo "<tr><td>id</td><td>nombre</td></tr> \n"; 
				   do { 
					  echo "<tr><td>".$row["id_centro"]."</td><td>".$row["nombre_centro"]."</td></tr> \n"; 
				   } while ($row = mysqli_fetch_array($resultado)); 
				   echo "</table> \n"; 
				} else { 
				echo "¡ No se ha encontrado ningún registro !"; 
				} 
				
-				mysqli_free_result($resultado);
			}
			?> 
			
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>