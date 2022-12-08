
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
    
</head>

<body class="flex flex-wrap justify-center bg-blue-100">

    <div class="flex w-full justify-center px-4 bg-purple-900 text-white">
        <a class="mx-3 my-4" href="/job vacancy/home.php">Home</a>
        <a class="mx-3 my-4 active" href="/job vacancy/insert.php">New</a>
    </div>
    <div class="my-1 w-full flex justify-center">
        <div class="my-10 flex justify-center w-full">
            <section class="border rounded shadow-lg p-4 w-6/12 bg-gray-200">
                <h1 class="text-center text-3xl my-2">Enter the info</h1>
                <?php
            		session_start();
                    if(isset($_SESSION['position'])){
                        echo '<div class="flex justify-around my-8">';
                        echo '<div class="p-3 bg-green-300 w-10/12 text-green-800 rounded shadow-sm text-center">';
                        echo '<span> Data inserted successfuly 🙂 </span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    session_destroy() 
                ?>
                <hr>
                <form class="my-4" action="action.php"  method="post">
                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <input type="text" name="posted_in" title="Posted in" class="p-2 rounded border shadow-sm w-full" placeholder="Posted in" />
                        </div>
                    </div>

                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <input type="text" name="company" title="Company name" class="p-2 rounded border shadow-sm w-full" placeholder="Company name" />
                        </div>
                    </div>

                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <input type="text" name="position" title="Position" class="p-2 rounded border shadow-sm w-full" placeholder="Position name" required />
                        </div>
                    </div>

                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <select name="job_type" id="JT" title="Job type" class="p-2 rounded border shadow-sm w-full pointer" >
                                <option value="none" disabled selected>Job type</option>
                                <option value="permanent">Permanent</option>
                                <option value="intern">Intern</option>
                                <option value="contractual">Contractual</option>
                                <option value="freelance">Freelance</option>
                                <option value="Remote-Permanent">Remote Permanent</option>
                                <option value="Remote-contract">Remote Contract</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <select name="place" id="place" title="Work place" class="p-2 rounded border shadow-sm w-full pointer" >
                                <option value="none" disabled selected>Work place</option>
                                <option value="Addis Ababa">Addis Ababa</option>
                                <option value="Adama">Adama</option>
                                <option value="Remote">Remote</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <input type="text" name="deadline" title="Deadline" class="p-2 rounded border shadow-sm w-full" placeholder="Deadline" />
                        </div>
                    </div>
                    
                    
                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <input type="submit" value="Save" class="h-op-75 p-2 bg-gray-800 text-white w-full rounded tracking-wider cursor-pointer" />
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
        
</body>

</html>


