<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    </script>";
    exit;
}

// Ambil albumid dari parameter URL
$albumid = isset($_GET['albumid']) ? $_GET['albumid'] : '';

// Query untuk mengambil album dan foto
$album_query = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <style>
        body {
            margin-bottom: 70px;
            /* Tambahkan margin bawah untuk ruang footer */
            background-color: #6EACDA;
            justify-content: center;
        }

        footer {
            background-color: #f8f9fa;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        .modal-dialog-scrollable .modal-content {
            max-height: calc(100vh - 100px);
        }

        .card-img-top {
            width: 100%;
            height: 300px;
            object-fit: cover;
            /* Memastikan gambar menutupi area yang ditentukan */
        }
    </style>
</head>

<body>
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

    <div class="container mt-3">
        <div class="mb-3">
            Album kamu :
            <?php while ($row = mysqli_fetch_array($album_query)) { ?>
                <a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-primary"> <?php echo $row['namaalbum'] ?> </a>
            <?php } ?>
        </div>

        <div class="row">
        <?php
// Ambil albumid dari parameter URL
$albumid = isset($_GET['albumid']) ? $_GET['albumid'] : '';

// Query untuk mengambil foto berdasarkan albumid jika ada
if ($albumid) {
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
}

while ($data = mysqli_fetch_array($query)) {
?>
    <div class="col-md-3">
        <div class="card">
        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="width: 100%; height: 300px; object-fit: cover;">

            <div class="card-footer text-center">
                <?php
                $fotoid = $data['fotoid'];
                $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                if (mysqli_num_rows($ceksuka) == 1) { ?>
                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>&albumid=<?php echo $albumid ?>"><i class="fa fa-heart text-danger"></i></a>
                <?php } else { ?>
                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>&albumid=<?php echo $albumid ?>"><i class="fa-regular fa-heart"></i></a>
                <?php }

                $like_query = "SELECT * FROM likefoto WHERE fotoid='$fotoid'";
                $like = mysqli_query($koneksi, $like_query);
                if (!$like) {
                    die("Query Error: " . mysqli_error($koneksi));
                }
                echo mysqli_num_rows($like) . ' Suka';

                // Menampilkan jumlah komentar
                $comment_query = "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'";
                $comments = mysqli_query($koneksi, $comment_query);
                if (!$comments) {
                    die("Query Error: " . mysqli_error($koneksi));
                }
                echo '<a href="#" data-bs-toggle="modal" data-bs-target="#comments' . $fotoid . '"><i class="fa-regular fa-comment"></i> ' . mysqli_num_rows($comments) . ' komentar</a>';
                ?>
            </div>
        </div>

        <!-- Modal untuk menampilkan dan menambah komentar -->
        <div class="modal fade" id="comments<?php echo $fotoid ?>" tabindex="-1" aria-labelledby="commentsLabel<?php echo $fotoid ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentsLabel<?php echo $fotoid ?>">Komentar untuk Foto <?php echo $data['judulfoto'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Menampilkan gambar -->
                        <div class="text-center mb-3">
                            <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="img-fluid" alt="<?php echo $data['lokasifile'] ?>">
                        </div>

                        <!-- Menampilkan komentar -->
                        <?php
                        $comments_query = mysqli_query($koneksi, "SELECT komentarfoto.*, user.username FROM komentarfoto JOIN user ON komentarfoto.userid = user.userid WHERE fotoid='$fotoid'");
                        while ($comment = mysqli_fetch_array($comments_query)) {
                            echo '<div class="mb-2">';
                            echo '<strong>' . htmlspecialchars($comment['username']) . '</strong>: ' . htmlspecialchars($comment['isikomentar']);
                            echo '<br><small>' . htmlspecialchars($comment['tanggalkomentar']) . '</small>';
                            echo '</div>';
                        }
                        ?>

                        <!-- Formulir untuk menambahkan komentar -->
                        <form action="../config/proses_komentar.php" method="POST">
                            <input type="hidden" name="fotoid" value="<?php echo $fotoid ?>">
                            <div class="mb-3">
                                <textarea class="form-control" name="isikomentar" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL 2024 | HANIFAH</p>
    </footer>
</body>

</html>