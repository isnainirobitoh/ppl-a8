<?php
session_start();
require 'functions.php';

if( isset($_POST["lupapassword"]) ) {
    $tanggallahir = $_POST["tanggallahir"];
    $email = $_POST["email"];

    $qry = $conn->query("SELECT * FROM cust WHERE tanggallahir ='$tanggallahir' AND email = '$email'");
    $cek = $qry->num_rows;
    
    if( $cek > 0) {
        $row = $qry->fetch_assoc();
        $_SESSION["lupapassword"] = true;
        $_SESSION["user_id"] = $row["id"];
        echo "
            <script type='text/javascript'>
                window.location='setpw.php';
            </script>";
        exit;
    } else {
        $error = true;
    }
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUPA PASSWORD</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            list-style: none;
        }
        body{
            background: linear-gradient(115deg, #3b805c 10%, #C5F6E4 90%); 
            height: 100vh;
            width: 100%;
        }
        .header-profil{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 5%;
            margin-bottom: 2%;
            font-size: 20px;
            text-transform: uppercase;
        }
        p {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2%;
            margin-bottom: 2%;
        }
        form{
            margin-bottom: 20px;
            margin-right: 20px;
            margin-left: 20px;
            padding-left: 3%;
            padding-right: 3%;
            padding-top: 3%;
            padding-bottom: 3%;
            border-radius: 5px;
            display: table;
            background-color: #fff;
            margin: 0 auto;
        }
        label{
            float: left;
            width: 30%;
            border: 0;
            font-weight: 900; 
            color: #14161a;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            margin-top: 15px;
            text-transform: uppercase;
        }
        .label label{
	        display: inline-block;
            vertical-align: -webkit-baseline-middle;
        }
        input{
	        float: left;
	        width: 70%;
	        border: 0;
            margin-top: 10px;
        }
        input[type=text], input[type=date], input[type=email],textarea{
            border: 2px solid #bfbbbb;
            padding: 9px;
            border-radius: 10px;
            background: #fff;
            width: 50%;
            font-family: Arial, Helvetica, sans-serif; 
            background-color: #d9f1c2;
            color: #131313;
        }
        input[type=text]:focus, input[type=email]:focus, textarea:focus{
            border:2px solid #87bed8;
        }
        button{
            width: 180px;
            color:#000;
            font-size: 12px;
            padding: 12px 0;
            background-color: #E1D5B8;
            border: 0;
            border-radius: 20px;
            outline: none;
            margin-top: 30px;
            cursor: pointer;
        }
        button:hover{
            color:#131313;
            background-color: #82BAE5;
        }
        .btn-profil{
            display: flex;
            align-items: center;
            justify-content: right;
            transition-duration: 0.4s;
            margin-top: 80px;
            margin-left: 10px;
            width: 20%;
        }
        .btn-profil button{
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-profil">
            <h2>Lupa Password</h2>
        </div>
        <div>
            <p>Masukkan Email dan Tanggal Lahir Anda untuk validasi data.</p>
        </div>
        <div>
        <form action="" method="post">
            <label for="tanggallahir">Tanggal Lahir:</label>
            <input type="date" name="tanggallahir" id="tanggallahir" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label>
            <?php if( isset($error) ) : ?>
            <p style="color: red; font-style:italic;">Email atau Tanggal lahir salah!</p>
            <?php endif; ?>
            </label>
            
            <div class=btn-profil>
                <button type="submit" name="lupapassword">KIRIM</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>