<?php  

 include_once 'db_connect.php';
include_once 'functions.php';
include_once 'functions_juanjo.php';
include_once 'noticias.inc.php';
setlocale (LC_ALL, "es_ES");
 
sec_session_start();
 $sql = "DELETE FROM tbl_sample WHERE id = '".$_POST["id"]."'";  
 if(mysqli_query($mysqli, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?> 