<!-- INI DIPAKE -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/rating.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Formulir Rating dan Ulasan</title>

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

    <div class="headings">
        <h1>How Would You Rate Use?</h1>
    </div>
    <section class='rate-area'>
        <?php include "koneksi.php"; ?>
        <form action="#" method="post">
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5">☆</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4">☆</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">☆</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2">☆</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1">☆</label>
            </div>
            
            <input type="text" id="nama" name="nama" placeholder="Nama" required class="review-input"><br>
            <textarea id="ulasan" name="ulasan" placeholder="Ulasan" required class="review-input"></textarea><br>

            <button name="review" type="submit">Send</button>
        </form>
    </section>
<?php
if(isset($_POST['review'])){
    $rating=$_POST['rating'];
    $nama=$_POST['nama'];
    $ulasan=$_POST['ulasan'];

    $query = $koneksi->query("INSERT INTO tb_rating(rating, nama, ulasan)VALUES('$rating','$nama','$ulasan')");
    if($query){
        echo"<script>
        Swal.fire({
            title: 'Terimakasih atas Pendapat Anda!',
            text: 'Kami tunggu di-orderan berikutnya',
            icon: 'success'
        }).then(function() {
            window.location='index.php';
        });
    </script>";
        }else{
            echo "Gagal menyimpan data";
            

    }
}
?>


</body>
</html>
