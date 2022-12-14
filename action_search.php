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
    
    // (B) CONNECT TO DATABASE
    $pdo = new PDO(
        "mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME,
        DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
	// session_start();
	$user_id = $_SESSION['user_id'];
    // (C) SEARCH
    if($_POST["search"] == ''){
        header('Location: home.php');
		exit;
    } else {
        $stmt = $pdo->prepare("SELECT * FROM `jobs` WHERE 
                                `user_id` = ? AND `posted_in` LIKE ? OR 
								`user_id` = ? AND `company` LIKE ? OR 
								`user_id` = ? AND `position` LIKE ? OR 
								`user_id` = ? AND `job_type` LIKE ? OR 
								`user_id` = ? AND `place` LIKE ? OR 
								`user_id` = ? AND `deadline` LIKE ?
								 ORDER BY `id` DESC"
                                );
        $stmt->execute([$user_id, "%".$_POST["search"]."%", 
						$user_id, "%".$_POST["search"]."%",
						$user_id, "%".$_POST["search"]."%",
						$user_id, "%".$_POST["search"]."%",
						$user_id, "%".$_POST["search"]."%",
						$user_id, "%".$_POST["search"]."%"]);
        $result = $stmt->fetchAll();
        if (isset($_POST["ajax"])) { 
            echo json_encode($result); 
        }
    }
	 
?>
