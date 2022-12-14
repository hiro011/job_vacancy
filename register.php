
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Vacancy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="/job.vacancy/css/font.css">
    <link rel="stylesheet" href="/job.vacancy/css/bootstrap.min.css">
    <link rel="stylesheet" href="/job.vacancy/css/app.css">
    <link rel="stylesheet" href="/job.vacancy/css/my_style.css">
    
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <style>
        .profile-img-label:hover{
            opacity: .75;
            color: blue;
            text-decoration: underline;
        }
        .profile-img-css{
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

</head>

<body class="flex flex-wrap justify-center bg-blue-100">
    <div class="flex w-full justify-center px-4 bg-purple-900 text-white">
        <a class="mx-3 my-4" href="/job.vacancy/login.php">Login</a>
        <a class="mx-3 my-4 px-2 active" href="/job.vacancy/register.php">Register</a>
    </div>

    <div class="my-1 w-full flex justify-center">
        <div class="my-10 flex justify-center w-full">
            <section class="border rounded shadow-lg p-4 w-6/12 bg-gray-200">
                <h1 class="text-center text-3xl my-2">Register</h1>
                <hr>
				<?php
                    session_start();
					//Message,If file size greater than allowed size 
                    if(isset($_SESSION['size'])){
                        echo '<div class="flex justify-around my-8">';
                        echo '<div class="p-3 bg-red-300 text-orange-800 rounded shadow-sm text-center">';
                        echo '<span> File Size Limit beyond acceptance! </span>';
                        echo '</div>';
                        echo '</div>';
                    } 
					session_unset();
                ?>
                
                <form class="my-4" action="register_action.php" method="post" enctype="multipart/form-data">
                    <div class="flex justify-center mx-3 w-10/12 my-4">
						<div>
							<label for="image" class="flex flex-col justify-center cursor-pointer profile-img-label mx-5">
								<img src="/job.vacancy/img/defualt/defualt_profile.png" alt="defualt profile pic" id="profile_pic" class="profile-img-css"></br>
								<span class="mx-2 strong underline">Choose profile</span>
							</label>

							<input type="file" name="profile" id="image" accept="image/jpg,image/jpeg,image/png,image/gif" class="cursor-pointer" onchange="openimg(this);" style="display: none">
						</div>
					</div>

					<div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <input type="text" name="username" title="Username" class="p-2 rounded border shadow-sm w-full" placeholder="Username" required />
                        </div>
                    </div>

                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <input type="password" name="passcode" title="Password" class="p-2 rounded border shadow-sm w-full" placeholder="Password" required />
                        </div>
                    </div>
                    
                    <div class="flex justify-around my-4">
                        <div class="flex flex-wrap w-10/12">
                            <input type="submit" value="Register" class="h-op-75 p-2 bg-gray-800 text-white w-full rounded tracking-wider cursor-pointer" />
                        </div>
                    </div>
                </form>
                <div class="text-center " >
                    Already have an account?
                    <a href="/job.vacancy/login.php" class="text-red-400 underline">login</a>
                </div>
            </section>
        </div>
    </div>

    <script>
        function openimg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile_pic').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>


