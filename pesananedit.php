<!-- INI DIPAKE -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulir Pemesanan</title>
<link rel="stylesheet" href="assets/css/edit.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php
        session_start();
        include "koneksi.php";

        // Pastikan sesi id_user telah diset sebelum melanjutkan
        if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
            echo "<script>alert('Silakan Login!');window.location='login.php'</script>";
            exit; // Hentikan eksekusi skrip jika sesi id_user tidak tersedia
        }

        // Simpan id_user dari sesi dalam variabel
        $id_user = $_SESSION['id_user'];

        // Deklarasi variabel untuk form
        $nama = $no = $kendaraan = $layanan = $waktu = $jam = $jumlah = '';

        // Cek apakah id_pesanan ada di URL untuk edit pesanan
        if (isset($_GET['id_pesanan'])) {
            $id_pesanan = $_GET['id_pesanan'];
            // Ambil data pesanan berdasarkan id_pesanan
            $result = mysqli_query($koneksi, "SELECT * FROM tb_pesanan WHERE id_pesanan='$id_pesanan'");
            $pesanan = mysqli_fetch_array($result);

            // Isi variabel form dengan data dari database
            $nama = $pesanan['nama'];
            $no = $pesanan['no'];
            $kendaraan = $pesanan['kendaraan'];
            $layanan = $pesanan['layanan'];
            $waktu = $pesanan['waktu'];
            $jam = $pesanan['jam'];
            $jumlah = $pesanan['jumlah'];
        }

        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $no = $_POST['no_hp'];
            $kendaraan = $_POST['jenis_kendaraan'];
            $layanan = $_POST['jenis_layanan'];
            $waktu = $_POST['waktu'];
            $jam = $_POST['jam'];
            $jumlah = $_POST['jumlah_kendaraan'];

            if (isset($_GET['id_pesanan'])) {
                // Proses update pesanan
                $id_pesanan = $_POST['id_pesanan'];
                $query = $koneksi->query("UPDATE tb_pesanan SET nama='$nama', no='$no', kendaraan='$kendaraan', waktu='$waktu', jam='$jam', jumlah='$jumlah' WHERE id_pesanan='$id_pesanan'");
                if ($query) {
                    echo "<script>
                        Swal.fire({
                            title: 'Pesanan Berhasil diupdate!',
                            text: 'Silakan cek pesanan Anda.',
                            icon: 'success'
                        }).then(function() {
                            window.location='index.php';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Maaf, Pesanan Gagal diupdate!',
                            text: 'Silakan coba lagi.',
                            icon: 'error'
                        }).then(function() {
                            window.location='pesanan.php?id_pesanan=$id_pesanan';
                        });
                    </script>";
                }
            } else {
                // Proses pembuatan pesanan baru
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
        }
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
    <main>
        <h2>Formulir Pemesanan</h2>
        <form action="#" method="post" class="order-form">
            <section class="main-form">
                <div class="sec-one">
                    <div class="sec-one-1">
                        <input type="hidden" name="id_pesanan" value="<?php echo isset($pesanan['id_pesanan']) ? $pesanan['id_pesanan'] : ''; ?>">
                        
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                        
                        <label for="no_hp">No HP:</label>
                        <input type="text" id="no_hp" name="no_hp" value="<?php echo $no; ?>">
                    </div>
                    <div class="sec-one-2">
                        <label for="jenis_kendaraan">Jenis Kendaraan:</label>
                        <div class="option-type">
                            <select id="jenis_kendaraan" name="jenis_kendaraan">
                                <option value="Mobil" <?php echo ($kendaraan == 'Mobil') ? 'selected' : ''; ?>>Mobil</option>
                                <option value="Motor" <?php echo ($kendaraan == 'Motor') ? 'selected' : ''; ?>>Motor</option>
                            </select>
                            <select id="jumlah_kendaraan" name="jumlah_kendaraan">
                                <option value="1" <?php echo ($jumlah == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($jumlah == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($jumlah == '3') ? 'selected' : ''; ?>>3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="sec-two">
                    <div class="sec-two-2">
                        <label for="waktu">Pilih Tanggal:</label>
                        <input type="date" id="waktu" name="waktu" value="<?php echo $waktu; ?>">
                        
                        <label for="jam">Pilih Waktu:</label>
                        <input type="time" id="jam" name="jam" value="<?php echo $jam; ?>">
                    </div>
                    <div class="sec-two-1">
                        <label for="jenis_layanan">Jenis Layanan:</label>
                        <?php if (isset($_GET['id_pesanan'])): ?>
                            <input type="text" id="jenis_layanan" name="jenis_layanan" value="<?php echo $layanan; ?>" readonly>
                        <?php else: ?>
                            <select id="jenis_layanan" name="jenis_layanan">
                                <option value="Servis" <?php echo ($layanan == 'Servis') ? 'selected' : ''; ?>>Paket Hemat Cuci Kilat</option>
                                <option value="Cuci" <?php echo ($layanan == 'Cuci') ? 'selected' : ''; ?>>Paket Nyaman Grooming Lengkap</option>
                                <option value="Servis dan Cuci" <?php echo ($layanan == 'Servis dan Cuci') ? 'selected' : ''; ?>>Paket Premium Full Servis</option>
                            </select>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <div class="btn-flex">
                <button name="submit" type="submit"><?php echo isset($_GET['id_pesanan']) ? 'Update Pesanan' : 'Buat Pesanan'; ?></button>
            </div>
        </form>
    </main>
</body>
</html>
