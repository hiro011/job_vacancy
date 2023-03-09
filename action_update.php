<?php

	// servername => localhost
	// username => root
	// password => empty
	// database name => jobs_vacancy
	$conn = mysqli_connect("localhost", "root", "rootadmin", "jobs_vacancy");
	
	// Check connection
	if($conn === false){
		die("ERROR: Could not connect. "
			. mysqli_connect_error());
	}
	
	session_start();
	
	// Taking all values from the form data(input)
	$id = $_SESSION['row_id'];
	$posted_in = $_REQUEST['posted_in'];
	$company = $_REQUEST['company'];
	$position = $_REQUEST['position'];
	$job_type = $_REQUEST['job_type'];
	$place = $_REQUEST['place'];
	$deadline = $_REQUEST['deadline'];
	$u_date = date("y/m/d");
	
	// Performing update query execution
 
	$sql = "UPDATE jobs SET posted_in = '$posted_in',
					company = '$company', position = '$position', job_type = '$job_type', 
					place = '$place', deadline = '$deadline', updated_date = '$u_date'
					WHERE id = $id";
					
	// UPDATE `jobs` SET `posted_in` = 'ellens' WHERE `jobs`.`id` = 58;
	 
	if(mysqli_query($conn, $sql)){

		$_SESSION['update'] = true;
		 
		mysqli_close($conn);
		header('Location: home.php');
		exit;
	} else{
		echo "ERROR: Hush! Sorry $sql. "
			. mysqli_error($conn);
	}
	
	// Close connection
	mysqli_close($conn);
?>
