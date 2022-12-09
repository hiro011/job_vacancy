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
    
    $user = mysqli_real_escape_string($conn,$_REQUEST['username']);
    $pass = mysqli_real_escape_string($conn,$_REQUEST['password']);
	
    $sql = "SELECT id FROM users WHERE username = '$user'";
    $check = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_array($check,MYSQLI_ASSOC);
    
    session_start();
    $count = mysqli_num_rows($check);
    if ($count != 1){
        $_SESSION['user'] = 'false';
        
        mysqli_close($conn);
        header('Location: login.php');
        exit;
    }else{
        $sql = "SELECT id FROM users WHERE username = '$user'  AND passcode = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($result);
        if ($count == 1){
            $userName = $_REQUEST['username'];
            $_SESSION['login_user'] = $userName;
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
