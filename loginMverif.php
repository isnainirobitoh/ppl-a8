<?php
session_start();

require 'functions.php';

if( isset($_POST["login"]) ) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $qry = $conn->query("SELECT * FROM mitraa WHERE email = '$email' AND password = '$password'");
    $cek = $qry->num_rows;
    // cek email
    if( $cek > 0) {
        $verif = $qry->fetch_assoc();
        if ( $verif['is_verif'] == 1 ) {
            $_SESSION["login"] = true;
            echo "
                <script type='text/javascript'>
                    window.location='dashboardM.php';
                </script>";
            $_SESSION['user'] = $verif;
            // $_SESSION['id_mitra'] = $id_mitra;
            exit;
            } else {
                echo "
                <script type='text/javascript'>
                    alert('Harap Verifikasi Akun Anda!');
                    window.history.back();
                </script>";
            }
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
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

</head>
<body style="background-color:#C5F6E4;">
<div class="container">
    <div id="header">
        <h1>COD.tly Login</h1>
</div>
    <form action="" method="post">
        <fieldset>
        <div class="form-grup">
            <div class="label">
                <label for="email">EMAIL</label>
            </div>
            <div class="input">
                <input type="email" name="email" placeholder="Masukkan Email Anda" id="email" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="password">PASSWORD</label>
            </div>
            <div class="input">
                <input type="password" name="password" placeholder="Masukkan Password Anda" id="password" required/>
            </div>
        </div>
        <?php if( isset($error) ) : ?>
        <p style="color: red; font-style:italic;">Email atau Password yang anda masukkan salah!</p>
        <?php endif; ?>
        <div class="form-grup">
            <button type="submit" name="login">Masuk</button>
        </div>
        <a href="registrasimitrav.php" class="clickme">Registrasi</a>
        <a href="lupapasswordM.php" class="clickme">Lupa Password?</a>
        <br>
        <br>
        </fieldset>

    </form>

</body>
</html>