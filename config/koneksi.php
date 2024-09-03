<?php
$hostname = 'localhost';
$userdb = 'root';
$passdb = '';
$namedb = 'ukk_galerifoto';
$port = 3310; // Port yang digunakan oleh MySQL

// Menghubungkan ke MySQL dengan port yang ditentukan
$koneksi = mysqli_connect($hostname, $userdb, $passdb, $namedb, $port);



?>
