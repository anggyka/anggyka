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
        <h2>Data Barang</h2>
        <div class="border-p"></div>
  <?php
//untuk memanggil koneksi database
include "../kon.php";
if (isset($_POST['simpan'])){
		$nama=$_POST['nama'];
		$hrg_5=$_POST['hrg_5'];
		$hrg_10=$_POST['hrg_10'];
		$hrg_20=$_POST['hrg_20'];
		$hrg_25=$_POST['hrg_25'];
		$hrg_30=$_POST['hrg_30'];
		$deskripsi=$_POST['deskripsi'];
		move_uploaded_file($_FILES['gambar']['tmp_name'], "gambar/".$_FILES['gambar']['name']);
	  $filename = $_FILES['gambar']['name'];
		
//Mencek data yang sama
$q =mysqli_query($con, "select * from tb_barang_new where nama_barang='$nama'") or die (mysql_error());
$k =mysqli_num_rows($q);
if ($k>0){
	echo "<script>alert('nama barang sudah ada, gagal disampan!!')</script>";
	}
	else{
	
//Proses simpan 
$query = mysqli_query($con, "insert into tb_barang_new (nama_barang,hrg_5,hrg_10,hrg_20,hrg_25,hrg_30,deskripsi,gambar) values ('$nama','$hrg_5','$hrg_10','$hrg_20','$hrg_25','$hrg_30','$deskripsi','$filename')") or die(mysqli_error());
if (!mysql_query($query)){
echo "<script>alert('Berhasil Disimpan.'); document.location='tbarang.php';</script>";
}else{
echo "<script>alert('Gagal Disimpan.'); document.location='tbarang.php';</script>"; 
	}
	
	}
	
}
?>
        <fieldset>
            <form method="post" name="tbarang" action="">
           		Nama Barang :
                <input type="text" name="nama" placeholder="Masukan Nama Barang" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" autofocus required>
                <p></p> Harga per 5 Liter :
                <input type="text" name="hrg_5" placeholder="Masukan Harga" opattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                 <p></p> Harga per 10 Liter :
                <input type="text" name="hrg_10" placeholder="Masukan Harga" opattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                 <p></p> Harga per 20 Liter :
                <input type="text" name="hrg_20" placeholder="Masukan Harga" opattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                 <p></p> Harga per 25 Liter :
                <input type="text" name="hrg_25" placeholder="Masukan Harga" opattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                 <p></p> Harga per 30 Liter :
                <input type="text" name="hrg_30" placeholder="Masukan Harga" opattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
                <p></p> Deskripsi :
                 <textarea type="text" name="deskripsi" placeholder="Masukan Deskripsi"></textarea>
                <p></p> Masukkan Gambar :
                <p></p><input type="file" name="gambar" /><p></p>
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
                        			onClick="document.location='barang.php?tampil'" value="Lihat Data"  />
            </form>
        </fieldset>
    </div>
</body>
</html>
