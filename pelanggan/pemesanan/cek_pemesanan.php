<!DOCTYPE html>
<?php
include "../../kon.php";
session_start();
if (!isset($_SESSION['pelanggan'])){
header ("location:login.php");
}	
$session	= $_SESSION['pelanggan'];
$get_id 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT id_pelanggan, nama_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$session'"));
			$ip 		= $get_id['id_pelanggan'];
			$np 		= $get_id['nama_pelanggan'];
	
?>
<html>
<head>
	<title>Depo Air Isi Ulang Bambang</title>
	<link rel="stylesheet" type="text/css" href="cek.css">
</head>
<body>
	<div class="wrap">
<div class="menu">
<ul>
<li><a href="index.php">Pemesanan</a></li>
<li><a href="logout.php">Logout&nbsp;&nbsp;(<?php echo $np;  ?>)</a></li>
</ul>
<nav>
<ul>
<li><a href="../../index.php">Depo Air Isi Ulang Bambang</a>
</li>  
</nav>
		</div>
        </div>
<body>
    <div id="login">
        <h2>Data Pesanan</h2>
        <div class="border-p"></div>

<table width="550" border="0" align="center">
  <tr bgcolor="#DFDFDF">
  	 <th width="23" scope="col">No</th>
     <th width="112" scope="col">tgl_pemesanan</th>
     <th width="112" scope="col">id_pelanggan</th>
     <th width="112" scope="col">nama_pelanggan</th>
     <th width="112" scope="col">ozon</th>
     <th width="112" scope="col">ro</th>
     <th width="112" scope="col">conv</th>
     <th width="112" scope="col">status</th>
     </tr>
<?php
   include"../../kon.php";
 			$session 	= $_SESSION['pelanggan'];
			$get_id 	= mysqli_fetch_assoc(mysqli_query($con, "SELECT id_pelanggan, nama_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$session'"));
			$id 		= $get_id['id_pelanggan'];
			
			$sql=mysqli_query($con, "SELECT * FROM tb_pemesanan_new WHERE id_pelanggan='$id'") or die (mysqli_error());
			$i=1;
		  while ($row=mysqli_fetch_array($sql)) {
?>
  <tr align="center">
       <td><?php echo $i++;?></td>
       <td><?php echo $row['tgl_pemesanan'];?></td>
       <td><?php echo $row['id_pelanggan'];?></td>
       <td><?php echo $get_id['nama_pelanggan'];?></td>
       <td><?php echo $row['ozon'];?></td>
       <td><?php echo $row['ro'];?></td>
       <td><?php echo $row['conv'];?></td>
       <td><?php echo $row['status'];?></td>
       </tr>
        </table>
 <?php
 }
?>

 </div>
</body>
</html>