<?php
session_start();
require 'functions.php';

if( !isset($_SESSION["lupapasswordM"]) || !isset($_SESSION["user_id"]) ) {
    header("Location: lupapasswordM.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM mitraa WHERE id = $user_id");
$user = mysqli_fetch_assoc($query);

if (isset($_POST['setpwm'])) {
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if( $password !== $password2 ) {
        echo "
        <script>
            alert('Password dan Konfirmasi Password Harus Sama');
            window.history.back();
        </script>
        ";
        return false;
    }
  
    $query = "UPDATE mitraa SET password = '$password' WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
  
    if ($result) {
      $_SESSION['user'] = [
        'id' => $user_id,
        'password' => $password
      ];
      echo "<script type='text/javascript'>
      window.location='loginMverif.php';
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
    <title>Ubah Password</title>

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
        input[type=password], textarea{
            border: 2px solid #bfbbbb;
            padding: 9px;
            border-radius: 10px;
            background: #fff;
            width: 50%;
            font-family: Arial, Helvetica, sans-serif; 
            background-color: #d9f1c2;
            color: #131313;
        }
        input[type=password]:focus, textarea:focus{
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
            <h2>Mengubah Data Password</h2>
        </div>
        <?php if (isset($error)): ?>
        <p>Gagal mengubah password.</p>
        <?php endif; ?>
        <div>
        <form action="" method="post">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="password2">Konfirmasi Password:</label>
            <input type="password" name="password2" id="password2" required>
            
            <div class=btn-profil>
                <button type="submit" name="setpwm">KIRIM</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>