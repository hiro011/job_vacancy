
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
	
	$job_id = $_REQUEST['id'];
	
	// Saving history
	$user_id = $_SESSION['user_id'];
	$result =  mysqli_query($conn, "SELECT * FROM jobs WHERE user_id = '$user_id' and id = '$job_id'");
	$row2 = mysqli_fetch_array($result,MYSQLI_ASSOC);		
   
	$_SESSION['row'] = $row2;
	$_SESSION['row_id'] = $job_id;

  $_SESSION['searchResult']=$_SESSION['searchResult2'];
  $_SESSION['postsearch']=$_SESSION['postsearch2'];

	mysqli_close($conn);

	echo " <script> history.go(-1); </script> ";

	// header('Location: ' . $_SERVER['HTTP_REFERER']); 
	// header('Location: home.php');
	// header("Refresh:0; url=home.php");
	
	exit;
	
?>

