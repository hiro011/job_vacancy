
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

                                echo "<tr>";

                                // the numbering column --------
                                echo "<td>" . $number . "</td>"; // incrimented number

                                // the 1st column --------
                                $rowWord1 = $row['posted_in']; 
                                $rowWord1I = strpos($rowWord1, $_POST["search"]); // index of searched key in collumn
                                if($rowWord1I !== false){ // check if index isnot false or there is index value
                                    echo "<td>";
                                        // echo all words before the searched key word if exist
                                        if ($rowWord1I !== 0){
                                            for ($i = 0; $i < $rowWord1I; $i++) {
                                                echo $rowWord1[$i];
                                            }
                                        }
                                        // echo the searched key word highligheted 
                                        echo '<span class="highlight">';
                                        for ($i = $rowWord1I; $i < ($rowWord1I + $sL); $i++) {
                                            echo $rowWord1[$i];
                                        }
                                        echo '</span>';
                                        // echo all word after searched key if exist
                                        if (($rowWord1I + $sL) < strlen($rowWord1)){ 
                                            for ($i = ($rowWord1I + $sL); $i < strlen($rowWord1); $i++) {
                                                echo $rowWord1[$i];
                                            }
                                        }
                                    echo "</td>";

                                } else echo "<td>" . $rowWord1 . "</td>";
                                
                                // the 2nd column --------
                                $rowWord2 = $row['company']; 
                                $rowWord2I = strpos($rowWord2, $_POST["search"]); // index of searched key in pos
                                if($rowWord2I !== false){ // check if index isnot false or there is index value
                                    echo "<td>";
                                        // echo all words before the searched key word
                                        if ($rowWord2I !== 0){
                                            for ($i = 0; $i < $rowWord2I; $i++) {
                                                echo $rowWord2[$i];
                                            }
                                        }
                                        // echo the searched key word highligheted 
                                        echo '<span class="highlight">';
                                        for ($i = $rowWord2I; $i < ($rowWord2I + $sL); $i++) {
                                            echo $rowWord2[$i];
                                        }
                                        echo '</span>';
                                        // echo all word after searched key if exist
                                        if (($rowWord2I + $sL) < strlen($rowWord2)){
                                            for ($i = ($rowWord2I + $sL); $i < strlen($rowWord2); $i++) {
                                                echo $rowWord2[$i];
                                            }
                                        }
                                    echo "</td>";

                                } else echo "<td>" . $row['company'] . "</td>";

                                // the 3rd column --------
                                $rowWord3 = $row['position']; 
                                $rowWord3I = strpos($rowWord3, $_POST["search"]); // index of searched key in pos
                                if($rowWord3I !== false){ // check if index isnot false or there is index value
                                    echo "<td>";
                                        // echo all words before the searched key word
                                        if ($rowWord3I !== 0){
                                            echo '<span class="c-green">';
                                            for ($i = 0; $i < $rowWord3I; $i++) {
                                                echo $rowWord3[$i];
                                            }
                                            echo '</span>';
                                        }
                                        // echo the searched key word highligheted 
                                        echo '<span class="highlight">';
                                        for ($i = $rowWord3I; $i < ($rowWord3I + $sL); $i++) {
                                            echo $rowWord3[$i];
                                        }
                                        echo '</span>';
                                        // echo all word after searched key if exist
                                        if (($rowWord3I + $sL) < strlen($rowWord3)){
                                            echo '<span class="c-green">';
                                            for ($i = ($rowWord3I + $sL); $i < strlen($rowWord3); $i++) {
                                                echo $rowWord3[$i];
                                            }
                                            echo '</span>';
                                        }
                                    echo "</td>";

                                } else echo "<td class='c-green'>" . $row['position'] . "</td>";

                                // the 4th column --------
                                $rowWord4 = $row['job_type']; 
                                $rowWord4I = strpos($rowWord4, $_POST["search"]); // index of searched key in pos
                                if($rowWord4I !== false){ // check if index isnot false or there is index value
                                    echo "<td>";
                                        // echo all words before the searched key word
                                        if ($rowWord4I !== 0){
                                            for ($i = 0; $i < $rowWord4I; $i++) {
                                                echo $rowWord4[$i];
                                            }
                                        }
                                        // echo the searched key word highligheted 
                                        echo '<span class="highlight">';
                                        for ($i = $rowWord4; $i < ($rowWord4I + $sL); $i++) {
                                            echo $rowWord4[$i];
                                        }
                                        echo '</span>';
                                        // echo all word after searched key if exist
                                        if (($rowWord4I + $sL) < strlen($rowWord4)){
                                            for ($i = ($rowWord4I + $sL); $i < strlen($rowWord4); $i++) {
                                                echo $rowWord4[$i];
                                            }
                                        }
                                    echo "</td>";

                                } else echo "<td>" . $row['job_type'] . "</td>";
                                
                                // the 5th column --------
                                $rowWord5 = $row['place']; 
                                $rowWord5I = strpos($rowWord5, $_POST["search"]); // index of searched key in collumn
                                if($rowWord5I !== false){ // check if index isnot false or there is index value
                                    echo "<td>";
                                        // echo all words before the searched key word if exist
                                        if ($rowWord5I !== 0){
                                            echo '<span class="c-green">';
                                            for ($i = 0; $i < $rowWord5I; $i++) {
                                                echo $rowWord5[$i];
                                            }
                                            echo '</span>';
                                        }
                                        // echo the searched key word highligheted 
                                        echo '<span class="highlight">';
                                        for ($i = $rowWord5I; $i < ($rowWord5I + $sL); $i++) {
                                            echo $rowWord5[$i];
                                        }
                                        echo '</span>';
                                        // echo all word after searched key if exist
                                        if (($rowWord5I + $sL) < strlen($rowWord5)){ 
                                            echo '<span class="c-green">';
                                            for ($i = ($rowWord5I + $sL); $i < strlen($rowWord5); $i++) {
                                                echo $rowWord5[$i];
                                            }
                                            echo '</span>';
                                        }
                                    echo "</td>";

                                } else echo "<td class='c-green'>" . $row['place'] . "</td>";
                                
                                // the 6th column --------
                                $rowWord6 = $row['deadline']; 
                                $rowWord6I = strpos($rowWord6, $_POST["search"]); // index of searched key in collumn
                                if($rowWord6I !== false){ // check if index isnot false or there is index value
                                    echo "<td>";
                                        // echo all words before the searched key word if exist
                                        if ($rowWord6I !== 0){
                                            for ($i = 0; $i < $rowWord6I; $i++) {
                                                echo $rowWord6[$i];
                                            }
                                        }
                                        // echo the searched key word highligheted 
                                        echo '<span class="highlight">';
                                        for ($i = $rowWord6I; $i < ($rowWord6I + $sL); $i++) {
                                            echo $rowWord6[$i];
                                        }
                                        echo '</span>';
                                        // echo all word after searched key if exist
                                        if (($rowWord6I + $sL) < strlen($rowWord6)){ 
                                            for ($i = ($rowWord6I + $sL); $i < strlen($rowWord6); $i++) {
                                                echo $rowWord6[$i];
                                            }
                                        }
                                    echo "</td>";

                                } else echo "<td>" . $row['deadline'] . "</td>";
                                
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


