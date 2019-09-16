<?php include 'server.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Create new account</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="style/web.css" type="text/css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <main class="container register">
        <h1>Create a new account</h1>

        <form action="register.php" method="POST" autocomplete="false">
  	        <?php include('errors.php'); ?>

            <div class="form-group uname">
                <label for="uname">Username</label>
                <input type="text" placeholder="uname" name="uname">
            </div>

            <div class="form-group email">
                <label for="email">Email</label>
                <input type="email" placeholder="email" name="email">
            </div>

            <div class="form-group psw">
                <label for="psw">Password</label>
                <input type="password" placeholder="Enter Password" name="psw">
            </div>

            <div class="form-group cpsw">
                <label for="cpsw">Confirm password</label>
                <input type="password" placeholder="Confirm Password" name="cpsw">
            </div>
            
            <input type="submit" value="SIGN UP" name="reg_user">

            <a href="login.php">Back to login</a>
        </form>
    </main>
</body>
</html>