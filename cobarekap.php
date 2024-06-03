<!-- INI DIPAKE -->
<table border="1">
    <?php
    session_start();
    include "koneksi.php";
    $id_user = $_SESSION['id_user'];
    
    // Mengambil id_pesanan dari parameter URL
    $id_pesanan = $_GET['id_pesanan'];


// Ubah query untuk melakukan JOIN dengan menggunakan id_pesanan sebagai kunci relasi
$ambildata = mysqli_query($koneksi, "SELECT * FROM tb_pesanan LEFT JOIN tbl_bayar ON tb_pesanan.id_pesanan = tbl_bayar.id_pesanan WHERE tb_pesanan.id_user='$id_user' AND tb_pesanan.id_pesanan='$id_pesanan'");
$tampil = mysqli_fetch_array($ambildata); // Ambil satu baris data saja
?>
<link rel="stylesheet" href="assets/css/cobarekap.css"> 
<body>
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
    <main>
        <h2>Check Your Order</h2>
        <ul class="order-details">
            <?php
            if ($tampil) {
                echo "
                <li><strong>Nama:</strong> <span>{$tampil['nama']}</span></li>
                <li><strong>Nomor HP:</strong> <span>{$tampil['no']}</span></li>
                <li><strong>Kendaraan:</strong> <span>{$tampil['kendaraan']}</span></li>
                <li><strong>Jumlah Kendaraan:</strong> <span>{$tampil['jumlah']}</span></li>
                <li><strong>Jenis Layanan:</strong> <span>{$tampil['layanan']}</span></li>
                <li><strong>Price:</strong> <span>";
                $layanan = $tampil['layanan']; // Simpan layanan ke dalam variabel $layanan
                if ($layanan == 'Layanan A') {
                    echo '15.000IDR';
                } elseif ($layanan == 'Layanan B') {
                    echo '30.000IDR';
                } else {
                    echo '45.000IDR';
                }
                echo "</span></li>
                <li><strong>Day/Time:</strong> <span>{$tampil['waktu']}<br>{$tampil['jam']}</span></li>
                <li><strong>Bayar:</strong> <span>";
                if (!empty($tampil['profile'])) {
                    echo "<img src='assets/image/paid.png' alt='Paid' width='100' class='status-icon'> {$tampil['profile']}";
                } else {
                    echo "Belum dibayar";
                }
                echo "</span></li>
                <li><strong>Verifikasi:</strong> <span>";
                if (empty($tampil['verifikasi'])) {
                    echo "<img src='assets/image/proses.png' width='100' alt='Proses' class='status-icon'>";
                } else {
                    echo "<img src='assets/image/done.png' width='100' alt='Done' class='status-icon'> {$tampil['verifikasi']}";
                }
                echo "</span></li>";
            } else {
                echo "<li>Tidak ada pesanan untuk ditampilkan.</li>";
            }
            ?>
        </ul>
        <a href="cobalagipesan.php" class="back-link">Back</a>
    </main>

</body>
