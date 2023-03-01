<?php

	// servername => localhost
	// username => root
	// password => empty
	// database name => jobs_vacancy
	
	$conn = mysqli_connect("localhost", "root", "", "jobs_vacancy");
	
	// Check connection
	if($conn === false){
		die("ERROR: Could not connect. "
			. mysqli_connect_error());
	}
 
	session_start(); 
	$id = $_REQUEST['id'];
	
	// Performing delete query execution 
	$sql = "DELETE FROM deleted_jobs WHERE id = '$id'";
	if(mysqli_query($conn, $sql)){
		 
		$_SESSION['history_deleted'] = $id;
		
		mysqli_close($conn);
		header('Location: home.php#deleted_history');
		exit;
	} 
	else{
		echo "ERROR: Hush! Sorry $sql. "
			. mysqli_error($conn);
	}

?>
