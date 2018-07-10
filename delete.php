<?php 
	require_once("db.php");
	/*Delete Data*/
	$sql = $conn->prepare("DELETE  FROM employee_details WHERE id=?");  
	$sql->bind_param("i", $_GET["id"]); 
	$sql->execute();
	$sql->close();
	header('location:index.php');		
?>