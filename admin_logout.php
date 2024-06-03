<!-- INI DIPAKE -->
<?php
session_start();
if(!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])){
    echo"<script>alert('Silahkan Login!');window.location='login.php'</script>";
}
?>
<link rel="stylesheet" href="assets/css/admin.css">
<body>
<?php
include "koneksi.php"; //koneksi ke database
$id_user = $_SESSION['id_user']; //ambil ID pengguna dari sesi

// Query untuk mengambil data pengguna berdasarkan ID pengguna
$query = $koneksi->query("SELECT * FROM tb_users WHERE id_user='$id_user'");
$data_user = $query->fetch_assoc(); //ambil data pengguna dari hasil query

// Mengakses data nama pengguna
$nama_pengguna = $data_user['nama'];
$user_name = $data_user['username'];
?>
<body>
    <main>
        <h1> SEE YOU SOON!🙌</h1>
        <!-- <button> <?= $user_name;?></button><br>
        <button> <?= $nama_pengguna;?></button><br> -->
        <button onclick="window.location.href='logout.php'">Logout</button>
    </main>
</body>
