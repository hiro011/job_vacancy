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
	// Taking all 7 values from the form data(input)
	$user_id = $_SESSION['user_id'];
	$posted_in = $_REQUEST['posted_in'];
	$company = $_REQUEST['company'];
	$position = $_REQUEST['position'];
	$job_type = $_REQUEST['job_type'];
	$place = $_REQUEST['place'];
	$deadline = $_REQUEST['deadline'];
	$date = date("y/m/d");
	
	// Performing insert query execution
	// here our table name is jobs
	$sql = "INSERT INTO jobs VALUES ('$id', '$user_id', '$posted_in',
	'$company', '$position', '$job_type', 
	'$place', '$deadline', '$date')" ;
	 
	
	 
	if(mysqli_query($conn, $sql)){
		
		// Initialize the session
		session_start();
		// Temporarily in $_POST structure.
		$_SESSION['position'] = $_POST['position'];
		 
		mysqli_close($conn);
		header('Location: insert.php');
		exit;
	} else{
		echo "ERROR: Hush! Sorry $sql. "
			. mysqli_error($conn);
	}
	
	// Close connection
	mysqli_close($conn);
?>
