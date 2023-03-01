
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

// Saving history
$user_id = $_SESSION['user_id'];
$result =  mysqli_query($conn, "SELECT * FROM jobs WHERE user_id = '$user_id' and id = '$job_id'");
$row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

$user_id = $row2['user_id'];
$posted_in = $row2['posted_in'];
$company = $row2['company'];
$position = $row2['position'];
$job_type = $row2['job_type'];
$place = $row2['place'];
$deadline = $row2['deadline'];
$save_date = $row2['date'];
$date = date("y/m/d");

// Performing insert query execution
$sql1 = "INSERT INTO deleted_jobs VALUES ('$id', '$job_id', '$user_id', '$posted_in',
		'$company', '$position', '$job_type', '$place', '$deadline', 
		'$save_date', '$date')";

if (mysqli_query($conn, $sql1)) {
  // Performing delete query execution 
  $sql = "DELETE FROM jobs WHERE id = '$job_id'";
  if (mysqli_query($conn, $sql)) {

    $_SESSION['delete'] = $job_id;

    mysqli_close($conn);
    // header('Location: home.php');
    echo " <script> history.go(-1); </script> ";
    exit;
  } else {
    echo "ERROR: Hush! Sorry $sql. "
      . mysqli_error($conn);
  }
} else {
  $_SESSION['history'] = $job_id;

  mysqli_close($conn);
  header('Location: home.php');
  exit;
}


?>
