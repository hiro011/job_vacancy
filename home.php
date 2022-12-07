
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Vacancy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="/job vacancy/css/font.css">
    <link rel="stylesheet" href="/job vacancy/css/bootstrap.min.css">
    <link rel="stylesheet" href="/job vacancy/css/app.css">
    <link rel="stylesheet" href="/job vacancy/css/my_style.css">

    <style>
        .highlight{ /* highlight searched word key */
            color: blue;
        }
    </style>
   
</head>

<body class="flex flex-wrap justify-center bg-blue-100">

    <div class="flex w-full justify-center px-4 bg-purple-900 text-white">
        <a class="mx-3 my-4 active" href="/job vacancy/home.php">Home</a>
        <a class="mx-3 my-4" href="/job vacancy/insert.php">New</a>
    </div>
    <div class="my-10 w-full flex justify-center">
                
        <div class="my-1 flex justify-center w-full">
            <section class="border rounded shadow-lg p-4  bg-gray-200">
                <h1 class="text-center text-3xl my-2">Applied Job Vacancies</h1>
                <?php
                    // deleted successfully message
            		session_start();
                    if(isset($_SESSION['id'])){
                        echo '<div class="flex justify-around my-8">';
                        echo '<div class="p-3 bg-red-300 w-10/12 text-orange-800 rounded shadow-sm text-center">';
                        echo '<span> Data deleted successfuly 🙂 </span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    session_destroy() 
                ?>
                <hr>
                
                <form action="home.php" method="post" class="flex justify-center my-3">
                    <a href="/job vacancy/home.php" class="btn-del">clear</a>
                    <input type="text" name="search" class="search" 
                        <?php 
                            // set the input value to searched key word
                            // if it searched
                            if(isset($_POST["search"])) 
                            echo 'value="'.$_POST["search"].'"'
                        ?> 
                        placeholder="search...">
                    <input type="submit" value="Search" class="btn">
                </form>

                <?php
                    $conn = mysqli_connect("localhost", "root", "", "jobs_vacancy");
                        
                    // Check connection
                    if($conn === false){
                        die("ERROR: Could not connect. "
                            . mysqli_connect_error());
                    }

                    $result =  mysqli_query($conn, "SELECT * FROM jobs");

                    echo "<table border='1'>
                            <tr>    
                                <th>No</th>
                                <th>Posted In</th>
                                <th>Company</th>
                                <th>Position</th>
                                <th>Job Type</th>
                                <th>Place</th>
                                <th>Deadline</th>
                                <th>Date</th>
                                <th>Option</th>
                            </tr> "; 
                    $number = 1;

                    if (isset($_POST["search"])) { /* check if search button/input is clicke */
                        // (B1) SEARCH FOR USERS
                        require "search.php";
                        if (count($result) > 0) { 
                            foreach ($result as $row) {
                                $formattedDate = date("d-M-Y", strtotime($row["date"]));

                                $sL = strlen($_POST["search"]); // length of searched key
                                
                                $rowWord = $row['posted_in']; // pos = posted_in
                                $rowWordI = strpos($rowWord, $_POST["search"]); // index of searched key in pos

                                echo "<tr>";
                                echo "<td>" . $number . "</td>"; // incrimented number
                                
                                // the 1st column
                                if($rowWordI !== false){ // check if index isnot false or there is index value
                                    echo "<td>";
                                    // echo all words before the searched key word
                                    if ($rowWordI !== 0){
                                        for ($i = 0; $i < $rowWordI; $i++) {
                                            echo $rowWord[$i];
                                        }
                                    }
                                    // echo the searched key word highligheted 
                                    echo '<span class="highlight">';
                                    for ($i = $rowWordI; $i < ($rowWordI + $sL); $i++) {
                                        echo $rowWord[$i];
                                    }
                                    echo '</span>';
                                    // echo all word after searched key if exist
                                    if (($rowWordI + $sL) < strlen($rowWord)){
                                        for ($i = ($rowWordI + $sL); $i < strlen($rowWord); $i++) {
                                            echo $rowWord[$i];
                                        }
                                    }
                                    echo "<td>";

                                } else echo "<td>" . $rowWord . "</td>";

                                echo "<td>" . $row['company'] . "</td>";
                                echo "<td class='c-green'>" . $row['position'] . "</td>";
                                echo "<td>" . $row['job_type'] . "</td>";
                                echo "<td class='c-green'>" . $row['place'] . "</td>";
                                echo "<td>" . $row['deadline'] . "</td>";
                                echo "<td>" . $formattedDate . "</td>";
                                echo "<td><a href='/job vacancy/delete.php?id=".$row['id']."' class='btn-del'>Delete </a> </td>";
                                echo "</tr>";
                                $number++;
                            }
                            echo "</table>";
                        }else { 
                            echo "</table>";
    
                            echo "<h2 style='text-align:center; color: red'>--- No result found ---</h2>"; 
                        }
                    } else {
                        while($row = mysqli_fetch_array($result)){
                            $formattedDate = date("d-M-Y", strtotime($row["date"]));
                            echo "<tr>";
                            echo "<td>" . $number . "</td>";
                            echo "<td>" . $row['posted_in'] . "</td>";
                            echo "<td>" . $row['company'] . "</td>";
                            echo "<td class='c-green'>" . $row['position'] . "</td>";
                            echo "<td>" . $row['job_type'] . "</td>";
                            echo "<td class='c-green'>" . $row['place'] . "</td>";
                            echo "<td>" . $row['deadline'] . "</td>";
                            echo "<td>" . $formattedDate . "</td>";
                            echo "<td><a href='/job vacancy/delete.php?id=".$row['id']."' class='btn-del'>Delete </a> </td>";
                            echo "</tr>";
                            $number++;
                        }
                        echo "</table>";
                    }
                    
                    mysqli_close($conn);

                ?>
            
            </section>
        </div>

    </div>

</body>

</html>


