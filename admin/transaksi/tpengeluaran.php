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
    <title>Input Data Transaksi</title>
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
        <h2>Pengeluaran</h2>
        <div class="border-p"></div>
 <?php
//untuk memanggil koneksi database
include "../kon.php";
if (isset($_POST['simpan'])){
	date_default_timezone_set('Asia/Jakarta');
	$tgl_k		= date("y-m-d H:i:s");
		$kode_pengeluaran=$_POST['kode_pengeluaran'];
		$jumlah_k=$_POST['jumlah_k'];
		$harga_k=$_POST['harga_k'];
		
$q =mysqli_query($con, "select * from tb_keluar where kode_pengeluaran='$kode_pengeluaran'") or die (mysqli_error());
$row=mysqli_fetch_array($q);
	
$total_k = $harga_k * $jumlah_k;

//Proses simpan 
$query = mysqli_query($con, "insert into tb_pengeluaran (tgl_k,kode_pengeluaran,jumlah_k,harga_k,total_k) values ('$tgl_k','$kode_pengeluaran','$jumlah_k','$harga_k','$total_k')") or die(mysqli_error());
if (!mysqli_query($query)){
echo "<script>alert('Berhasil Disimpan.'); document.location='tpengeluaran.php';</script>";
}else{
echo "<script>alert('Gagal Disimpan.'); document.location='tpengeluaran.php';</script>"; 
	}
	
	
}
?>
        <fieldset>
            <form method="post" name="tpengeluaran" action="">
           Jenis Pengeluaran:
                <p></p><select name="kode_pengeluaran" id="kode_pengeluaran" class='form-control' style=" padding: 0.8em;" autofocus required>
        <option>--Pilih--</option>
         <?php
	$sql=mysqli_query($con, "SELECT * FROM tb_keluar order by kode_pengeluaran desc");
	$i=1;
	while ($row=mysqli_fetch_array($sql)) {
?>
        <option value="<?php echo $row['kode_pengeluaran'];?>"><!-- //menampilkan nip dan nama pada pencarian  --> <?php echo $row['kode_pengeluaran'] ;?>|| <?php echo $row['jenis_pengeluaran'] ;?> </option>
       <?php } ?>
        
      </select>
            <p></p> jumlah :
                <p></p><input type="number" name="jumlah_k" style="width: 60px; padding: 0.7em;"  placeholder="Jumlah" required>
            <p></p>Harga :
                <input type="text" name="harga_k" placeholder="Harga Persatuan" required>
                <input type="submit" name="simpan" value="Simpan">
                <input type="reset" name="Reset" value="Clear">
            </form>
        </fieldset>
    </div>
</body>
</html>
