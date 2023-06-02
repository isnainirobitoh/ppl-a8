<?php
$conn = mysqli_connect("localhost","root","","phpdasar"); 

$namalengkap = $_POST["namalengkap"];
$tanggallahir =  $_POST["tanggallahir"];
$email=  $_POST["email"];
$password =  $_POST["password"];
$password2 =  $_POST["password2"];
$code = md5($email.date('Y-m-d H:i:s'));

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'codtlyppl@gmail.com';                     //SMTP username
    $mail->Password   = 'vzocsxjgcwrotgjt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@codtly.com', 'COD.tly');
    $mail->addAddress($email, $namalengkap);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi Akun';
    $mail->Body    = 'Hallo, ' .$namalengkap.' Terima kasih sudah mendaftar di website ini, <br>Mohon verifikasi akun anda dengan klik link di bawah.<br>
    <a href="http://localhost/ppl/sprint1/verif.php?code='.$code.'">Verifikasi</a>';
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
        $query = "INSERT INTO cust(namalengkap, tanggallahir, email, password, verifikasi_code)VALUES('$namalengkap', '$tanggallahir', '$email', '$password', '$code')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>