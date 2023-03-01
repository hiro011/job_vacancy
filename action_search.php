<?php

  if (!isset($_SESSION)) {
    session_start();
  }

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
    "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
    DB_USER,
    DB_PASSWORD,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
  );

  $user_id = $_SESSION['user_id'];
  // (C) SEARCH
  if ($_POST["search"] == '') {
    header('Location: home.php');
    exit;
  } else { 
    if (isset($_SESSION['sort']) && ($_SESSION['sort'] === '1')) {
      $stmt = $pdo->prepare("SELECT * FROM `jobs` WHERE 
              `user_id` = ? AND (`posted_in` LIKE ? OR 
              `company` LIKE ? OR `position` LIKE ? OR 
              `job_type` LIKE ? OR `place` LIKE ? OR 
              `deadline` LIKE ? ) ORDER BY `id` ASC");
    } elseif (isset($_SESSION['sort']) && ($_SESSION['sort'] === '2')) {
      $stmt = $pdo->prepare("SELECT * FROM `jobs` WHERE 
              `user_id` = ? AND (`posted_in` LIKE ? OR 
              `company` LIKE ? OR `position` LIKE ? OR 
              `job_type` LIKE ? OR `place` LIKE ? OR 
              `deadline` LIKE ? ) ORDER BY `accepted` DESC");
    } else { 
      $stmt = $pdo->prepare("SELECT * FROM `jobs` WHERE 
              `user_id` = ? AND (`posted_in` LIKE ? OR 
              `company` LIKE ? OR `position` LIKE ? OR 
              `job_type` LIKE ? OR `place` LIKE ? OR 
              `deadline` LIKE ? ) ORDER BY `id` DESC");
    }

    $stmt->execute([
      $user_id, "%" . $_POST["search"] . "%",
      "%" . $_POST["search"] . "%",
      "%" . $_POST["search"] . "%",
      "%" . $_POST["search"] . "%",
      "%" . $_POST["search"] . "%",
      "%" . $_POST["search"] . "%"
    ]);

    $result = $stmt->fetchAll();

    if (isset($_POST["ajax"])) {
      $_SESSION['result'] = json_encode($result);
      // echo json_encode($result); 
      header('Location: home.php');
      exit;
    } else {
      $_SESSION['searchResult'] = $result;
      $_SESSION['postsearch'] = $_POST["search"];
      header('Location: home.php');
      exit;
    }
  }

?>
