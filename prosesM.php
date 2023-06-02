<?php
$conn = mysqli_connect("localhost","root","","phpdasar"); 

$namapemilikusaha = $_POST["namapemilikusaha"];
$tanggallahir =  $_POST["tanggallahir"];
$namausaha = $_POST["namausaha"];
$deskripsiusaha = $_POST["deskripsiusaha"];
$alamatusaha = $_POST["alamatusaha"];
$kota = $_POST["kota"];
$provinsi = $_POST["provinsi"];
$nomortelepon = $_POST["nomortelepon"];
$namabank = $_POST["namabank"];
$nomorrekening = $_POST["nomorrekening"];
$gambarusaha = $_FILES["gambarusaha"];
$email=  $_POST["email"];
$password =  $_POST["password"];
$password2 =  $_POST["password2"];
$code = md5($email.date('Y-m-d H:i:s'));

$file_tmp = $gambarusaha['tmp_name'];
$file_name = $gambarusaha['name'];
$file_dest = 'file/'.$file_name;
move_uploaded_file($file_tmp, $file_dest);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                         //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                //Enable SMTP authentication
    $mail->Username   = 'codtlyppl@gmail.com';          //SMTP username
    $mail->Password   = 'vzocsxjgcwrotgjt';                  //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable implicit TLS encryption
    $mail->Port       = 465;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@codtly.com', 'COD.tly');
    $mail->addAddress($email, $namapemilikusaha);     //Add a recipient

    //Content
    $mail->isHTML(true);                              //Set email format to HTML
    $mail->Subject = 'Verifikasi Akun';
    $mail->Body    = 'Hallo, ' .$namapemilikusaha.' Terima kasih sudah mendaftar di website ini, <br>Mohon verifikasi akun anda dengan klik link di bawah .<br>
    <a href="http://localhost/ppl/sprint1/verifM.php?code='.$code.'">VERIFIKASI</a>';
    
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if($mail->send()){
       // cek email sudah ada atau belum
       $result = mysqli_query($conn, "SELECT email FROM cust WHERE email = '$email' ");
       if( mysqli_fetch_assoc($result) > 0 ) {
           echo "
           <script type='text/javascript'>
               alert('Data sudah pernah digunakan!');
               window.history.back();
           </script>
           ";
           return false;
       } else if ( $password !== $password2 ) { //cek konfirmasi password
           echo "
           <script type='text/javascript'>
               alert('Password dan Konfirmasi Password Harus Sama');
               window.history.back();
           </script>
           ";
           return false;
       } else {
           echo "
           <script type='text/javascript'>
               alert('Berhasil mendaftar! Silahkan cek email Anda untuk Verifikasi Akun.');
               window.location='index.php';
           </script>
           ";
       }
       
        // tambahkan user ke database
        $query = "INSERT INTO mitraa(namapemilikusaha, tanggallahir, namausaha, deskripsiusaha, alamatusaha, kota, provinsi, 
                    nomortelepon, namabank, nomorrekening, gambarusaha, email, password, verifikasi_code)VALUES('$namapemilikusaha', '$tanggallahir', 
                    '$namausaha', '$deskripsiusaha', '$alamatusaha', '$kota', '$provinsi','$nomortelepon', '$namabank', '$nomorrekening', '$file_dest', 
                    '$email', '$password', '$code')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>