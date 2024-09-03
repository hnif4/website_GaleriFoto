<?php
session_start();
include '../config/koneksi.php'; // Ensure the path is correct for your setup

if (!isset($_SESSION['userid'])) {
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    </script>";
    exit;
}

if (isset($_POST['fotoid']) && isset($_POST['isikomentar'])) {
    $fotoid = $_POST['fotoid'];
    $isikomentar = $_POST['isikomentar'];
    $userid = $_SESSION['userid'];
    $tanggalkomentar = date('Y-m-d H:i:s');

    // Explicitly specify the columns being inserted into
    $query = "INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) VALUES ('$fotoid', '$userid', '$isikomentar', '$tanggalkomentar')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
        alert('Komentar berhasil disimpan!');
        location.href='../admin/home.php'; // Redirect to home.php
        </script>";
    } else {
        echo "<script>
        alert('Gagal menyimpan komentar!');
        location.href='../admin/home.php'; // Redirect to home.php
        </script>";
    }
} 
?>