<!-- INI DIPAKE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARe WASH</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php 
    include "koneksi.php";
    session_start();
    ?>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a href="layanan.php">Services</a>
                    <div class="dropdown-content">
                        <a href="pesanan_1.php">Pesanan 1</a>
                        <a href="pesanan_2.php">Pesanan 2</a>
                        <a href="pesanan_3.php">Pesanan 3</a>
                    </div>
                </li>
                <li><a href="pesanan.php">Book Now</a></li>
                <li><a href="rating.php">Rating</a></li>
                <li><a href="cobalagipesan.php">Track Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="semua">
            <div class="kiri">
                <div class="welcome">
                    <div class="welcomingtext">
                        <h1>Improve Your Drive with Superior Care!</h1>
                    </div>
                    <div class="signup">
                        <p>Don't have an account? <a href="register.php">Sign up here!</a></p>
                    </div>
                </div>
                <div class="forms">
                    <form method="post">
                        <div class="input-box">
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="input-box">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="btn">
                            <button name="login" type="submit" class="btn">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="kanan">
                <div class="picture">
                    <img src="assets/image/carwash.png" alt="Carwash Image">
                </div>
            </div>
        </div>
    </div>
    


    <?php
    if (isset($_POST['login'])) {
        $uname = $_POST['username'];
        $pwd = $_POST['password'];

        $qry = $koneksi->query("SELECT * FROM tb_users WHERE username='$uname' AND password='$pwd'");
        $result = mysqli_num_rows($qry);

        if ($result == 1) {
            $data = $qry->fetch_assoc();
            $_SESSION['id_user'] = $data['id_user'];

            if ($data['posisi'] == 'admin') {
                echo "<script>
                    Swal.fire({
                        title: 'Login Berhasil!',
                        text: 'Silakan Masuk!',
                        icon: 'success'
                    }).then(function() {
                        window.location='index_admin.php';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Login Berhasil!',
                        text: 'Silakan Masuk!',
                        icon: 'success'
                    }).then(function() {
                        window.location='index.php';
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Login Gagal!',
                    text: 'Coba login kembali!',
                    icon: 'error'
                }).then(function() {
                    window.location='login.php';
                });
            </script>";
        }
    }
    ?>
</body>
</html>
