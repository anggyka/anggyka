<!DOCTYPE html>
<?php
include "kon.php";
session_start();
if (!isset($_SESSION['admin'])){
header ("location:login_admin.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Data Master</title>
    <!-- Untuk CSS ditaruh pada file style.css, sehingga perlu dipanggil code ini -->
    <link rel="stylesheet" href="admin1.css">
</head>
<div class="wrap">
<div class="menu">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="logout.php">Logout&nbsp;&nbsp;(<?php echo $_SESSION['admin'];  ?>)</a></li>
</ul>
<nav>
<ul>
<li><a href="#">Master</a>
<ul>
 <li><a href="tadmin.php">Admin</a></li>
 <li><a href="master/tbarang.php">Barang</a></li>
 <li><a href="master/tkeluar.php">Pengeluaran</a></li>
 <li><a href="master/tpelanggan.php">Pelanggan</a></li>
</ul>
</li>
<li><a href="#">Transaksi</a>
<ul>
 <li><a href="transaksi/tpenjualan.php">Penjualan</a></li>
 <li><a href="#">Pemesenan</a></li>
 <li><a href="transaksi/tpengeluaran.php">Pengeluaran</a></li>
</ul>
</li>
<li><a href="#">Laporan</a>
<ul>
 <li><a href="laporan/laporan_pendapatan.php">Pendapatan</a></li>
 </ul>
</li>   
</nav>
		</div>
        </div>
<body>
    <div id="login">
        <h2>Edit Data Admin</h2>
        <div class="border-p"></div>
        <?php
//untuk memanggil koneksi database
include "kon.php";				

$edit=$_GET['edit'];

//menampilkan data yang sudah di input
$q =mysql_query("select * from tb_admin where id_admin='$edit'") or die (mysql_error());
$row=mysql_fetch_array($q);

if (isset($_POST['edit'])){
//mengirim data dari form	
		$id_admin=$_POST['id_admin'];
		$nama_admin=$_POST['nama_admin'];
		$username_admin=$_POST['username_admin'];
		$alamat_admin=$_POST['alamat_admin'];
		$hp_admin=$_POST['hp_admin'];
		$pass=$_POST['pass'];
	
//Proses update
$query = mysql_query("update tb_admin set nama_admin='$nama_admin', username_admin='$username_admin', alamat_admin='$alamat_admin', hp_admin='$hp_admin', pass='$pass' where id_admin='$id_admin'") or die(mysql_error());
if (!mysql_query($query)){
//jika berhasil maka tampil validasi ini dan kembali kehalaman index.php	
echo "<script>alert('Berhasil Dirubah.'); document.location='admin.php';</script>";
}else{
//jika gagal akan tampil validasi ini dan kembali kehalaman index.php
echo "<script>alert('Gagal Dirubah'); document.location='admin.php';</script>"; 
	}
	
	
}


?>


<fieldset>
            <form method="post" name="tpelanggan" action="">
            Id:
                <p></p><input type="text" value="<?php echo $row['id_admin']; ?>" name="id_admin" id="id_admin" readonly="readonly">
            <p></p>Nama Lengkap:
                <input type="text" value="<?php echo $row['nama_admin']; ?>" name="nama_admin" id="nama_admin" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
                <p></p> Username:
                <input type="email" value="<?php echo $row['username_admin']; ?>" name="username_admin" id="username_admin" required>
            <p></p>Alamat :
               <input type="text" value="<?php echo $row['alamat_admin']; ?>" name="alamat_admin" id="alamat_admin" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
            <p></p>Nomor Hp :
                <input type="text" value="<?php echo $row['hp_admin']; ?>" name="hp_admin" id="hp_admin" pattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
            <p></p>Password :
               <input type="text" value="<?php echo $row['pass']; ?>" name="pass" id="pass" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
                <input type="submit" name="edit" value="Simpan">
                <input type="button" style=" width: 20%; padding: 1em;
   											 margin: 1.5em 0;
   											 color: #888;
   											 background-color:#F33;
   											 border:none;
   											 color:#eee;
   											 border-bottom: 4px solid transparent;" 
                        			onClick="document.location='admin.php?tampil'" value="Kembali"  />
            </form>
        </fieldset>
    </div>
</body>
</html>
