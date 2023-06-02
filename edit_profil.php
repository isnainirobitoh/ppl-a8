<?php
session_start();
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
    exit;
}

$id = $_SESSION['user']['id'];

$query = mysqli_query($conn, "SELECT * FROM cust WHERE id = $id");
$user = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $namalengkap = $_POST['namalengkap'];
    $email = $_POST['email'];
    $tanggallahir = $_POST['tanggallahir'];
    $password = $_POST['password'];
  
    $query = "UPDATE cust SET namalengkap = '$namalengkap', email = '$email', tanggallahir = '$tanggallahir' WHERE id = $id";
    $result = mysqli_query($conn, $query);
  
    if ($result) {
      $_SESSION['user'] = [
        'id' => $id,
        'namalengkap' => $namalengkap,
        'email' => $email,
        'tanggallahir' => $tanggallahir
      ];
      echo "<script type='text/javascript'>
      alert('Berhasil Diubah');
      window.location='edit_profil.php';
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
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>Edit Akun</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
        h1{
            color: rgb(22, 29, 50);
            font-family: 'Poppins';
            font-weight: bold;
            text-align: center;
            text-shadow: 2px 2px 5px rgb(246, 250, 251);
        }
        body{
            background: linear-gradient(115deg, #3b805c 10%, #5472ad 90%); 
            width: 100%;
            height: 100vh;
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
        input[type=text], input[type=date], input[type=email], input[type=password], textarea{
            border: 2px solid #bfbbbb;
            padding: 9px;
            border-radius: 10px;
            background: #fff;
            width: 50%;
            font-family: Arial, Helvetica, sans-serif; 
            background-color: #d9f1c2;
            color: #131313;
        }
        input[type=text]:focus, input[type=email]:focus, input[type=password], textarea:focus{
            border:2px solid #87bed8;
        }
        button{
            background-color: #ecd27b; color: black;
            border: none;
            font-size: 12px;
            padding: 10px 20px 10px 20px; 
            border-radius: 8px; 
            transition-duration: 0.4s;
            cursor: pointer;
            float: right;
            font-family: 'Poppins';
            margin-top: 20px;
            width: 20%;
            margin-left: 10px;
            text-decoration: none;
        }
        button:hover {
            background-color: #527454; 
            color: white; 
        }
    </style>

</head>
<body>
<h1>EDIT AKUN</h1>

  <?php if (isset($error)): ?>
    <p>Gagal mengubah profil.</p>
  <?php endif; ?>

  <form action="" method="post">
    <label for="namalengkap">Nama:</label>
    <input type="text" name="namalengkap" id="namalengkap" value="<?php echo $user['namalengkap'] ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $user['email'] ?>" required>

    <label for="tanggallahir">Tanggal Lahir:</label>
    <input type="date" name="tanggallahir" id="tanggallahir" value="<?php echo $user['tanggallahir'] ?>" required>

    <br>
    <button><a href = "dashboardC.php">Kembali</a></button>
    <br>
    <button type="submit" name="submit">SIMPAN DATA</button>
  </form>
</body>
</html>