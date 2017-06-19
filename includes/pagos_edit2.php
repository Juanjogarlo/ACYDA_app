<?php  

 include_once 'db_connect.php';
include_once 'functions.php';
include_once 'functions_juanjo.php';
include_once 'noticias.inc.php';
setlocale (LC_ALL, "es_ES");
 
sec_session_start();

 $id = $_POST["id"];  
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE tbl_sample SET ".$column_name."='".$text."' WHERE id='".$id."'";  
 if(mysqli_query($mysqli, $sql))  
 {  
      echo 'Data Updated';  
 }  
 ?>  