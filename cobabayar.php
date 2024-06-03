<title>Upload Bukti</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container">
    <h1>Upload Bukti</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="forms">
            <label for="name">Name</label>
            <input type="text" name="name">
        </div>
        <div class="forms">
            <label for="images">Profile</label>
            <input type="file" name="images">
        </div>
        <div class="buttons">
            <button class="btn_tambah" type="submit" name="submit">Upload</button>
            <a href="index.php" class="btn_kembali">Kembali</a>
        </div>
    </form>
</div>


<?php
session_start();

// Pastikan sesi id_user telah diset sebelum melanjutkan
if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
    echo "<script>alert('Silakan Login!');window.location='login.php'</script>";
    exit; // Hentikan eksekusi skrip jika sesi id_user tidak tersedia
}

// Simpan id_user dari sesi dalam variabel
$id_user = $_SESSION['id_user'];

include "koneksi.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $image = $_FILES['images']['name'];
    $tmp = $_FILES['images']['tmp_name'];

    // Ambil id_pesanan dari tb_pesanan yang belum memiliki data pembayaran di tbl_bayar
    $result = $koneksi->query("SELECT tb.id_pesanan 
                               FROM tb_pesanan tb 
                               LEFT JOIN tbl_bayar tbay ON tb.id_pesanan = tbay.id_pesanan 
                               WHERE tb.id_user = '$id_user' AND tbay.id_pesanan IS NULL 
                               ORDER BY tb.id_pesanan DESC LIMIT 1");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_pesanan = $row['id_pesanan'];

        // Simpan data ke tbl_bayar beserta id_pesanan
        $koneksi->query("INSERT INTO tbl_bayar(name, profile, id_pesanan) VALUES('$name', '$image', '$id_pesanan')");

        $location = 'bukti/' . $image;
        move_uploaded_file($tmp, $location);

        echo "<script>
        Swal.fire({
            title: 'Bukti berhasil diunggah!',
            text: 'Silakan tunggu verifikasi admin!',
            icon: 'success'
        }).then(function() {
            window.location='index.php';
        });
        </script>";
    } else {
        echo "<script>alert('Tidak ada pesanan yang perlu dibayar');window.location='index.php'</script>";
    }
}


