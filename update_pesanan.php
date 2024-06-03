<!-- GA DIPAKE -->
<?php
include "koneksi.php";

if(isset($_GET['id_user'])){
    $id_user = $_GET['id_user'];
    $query_order = "SELECT * FROM tb_pesanan WHERE id=$id_user";
    $result_order = mysql_query($koneksi, $query_order); 

    if($result_order && mysqli_num_rows($result_order)>0){
        $row = mysqli_fetch_assoc($result_order);
    
    $nama=$row['nama'];
    $no = $row['no'];
    $kendaraan = $row['jenis_kendaraan'];
    $layanan = $row['jenis_layanan'];
    $waktu = $row['waktu'];
    $jumlah = $row['jumlah_kendaraan'];
    }
    if(isset($_POST['']))

}