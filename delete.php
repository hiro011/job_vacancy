		<?php

		// servername => localhost
		// username => root
		// password => empty
		// database name => jobs_vacancy
		$id = $_REQUEST['id'];
		$conn = mysqli_connect("localhost", "root", "", "jobs_vacancy");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
	 
		// Performing delete query execution
		// here our table name is jobs
		$sql = "DELETE FROM jobs WHERE id = '$id'";
	
		if(mysqli_query($conn, $sql)){
			
			// Initialize the session
			session_start();
			// Temporarily in $_POST structure.
			$_SESSION['delete'] = $id;
			
			mysqli_close($conn);
			header('Location: home.php');
			exit;
		} else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn);
		}
		
		?>
