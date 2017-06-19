<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Otra página protegida</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            
			<?php 
 
			if ($resultado = mysqli_query($mysqli, "SELECT * FROM centros LIMIT 10")) 
			{
				printf("La selección devolvió %d filas.\n", $resultado->num_rows);
	
				echo "<table>";  
				echo "<tr>";  
				echo "<th>id</th>";  
				echo "<th>nombre</th>";  
				echo "</tr>";  
				foreach( $resultado as $row ){   
					echo "<tr>";
					echo "<br>"; 
					echo "<td>";	
					echo $row['id_centro'];
					echo "</td>";					
					echo "<td>";
					echo $row['nombre_centro'];
					echo "</td>";
					echo "</tr>";  
				}  
				echo "</table>";  
				
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