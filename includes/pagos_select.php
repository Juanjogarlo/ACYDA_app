<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'functions_juanjo.php';
include_once 'noticias.inc.php';
setlocale (LC_ALL, "es_ES");
 
sec_session_start();
 
 
 $sql = "SELECT * FROM pagos ORDER BY id_alumno DESC";  
 $result = mysqli_query($mysqli, $sql);  
 ?>
      <div class="table-responsive">  
           <table id="Jtabla" class='table table-striped'>
		   <thead><?php
		   $info_campos = $result->fetch_fields();
					foreach ($info_campos as $valor) {
						printf("<th>%s</th>",   $valor->name);
					}
					echo '</thead>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tbody><tr>  
                     <td>'.$row["id_alumno"].'</td>  
                     <td class="id_actividad" data-id1="'.$row["id_alumno"].'">'.$row["id_actividad"].'</td>  
                     <td class="Sep" data-id2="'.$row["id_alumno"].'" data-id_act2="'.$row["id_actividad"].'" contenteditable>'.$row["Sep"].'</td>  
                     <td class="Oct" data-id3="'.$row["id_alumno"].'" data-id_act3="'.$row["id_actividad"].'" contenteditable>'.$row["Oct"].'</td>  
                     <td class="Nov" data-id4="'.$row["id_alumno"].'" data-id_act4="'.$row["id_actividad"].'" contenteditable>'.$row["Nov"].'</td>  
                     <td class="Dic" data-id5="'.$row["id_alumno"].'" data-id_act5="'.$row["id_actividad"].'" contenteditable>'.$row["Dic"].'</td>  
                     <td class="Ene" data-id6="'.$row["id_alumno"].'" data-id_act6="'.$row["id_actividad"].'" contenteditable>'.$row["Ene"].'</td>  
                     <td class="Feb" data-id7="'.$row["id_alumno"].'" data-id_act7="'.$row["id_actividad"].'" contenteditable>'.$row["Feb"].'</td>  
                     <td class="Mar" data-id8="'.$row["id_alumno"].'" data-id_act8="'.$row["id_actividad"].'" contenteditable>'.$row["Mar"].'</td>  
                     <td class="Abr" data-id9="'.$row["id_alumno"].'" data-id_act9="'.$row["id_actividad"].'" contenteditable>'.$row["Abr"].'</td>  
                     <td class="May" data-id10="'.$row["id_alumno"].'" data-id_act10="'.$row["id_actividad"].'" contenteditable>'.$row["May"].'</td>  
                     <td class="Jun" data-id11="'.$row["id_alumno"].'" data-id_act11="'.$row["id_actividad"].'" contenteditable>'.$row["Jun"].'</td>  
                     <td class="Total" data-id12="'.$row["id_alumno"].'" data-id_act12="'.$row["id_actividad"].'" contenteditable>'.$row["Total"].'</td>  
                     
				</tr> </tbody> 
           ';  
      }  
       
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>  