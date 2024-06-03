<!-- INI DIPAKE -->
<?php
session_start();
if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
    echo "<script>alert('Silahkan Login!');window.location='login.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CARe WASH</title>
        <link rel="stylesheet" href="assets/css/index.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <?php
            include "koneksi.php"; //koneksi ke database
            $id_user = $_SESSION['id_user']; //ambil ID pengguna dari sesi

            // Query untuk mengambil data pengguna berdasarkan ID pengguna
            $query = $koneksi->query("SELECT * FROM tb_users WHERE id_user='$id_user'");
            $data_user = $query->fetch_assoc(); //ambil data pengguna dari hasil query

            // Mengakses data nama pengguna
            $nama_pengguna = $data_user['nama'];
        ?>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="layanan.php">Services</a>
                <div class="dropdown-content">
                    <a href="pesanan_1.php">Paket Hemat Cuci Kilat</a>
                    <a href="pesanan_2.php">Paket Nyaman Grooming Lengkap</a>
                    <a href="pesanan_3.php">Paket Premium Full Servis</a>
                </div>
            </li>
            <li><a href="pesanan.php">Book Now</a></li>
            <li><a href="rating.php">Rating</a></li>
            <li><a href="cobalagipesan.php">Track Order</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
        <section class="section-one">
            <article>
                <div>
                    <h1>Perfect Details, Ultimate Satisfaction.</h1>
                    <p>We ensure every corner of your vehicle is perfectly clean.</p>
                </div>
                <div class="learn-more">
                    <a href="layanan.php">Learn More</a>
                </div>
            </article>
            <aside>
                <img src="assets/image/index.png">
            </aside>    
        </section>

        <!-- <h1>HAI <?= $nama_pengguna; ?> Selamat Datang </h1> -->

        <section class="section-two">
            <header>
                <h1>What They're Saying About Us?</h1>
            </header>
            <detail>
                <form method="post" action="">
                    <ul class="review" style="list-style: none; padding: 0;">
                        <?php
                            include "koneksi.php";
                            $takedata = mysqli_query($koneksi, "SELECT * FROM tb_rating");
                            while ($tampil = mysqli_fetch_array($takedata)) {
                                echo "<li class='review-item'>";
                                    echo "<strong>{$tampil['nama']}</strong>";
                                    $rating = intval($tampil['rating']); // Konversi rating ke tipe integer
                                    for ($i = 0; $i < $rating; $i++) {
                                        echo "⭐"; // Menampilkan bintang sesuai rating
                                    }
                                    echo "<p>{$tampil['ulasan']}</p>";
                                echo "</li>";
                            }
                        ?>
                    </ul>
                </form>
            </detail>
        </section>      
    </body>
</html>
