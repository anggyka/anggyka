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
        </div><body>
    <div id="login">
        <h2>Data Pelanggan</h2>
        <div class="border-p"></div>
<?php
include "../kon.php";
		
$edit=$_GET['edit'];

//menampilkan data yang sudah di input
$q =mysqli_query($con, "SELECT * FROM tb_keluar WHERE kode_pengeluaran='$edit'") or die (mysqli_error());
$row=mysqli_fetch_array($q);

if (isset($_POST['edit'])){
//mengirim data dari form	
		$kode_pengeluaran=$_POST['kode_pengeluaran'];
		$jenis_pengeluaran=$_POST['jenis_pengeluaran'];
	
//Proses update
$query = mysqli_query($con, "update tb_keluar set jenis_pengeluaran='$jenis_pengeluaran' where kode_pengeluaran='$kode_pengeluaran'") or die(mysqli_error());
if (!mysqli_query($query)){
//jika berhasil maka tampil validasi ini dan kembali kehalaman index.php	
echo "<script>alert('Berhasil Dirubah.'); document.location='keluar.php';</script>";
}else{
//jika gagal akan tampil validasi ini dan kembali kehalaman index.php
echo "<script>alert('Gagal Dirubah'); document.location='keluar.php';</script>"; 
	}
	
	
}


?>

<fieldset>
            <form method="post" name="tpelanggan" action="">
            Kode Pengeluaan:
                <p></p><input type="text" value="<?php echo $row['kode_pengeluaran']; ?>" name="kode_pengeluaran" id="kode_pengeluaran" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" readonly required>
            <p></p>Jenis Pengeluaran:
                <input type="text" value="<?php echo $row['jenis_pengeluaran']; ?>" name="jenis_pengeluaran" id="jenis_pengeluaran" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" autofocus required>
                <input type="submit" name="edit" value="Simpan">
                <input type="button" style=" width: 20%; padding: 1em;
   											 margin: 1.5em 0;
   											 color: #888;
   											 background-color:#F33;
   											 border:none;
   											 color:#eee;
   											 border-bottom: 4px solid transparent;" 
                        			onClick="document.location='keluar.php?tampil'" value="Kembali"  />
            </form>
        </fieldset>

    </div>
</body>
</html>
