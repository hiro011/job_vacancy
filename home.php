<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Job Vacancy</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="/job.vacancy/css/app.css"> -->
  <link rel="stylesheet" href="/job.vacancy/css/my_style.css?v=<?php echo time(); ?>">

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .profile-img-css {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
    }

    .bg-blue-300:hover {
      opacity: 0.7
    }
  </style>
</head>

<body class="flex flex-wrap justify-center bg-blue-100">
  <?php
  session_start();
  if (isset($_SESSION['login_user'])) {
    $user = $_SESSION['login_user'];
  } else $user = 'Guest';

  if ($user == 'Guest') {
    $_SESSION['login'] = 'false';
    header('Location: login.php');
    exit;
  }
  ?>

  <div class="flex w-full fixed-nav justify-between px-4 bg-purple-900 text-white">
    <div class="my-4">
      <?php
      if ($user != 'Guest') {
        echo '<a class="mx-3 nav-a active" href="/job.vacancy/home.php">Home</a>';
        echo '<a class="mx-3 nav-a" href="/job.vacancy/home.php#deleted_history">Deleted</a>';
        echo '<a class="mx-3 nav-a" href="/job.vacancy/insert.php">New</a>';
      }
      ?>
    </div>

    <div class="flex flex-col justify-center">
      <?php
      if (isset($_SESSION['profile'])) {
        echo '<img src="/job.vacancy/img/' . $_SESSION['profile'] . '" title="' . $user . '" alt="profile img" class="profile-img-css" >';
      } else echo '<img src="/job.vacancy/img/defualt/defualt_profile.png" title="' . $user . '" alt="profile img" class="profile-img-css" >';

      echo '<h2 title="' . $user . '">';
      echo $user;
      echo '</h2>';
      ?>
      <a href="/job.vacancy/login.php" class="text-red-500" title="logout"> Logout </a>

    </div>
  </div>

  <div class="w-full flex justify-center my-16">

    <div class="my-4 flex justify-center w-full">
      <section class="border view_sec rounded shadow-lg  bg-gray-200">
        <h1 class="text-center text-3xl my-2">Applied Job Vacancies</h1>

        <!-- Messages -->
        <?php
        if (isset($_SESSION['delete'])) {
          echo '<div class="flex  justify-around my-8" title="Click to hide" onclick="hide(this)">';
          echo '<div class="p-3 message_alert bg-red-300 w-6/12 text-orange-800 rounded shadow-sm text-center">';
          echo '<span> Data deleted successfuly 🙂 </span>';
          echo '</div>';
          echo '</div>';
        }
        unset($_SESSION['delete']);

        if (isset($_SESSION['undo'])) {
          echo '<div class="flex  justify-around my-8" title="Click to hide" onclick="hide(this)">';
          echo '<div class="p-3 message_alert bg-green-500 w-6/12 text-green-800 rounded shadow-sm text-center">';
          echo '<span> Data undo successful 🙂 </span>';
          echo '</div>';
          echo '</div>';
        }
        unset($_SESSION['delete2']);

        if (isset($_SESSION['update'])) {
          echo '<div class="flex  justify-around my-8" title="Click to hide" onclick="hide(this)">';
          echo '<div class="p-3 message_alert bg-green-500 w-6/12 text-green-800 rounded shadow-sm text-center">';
          echo '<span> Update data successful 🙂 </span>';
          echo '</div>';
          echo '</div>';
        }
        unset($_SESSION['update']);

        if (isset($_SESSION['history'])) {
          echo '<div class="flex  justify-around my-8" title="Click to hide" onclick="hide(this)">';
          echo '<div class="p-3 message_alert bg-red-300 w-6/12 text-orange-800 rounded shadow-sm text-center">';
          echo '<span> Unable to save data history! </span>';
          echo '</div>';
          echo '</div>';
        }
        unset($_SESSION['history']);

        if (isset($_SESSION['history_deleted'])) {
          echo '<div class="flex  justify-around my-8" title="Click to hide" onclick="hide(this)">';
          echo '<div class="p-3 message_alert bg-red-300 w-6/12 text-orange-800 rounded shadow-sm text-center">';
          echo '<span> History data deleted successfuly 🙂 </span>';
          echo '</div>';
          echo '</div>';
        }
        unset($_SESSION['history_deleted']);

        if (isset($_SESSION['undoerror'])) {
          echo '<div class="flex  justify-around my-8" title="Click to hide" onclick="hide(this)">';
          echo '<div class="p-3 message_alert bg-red-300 w-6/12 text-orange-800 rounded shadow-sm text-center">';
          echo '<span> Error! failed to undo. </span>';
          echo '</div>';
          echo '</div>';
        }
        unset($_SESSION['undo']);
        ?>

        <hr>

        <form action="action_search.php" method="post" class="flex justify-center my-3">
          <a href="/job.vacancy/home.php" class="btn-del p-1">clear</a>
          <input type="search" name="search" class="search" <?php
                                                            // set the input value to searched key word
                                                            // if it searched
                                                            if (isset($_SESSION['postsearch'])) {
                                                              echo 'value="' . $_SESSION['postsearch'] . '"';
                                                            }
                                                            ?> placeholder="search...">
          <input type="submit" value="Search" class="btn bg-green-600">
        </form>

        <form action="action_sort.php" method="post" class="flex justify-center my-3">
          <select name="sort" class="cursor-pointer rounded">
            <option value='0' <?php
                              if (isset($_SESSION['sort']) && ($_SESSION['sort'] === '0')) {
                                echo "selected";
                              }
                              ?>> Latest </option>

            <option value='1' <?php
                              if (isset($_SESSION['sort']) && ($_SESSION['sort'] === '1')) {
                                echo "selected";
                              }
                              ?>> Oldest </option>

            <option value='2' <?php
                              if (isset($_SESSION['sort']) && ($_SESSION['sort'] === '2')) {
                                echo "selected";
                              }
                              ?>> Accepted </option>
          </select>
          <input type="submit" value="Sort" class="rounded py-2 px-3 bg-blue-300">
        </form>

        <?php
        if (isset($_SESSION['row'])) {
          $edit_row = $_SESSION['row'];
          unset($_SESSION['row']);
        ?>


          <div id="modal_edit" class="modal flex justify-center">
            <div class="m-4 form-container border shadow rounded p-4 w-6/12">
              <form action="action_update.php" method="post">

                <div class="flex justify-around my-4">
                  <div class="flex flex-wrap w-10/12">
                    <input type="text" name="posted_in" title="Posted in" <?php
                                                                          echo 'value="' . $edit_row['posted_in'] . '"';
                                                                          ?> class="p-2 rounded border shadow-sm w-full" placeholder="Posted in" />
                  </div>
                </div>

                <div class="flex justify-around my-4">
                  <div class="flex flex-wrap w-10/12">
                    <input type="text" name="company" title="Company name" <?php
                                                                            echo 'value="' . $edit_row['company'] . '"';
                                                                            ?> class="p-2 rounded border shadow-sm w-full" placeholder="Company name" />
                  </div>
                </div>

                <div class="flex justify-around my-4">
                  <div class="flex flex-wrap w-10/12">
                    <input type="text" name="position" title="Position" <?php
                                                                        echo 'value="' . $edit_row['position'] . '"';
                                                                        ?> class="p-2 rounded border shadow-sm w-full" placeholder="Position name" required />
                  </div>
                </div>

                <div class="flex justify-around my-4">
                  <div class="flex flex-wrap w-10/12">
                    <select name="job_type" id="JT" title="Job type" class="p-2 rounded border shadow-sm w-full pointer">
                      <option value="none" disabled selected>Job type</option>

                      <option <?php if ($edit_row["job_type"] == "permanent") {
                                echo "selected";
                              } ?> value="permanent">Permanent</option>

                      <option <?php if ($edit_row["job_type"] == "intern") {
                                echo "selected";
                              } ?> value="intern">Intern</option>

                      <option <?php if ($edit_row["job_type"] == "contractual") {
                                echo "selected";
                              } ?> value="contractual">Contractual</option>

                      <option <?php if ($edit_row["job_type"] == "freelance") {
                                echo "selected";
                              } ?> value="freelance">Freelance</option>

                      <option <?php if ($edit_row["job_type"] == "Remote-Permanent") {
                                echo "selected";
                              } ?> value="Remote-Permanent">Remote Permanent</option>

                      <option <?php if ($edit_row["job_type"] == "Remote-contract") {
                                echo "selected";
                              } ?> value="Remote-contract">Remote Contract</option>

                      <option <?php if ($edit_row["job_type"] == "other") {
                                echo "selected";
                              } ?> value="other">Other</option>
                    </select>
                  </div>
                </div>

                <div class="flex justify-around my-4">
                  <div class="flex flex-wrap w-10/12">
                    <select name="place" id="place" title="Work place" class="p-2 rounded border shadow-sm w-full pointer">
                      <option value="none" disabled selected>Work place</option>
                      <option <?php if ($edit_row["place"] == "Addis Ababa") {
                                echo "selected";
                              } ?> value="Addis Ababa">Addis Ababa</option>
                      <option <?php if ($edit_row["place"] == "Adama") {
                                echo "selected";
                              } ?> value="Adama">Adama</option>
                      <option <?php if ($edit_row["place"] == "Remote") {
                                echo "selected";
                              } ?> value="Remote">Remote</option>
                      <option <?php if ($edit_row["place"] == "other") {
                                echo "selected";
                              } ?> value="other">Other</option>
                    </select>
                  </div>
                </div>

                <div class="flex justify-around my-4">
                  <div class="flex flex-wrap w-10/12">
                    <input type="text" name="deadline" title="Deadline" 
                      <?php
                        echo 'value="' . $edit_row['deadline'] . '"';
                      ?> 
                      class="p-2 rounded border shadow-sm w-full" placeholder="Deadline" />
                  </div>
                </div>


                <div class="flex justify-around my-4">
                  <div class="flex flex-wrap w-32">
                    <input type="submit" value="Update" class=" w-full h-op-75 p-2 bg-green-600 text-white rounded tracking-wider cursor-pointer" />
                  </div>

                  <div class="flex flex-wrap w-32">
                    <input type="button" onclick="cancelEdit()" value="Cancel" class="w-full h-op-75 p-2 bg-red-500 text-white rounded tracking-wider cursor-pointer" />
                  </div>
                </div>

              </form>

            </div>
          </div>

        <?php
        }
        ?>

        <div class="table_wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>ID</th>
                <th>Posted In</th>
                <th>Company</th>
                <th>Position</th>
                <th>Job Type</th>
                <th>Place</th>
                <th>Deadline</th>
                <th>Date</th>
                <th>Options</th>
              </tr>
            </thead>

            <tbody>

              <?php
              $conn = mysqli_connect("localhost", "root", "rootadmin", "jobs_vacancy");

              // Check connection
              if ($conn === false) {
                die("ERROR: Could not connect. "
                  . mysqli_connect_error());
              }
              $user_id = $_SESSION['user_id'];

              if (isset($_SESSION['sortResult'])) {
                if ($_SESSION['sort'] == 1) {
                  $result = mysqli_query($conn, "SELECT * FROM jobs WHERE user_id = '$user_id' ORDER BY id ASC");
                }  
                
                if ($_SESSION['sort'] == 2) {
                  $result = mysqli_query($conn, "SELECT * FROM jobs WHERE user_id = '$user_id' ORDER BY accepted DESC");
                }
              } else {
                $result =  mysqli_query($conn, "SELECT * FROM jobs WHERE user_id = '$user_id' ORDER BY id DESC");
              }

              if (isset($_SESSION['searchResult'])) { /* check if search button/input is clicked */
                $number = 1;

                $result = $_SESSION['searchResult'];
                $_POST["search"] = $_SESSION['postsearch'];

                if (count($result) > 0) {
                  foreach ($result as $row) {
                    $formattedDate = date("d-M-Y", strtotime($row["date"]));
                    $sL = strlen($_POST["search"]); // length of searched key
                   
                    if ($row['accepted'] == 1) {
                      echo "<tr class='bg-blue-200'>";
                    } else {
                      if($number % 2 == 0){
                        echo "<tr>";
                      }
                      else{
                        echo "<tr class='bg-gray-100'>";
                      }
                    }  

                    // the numbering column --------
                    echo "<td>" . $number . "</td>"; // incrimented number
                    echo "<td>" . $row['id'] . "</td>"; // id

                    // the 1st column --------
                    $rowWord1 = $row['posted_in'];
                    $rowWord1I = stripos($rowWord1, $_POST["search"]); // index of searched key in collumn
                    if ($rowWord1I !== false) { // check if index isnot false or there is index value
                      echo "<td>";
                      // echo all words before the searched key word if exist
                      if ($rowWord1I !== 0) {
                        for ($i = 0; $i < $rowWord1I; $i++) {
                          echo $rowWord1[$i];
                        }
                      }
                      // echo the searched key word highligheted 
                      echo '<span class="bg-yellow-400">';
                      for ($i = $rowWord1I; $i < ($rowWord1I + $sL); $i++) {
                        echo $rowWord1[$i];
                      }
                      echo '</span>';
                      // echo all word after searched key if exist
                      if (($rowWord1I + $sL) < strlen($rowWord1)) {
                        for ($i = ($rowWord1I + $sL); $i < strlen($rowWord1); $i++) {
                          echo $rowWord1[$i];
                        }
                      }
                      echo "</td>";
                    } else echo "<td>" . $rowWord1 . "</td>";

                    // the 2nd column --------
                    $rowWord2 = $row['company'];
                    $rowWord2I = stripos($rowWord2, $_POST["search"]); // index of searched key in pos
                    if ($rowWord2I !== false) { // check if index isnot false or there is index value
                      echo "<td>";
                      // echo all words before the searched key word
                      if ($rowWord2I !== 0) {
                        for ($i = 0; $i < $rowWord2I; $i++) {
                          echo $rowWord2[$i];
                        }
                      }
                      // echo the searched key word highligheted 
                      echo '<span class="bg-yellow-400">';
                      for ($i = $rowWord2I; $i < ($rowWord2I + $sL); $i++) {
                        echo $rowWord2[$i];
                      }
                      echo '</span>';
                      // echo all word after searched key if exist
                      if (($rowWord2I + $sL) < strlen($rowWord2)) {
                        for ($i = ($rowWord2I + $sL); $i < strlen($rowWord2); $i++) {
                          echo $rowWord2[$i];
                        }
                      }
                      echo "</td>";
                    } else echo "<td>" . $row['company'] . "</td>";

                    // the 3rd column --------
                    $rowWord3 = $row['position'];
                    $rowWord3I = stripos($rowWord3, $_POST["search"]); // index of searched key in pos
                    if ($rowWord3I !== false) { // check if index isnot false or there is index value
                      echo "<td>";
                      // echo all words before the searched key word
                      if ($rowWord3I !== 0) {
                        echo '<span class="text-green-600">';
                        for ($i = 0; $i < $rowWord3I; $i++) {
                          echo $rowWord3[$i];
                        }
                        echo '</span>';
                      }
                      // echo the searched key word highligheted 
                      echo '<span class="bg-yellow-400">';
                      for ($i = $rowWord3I; $i < ($rowWord3I + $sL); $i++) {
                        echo $rowWord3[$i];
                      }
                      echo '</span>';
                      // echo all word after searched key if exist
                      if (($rowWord3I + $sL) < strlen($rowWord3)) {
                        echo '<span class="text-green-600">';
                        for ($i = ($rowWord3I + $sL); $i < strlen($rowWord3); $i++) {
                          echo $rowWord3[$i];
                        }
                        echo '</span>';
                      }
                      echo "</td>";
                    } else echo "<td class='text-green-600'>" . $row['position'] . "</td>";

                    // the 4th column --------
                    $rowWord4 = $row['job_type'];
                    $rowWord4I = stripos($rowWord4, $_POST["search"]); // index of searched key in pos
                    if ($rowWord4I !== false) { // check if index isnot false or there is index value
                      echo "<td>";
                      // echo all words before the searched key word
                      if ($rowWord4I !== 0) {
                        for ($i = 0; $i < $rowWord4I; $i++) {
                          echo $rowWord4[$i];
                        }
                      }
                      // echo the searched key word highligheted 
                      echo '<span class="bg-yellow-400">';
                      for ($i = $rowWord4I; $i < ($rowWord4I + $sL); $i++) {
                        echo $rowWord4[$i];
                      }
                      echo '</span>';
                      // echo all word after searched key if exist
                      if (($rowWord4I + $sL) < strlen($rowWord4)) {
                        for ($i = ($rowWord4I + $sL); $i < strlen($rowWord4); $i++) {
                          echo $rowWord4[$i];
                        }
                      }
                      echo "</td>";
                    } else echo "<td>" . $row['job_type'] . "</td>";

                    // the 5th column --------
                    $rowWord5 = $row['place'];
                    $rowWord5I = stripos($rowWord5, $_POST["search"]); // index of searched key in collumn
                    if ($rowWord5I !== false) { // check if index isnot false or there is index value
                      echo "<td>";
                      // echo all words before the searched key word if exist
                      if ($rowWord5I !== 0) {
                        if ($row['place'] === 'Adama') {
                          echo '<span class="text-green-600">';
                        } else {
                          echo '<span>';
                        }
                        for ($i = 0; $i < $rowWord5I; $i++) {
                          echo $rowWord5[$i];
                        }
                        echo '</span>';
                      }
                      // echo the searched key word highligheted 
                      echo '<span class="bg-yellow-400">';
                      for ($i = $rowWord5I; $i < ($rowWord5I + $sL); $i++) {
                        echo $rowWord5[$i];
                      }
                      echo '</span>';
                      // echo all word after searched key if exist
                      if (($rowWord5I + $sL) < strlen($rowWord5)) {
                        if ($row['place'] === 'Adama') {
                          echo '<span class="text-green-600">';
                        } else {
                          echo '<span>';
                        }
                        for ($i = ($rowWord5I + $sL); $i < strlen($rowWord5); $i++) {
                          echo $rowWord5[$i];
                        }
                        echo '</span>';
                      }
                      echo "</td>";
                    } else {
                      echo "<td>";
                      if ($row['place'] === 'Adama') {
                        echo '<span class="text-green-600"> ' . $row['place'] . '</span>';
                      } else {
                        echo '<span>' . $row['place'] . '</span>';
                      }
                      echo "</td>";
                    }

                    // the 6th column --------
                    $rowWord6 = $row['deadline'];
                    $rowWord6I = stripos($rowWord6, $_POST["search"]); // index of searched key in collumn
                    if ($rowWord6I !== false) { // check if index isnot false or there is index value
                      echo "<td>";
                      // echo all words before the searched key word if exist
                      if ($rowWord6I !== 0) {
                        for ($i = 0; $i < $rowWord6I; $i++) {
                          echo $rowWord6[$i];
                        }
                      }
                      // echo the searched key word highligheted 
                      echo '<span class="bg-yellow-400">';
                      for ($i = $rowWord6I; $i < ($rowWord6I + $sL); $i++) {
                        echo $rowWord6[$i];
                      }
                      echo '</span>';
                      // echo all word after searched key if exist
                      if (($rowWord6I + $sL) < strlen($rowWord6)) {
                        for ($i = ($rowWord6I + $sL); $i < strlen($rowWord6); $i++) {
                          echo $rowWord6[$i];
                        }
                      }
                      echo "</td>";
                    } else echo "<td>" . $row['deadline'] . "</td>";

                    echo "<td>" . $formattedDate . "</td>";
                    // echo "<td><button onclick='deleteJob(".$row["id"].")' class='btn-del p-1'>Delete </button> </td>";

                    echo "<td>
											<div class='flex justify-between'>";
                  
                      if ($row['accepted'] == 1) {
                        echo	"<button onclick='declineJob(" . $row["id"] . ")' class='btn p-1 mx-1'>Decline </button> ";
                      } else {
                        echo	"<button onclick='acceptedJob(" . $row["id"] . ")' class='btn p-1 mx-1'>Accepted </button> ";
                      }
    
                    echo "<button onclick='editJob(" . $row["id"] . ")' class='btn p-1 mx-1'>Edit </button> 
											<button onclick='deleteJob(" . $row["id"] . ")' class='btn-del p-1'>Delete </button>
											</div>
											</td>";
                    echo "</tr>";
                    $number++;
                  }
                } else {
                  echo '<tr>';
                  echo "<td colspan='10' class='text-center text-red-500 '> No result found... </td>";
                  echo '</tr>';
                }
                echo "</tbody>";
                echo "</table>";
              } else {
                $number = 1;

                while ($row = mysqli_fetch_array($result)) {
                  $formattedDate = date("d-M", strtotime($row["date"]));
                  
                  if ($row['accepted'] == 1) {
                    echo "<tr class='bg-blue-200'>";
                  } else {
                    if($number % 2 == 0){
                      echo "<tr>";
                    }
                    else{
                      echo "<tr class='bg-gray-100'>";
                    }
                  }
                  echo "<td>" . $number . "</td>"; // incrimented number
                  echo "<td>" . $row['id'] . "</td>"; // id
                  echo "<td>" . $row['posted_in'] . "</td>";
                  echo "<td>" . $row['company'] . "</td>";
                  echo "<td class='text-green-600'>" . $row['position'] . "</td>";
                  echo "<td>" . $row['job_type'] . "</td>";
                  if ($row['place'] === 'Adama') {
                    echo "<td class='text-green-600'>" . $row['place'] . "</td>";
                  } else {
                    echo "<td>" . $row['place'] . "</td>";
                  }
                  echo "<td>" . $row['deadline'] . "</td>";
                  echo "<td>" . $formattedDate . "</td>";

                  echo "<td>
												<div class='flex justify-between'> ";
                  
                  if ($row['accepted'] == 1) {
                    echo	"<button onclick='declineJob(" . $row["id"] . ")' class='btn p-1 mx-1'>Decline </button> ";
                  } else {
                    echo	"<button onclick='acceptedJob(" . $row["id"] . ")' class='btn p-1 mx-1'>Accepted </button> ";
                  }

                  echo "<button onclick='editJob(" . $row["id"] . ")' class='btn p-1 mx-1'>Edit </button> 
                        <button onclick='deleteJob(" . $row["id"] . ")' class='btn-del p-1'>Delete </button>
												</div>
												</td>";

                  echo "</tr>";
                  $number++;
                }
                echo "</tbody>";
                echo "</table>";
              }
              ?>
        </div>

        <h1 class="text-center text-3xl my-2" id="deleted_history">Deleted History</h1>
        <hr>
        <div class="deleted-table-div">

          <?php
          $result2 =  mysqli_query($conn, "SELECT * FROM deleted_jobs WHERE user_id = '$user_id'");
          $check = mysqli_fetch_array($result2, MYSQLI_ASSOC);

          $count = mysqli_num_rows($result2);
          if ($count > 0) {
            echo '<table class="table" >';
            echo '<thead>
									<tr>    
										<th>No</th>
										<th>ID</th>
										<th>Posted In</th>
										<th>Company</th>
										<th>Position</th>
										<th>Job Type</th>
										<th>Place</th>
										<th>Deadline</th>
										<th>Inserted Date</th>
										<th>Deleted Date</th>
										<th>Options</th>
									</tr>  
								</thead>';
            echo '<tbody>';

            $result2 =  mysqli_query($conn, "SELECT * FROM deleted_jobs WHERE user_id = '$user_id'");
            $number1 = 1;
            while ($row = mysqli_fetch_array($result2)) {
              $formattedDate = date("d-M", strtotime($row["date"]));
              $formattedDate2 = date("d-M", strtotime($row["save_date"]));
              if($number1 % 2 == 0){
                echo "<tr>";
              }
              else{
                echo "<tr class='bg-gray-100'>";
              }
              echo "<td>" . $number1 . "</td>"; // incrimented number
              echo "<td>" . $row['job_id'] . "</td>"; // id
              echo "<td class='line-through'>" . $row['posted_in'] . "</td>";
              echo "<td class='line-through'>" . $row['company'] . "</td>";
              echo "<td class='line-through'>" . $row['position'] . "</td>";
              echo "<td class='line-through'>" . $row['job_type'] . "</td>";
              echo "<td class='line-through'>" . $row['place'] . "</td>";
              echo "<td class='line-through'>" . $row['deadline'] . "</td>";
              echo "<td class='line-through'>" . $formattedDate2 . "</td>";
              echo "<td>" . $formattedDate . "</td>";

              echo "<td> <div class='flex justify-between'>
											<a href='/job.vacancy/action_undo_delete.php?id=" . $row['id'] . "' 
											class='p-1 mx-1 btn'>Undo </a>";

              echo '<button onclick="deleteHistory(' . $row['id'] . ')" class="btn-del p-1">
											Delete </button> </div> </td>';

              echo "</tr>";
              $number1++;
            }
            echo '</tbody>';
            echo '</table>';
          } else {
            echo '<h2 class="text-center"> No delete history </h2>';
          }
          ?>
        </div>
        <?php
        if (isset($_SESSION['searchResult'])) {
          $_SESSION['searchResult2'] = $_SESSION['searchResult'];
          $_SESSION['postsearch2'] = $_SESSION['postsearch'];
        } else {
          unset($_SESSION['searchResult2']);
          unset($_SESSION['postsearch2']);
        }

        unset($_SESSION['searchResult']);
        unset($_SESSION['postsearch']);
        ?>
      </section>
    </div>
  </div>

  <!-- <script src="js/javascript.js"></script> -->
  <script>
    function hide(messege_div) {
      messege_div.style.display = "none";
    }

    function editJob(id) {
      window.open("edit_job.php?id=" + id, "_self");
    }

    function acceptedJob(id) {
      window.open("accepted_job.php?id=" + id + "&value=1", "_self");
    }

    function declineJob(id) {
      window.open("accepted_job.php?id=" + id + "&value=0", "_self");
    }

    function cancelEdit() {
      var id = document.getElementById("modal_edit");
      id.style.display = "none";
    }

    function deleteJob(id) {
      if (confirm("Are you sure to delele?")) {
        window.open("action_delete.php?id=" + id, "_self", "", "");
      }
    }

    function deleteHistory(id) {
      if (confirm("Are you sure to delele?")) {
        window.open("action_delete_history.php?id=" + id, "_self", "", "");
      }
    }
  </script>


</body>

</html>