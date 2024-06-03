<!-- INI DIPAKE -->
<?php
session_start();
include "koneksi.php";

$deleteSuccess = false;

if (isset($_POST['delete'])) {
    $id_pesanan = $_POST['id_pesanan'];
    // Query untuk menghapus data dari kedua tabel
    $deletePesanan = mysqli_query($koneksi, "DELETE FROM tb_pesanan WHERE id_pesanan='$id_pesanan'");
    $deleteBayar = mysqli_query($koneksi, "DELETE FROM tbl_bayar WHERE id_pesanan='$id_pesanan'");
    
    // Periksa apakah query berhasil
    if ($deletePesanan && $deleteBayar) {
        $deleteSuccess = true;
        $deleteMessage = 'Pesanan berhasil dihapus.';
    } else {
        $deleteMessage = 'Gagal menghapus pesanan.';
    }
}

$id_user = $_SESSION['id_user'];

// Ubah query untuk melakukan JOIN dengan menggunakan id_pesanan sebagai kunci relasi
$ambildata = mysqli_query($koneksi, "SELECT * FROM tb_pesanan LEFT JOIN tbl_bayar ON tb_pesanan.id_pesanan = tbl_bayar.id_pesanan WHERE tb_pesanan.id_user='$id_user'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pemesanan</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets/css/cobalagipesan.css"> 
    <script>
        function confirmDelete(id_pesanan) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "",
                        data: { delete: true, id_pesanan: id_pesanan },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: "Error!",
                                text: "Gagal menghapus pesanan.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>
</head>
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
    <section>
        <h1>Data Pemesanan</h1>
        <table class="table table-responsive-stack" id="tableOne">
            <thead>
                <tr>
                    <th class="t-header">Tanggal/Jam</th>
                    <th class="t-header">Verifikasi</th>
                    <th class="t-header">Layanan</th>
                    <th class="t-header">Detail</th>
                    <th class="t-header">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($tampil = mysqli_fetch_array($ambildata)) {
                    $verifikasi_icon = ($tampil['verifikasi'] != '') ? '<img src="ceklis.png" alt="Checked" width="30" height="30">' : ''; 
                    $id_pesanan = $tampil['id_pesanan'];
                    $disabled_edit = ($tampil['verifikasi'] != '') ? 'disabled' : ''; 
                    echo "
                    <tr class='row-loop'>
                        <td class='time-date'>$tampil[waktu]<br>$tampil[jam]</td>
                        <td class='verify'>$verifikasi_icon</td>
                        <td class='service'>$tampil[layanan]</td>
                        <td class='detail'><a href='cobarekap.php?id_pesanan=$id_pesanan'>view details</a></td> 
                        <td class='action-btn'>
                            <a href='pesananedit.php?id_pesanan=$id_pesanan'><button $disabled_edit>Edit</button></a>
                            <button class='delete-btn' onclick='confirmDelete($id_pesanan)'>Delete</button>
                        </td>
                    </tr>";
                } ?>
            </tbody>
        </table>
        
    </section>
</body>
</html>
