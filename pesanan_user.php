<!-- KAYAKNYA INI GA KEPAKE -->
<h1>Data Pemesanan</h1>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nomor HP</th>
        <th>Kendaraan</th>
        <th>Jenis Layanan</th>
        <th>Tanggal</th>
        <th>Jumlah Kendaraan</th>
        <th>Bayar</th>
        <th>Verifikasi</th>
    </tr>
    <a href="index.php">Back</a>
    <?php
session_start();
include "koneksi.php";
$id_user = $_SESSION['id_user'];

$no = 1;
// Ubah query untuk melakukan JOIN dengan menggunakan id_pesanan sebagai kunci relasi
$ambildata = mysqli_query($koneksi, "SELECT * FROM tb_pesanan LEFT JOIN tbl_bayar ON tb_pesanan.id_pesanan = tbl_bayar.id_pesanan WHERE tb_pesanan.id_user='$id_user'");
while ($tampil = mysqli_fetch_array($ambildata)) {
    echo "
    <tr>
        <td>$no</td>
        <td>$tampil[nama]</td>
        <td>$tampil[no]</td>
        <td>$tampil[kendaraan]</td>
        <td>$tampil[layanan]</td>
        <td>$tampil[waktu]</td>
        <td>$tampil[jumlah]</td>
        <td>$tampil[profile]</td>
        <td>$tampil[verifikasi]</td>
    </tr>";
    $no++;
}
?>
