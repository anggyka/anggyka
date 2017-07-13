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
        <h2>Data Barang</h2>
        <div class="border-p"></div>
<?php 
include "../kon.php";
if (isset($_GET['hapus'])){
	$id=$_GET['hapus'];
	
$query = mysqli_query($con, "DELETE FROM tb_barang_new WHERE id_barang ='$id'") or die(mysqli_error());
if (!mysqli_query($query)){
echo "<script>alert('Berhasil Dihapus.'); document.location='barang.php';</script>";
}else{
echo "<script>alert('Gagal Dihapus.'); document.location='barang.php';</script>"; 
	}
	
	}

?>
<hr />
 

<table width="488" border="0" align="center">
  <tr bgcolor="#E5E5E5">
    <th width="115" scope="col">id</th>
    <th width="112" scope="col">nama</th>
     <th width="112" scope="col">harga 5L</th>
     <th width="112" scope="col">harga 10L</th>
     <th width="112" scope="col">harga 20L</th>
     <th width="112" scope="col">harga 25L</th>
     <th width="112" scope="col">harga 30L</th>
     <th width="112" scope="col">deskripsi</th>
     <th width="112" scope="col">gambar</th>
    <th width="96" scope="col"><a href="tbarang.php">Tambah</a></th>
  </tr>
   <?php
   //menampilkan data
	$sql=mysqli_query($con,"SELECT * FROM tb_barang_new") or die (mysqli_error());
	
	while ($row=mysqli_fetch_array($sql)) {
?>
  
  <tr align="center">
    <td><?php echo $row['id_barang'];?></td>
    <td><?php echo $row['nama_barang'];?></td>
    <td><?php echo $row['hrg_5'];?></td>
     <td><?php echo $row['hrg_10'];?></td>
      <td><?php echo $row['hrg_20'];?></td>
       <td><?php echo $row['hrg_25'];?></td>
        <td><?php echo $row['hrg_30'];?></td>
         <td><?php echo $row['deskripsi'];?></td>
          <td><?php echo $row['gambar'];?></td>
    <td><a href="ebarang.php?edit=<?php echo $row['id_barang'];?>">Edit</a> <a onClick="return confirm('Anda Yakin');" href="barang.php?hapus=<?php echo $row['id_barang']; ?>">Hapus</a></td>
  </tr>
  <?php
  } ?>
</table>
    </div>
</body>
</html>
