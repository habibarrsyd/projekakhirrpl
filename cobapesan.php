<h1>Data Pemesanan</h1>
<table border="1">
    <tr>
        <th>Tanggal<br>jam</th>
        <th>Verifikasi</th>
        <th>Layanan</th>
        <th>Detail</th>
    </tr>
    <?php
    session_start();
    include "koneksi.php";
    $id_user = $_SESSION['id_user'];

    // Ubah query untuk melakukan JOIN dengan menggunakan id_pesanan sebagai kunci relasi
    $ambildata = mysqli_query($koneksi, "SELECT * FROM tb_pesanan LEFT JOIN tbl_bayar ON tb_pesanan.id_pesanan = tbl_bayar.id_pesanan WHERE tb_pesanan.id_user='$id_user'");
    while ($tampil = mysqli_fetch_array($ambildata)) {
        $verifikasi_icon = ($tampil['verifikasi'] != '') ? '<img src="ceklis.png" alt="Checked" width="30" height="30">' : ''; // Tambahkan gambar checklist hijau jika kolom verifikasi tidak kosong
        $id_pesanan = $tampil['id_pesanan']; // Ambil id_pesanan dari hasil query
        echo "
        <tr>
            <td>$tampil[waktu]<br>$tampil[jam]</td>
            <td>$verifikasi_icon</td>
            <td>$tampil[layanan]</td>
            <td><a href='cobarekap.php?id_pesanan=$id_pesanan'>view details</a></td> <!-- Tambahkan id_pesanan sebagai parameter dalam URL -->
        </tr>";
    }
    ?>
</table>
<a href="index.php">Back</a> <!-- Pindahkan link 'Back' di luar tabel -->
