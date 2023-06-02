
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

</head>
<body style="background-color:#C5F6E4;">
<div class="container">
    <div id="header">
        <h1>COD.tly Register</h1>
</div>
    <form action="proses.php" method="post">
        <fieldset>

        <div class="form-grup">
            <div class="label">
                <label for="namalengkap">NAMA LENGKAP</label>
            </div>
            <div class="input">
                <input type="text" name="namalengkap" placeholder="Masukkan Nama Lengkap Anda" id="namalengkap" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="tanggallahir">TANGGAL LAHIR</label>
            </div>
            <div class="input">
                <input type="date" name="tanggallahir" id="tanggallahir" required/>
            </div>
        </div>
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
        <div class="form-grup">
            <div class="label">
                <label for="password2">KONFIRMASI PASSWORD</label>
            </div>
            <div class="input">
                <input type="password" name="password2" placeholder="Masukkan Password Anda Sekali Lagi" id="password2" required/>
            </div>
        </div>
        <div class="form-grup">
            <button type="submit" name="register">Daftar</button>
        </div>
        </fieldset>

    </form>

</body>
</html>