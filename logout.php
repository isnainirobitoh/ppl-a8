<?php

session_start();

echo '<script>';
echo 'if(confirm("Apakah anda yakin ingin logout?")){';
echo 'window.location.href="index.php";';
echo '} else {';
echo 'window.history.back();';
echo '}';
echo '</script>';

// // Destroy semua data session
// session_destroy();
?>
