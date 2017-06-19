 <?php  
 include_once 'db_connect.php';
include_once 'functions.php';
include_once 'functions_juanjo.php';
include_once 'noticias.inc.php';
setlocale (LC_ALL, "es_ES");
 
sec_session_start();

$sql = "INSERT INTO tbl_sample(first_name, last_name) VALUES('".$_POST["first_name"]."', '".$_POST["last_name"]."')";  
 if(mysqli_query($mysqli, $sql))  
 {  
      echo 'Data Inserted';  
 }  
 ?> 