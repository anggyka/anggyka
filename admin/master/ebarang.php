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
	<link rel="stylesheet" type="text/css" href="../css/admin1.css">
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
include "../kon.php";
$edit=$_GET['edit'];

//menampilkan data yang sudah di input
$q =mysqli_query($con, "select * from tb_barang_new WHERE id_barang='$edit'") or die (mysqli_error());
$row=mysqli_fetch_array($q);

if (isset($_POST['edit'])){
//mengirim data dari form	
		$id=$_POST['id_barang'];
		$nama=$_POST['nama_barang'];
		$hrg_5=$_POST['hrg_5'];
		$hrg_10=$_POST['hrg_10'];
		$hrg_20=$_POST['hrg_20'];
		$hrg_25=$_POST['hrg_25'];
		$hrg_30=$_POST['hrg_30'];
		$deskripsi=$_POST['deskripsi'];
		$gambar=$_POST['gambar'];
	
//Proses update
$query = mysqli_query($con, "update tb_barang_new set nama_barang='$nama',hrg_5='$hrg_5',hrg_10='$hrg_10',hrg_20='$hrg_20',hrg_25='$hrg_25',hrg_30='$hrg_30',deskripsi='$deskripsi',gambar='$gambar' where id_barang='$id'") or die(mysqli_error());
if (!mysqli_query($query)){
//jika berhasil maka tampil validasi ini dan kembali kehalaman index.php	
echo "<script>alert('Berhasil Dirubah.'); document.location='barang.php';</script>";
}else{
//jika gagal akan tampil validasi ini dan kembali kehalaman index.php
echo "<script>alert('Gagal Dirubah'); document.location='barang.php';</script>"; 
	}
	
	
}


?>
<fieldset>
            <form method="post" name="tpelanggan" action="">
             Id Barang:
                <input type="text" value="<?php echo $row['id_barang']; ?>" name="id_barang" id="id_barang" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required readonly>
            Nama Barang:
                <input type="text" value="<?php echo $row['nama_barang']; ?>" name="nama_barang" id="nama_baran" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" autofocus required>
                 <p></p>Harga per 5 Liter:
                <input type="text" value="<?php echo $row['hrg_5']; ?>" name="hrg_5" id="hrg_5" pattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                <p></p>Harga per 10 Liter:
                <input type="text" value="<?php echo $row['hrg_10']; ?>" name="hrg_10" id="hrg_10" pattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                <p></p>Harga per 20 Liter:
                <input type="text" value="<?php echo $row['hrg_20']; ?>" name="hrg_20" id="hrg_20" pattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                <p></p>Harga per 25 Liter:
                <input type="text" value="<?php echo $row['hrg_25']; ?>" name="hrg_25" id="hrg_25" pattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                <p></p>Harga per 30 Liter:
                <input type="text" value="<?php echo $row['hrg_30']; ?>" name="hrg_30" id="hrg_30" pattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                <p></p>Deskripsi:
                 <input type="text" value="<?php echo $row['deskripsi']; ?>" name="deskripsi" id="deskripsi">
                <p></p>Gambar:
                <input type="text" value="<?php echo $row['gambar']; ?>" name="gambar" id="gambar" >
                <input type="submit" name="edit" value="Simpan">
                <input type="button" style=" width: 20%; padding: 1em;
   											 margin: 1.5em 0;
   											 color: #888;
   											 background-color:#F33;
   											 border:none;
   											 color:#eee;
   											 border-bottom: 4px solid transparent;" 
                        			onClick="document.location='barang.php?tampil'" value="Kembali"  />
            </form>
        </fieldset>

    </div>
</body>
</html>
