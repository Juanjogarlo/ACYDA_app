<?php
include_once 'includes/db_connect.php'; 
include_once 'includes/functions.php';
include_once 'includes/functions_juanjo.php';

setlocale (LC_ALL, "es_ES");
sec_session_start();
 
if(isset($_GET['act'])and(isset($_GET['mes'])))
{
	$sel_mes_act = "SELECT id_actividad,id_alumno,$_GET[mes] FROM pagos WHERE id_actividad = '$_GET[act]' ORDER BY 1";
	$run_mes_act = mysqli_query($mysqli,$sel_mes_act);
	//echo $sel_mes_act;
	$int=1000000;
	setcookie("actividad",$_GET['act'],time()+$int);
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
		
		<!-- CSS y JS para dataTable -->
		<link rel="stylesheet" href="css/dataTables.bootstrap4.css" />
		<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css" />
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="js/dataTables.bootstrap4.js"></script>
		<script type="text/javascript" language="javascript" src="js/dataTables.bootstrap4.min.js"></script>
		
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
			<?php if (!empty($run_mes_act)) : ?>
			<!-- Botones para moverse entre los meses -->
			<?php include 'includes/botones_meses.php';?>
			
			<?php 
			$columnas = $run_mes_act->field_count;
			
			$sel_acti = "SELECT nombre_actividad FROM actividades WHERE id_actividad='$_GET[act]'";
			$run_acti = mysqli_query($mysqli,$sel_acti);
			$row1 = mysqli_fetch_assoc($run_acti);
			echo '
			<div class="jumbotron jumbotronjuanjo jumbotronjuanjoseparador" style="font-size:1.2em !important;">
			<b>Actividad: </b>'.$row1['nombre_actividad'].'<br><b>Mes: </b>'.$_GET[mes].'
			</div>';
			?>
			<div id="guardado" type="hidden">guardado</div>
			<form action="guardar_asist.php" method="post" class="form-horizontal" >
			<table id="Jtabla" class='table table-striped'>
				<thead>
				<?php 
				echo '<th>Nombre</th>';
				echo '<th>Pago</th>';
				?>
				</thead>
				<tbody>
					<?php 
						///por cada una de las filas
						if ($row = mysqli_fetch_array($run_mes_act))
						{ 
						   do 
						   { 
							$alu_name = nombre_alumno($row[id_alumno],$mysqli);
							echo '<tr>';
							for($u=1;$u<$columnas;$u++)
								{
									if($u==2){
									
									
									echo '<td class="PagoMes" data-id1="'.$row["id_alumno"].'" data-id_act1="'.$row["id_actividad"].'" data-id_mes1="'.$_GET[mes].'"contenteditable>'.$row[$u].'</td>';
									}
									else
									{
										echo '<td>'.$alu_name.'</td>';
									}
								}
								echo '</tr>'; 
							} while ($row = mysqli_fetch_array($run_mes_act)); 
							echo '<tr>
								<td>TOTAL</td>';
								$sel_mes_act2 = "SELECT SUM($_GET[mes]) AS TOTAL FROM pagos WHERE id_actividad = '$_GET[act]' ORDER BY 1";
								$run_mes_act2 = mysqli_query($mysqli,$sel_mes_act2);
								$row2 = mysqli_fetch_array($run_mes_act2);
							echo '<td class="TotalMes">'.$row2[0].'</td>';
							echo '</tr>';
							echo '</table>';
							?>
								
							</form>
							<?php
						} 
						else 
						{ 
							echo "¡ No se ha encontrado ningún registro !"; 
						} 
					?>
				</tbody>
			<!-- FIN SI EXITE TABLA -->
			<?php else : ?>
			<!-- INICIO SELECCION DE TABLA -->
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="tabla" class="control-label col-sm-2">Actividad</label>
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
										}
										else{
											echo '<option value="'.$rows['id_actividad'].'">'.$rows2['nombre_actividad'].'</option>';
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="tabla" class="control-label col-sm-2">Mes</label>
						<div class="col-sm-5">
							<select class="form-control" name="mes" required>
								<option value="Sep">Septiembre</option>
								<option value="Oct">Octubre</option>
								<option value="Nov">Noviembre</option>
								<option value="Dic">Diciembre</option>
								<option value="Ene">Enero</option>
								<option value="Feb">Febrero</option>
								<option value="Mar">Marzo</option>
								<option value="Abr">Abril</option>
								<option value="May"selected="selected">Mayo</option>
								<option value="Jun">Junio</option>
							</select>
						</div>
					</div>
					<div class="form-group">
					<label class="control-label col-sm-2"></label>
						<div class="col-sm-5">
							<input type="submit" class="btn btn-info btn-sm btn-100" value="Ver alumnos">
						</div>
					</div>
				</form>
				
			<!-- FIN SELECCION DE TABLA -->	
			<?php endif; 	
		else : 
            include 'includes/loguear.php';
		endif; ?>
		</div>
    </body>
</html>
<script>  

 $(document).ready(function(){  
      function fetch_data()  
      {  
           $.ajax({  
                url:"includes/pagos_select.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
		   $('#Jtabla').DataTable(
			{
				"language": {
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
				},
				stateSave: true
			});
			$('#guardado').hide();
			//textoout();
      }  
      fetch_data();  
      $(document).on('click', '#btn_add', function(){  
           var first_name = $('#first_name').text();  
           var last_name = $('#last_name').text();  
		   var Oct = $('#Oct').text();  
           if(first_name == '')  
           {  
                alert("Enter First Name");  
                return false;  
           }  
           if(last_name == '')  
           {  
                alert("Enter Last Name");  
                return false;  
           }  
           $.ajax({  
                url:"includes/pagos_insert.php",  
                method:"POST",  
                data:{first_name:first_name, last_name:last_name},  
                dataType:"text",  
                success:function(data)  
                {  
                     alert(data);  
                     fetch_data();  
                }  
           })  
      });  
      function edit_data(id, id_act, text, mes)  
      {  
           $.ajax({  
                url:"includes/pagos_mes_edit.php",  
                method:"POST",  
                data:{id:id, id_act:id_act, text:text, mes:mes},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
					 //mensaje de guardado
                }  
           }); 		   
      } 
		$(document).on('focusout', '.PagoMes', function(){  
           var id = $(this).data("id1"); 
		   var id_act = $(this).data("id_act1"); 		   
           var cant = $(this).text(); 
		   var mes = $(this).data("id_mes1"); 		   
           edit_data(id, id_act, cant, mes);  
		   act_total();
		   setTimeout(textoin(), 4000);
      });  	 
		function textoin(){
		  $("#guardado").fadeIn(1000);
		  setTimeout(textoout(), 4000);
		}
		function textoout(){
		  $("#guardado").fadeOut(1000);
		}
	  function act_total()  
      {	
		  $(".TotalMes").text("Actu");  
	  }
      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id3");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"includes/pagos_delete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });  
 </script>