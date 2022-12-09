
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

<body class="flex justify-center bg-blue-100">

    <div class="my-5 flex justify-center w-full">
                
        <section class="border rounded shadow-lg p-4  bg-gray-200">
            <h1 class="text-center text-3xl my-2">Login</h1>
            <?php
                // no user account message
                session_start();
                if(isset($_SESSION['user'])){
                    echo '<div class="flex justify-around my-8">';
                    echo '<div class="p-3 bg-red-300 text-orange-800 rounded shadow-sm text-center">';
                    echo '<span> Username does not exit! </span>';
                    echo '</div>';
                    echo '</div>';
                }
                // wrong password message
                if(isset($_SESSION['password'])){
                    echo '<div class="flex justify-around my-8">';
                    echo '<div class="p-3 bg-red-300 w-10/12 text-orange-800 rounded shadow-sm text-center">';
                    echo '<span> Wrong password! </span>';
                    echo '</div>';
                    echo '</div>';
                }
                session_destroy() 
            ?>
            <hr>
            
            <form class="my-4" action="verify.php"  method="post">
                <div class="flex justify-around my-4">
                    <div class="flex flex-wrap w-10/12">
                        <input type="text" name="username" title="username" class="p-2 rounded border shadow-sm w-full" placeholder="Username" required />
                    </div>
                </div>

                <div class="flex justify-around my-4">
                    <div class="flex flex-wrap w-10/12">
                        <input type="password" name="password" title="Password" class="p-2 rounded border shadow-sm w-full" placeholder="Password" required />
                    </div>
                </div>

                <div class="flex justify-around my-4">
                    <div class="flex flex-wrap w-10/12">
                        <input type="submit" value="login" class="h-op-75 p-2 bg-green-800 text-white w-full rounded tracking-wider cursor-pointer" />
                    </div>
                </div>
            </form>

        </section>

    </div>

</body>

</html>


