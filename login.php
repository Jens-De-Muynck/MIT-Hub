<?php include 'server.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Log in</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="style/web.css" type="text/css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <main class="container login">
        <h1>Please login to continue</h1>

        <form action="login.php" method="POST" autocomplete="false">
  	        <?php include('errors.php'); ?>

            <div class="form-group uname">
                <label for="uname">Username</label>
                <input type="text" placeholder="Enter Username" name="uname">
            </div>

            <div class="form-group psw">
                <label for="psw">Password</label>
                <input type="password" placeholder="Enter Password" name="psw">
            </div>
            
            <input type="submit" value="LOG IN" name="login_user">

            <a href="register.php">Create a new account</a>
            <!-- <a href="#">Forgot password?</a> -->
        </form>
    </main>
</body>
</html>