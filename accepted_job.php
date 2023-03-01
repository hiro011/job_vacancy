
<?php

  // servername => localhost
  // username => root
  // password => empty
  // database name => jobs_vacancy

  $conn = mysqli_connect("localhost", "root", "", "jobs_vacancy");

  // Check connection
  if ($conn === false) {
    die("ERROR: Could not connect. "
      . mysqli_connect_error());
  }

  session_start();

  $job_id = $_REQUEST['id'];
  $value = $_REQUEST['value'];

  if (isset($_SESSION['searchResult2'])) {
    $_SESSION['searchResult'] = $_SESSION['searchResult2'];
    $_SESSION['postsearch'] = $_SESSION['postsearch2'];
  }

  $sql = "UPDATE jobs SET accepted = $value WHERE id = $job_id";

  if (mysqli_query($conn, $sql)) {

    $_SESSION['accepted'] = $job_id;

    mysqli_close($conn);

    if (isset($_SESSION['postsearch'])) {
      header('Location: action_search.php?value=1');
    } else {
      header('Location: home.php');
    }
    exit;
  } else {
    echo "ERROR: Hush! Sorry $sql. "
      . mysqli_error($conn);
  }

  // Close connection
  mysqli_close($conn);

?>

