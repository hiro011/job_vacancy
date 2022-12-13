<?php

	// servername => localhost
	// username => root
	// password => empty
	// database name => jobs_vacancy
	 
    // (A) DATABASE CONFIG - CHANGE TO YOUR OWN!
    define("DB_HOST", "localhost");
    define("DB_NAME", "jobs_vacancy");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    
	$conn = mysqli_connect("localhost", "root", "", "jobs_vacancy");
    
    session_start();
	$username = $_POST['username'];  
    $password = $_POST['password'];
	
	// To prevent from mysqli injection
	$username = stripcslashes($username);  
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($conn,$username);
    $password = mysqli_real_escape_string($conn,$password);
	
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $check = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_array($check,MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($check);
    if ($count != 1){
        $_SESSION['user'] = 'false';
        
        mysqli_close($conn);
        header('Location: login.php');
        exit;
    }else{
        $sql = "SELECT id FROM users WHERE username = '$username' and passcode = '$password'";
        $result = mysqli_query($conn, $sql); 
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($result);
        if ($count == 1){
			$sql2 = "SELECT username, profile FROM users WHERE username = '$username' and passcode = '$password'";
			$res = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_array($res,MYSQLI_ASSOC);
			
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['login_user'] = $row2['username'];
			$_SESSION['profile'] = $row2['profile'];

            mysqli_close($conn);
            header('Location: home.php');
            exit;
        }else{
            $_SESSION['password'] = 'false';
        
            mysqli_close($conn);
            header('Location: login.php');
            exit;
        }
    }



?>  
