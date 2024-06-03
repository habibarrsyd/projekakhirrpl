<!-- INI DIPAKE -->
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

// Variabel untuk menyimpan harga berdasarkan layanan
$harga = "";

// Ambil layanan dari tabel tb_pesanan
$result_layanan = $koneksi->query("SELECT layanan FROM tb_pesanan WHERE id_user = '$id_user' ORDER BY id_pesanan DESC LIMIT 1");

if ($result_layanan->num_rows > 0) {
    $row_layanan = $result_layanan->fetch_assoc();
    $layanan = $row_layanan['layanan'];
    
    // Tentukan harga berdasarkan layanan
    if ($layanan == "Layanan A") {
        $harga = "15000";
    } elseif ($layanan == "Layanan B") {
        $harga = "30000";
    } elseif ($layanan == "Layanan C") {
        $harga = "45000";
    } else {
        // Jika layanan tidak dikenali, atur harga menjadi default atau sesuai kebutuhan
        $harga = "0";
    }
} else {
    // Jika tidak ada layanan yang ditemukan, atur harga menjadi default atau sesuai kebutuhan
    $harga = "0";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Bukti</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="assets/css/barubayar.css">
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
        <main>
            <div class="headings">
                <h1>Let's Finish Your Payment</h1>
            </div>
            <section class="payment-container">
                <div class="qr-code">
                    <div class="qr-code-divide">
                        <p>placeholder</p>
                    </div>
                    <h2>Let's Pay Up!</h2>
                </div>
                <div class="payment-detail">
                    <form method="post" enctype="multipart/form-data">
                        <div class="forms">
                            <label for="price">Price</label>
                            <input type="text" name="price" value="<?php echo $harga; ?>" readonly>
                        </div>
                        <div class="forms">
                            <label for="images">Payment Status</label>
                            <input type="file" name="images">
                        </div>
                        <div class="buttons">
                            <button class="btn_tambah" type="submit" name="submit">Upload</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>


        <div class="container">
            
        </div>

        <?php
        if(isset($_POST['submit'])){
            $image = $_FILES['images']['name'];
            $tmp = $_FILES['images']['tmp_name'];
            $price = $harga; // Ambil harga dari variabel yang sudah ditentukan

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
                $koneksi->query("INSERT INTO tbl_bayar(profile, id_pesanan) VALUES('$image', '$id_pesanan')");

                // Perbarui kolom harga pada tb_pesanan
                $koneksi->query("UPDATE tb_pesanan SET harga = '$price' WHERE id_pesanan = '$id_pesanan'");

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
        ?>

    </body>
</html>
