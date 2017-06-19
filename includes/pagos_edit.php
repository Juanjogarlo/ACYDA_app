<?php  

include_once 'db_connect.php';
include_once 'functions.php';
include_once 'functions_juanjo.php';
include_once 'noticias.inc.php';
setlocale (LC_ALL, "es_ES");
 
sec_session_start();

 $id = $_POST["id"];  
 $id_act = $_POST["id_act"]; 
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 
 $sql = "UPDATE pagos SET ".$column_name."='".$text."' WHERE id_alumno='".$id."' AND id_actividad='".$id_act."'";
 
 if(mysqli_query($mysqli, $sql))  
 {  
      echo 'Data Updated';  
 }  
 $sql2 = "SELECT SUM(Sep+Oct+Nov+Dic+Ene+Feb+Mar+Abr+May+Jun) AS TOTAL FROM pagos WHERE id_alumno='".$id."' AND id_actividad='".$id_act."'";
 $total = mysqli_query($mysqli, $sql2);

		while ($row = mysqli_fetch_array($total))
		{
			$asdf= $row['TOTAL'];
		} 

 echo $asdf; 
 $sql3 = "UPDATE pagos SET Total='".$asdf."' WHERE id_alumno='".$id."' AND id_actividad='".$id_act."'";
 mysqli_query($mysqli, $sql3)
 ?>  
