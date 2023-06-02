<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginMverif.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="styledashboard.css">
    
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
            <nav>
                <ul>
                    <li><a href="dashboardM.php">BERANDA</a></li>
                    <li><a href="artikelM.php">ARTIKEL</a></li>
                    <li><a href="marketplaceM.php">MARKETPLACE</a></li>
                    <li><a href="profilM.php" class="user"><i class="ri-user-3-fill"></i></a></li>
                    <li><a href="logout.php">LOGOUT<i class="ri-logout-box-r-fill"></i></a></li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col">
                <h1>WELCOME COD.tly</h1>
                <p>Taukah kamu? Bahwa mengkonsumsi makanan sehat sangat berpengaruh bagi kesehatan tubuh. 
                </p>

            </div>
            <div class="col">
                <div class="card card1">
                    <h5>Makanan Bergizi</h5>
                    <p>
                        Penting untuk menjaga kesehatan dan menjauhkan penyakit dari tubuh.
                    </p>
                </div>
                <div class="card card2">
                    <h5>Olahraga Teratur</h5>
                    <p>
                        Olahraga rutin setiap hari dapat memperkuat otot jantung.
                    </p>
                </div>
                <div class="card card3">
                    <h5>Makanan Seimbang</h5>
                    <p>
                        Menu dengan beranekaragam makanan dalam proporsi yang sesuai.
                    </p>
                </div>
                <div class="card card4">
                    <h5>DIET</h5>
                    <p>
                        Pada dasarnya adalah pola makan, yang cara dan jenis makanannya diatur.
                    </p>
                </div>
            </div>
        </div>

    </div>
    
</body>
</html>