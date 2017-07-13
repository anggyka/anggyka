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
    <title>Input Data Laporan</title>
    <!-- Untuk CSS ditaruh pada file style.css, sehingga perlu dipanggil code ini -->
    <link rel="stylesheet" href="../css/admin2.css">
</head>
<style type="text/css">
.caritanggal {
	display: none;
}
.carijangka {
	display: none;
}
</style>
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
        <h2>laporan <p>Depo Air Isi Ulang Bambang</h2>
        <div class="border-p"></div>
        
<button id="butTGL" style=" 
    padding: 0.5em;
    margin: 1.5em 0;
    color: #888;
    background-color:#00cdb1 ;
    border:none;
    color:#eee;
    border-bottom: 4px solid transparent;    ">Cari Berdasarkan Tanggal (Eksak)</button>
<button id="butJGK" style="
    width: 20%;
    padding: 0.5em;
    margin: 1.5em 0;
    color: #888;
    background-color:#00cdb1 ;
    border:none;
    color:#eee;
    border-bottom: 4px solid transparent;">Cari Berdasarkan Jangka</button><p>
<div class="caritanggal" id="idTanggal">
	<form method="post">
    Dari Tanggal
		<input type="date" name="tanggal" id="tgl">&nbsp;&nbsp;
        Sampai Dengan Tanggal
        <input type="date" name="tanggal_s" id="tanggal_s">
		<input type="submit" name="caritgl" value="Cari">
	</form>
</div>
<div class="carijangka" id="idJangka">
	<form method="post">
	<select name="jangka">
		<option value="">...</option>
		<option value="DAY">Hari</option>
		<option value="WEEK">Minggu</option>
		<option value="MONTH">Bulan</option>
		<option value="YEAR">Tahun</option>
	</select>
		<input type="submit" name="carijgk" value="Cari">
	</form>
</div>

<?php include"../kon.php"; laporanTanggal(); laporanJangka();

function laporanTanggal() {
	if (isset($_POST['caritgl'])) {
		$date =$_POST['tanggal'];
		$cls_date = new DateTime($date);
		$tanggal = $cls_date->format('Y-m-d');
		$date_s =$_POST['tanggal_s'];
		$cls_date_s = new DateTime($date_s);
		$tanggal_s = $cls_date_s->format('Y-m-d');
		// $sekarang= "20" . date('y-m-d');
		
		$q = mysql_query("SELECT tgl, id_barang, liter, galon, harga, sub FROM tb_penjualan_new WHERE tgl between '$tanggal' AND '$tanggal_s'");
		$q2 = mysql_query("SELECT SUM(sub) AS 'total' FROM tb_penjualan_new WHERE tgl BETWEEN '$tanggal' AND '$tanggal_s'");
		$t = mysql_fetch_assoc($q2);
		echo "<center>Pencarian Berdasarkan tanggal <strong>" . $tanggal . " </strong> Sampai tanggal <strong>" . $tanggal_s . " : </center></strong><p>";
		echo "<center><strong>Laporan Penjualan : </center></strong>";
		$total = $t['total'];		
echo "
	<table border=1 align=center>  <tr>
    <th> tgl</th>
    <th> id_barang  </th>
    <th> Jumlah liter </th>
	<th> Jumlah galon </th>
    <th> harga</th>
    <th> subtotal</th>
    </tr>";
	while ($d = mysqli_fetch_array($q)) {
			if (mysqli_num_rows($q) == 0) {
				echo "Tidak ada data.";
			} else {
				$tgl 	= $d['tgl'];
				$nama 	= $d['id_barang'];
				$jml_liter 	= $d['liter'];
				$jml_galon 	= $d['galon'];
				$harga 	= $d['harga'];
				$sub 	= $d['sub'];				
				echo "
				<tr valign=top>
				<td>" . $tgl . "</td>
				<td>" . $nama . "</td>
				<td>" . $jml_liter . "</td>
				<td>" . $jml_galon . "</td>
				<td>" . $harga . "</td>
				<td>" . $sub . "</td>
				</tr>";
			}
		}
		echo "</table>";
		echo "<center>TOTAL : <strong>" . $total . "</center></strong><br/><p>";
		$penj = $total;
		
		$q = mysqli_query($con, "SELECT tgl_k, kode_pengeluaran, jumlah_k, harga_k, total_k FROM tb_pengeluaran WHERE tgl_k between '$tanggal' AND '$tanggal_s'");
		$q2 = mysqli_query($con, "SELECT SUM(total_k) AS 'total' FROM tb_pengeluaran WHERE tgl_k BETWEEN '$tanggal' AND '$tanggal_s'");
		$t = mysqli_fetch_assoc($q2);
		echo "<center><strong>Laporan Pengeluaran : </center></strong>";
		$total = $t['total'];		
echo "
	<table border=1 align=center>  <tr>
    <th> tgl</th>
    <th> kode jenis  </th>
    <th> jml </th>
    <th> harga</th>
    <th> subtotal</th>
    </tr>";
	while ($d = mysqli_fetch_array($q)) {
			if (mysqli_num_rows($q) == 0) {
				echo "Tidak ada data.";
			} else {
				$tgl 	= $d['tgl_k'];
				$jns 	= $d['kode_pengeluaran'];
				$jml 	= $d['jumlah_k'];
				$hrg 	= $d['harga_k'];
				$tot 	= $d['total_k'];				
				echo "
				<tr valign=top>
				<td>" . $tgl . "</td>
				<td>" . $jns . "</td>
				<td>" . $jml . "</td>
				<td>" . $hrg . "</td>
				<td>" . $tot . "</td>
				</tr>";
			}
		}
		echo "</table>";
		echo "<center>TOTAL : <strong>" . $total . "</center></strong><br/>";
		$peng = $total;
		
		$hasil = $penj - $peng;
		echo "<center>TOTAL PENDAPATAN : <strong>" . $hasil . "</center></strong><br/>";
	}
}
		
		
function laporanJangka() {
	if (isset($_POST['carijgk'])) {
		$jangka = $_POST['jangka'];
		$q = mysqli_query($con, "SELECT * FROM tb_pengeluaran WHERE tgl_k BETWEEN SUBDATE(CURDATE(), INTERVAL 1 $jangka) AND NOW()");
		echo "Pencarian Berdasarkan <strong>" . $jangka . "</strong> : <br/> hari ini : <p>";
		while ($d = mysqli_fetch_array($q)) {
			if (mysqli_num_rows($q) == 0) {
				echo "Tidak ada data";
			} else {
				$tgl 	= $d['tgl_k'];
				$jns 	= $d['kode_pengeluaran'];
				$jml 	= $d['jumlah_k'];
				$hrg 	= $d['harga_k'];
				$tot 	= $d['total_k'];
				echo $tgl . " | " . $jns . " | " . $jml . " | " . $hrg . " | " . $tot . " | <br/>";
			}
			}
	}
}






function angka() {
	$berapa = 10;
	for ($i=$berapa; $i >= 1; $i--) { 
		echo "<option value='".$i."'>".$i."</option>";
	}
}
?>

<script type="text/javascript">
	var bTanggal 	= document.getElementById('butTGL');
	var lTanggal 	= document.getElementById('idTanggal');

	var bJangka 	= document.getElementById('butJGK');
	var lJangka 	= document.getElementById('idJangka');

	bTanggal.onclick = function() {
		lTanggal.style.display = "block";
		lJangka.style.display = "none";
	}

	bJangka.onclick = function() {
		lTanggal.style.display = "none";
		lJangka.style.display = "block"
	}
</script>
</div>

</div>
</body>
</html>