
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
    <form action="prosesM.php" method="post" enctype="multipart/form-data">
        <fieldset>

        <div class="form-grup">
            <div class="label">
                <label for="namapemilikusaha">NAMA PEMILIK USAHA</label>
            </div>
            <div class="input">
                <input type="text" name="namapemilikusaha" placeholder="Masukkan Pemilik Usaha" id="namapemilikusaha" required/>
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
                <label for="namausaha">NAMA USAHA</label>
            </div>
            <div class="input">
                <input type="text" name="namausaha" placeholder="Masukkan Nama Usaha" id="namausaha" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="deskripsiusaha">DESKRIPSI USAHA</label>
            </div>
            <div class="input">
                <input type="text" name="deskripsiusaha" placeholder="Masukkan Deskripsi Usaha" id="deskripsiusaha" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="alamatusaha">ALAMAT USAHA</label>
            </div>
            <div class="input">
                <input type="text" name="alamatusaha" placeholder="Masukkan Alamat Usaha" id="alamatusaha" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="kota">KOTA</label>
            </div>
            <div class="input">
                <input type="text" name="kota" placeholder="Masukkan Kota Usaha" id="kota" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="provinsi">PROVINSI</label>
            </div>
            <div class="input">
                <input type="text" name="provinsi" placeholder="Masukkan Provinsi Usaha" id="provinsi" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="nomortelepon">NOMOR TELEPON</label>
            </div>
            <div class="input">
                <input type="text" name="nomortelepon" placeholder="Masukkan Nomor Telepon" id="nomortelepon" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="namabank">NAMA BANK</label>
            </div>
            <div class="input">
                <input type="text" name="namabank" placeholder="Masukkan Nama Bank" id="namabank" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="nomorrekening">NOMOR REKENING</label>
            </div>
            <div class="input">
                <input type="text" name="nomorrekening" placeholder="Masukkan Nomor Rekening" id="nomorrekening" required/>
            </div>
        </div>
        <div class="form-grup">
            <div class="label">
                <label for="gambarusaha">GAMBAR BUKTI USAHA</label>
            </div>
            <div class="input">
                <input type="file" name="gambarusaha" placeholder="Masukkan Bukti Gambar Usaha" id="gambarusaha" required/>
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
            <button type="submit" name="registermitra">Daftar</button>
        </div>
        </fieldset>

    </form>
</body>
</html>