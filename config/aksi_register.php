<?php
include 'koneksi.php';

// Mengambil data dari formulir
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

// Validasi password
if (strlen($password) < 8) {
    echo "<script>
    alert('Password harus terdiri dari minimal 8 karakter.');
    history.back();
    </script>";
    exit(); // Hentikan eksekusi skrip
}

// Enkripsi password
$password = md5($password);

// Query untuk memasukkan data ke dalam tabel tanpa menyertakan userid
$sql = mysqli_query($koneksi, "INSERT INTO user (username, password, email, namalengkap, alamat) VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat')");

if ($sql) {
    echo "<script>
    alert('Pendaftaran akun berhasil!');
    location.href='../login.php';
    </script>";
} else {
    echo "<script>
    alert('Pendaftaran akun gagal. Silakan coba lagi.');
    history.back();
    </script>";
}
?>
