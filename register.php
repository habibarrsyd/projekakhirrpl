<!-- INI DIPAKE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Register Page</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php 
    include "koneksi.php"; 
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
    <div class="wrapper">
        <h1>Create New Account</h1>
        <form method="post">
            <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="text" name="nama" id="nama" placeholder="Nama" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>

            <button name="register" type="submit" class="btn">Sign Up</button>
            <p>Already Have an Account?&nbsp;<a href="login.php">Login!</a></p>
        </form>
    </div>

    <?php
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];

        // Perbaikan pada query SQL
        $query = $koneksi->query("INSERT INTO tb_users (username, email, nama, password) VALUES ('$username', '$email', '$nama', '$password')");
        if($query){
            // Check if username and password contain the word "admin"
            if (strpos($username, 'admin') !== false && strpos($password, 'admin') !== false) {
                // Set 'posisi' column in the database to "admin"
                $koneksi->query("UPDATE tb_users SET posisi='admin' WHERE username='$username'");
            }
            
            echo "<script>
            Swal.fire({
                title: 'Registrasi Berhasil!',
                text: 'Silakan Login!',
                icon: 'success'
            }).then(function() {
                window.location='login.php';
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Registrasi Gagal',
                text: 'Coba lagi!',
                icon: 'error'
            });
            </script>";
        }
    }
    ?>
</body>
</html>
