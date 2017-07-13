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
    <link rel="stylesheet" href="../css/admin2.css">
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
        <h2>Kasir Penjualan</h2>
        <div class="border-p"></div>
<?php
include "../kon.php";
		$id_barang=date("id_barang");
?>

<form method="post">
	<select name="id_barang" id="id_barang" class='form-control' required>
	<option value="" selected>Nama Barang...</option>
	<?php
	$q = mysqli_query($con, "SELECT id_barang, nama_barang FROM tb_barang_new");
	if (mysqli_num_rows($q) > 0) {
		while ($d = mysqli_fetch_array($q)) {
			echo "<option value=" . $d['id_barang'] . ">" . $d['nama_barang'] . "</option>";
		}
	} else {
		echo "<option>NO DATA</option>";
	}

	?>
      </select>
    <select name="liter" required>
    	<option value="">Liter...</option>
    	<option value="hrg_5">5 Liter</option>
    	<option value="hrg_10">10 Liter</option>
    	<option value="hrg_20">20 Liter</option>
    	<option value="hrg_25">25 Liter</option>
    	<option value="hrg_30">30 Liter</option>
    </select>
	<input type="number" name="jumlah" style="width: 50px;" placeholder="Qty..." min="1" max="999" step="1" required>
	<input type="submit" name="sbt" value="+ Pesanan">
</form>
<?php
include "../kon.php";
// SELECT nama, hrg_20  FROM `tb_barang_new` WHERE nama='RO'
if (isset($_POST['sbt'])) {
	date_default_timezone_set('Asia/Jakarta');
	$tgl 		= date("y-m-d H:i:s");
	$idresi 	= rand(1000000000, 9999999999);
	$nama 		= $_POST['id_barang'];
	$x 			= $_POST['liter'];
	$l 			= explode('_', $_POST['liter']);
	$liter 		= $l[1];
	$galon 		= $_POST['jumlah'];
	$qHarga 	= mysqli_query($con, "SELECT $x FROM tb_barang_new WHERE id_barang='$nama'") or die (mysqli_error());
	$dHarga 	= mysqli_fetch_assoc($qHarga);
	$harga 		= $dHarga[$x];
	$sub 		= $galon * $harga;

	mysqli_query($con, "INSERT INTO resi_new (id_resi, tgl, id_barang, liter, galon, harga, sub) VALUES ('$idresi', '$tgl', '$nama', '$liter', '$galon', '$harga', '$sub')") or die (mysqli_error());
}

	$datarow = mysqli_query($con, "SELECT * FROM resi_new");
	if (mysqli_num_rows($datarow) > 0) {
		$get	= mysqli_query($con, "SELECT * FROM resi_new ORDER BY tgl ASC");

		$rand_id = rand(0,1000000);
		$no = 1;
	echo "<p>
		<form method='post'>
		<input type='hidden' style='width:60px' name='idresi' value='" . $rand_id . "' readonly>
		<table cellspacing='0' border='1'>
			<tr>
				<td>No.</td>
				<td>TANGGAL</td>
				<td>ID ITEM</td>
				<td>LITER</td>
				<td>QUANTITY</td>
				<td>HARGA</td>
				<td>SUBTOTAL</td>
			</tr>";

	while ($resi = mysqli_fetch_array($get)) {
		$id 	= $resi['id_resi'];
		$tgl 	= $resi['tgl'];
		$nama 	= $resi['id_barang'];
		$liter 	= $resi['liter'];
		$galon 	= $resi['galon'];
		$harga 	= "Rp ".number_format($resi['harga'], 0, ',', '.').",-";
		$stotal = "Rp ".number_format($resi['sub'], 0, ',', '.').",-";
		$nb 	= mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_barang FROM tb_barang_new WHERE id_barang='$nama'"));
		$nm_brg = $nb['nama_barang'];
		
	
		echo "
		<tr>
			<td>". $no ."</td>
			<td><input type='text' style='width:100px' name='tgl' value='" . $tgl . "' readonly></td>
			<td><input type='text' style='width:150px' name='nama' value='" . $nm_brg . "' readonly></td>
			<td><input type='text' style='width:150px' name='liter' value='" . $liter . "' readonly></td>
			<td><input type='text' style='width:65px' name='gln' value='" . $galon . "' readonly></td>
			<td><input type='text' style='width:100px' name='hrg' value='" . $harga . "' readonly></td>
			<td><input type='text' style='width:100px' name='stotal' value='" . $stotal . "' readonly></td>
			<td><button><a href='x.php?id_resi=" . $id . "'>Hapus Resi</a></button></td>
		</tr>";
		$no++;
	
	}
	echo "</table>";
	$total_q = mysqli_query($con, "SELECT SUM(sub) AS total FROM resi_new");
	while ($data = mysqli_fetch_assoc($total_q)) {
		$angka 	= number_format($data['total'], 0, ',', '.');
		echo "<div class='total-wrapper'>Total<span class='total-bill'>Rp ".$angka.",- </span></div><hr/>";
	}
	echo " <input type='submit' name='simpan' value='Simpan' class='save-invoice'></form>";

	if (isset($_POST['simpan'])) {
		$id_resi 	= rand(1000000000, 9999999999);
		
		// memindahkan data RESI ke dalam tabel PENJUALAN
		mysqli_query($con, "INSERT INTO tb_penjualan_new (id_resi, tgl, id_barang, liter, galon, harga, sub) SELECT * FROM resi_new") or die (mysql_error());

		// memasukkan ID RESI
		mysqli_query($con, "UPDATE tb_penjualan_new SET id_transaksi='$id_resi' WHERE id_transaksi='0'");

		// menghapus DATA RESI
		mysqli_query($con, "TRUNCATE resi_new");

		echo "<script>window.alert('Resi akan segera diproses');window.location='proses.php'</script>";
	}
} else {
	echo "Tidak ada data resi!";
}

		
?>
</div>
</body>
</html>