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
	<link rel="stylesheet" type="text/css" href="../css/admin3.css">
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
        <h2>Data Keluar</h2>
        <div class="border-p"></div>
<?php 
include "../kon.php";
if (isset($_GET['hapus'])){
	$kode_pengeluaran=$_GET['hapus'];
	
$query = mysqli_query($con, "DELETE FROM tb_keluar WHERE kode_pengeluaran ='$kode_pengeluaran'") or die(mysqli_error());
if (!mysqli_query($query)){
echo "<script>alert('Berhasil Dihapus.'); document.location='keluar.php';</script>";
}else{
echo "<script>alert('Gagal Dihapus.'); document.location='keluar.php';</script>"; 
	}
	
	}

?>
<hr />
 

<table width="488" border="0" align="center">
  <tr bgcolor="#E5E5E5">
    <th width="115" scope="col">kode_pengeluaran</th>
    <th width="112" scope="col">jenis_pengeluaran</th>
    <th width="96" scope="col"><a href="tkeluar.php">Tambah</a></th>
  </tr>
   <?php
   //menampilkan data
	$sql=mysqli_query($con, "SELECT * FROM tb_keluar") or die (mysqli_error());
	
	while ($row=mysqli_fetch_array($sql)) {
?>
  
  <tr align="center">
    <td><?php echo $row['kode_pengeluaran'];?></td>
    <td><?php echo $row['jenis_pengeluaran'];?></td>
    <td><a href="ekeluar.php?edit=<?php echo $row['kode_pengeluaran'];?>">Edit</a> <a onClick="return confirm('Anda Yakin');" href="keluar.php?hapus=<?php echo $row['kode_pengeluaran']; ?>">Hapus</a></td>
  </tr>
  <?php
  } ?>
</table>
    </div>
</body>
</html>
