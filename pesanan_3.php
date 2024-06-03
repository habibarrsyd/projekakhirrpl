<!-- INI DIPAKE -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/pesanan.css">
<title>Formulir Pemesanan</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include "koneksi.php"; ?>

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
        <section class="headings">
            <aside>
                <h1>Let Us Know Your Needs.</h1>
            </aside>
        </section>
        <section class="content">
            <form action="#" method="post">
                <div class="main-form">    
                    <div class="leftSide">
                        <div class="partOne">
                            <h2>Step 1</h2>
                            <p>Fill in Your Details</p>
                            <input type="text" id="nama" name="nama" placeholder="Name">
                            <input type="text" id="no_hp" name="no_hp" placeholder="Phone Number">
                        </div>
                        <div class="partTwo">
                            <h2>Step 2</h2>
                            <p>Choose Your Vehicle Type.</p>
                            <div class="select-option">
                                <select id="jenis_kendaraan" name="jenis_kendaraan">
                                    <option value="Mobil">Mobil</option>
                                    <option value="Motor">Motor</option>
                                </select>
                                <select id="jumlah_kendaraan" name="jumlah_kendaraan">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>                       
                        </div>
                    </div>
                    <div class="rightSide">
                        <div class="partOne">
                            <h2>Step 3</h2>
                            <p>Choose what you want.</p>
                            <select id="jenis_layanan" name="jenis_layanan">
                                <option value="Layanan C">Paket Premium Full Servis</option>
                            </select>
                        </div>
                        <div class="partTwo">
                            <h2>Step 4</h2>
                            <p>Pick Your Schedule.</p>
                            <div class="select-option">
                                <input type="date" id="waktu" name="waktu">
                                <input type="time" id="waktu" name="jam">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn">
                    <button name="buat_pesanan" type="submit">Buat Pesanan</button>
                </div>
            </form>
        </section>
    </main>

<?php
session_start();

// Pastikan sesi id_user telah diset sebelum melanjutkan
if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
    echo "<script>alert('Silakan Login!');window.location='login.php'</script>";
    exit; // Hentikan eksekusi skrip jika sesi id_user tidak tersedia
}

// Simpan id_user dari sesi dalam variabel
$id_user = $_SESSION['id_user'];

// Lanjutkan dengan koneksi ke database
include "koneksi.php";

if (isset($_POST['buat_pesanan'])) {
    $nama = $_POST['nama'];
    $no = $_POST['no_hp'];
    $kendaraan = $_POST['jenis_kendaraan'];
    $layanan = $_POST['jenis_layanan'];
    $waktu = $_POST['waktu'];
    $jam = $_POST['jam'];
    $jumlah = $_POST['jumlah_kendaraan'];
    

    // Proses database
    $query = $koneksi->query("INSERT INTO tb_pesanan (id_user, nama, no, kendaraan, layanan, waktu, jam, jumlah) VALUES ('$id_user', '$nama', '$no', '$kendaraan', '$layanan', '$waktu', '$jam', '$jumlah')");
if ($query) {
    echo "<script>
        Swal.fire({
            title: 'Pesanan Berhasil dibuat!',
            text: 'Silakan cek pesanan Anda.',
            icon: 'success'
        }).then(function() {
            window.location='barubayar.php';
        });
    </script>";
} else {
    echo "<script>
        Swal.fire({
            title: 'Maaf, Pesanan Gagal dibuat!',
            text: 'Silakan coba lagi.',
            icon: 'error'
        }).then(function() {
            window.location='pesanan.php';
        });
    </script>";
}
}
?>

