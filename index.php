<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>HELLO</title>
    <link rel="stylesheet" type="text/css" href="assets/stylestart.css">
    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="#" class="logo"><i class="ri-home-heart-fill"></i><span>COD.tly</span></a>
        </div>
        <div class="row">
            <div class="col left">
                <h1>WELCOME TO COD.tly</h1>
                <h2>Do You Wanna Join Us?</h2>
            </div>
            <div class="col right">
                <p>Choose Your Role</p>
                <div class="card card1">
                    <button type="button" name="loginCverif"><a href="loginCverif.php">CUSTOMER</a></button>
                </div>
                <div class="card card2">
                    <button type="button" name="loginMverif"><a href="loginMverif.php">MITRA</a></button>
                </div>  
            </div>
        </div>

    </div>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>