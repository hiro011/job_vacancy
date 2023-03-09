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
	
	// Initialize the session
	session_start();
	// Taking all the values from the form data(input)
	$username = $_REQUEST['username'];
	$passcode = $_REQUEST['passcode'];
	$profile = 'defualt/defualt_profile.png';
	$date = date("y/m/d");
	
	$sql = "SELECT id FROM users WHERE username = '$username'";
    $check = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_array($check,MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($check);
    if ($count == 1){
        $_SESSION['user_register'] = 'false';
        
        mysqli_close($conn);
        header('Location: register.php');
        exit;
    }
	else {
		// if profile is set
		if (isset($_FILES['profile'])){
			//Getting the file name of the uploaded file
			$fileName = $_FILES['profile']['name'];
			//Getting the Temporary file name of the uploaded file
			$fileTempName = $_FILES['profile']['tmp_name'];
			//Getting the file size of the uploaded file
			$fileSize = $_FILES['profile']['size'];
			
			//Getting the file ext
			$fileExt = explode('.',$fileName);
			$fileActualExt = strtolower(end($fileExt));
		 
			//Checking,The file size is bellow than the allowed file size
			if($fileSize < 10000000){
				//Creating a unique name for file
				$fileNemeNew = uniqid('',true).".".$fileActualExt;
				// $fileNemeNew = $fileName;
				$fileTempName = $_FILES['profile']['tmp_name']; 
				//File destination
				$fileDestination = 'img/'.$fileNemeNew;
				//function to move temp location to permanent location
				move_uploaded_file($fileTempName, $fileDestination);
				$profile = $fileNemeNew;
			}else{
				$_SESSION['size'] = 'false';
			
				mysqli_close($conn);
				header('Location: register.php');
				exit;
			}
		}  
		
		// Performing insert query execution
		// here our table name is jobs
		$sql = "INSERT INTO users VALUES ('$id', '$username',
		'$passcode', '$profile', '$date')" ;
		 
		 
		if(mysqli_query($conn, $sql)){
			
			// Temporarily in $_POST structure.
			$_SESSION['username'] = $_POST['username'];
			 
			mysqli_close($conn);
			header('Location: login.php');
			exit;
		} else{
			 
			echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
		}
		
		// Close connection
		mysqli_close($conn);
	}
?>
