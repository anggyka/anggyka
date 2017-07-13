<!DOCTYPE html>
<?php
include "../kon.php";
session_start();
if (!isset($_SESSION['admin'])){
header ("location:../login.php");
}	
$session	= $_SESSION['admin'];
$get_id 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT id_admin, nama_admin FROM tb_admin WHERE username_admin='$session'"));
			$idd 		= $get_id['id_admin'];
			$nd 		= $get_id['nama_admin'];

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Data Master</title>
    <!-- Untuk CSS ditaruh pada file style.css, sehingga perlu dipanggil code ini -->
    <link rel="stylesheet" href="../css/admin1.css">
</head>
<div class="wrap">
<div class="menu">
<ul>
<li><a href="../logout.php">Logout&nbsp;&nbsp;(<?php echo $nd;  ?>)</a></li>
</ul>
<nav>
<ul>
<li><a href="../index.php">Depo Air Isi Ulang Bambang</a></li>  
</nav>
</div>
</div>
<body>
    <div id="login">
        <h2>Data Pengeluaran</h2>
        <div class="border-p"></div>
  <?php
//untuk memanggil koneksi database
include "../kon.php";
if (isset($_POST['simpan'])){
		$kode_pengeluaran=$_POST['kode_pengeluaran'];
		$jenis_pengeluaran=$_POST['jenis_pengeluaran'];
		
//Mencek data yang sama
$q =mysqli_query($con, "select * from tb_keluar where kode_pengeluaran='$kode_pengeluaran'") or die (mysql_error());
$k =mysqli_num_rows($q);
if ($k>0){
	echo "<script>alert('kode_pengeluaran sudah ada, gagal disampan!!')</script>";
	}
	else{
	
//Proses simpan 
$query = mysqli_query($con, "insert into tb_keluar (kode_pengeluaran,jenis_pengeluaran) values ('$kode_pengeluaran','$jenis_pengeluaran')") or die(mysql_error());
if (!mysql_query($query)){
echo "<script>alert('Berhasil Disimpan.'); document.location='tkeluar.php';</script>";
}else{
echo "<script>alert('Gagal Disimpan.'); document.location='tkeluar.php';</script>"; 
	}
	
	}
	
}
?>
        <fieldset>
            <form method="post" name="tkeluar" action="">
            Kode Pengeluaran :
                <input type="text" name="kode_pengeluaran" placeholder="Masukan Kode Pengeluaran" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" autofocus required>
            <p></p> Jenis Pengeluaran :
                <input type="text" name="jenis_pengeluaran" placeholder="Masukan Jenis Pengeluaran" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
                <input type="submit" name="simpan" value="Simpan">
                <input type="reset" name="Reset" value="Clear">
                <input type="button" style=" width: 20%; padding: 1em;
               								float:right;
   											 margin: 1.5em 0;
   											 color: #888;
   											 background-color:#36F;
   											 border:none;
   											 color:#eee;
   											 border-bottom: 4px solid transparent;" 
                        			onClick="document.location='keluar.php?tampil'" value="Lihat Data"  />
            </form>
        </fieldset>
    </div>
</body>
</html>
