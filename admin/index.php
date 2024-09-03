<?php
session_start();
$userid = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="vendors/prism/prism.css" rel="stylesheet">
    <link href="vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/user.css" rel="stylesheet">
    <link href="vendors/glightbox/glightbox.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background-color: #6EACDA;
            justify-content: center;
        }

        .home-content {
            padding: 20px;
        }

        .home-content header,
        .home-content article {
            margin-bottom: 20px;
        }

        footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
            <a href="home.php" class="nav-link ms-3">Home</a>
            <a href="album.php" class="nav-link ms-3">Album</a>
            <a href="foto.php" class="nav-link ms-3">Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNav">
                <div class="navbar-nav me-auto"></div>
                <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="py-4 pt-md-0 pb-8 pb-sm-11 mt-lg-n8 position-relative">
    <div class="container px-md-5 d-flex flex-column align-items-center">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7">
            <p class="fs-2 lh-1 text-400 text-center">Selamat Datang! Simpan semua kenangan di satu tempat~</p>
        </div>
    </div>
    <div class="col-md-11 text-center mt-6">
        <p class="text-300 mb-0">
            Kenangan adalah tindakan mengingat kembali pengalaman atau peristiwa masa lalu.<br>
            Itu memperkuat rasa identitas dan tujuan hidup kita serta mempererat hubungan kita.<br>
            Kenangan indah merupakan unsur penting dalam kebahagiaan saat ini.<br>
            Saat kita masih muda, semuanya terasa baru. Kita melakukan begitu banyak<br>
            hal untuk pertama kalinya sehingga kita membentuk kenangan yang sangat kuat.
        </p>
    </div>
</div>


    <div class="row g-3 mt-6" data-isotope='{"layoutMode":"packery"}'>
        <div class="col-lg-3 col-sm-6 col-12 gallery-item isotope-item">
            <img class="img-fluid w-100" src="../assets/gambar/k.jpg" alt="Kenangan 1" data-glightbox="title: Kenangan 1; description: Deskripsi 1" />
        </div>
        <div class="col-lg-3 col-sm-6 col-12 gallery-item isotope-item">
            <img class="img-fluid w-100" src="../assets/gambar/a3.jpg" alt="Kenangan 2" data-glightbox="title: Kenangan 2; description: Deskripsi 2" />
        </div>
        <div class="col-lg-3 col-sm-6 col-12 gallery-item isotope-item">
            <img class="img-fluid w-100" src="../assets/gambar/p2.jpg" alt="Kenangan 3" data-glightbox="title: Kenangan 3; description: Deskripsi 3" />
        </div>
        <div class="col-lg-3 col-sm-6 col-12 gallery-item isotope-item">
            <img class="img-fluid w-100" src="../assets/gambar/a1.jpg" alt="Kenangan 4" data-glightbox="title: Kenangan 4; description: Deskripsi 4" />
        </div>
        <div class="col-lg-3 col-sm-6 col-12 gallery-item isotope-item">
            <img class="img-fluid w-100" src="../assets/gambar/pacar.jpg" alt="Kenangan 5" data-glightbox="title: Kenangan 5; description: Deskripsi 5" />
        </div>
        <div class="col-lg-3 col-sm-6 col-12 gallery-item isotope-item">
            <img class="img-fluid w-100" src="../assets/gambar/cc.jpg" alt="Kenangan 6" data-glightbox="title: Kenangan 6; description: Deskripsi 6" />
        </div>
        <div class="col-lg-6 col-12 gallery-item isotope-item">
            <img class="img-fluid w-100" src="../assets/gambar/a.jpg" alt="Kenangan 7" data-glightbox="title: Kenangan 7; description: Deskripsi 7" />
        </div>
    </div>
</section>

    <!-- Footer -->
    <footer>
        <p>&copy; UKK RPL 2024 | HANIFAH</p>
    </footer>

    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>