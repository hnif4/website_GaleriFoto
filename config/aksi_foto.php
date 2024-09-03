<?php 
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsi = $_POST['deskripsi'];
    $tanggalunggah = date('Y-m-d');
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/img/';
    $namafoto = rand().'-'.$foto;

    move_uploaded_file($tmp, $lokasi.$namafoto);

    // Corrected column name from 'namafoto' to 'lokasifile'
    $sql = mysqli_query($koneksi, "INSERT INTO foto (judulfoto, deskripsifoto, tanggalunggah, lokasifile, albumid, userid) VALUES ('$judulfoto', '$deskripsi', '$tanggalunggah','$namafoto', '$albumid','$userid')");

    if ($sql) {
        echo "<script>
        alert('Data berhasil disimpan!');
        location.href='../admin/foto.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal disimpan!');
        location.href='../admin/foto.php';
        </script>";
    }
}

if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsi = $_POST['deskripsifoto'];
    $albumid = $_POST['albumid'];

    if (isset($_FILES['lokasifile']['name']) && $_FILES['lokasifile']['name'] != '') {
        $foto = $_FILES['lokasifile']['name'];
        $tmp = $_FILES['lokasifile']['tmp_name'];
        $lokasi = '../assets/img/';
        $namafoto = rand().'-'.$foto;

        move_uploaded_file($tmp, $lokasi.$namafoto);

        // Update with new file, corrected column name to 'lokasifile'
        $sql = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsi', lokasifile='$namafoto', albumid='$albumid' WHERE fotoid='$fotoid'");
    } else {
        // Update without new file
        $sql = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsi', albumid='$albumid' WHERE fotoid='$fotoid'");
    }

    if ($sql) {
        echo "<script>
        alert('Data berhasil diperbarui!');
        location.href='../admin/foto.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diperbarui!');
        location.href='../admin/foto.php';
        </script>";
    }
}

if (isset($_POST['hapus'])) {
    $fotoid = $_POST['fotoid'];

    $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE fotoid='$fotoid'");

    if ($sql) {
        echo "<script>
        alert('Data berhasil dihapus!');
        location.href='../admin/foto.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus!');
        location.href='../admin/foto.php';
        </script>";
    }
}
?>
