<?php
session_start();
$loggedIn = isset($_SESSION['userid']);
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            background-color: #6EACDA;
            justify-content: center;
        }

        .navbar {
            margin-bottom: 20px;
        }
        

        .container {
            max-width: 1200px;
            text-align: center;
        }

        .welcome-message {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 50px;
            font-weight: bold;
        }

        .home-content {
            padding: 20px;
        }

        .description {
            text-align: center;
            margin-bottom: 40px;
        }

       /* Banner Container home*/
       .banner-container {
    height: 500px; /* Set the desired height */
    position: relative;
    width: 500px;
    border: 1px solid;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.banner-item {
    position: absolute;
    width: 100%;
    height: 100%;
    background-size: cover; /* Adjusted to prevent cropping */
    background-position: center;
    background-repeat: no-repeat; /* Prevents image repetition */
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.banner-item.active {
    opacity: 1;
}
        .navigation-buttons {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .prev, .next {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        /* Media Queries */
@media screen and (max-width: 600px) {
    /* Untuk layar kecil */
    .nav-container {
        flex-direction: column;
    }
}
    </style>
</head>

<body>
    <!-- Welcome Message -->
    <div class="welcome-message" id="welcomeMessage">Halo user, Welcome to Website Galeri!</div>
    <!-- Home Content -->
    <section class="home-content" id="home">
        <div class="description">
            <p>Ini adalah Website Galeri yang bisa Anda gunakan untuk menyimpan semua kenangan.</p>
            <p>Simpan semua foto anda dengan masuk ke dalam website!</p>
        </div>
        <div class="navbar-nav ml-auto">
                    <?php if (!$loggedIn) : ?>
                        <a href="register.php" class="btn btn-outline-primary m-1"><b>Daftar</b></a>
                        <a href="login.php" class="btn btn-outline-success m-1"><b>Masuk</b></a>
                    <?php else : ?>
                        <a href="config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
                    <?php endif; ?>
                </div>
        <div class="banner-container">
            <div class="banner-item active" style="background-image: url('assets/gambar/pacar.jpg')"></div>
            <div class="banner-item" style="background-image: url('assets/gambar/p2.jpg')"></div>
            <div class="banner-item" style="background-image: url('assets/gambar/a1.jpg')"></div>
            <div class="banner-item" style="background-image: url('assets/gambar/k.jpg')"></div>
            <div class="navigation-buttons">
                <button class="prev" onclick="prevSlide()">Prev</button>
                <button class="next" onclick="nextSlide()">Next</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; UKK RPL 2024 | HANIFAH</p>
    </footer>

    <!-- Scripts -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function updateWelcomeMessage() {
            let userName = prompt("Please enter your name:");
            if (userName) {
                document.getElementById("welcomeMessage").innerText = `Halo ${userName}, Welcome to Website Galeri!`;
            } else {
                document.getElementById("welcomeMessage").innerText = `Halo User, Welcome to Website Galeri!`;
            }
        }

        window.onload = updateWelcomeMessage;

        let slideIndex = 0;
        const slides = document.getElementsByClassName("banner-item");

        function showSlide(index) {
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }
            slides[index].classList.add("active");
        }

        function nextSlide() {
            slideIndex = (slideIndex + 1) % slides.length;
            showSlide(slideIndex);
        }

        function prevSlide() {
            slideIndex = (slideIndex - 1 + slides.length) % slides.length;
            showSlide(slideIndex);
        }
    </script>
</body>

</html>
