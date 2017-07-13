<!DOCTYPE html>
<?php
include "../kon.php";
session_start();
if (!isset($_SESSION['admin'])){
header ("location:../login_admin.php");
}	
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Data Master</title>
    <!-- Untuk CSS ditaruh pada file style.css, sehingga perlu dipanggil code ini -->
    <link rel="stylesheet" href="../admin1.css">
</head>
<div class="wrap">
<div class="menu">
<ul>
<li><a href="../index.php">Home</a></li>
<li><a href="../logout.php">Logout&nbsp;&nbsp;(<?php echo $_SESSION['admin'];  ?>)</a></li>
</ul>
<nav>
<ul>
<li><a href="#">Master</a>
<ul>
 <li><a href="../tadmin.php">Admin</a></li>
 <li><a href="tbarang.php">Barang</a></li>
 <li><a href="tkeluar.php">Pengeluaran</a></li>
 <li><a href="tpelanggan.php">Pelanggan</a></li>
</ul>
</li>
<li><a href="#">Transaksi</a>
<ul>
 <li><a href="../transaksi/tpenjualan.php">Kasir Penjualan</a></li>
 <li><a href="#">Pemesenan</a></li>
 <li><a href="../transaksi/tpengeluaran.php">Pengeluaran</a></li>
</ul>
</li>
<li><a href="#">Laporan</a>
<ul>
 <li><a href="../laporan/laporan3.php">Pendapatan</a></li>
 </ul>
</li>   
</nav>
		</div>
        </div>
<body>
    <div id="login">
        <h2>Edit Data Pelanggan</h2>
        <div class="border-p"></div>
        <?php
//untuk memanggil koneksi database
include "../kon.php";
		

$edit=$_GET['edit'];

//menampilkan data yang sudah di input
$q =mysql_query("select * from tb_pelanggan where no_pelanggan='$edit'") or die (mysql_error());
$row=mysql_fetch_array($q);

if (isset($_POST['edit'])){
//mengirim data dari form	
		$nolang=$_POST['no_pelanggan'];
		$namalang=$_POST['nama_pelanggan'];
		$alamatlang=$_POST['alamat_pelanggan'];
		$hp_pelanggan=$_POST['hp_pelanggan'];
		$pass=$_POST['pass_pelanggan'];
	
//Proses update
$query = mysql_query("update tb_pelanggan set nama_pelanggan='$namalang', alamat_pelanggan='$alamatlang', hp_pelanggan='$hp_pelanggan', pass_pelanggan='$pass' where no_pelanggan='$nolang'") or die(mysql_error());
if (!mysql_query($query)){
//jika berhasil maka tampil validasi ini dan kembali kehalaman index.php	
echo "<script>alert('Berhasil Dirubah.'); document.location='pelanggan.php';</script>";
}else{
//jika gagal akan tampil validasi ini dan kembali kehalaman index.php
echo "<script>alert('Gagal Dirubah'); document.location='pelanggan.php';</script>"; 
	}
	
	
}


?>

<fieldset>
            <form method="post" name="tpelanggan" action="">
            Nomor Pelanggan :
               <input name="no_pelanggan" type="text" value="<?php echo $row['no_pelanggan']; ?>" id="no_pelanggan" readonly="readonly">
            <p></p> Nama Lengkap:
                <input type="text" value="<?php echo $row['nama_pelanggan']; ?>" name="nama_pelanggan" id="nama_pelanggan" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
            <p></p>Alamat :
               <input type="text" value="<?php echo $row['alamat_pelanggan']; ?>" name="alamat_pelanggan" id="alamat_pelanggan" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
            <p></p>Nomor Hp :
                <input type="text" value="<?php echo $row['hp_pelanggan']; ?>" name="hp_pelanggan" id="hp_pelanggan" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
            <p></p>Password :
               <input type="text" value="<?php echo $row['pass_pelanggan']; ?>" name="pass_pelanggan" id="pass_pelanggan" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
                <input type="submit" name="edit" value="Simpan">
                <input type="button" style=" width: 20%; padding: 1em;
   											 margin: 1.5em 0;
   											 color: #888;
   											 background-color:#F33;
   											 border:none;
   											 color:#eee;
   											 border-bottom: 4px solid transparent;" 
                        			onClick="document.location='pelanggan.php?tampil'" value="Kembali"  />
            </form>
        </fieldset>
    </div>
</body>
</html>
