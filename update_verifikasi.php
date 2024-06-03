<!-- GADIPAKE -->
<?php
// Menghubungkan dengan file koneksi.php
include "koneksi.php";

// $verifikasi = $_POST['verifikasi_te']
// $query = $koneksi->query("INSERT INTO tb_pesanan (verifikasi) VALUES ('$verifikasi')");
// if($query){
//     if($verifikasi!=NULL){
//         $query = $koneksi->query("INSERT INTO tb_pesanan (verifikasi) VALUES ('$verifikasi')");
//         echo "<script>
//             Swal.fire({
//                 title: 'Registrasi Berhasil!',
//                 text: 'Silakan Login!',
//                 icon: 'success'
//             }).then(function() {
//                 window.location='list_pesanan.php';
//             });
//         </script>";
//         }
//         else{
//             echo "<script>alert('Registrasi Gagal');window.location = 'login.php'; </script>";
//         }
//     }
    // ?
    
// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirimkan melalui form
    $id_pesanan = $_POST['id_pesanan'];
    $verifikasi_text = $_POST['verifikasi_text'];

    // Memperbarui kolom 'verifikasi' di dalam tabel 'tb_pesanan' berdasarkan 'id_pesanan'
    $query = "UPDATE tb_pesanan SET verifikasi='$verifikasi_text' WHERE id_pesanan='$id_pesanan'";
    
    // Menjalankan query untuk memperbarui data di dalam database
    if (mysqli_query($koneksi, $query)) {
        // Jika query berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: list_pesanan.php");
        exit(); // Pastikan kode di bawah tidak dijalankan setelah redirect
    } else {
        // Jika terjadi kesalahan saat menjalankan query, tampilkan pesan kesalahan
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika halaman diakses tanpa melalui metode POST, arahkan kembali ke halaman sebelumnya
    header("Location: list_pesanan.php");
    exit(); // Pastikan kode di bawah tidak dijalankan setelah redirect
}
?> 
