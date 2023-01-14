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
	$delete_id = $_REQUEST['id'];
	
	// undo history
	$user_id = $_SESSION['user_id'];
	$result =  mysqli_query($conn, "SELECT * FROM deleted_jobs WHERE user_id = '$user_id' and id = '$delete_id'");
	$row2 = mysqli_fetch_array($result,MYSQLI_ASSOC);		
 
	$id = $row2['job_id'];
	$user_id = $row2['user_id'];
	$posted_in = $row2['posted_in'];
	$company = $row2['company'];
	$position = $row2['position'];
	$job_type = $row2['job_type'];
	$place = $row2['place'];
	$deadline = $row2['deadline'];
	$date = $row2['save_date'];

	// Performing insert query execution
	$sql1 = "INSERT INTO jobs VALUES ('$id', '$user_id', '$posted_in','$company', 
		'$position', '$job_type', '$place', '$deadline', '$date')" ;
		
	if(mysqli_query($conn, $sql1)){
		// Performing delete query execution 
		$sql = "DELETE FROM deleted_jobs WHERE id = '$delete_id'";
		if(mysqli_query($conn, $sql)){
			 
			$_SESSION['undo'] = $id;
			
			mysqli_close($conn);
			header('Location: home.php');
			exit;
		} 
		else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn);
		}
	}
	else{
		$_SESSION['undoerror'] = $id;
		 
		mysqli_close($conn);
		header('Location: home.php');
		exit;
	}
	
?>
