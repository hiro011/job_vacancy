<?php

	if(!isset($_SESSION)){
		session_start(); 
	}

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

	$user_id = $_SESSION['user_id'];

	$result =  mysqli_query($conn, "SELECT * FROM jobs WHERE user_id = '$user_id' ");

	if($_POST['sort'] === '1' || $_POST['sort'] === '2'){
		$_SESSION['sortResult'] =  true;
	} else{
		unset($_SESSION['sortResult']);
	}

	$_SESSION['sort'] = $_POST['sort'];

	mysqli_close($conn);
	header('Location: home.php');
	exit;
 
	 
?>
