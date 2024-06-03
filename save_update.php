<!-- GAKEPAKE -->
<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_pesanan"]) && isset($_POST["pesan_update"])) {
    // Tangkap id_pesanan dan pesan_update dari permintaan POST
    $id_pesanan = $_POST["id_pesanan"];
    $pesan_update = $_POST["pesan_update"];

    // Lakukan query SQL untuk memperbarui pesan_update di database
    $query = "UPDATE tb_pesanan SET pesan_update='$pesan_update' WHERE id_pesanan='$id_pesanan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Pesan update berhasil disimpan.";
    } else {
        echo "Gagal menyimpan pesan update.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
