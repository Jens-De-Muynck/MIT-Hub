<?php
    session_start(); 

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Overzicht</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="style/web.css" type="text/css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="https://via.placeholder.com/30" alt="placeholder">
            </div>
            
            <div class="search">
                <div class="searchContainer">
                    <i class="fa fa-search"></i><!--
                    --><input class="searchBox" autocomplete="off" type="search" name="search" placeholder="Search documents, links, ..." autocomplete="off">
                    <!-- <i class="fas fa-times-circle"></i> -->
                    <!-- <input type="submit" value="Search" class="searchButton"> -->
                </div>
            </div>
            
            <div class="user">
                <div class="userContainer">

                    
            <!-- logged in user information -->
            <?php  if (isset($_SESSION['username'])) : ?>
                <p>Logged in as <br><span id='uname'> <?php echo $_SESSION['username']; ?> </span></p>
            <?php endif ?>
                </div>
                <div class="userContainer">
                    <i class="fas fa-bell"></i>
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </nav>
    </header>

    <main class="row">
        <div class="col categories">
            <ul>
                <p>SCHOOL</p>
                <li><a href="#"><i class="far fa-file"></i></a></li>
                <li><a href="#"><i class="far fa-images"></i></a></li>
            </ul>
            <ul>
                <p>FREE TIME</p>
                <li><a href="#"><i class="fas fa-gamepad"></i></a></li>
                <li><a href="#"><i class="far fa-laugh-squint"></i></a></li>
            </ul>
        </div>


        <div class="col content">
        
            <!-- notification message -->
            <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success" >
                <h3>
                <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
                </h3>
            </div>
            <?php endif ?>

            <!-- logged in user information -->
            <?php  if (isset($_SESSION['username'])) : ?>
                <p>Welcome <strong></strong></p>
                <p>  </p>
            <?php endif ?>

        </div>


        <div class="col chat" id="chat">
            <div class="messages" id="chat-wrap"> 
                <div id='chat-area'>
                    <?php include 'chat/chat_process.php'; ?>
                </div>
            </div>
            <input maxlength='100' autocomplete="off" type="search" name="type_message" id="type_message" placeholder="Type a message...">
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/jquery.scrollto@2.1.2/jquery.scrollTo.min.js"></script>
    <script src="chat/chat_updater.js"></script>
</body>
</html>