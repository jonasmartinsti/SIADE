<? 
	include('conecta.php'); 
	$id = (int) $_GET['id']; 
	mysql_query("DELETE FROM `ruas` WHERE `id` = '$id' ") ; 
	echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
	header("LOCATION: rua_listar.php");  
?>