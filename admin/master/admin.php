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
        <h2>Data Admin</h2>
        <div class="border-p"></div>
<?php 
//memamnggil file koneksi
include "../kon.php";

if (isset($_GET['hapus'])){
	//mengirim nip dari get hapus
	$id=$_GET['hapus'];
	//proses delete berdasarkan nip yang dikirim
$query = mysqli_query($con, "delete from tb_admin where id_admin ='$id'") or die(mysqli_error());
if (!mysqli_query($query)){
echo "<script>alert('Berhasil Dihapus.'); document.location='admin.php';</script>";
}else{
echo "<script>alert('Gagal Dihapus.'); document.location='admin.php';</script>"; 
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
    <th width="60" scope="col">Id admin</th>
    <th width="221" scope="col">Nama admin</th>
    <th width="102" scope="col">Username admin</th>
    <th width="130" scope="col">Email admin</th>
    <th width="221" scope="col">Alamat admin</th>
    <th width="120" scope="col">No. HP admin</th>
    <th width="101" scope="col"><a href="../daftar.php">Tambah</a></th>
  </tr>
  
   <?php
   //menampilkan data pegawai
if(isset($_POST['cari'])) {
	
	$id = $_POST['id'];
	//proses menampilkan data berdasarkan nip yang dicari
	$sql=mysqli_query($con, "SELECT * FROM tb_admin where id_admin like '%$id%' ") or die (mysqli_error());
	} else {   
	//proses menampilkan data tanpa pencarian
$sql=mysqli_query($con, "SELECT * FROM tb_admin") or die (mysqli_error());

	}
	//variabel nomor
	$i=1;
	while ($row=mysqli_fetch_array($sql)) {
?>
  
  <tr align="center">
    <td><?php echo $i;?></td>
    <td><?php echo $row['id_admin'];?></td>
    <td align="left"><?php echo $row['nama_admin'];?></td>
    <td align="left"><?php echo $row['username_admin'];?></td>
    <td align="left"><?php echo $row['email_admin'];?></td>
    <td align="left"><?php echo $row['alamat_admin'];?></td>
    <td><?php echo $row['hp_admin'];?></td>
    <td><a onclick="return confirm('Anda Yakin');" href="admin.php?hapus=<?php echo $row['id_adminn']; ?>">Hapus</a> </tr>
  <?php 
 
  $i++; 
  
  } ?>
</table>


    </div>
</body>
</html>
