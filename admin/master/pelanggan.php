<!DOCTYPE html>
<?php
include "../kon.php";
session_start();
if (!isset($_SESSION['admin'])){
header ("location:login.php");
}
$session	= $_SESSION['admin'];
$get_id 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT id_admin, nama_admin FROM tb_admin WHERE username_admin='$session'"));
			$idd 		= $get_id['id_admin'];
			$nd 		= $get_id['nama_admin'];

?>
<html>
<head>
	<title>Depo Air Isi Ulang Bambang</title>
	<link rel="stylesheet" type="text/css" href="../css/admin4.css">
</head>
<body>
	<div class="wrap">
<div class="menu">
<ul>
<li><a href="../logout.php">Logout&nbsp;&nbsp;(<?php echo $nd;  ?>)</a></li>
</ul>
<nav>
<ul>
<li><a href="../index.php">Depo Air Isi Ulang Bambang</a>
</li>  
</nav>
		</div>
        </div>
<body>
    <div id="login">
        <h2>Data Pelanggan</h2>
        <div class="border-p"></div>
<?php 
//memamnggil file koneksi
include "../kon.php";

if (isset($_GET['hapus'])){
	//mengirim nip dari get hapus
	$id=$_GET['hapus'];
	//proses delete berdasarkan nip yang dikirim
$query = mysqli_query($con, "delete from tb_pelanggan_new where id_pelanggan ='$id'") or die(mysqli_error());
if (!mysqli_query($query)){
echo "<script>alert('Berhasil Dihapus.'); document.location='pelanggan.php';</script>";
}else{
echo "<script>alert('Gagal Dihapus.'); document.location='pelanggan.php';</script>"; 
	}
	
	}

?>
<hr />

<form name="form1" method="post" action="">
  <label for="nip"></label>
  <input type="text" name="id" id="id" placeholder="Masukkan ID !!">
  <input type="submit" name="cari" id="cari" value="Cari">
</form>
<table width="951" border="0">
  <tr align="center" bgcolor="#E5E5E5">
  
    <th width="23" scope="col">No</th>
    <th width="60" scope="col">Id Pelanggan</th>
    <th width="221" scope="col">Nama Pelanggan</th>
    <th width="102" scope="col">Username Pelanggan</th>
    <th width="130" scope="col">Email Pelanggan</th>
    <th width="221" scope="col">Alamat Pelanggan</th>
    <th width="120" scope="col">No. HP Pelanggan</th>
    <th width="101" scope="col"><a href="tpelanggan.php">Tambah</a></th>
  </tr>
  
   <?php
   //menampilkan data pegawai
if(isset($_POST['cari'])) {
	
	$id = $_POST['id'];
	//proses menampilkan data berdasarkan nip yang dicari
	$sql=mysqli_query($con, "SELECT * FROM tb_pelanggan_new where id_pelanggan like '%$id%' ") or die (mysqli_error());
	} else {   
	//proses menampilkan data tanpa pencarian
$sql=mysqli_query($con, "SELECT * FROM tb_pelanggan_new") or die (mysqli_error());

	}
	//variabel nomor
	$i=1;
	while ($row=mysqli_fetch_array($sql)) {
?>
  
  <tr align="center">
    <td><?php echo $i;?></td>
    <td><?php echo $row['id_pelanggan'];?></td>
    <td align="left"><?php echo $row['nama_pelanggan'];?></td>
    <td align="left"><?php echo $row['username_pelanggan'];?></td>
    <td align="left"><?php echo $row['email_pelanggan'];?></td>
    <td align="left"><?php echo $row['alamat_pelanggan'];?></td>
    <td><?php echo $row['hp_pelanggan'];?></td>
    <td><a onclick="return confirm('Anda Yakin');" href="pelanggan.php?hapus=<?php echo $row['id_pelanggan']; ?>">Hapus</a> </tr>
  <?php 
 
  $i++; 
  
  } ?>
</table>

    </div>
</body>
</html>
