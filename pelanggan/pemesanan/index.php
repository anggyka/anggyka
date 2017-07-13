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
	<title>Pemesanan</title>
</head>
<style type="text/css">
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
		font-family: arial;
	}
	
.header {
	background-color: #2a333b;
	height: 55px;
}
.header-box {
	width: 1000px;
	margin: 0 auto;
	padding: 20px;
	font-size: 14px;
}
.header-logo {
	color: white;
	float: left;
	width: 400px;
}
.header-logo a { color: white; text-decoration: none }
.header-logo a:hover { color: #40aae6; }

.header-nav {
	color: white;
	float: right;
}
.header-nav a { color: white; text-decoration: none }
.header-nav a:hover { color: #40aae6; }
.header-nav ul {
	display: inline;
	list-style-type: none;
	padding: 0;
}
.header-nav li { float: left; padding-left: 50px; }

/*=========*/
	hr {
		border: 1px dotted black;
	}
	select {
		width: 390px;
	}
	input, select, button {
		padding: 5px;
		margin: 10px;
		float: left;
	}
	input[type='submit'], button {
		padding: 7px 40px;
		background-color: #8399ff;
		border: none;
		color: white;
		border-radius: 3px;
		cursor: pointer;
	}

	button {
		background-color: #ffa63c;
	}

	.pesan {
		background-color: #f1f1f1;
		margin: 20px 10px 10px 20px;
		width: 500px;
		height: 130px;
		padding: 10px;
		transition: .3s;
		float: left;
	}
	.pesan:hover {
		box-shadow: 0px 1px 5px black;
	}
	.keranjang {
		background-color: #f1f1f1;
		margin: 20px 10px 10px 20px;
		width: 500px;
		padding: 10px;
		transition: .3s;
		float: left;
	}
	.keranjang:hover {
		box-shadow: 0px 1px 5px black;
	}
	.sukses {
		display: block;
		margin: 10px 10px 10px 0px;
		font-size: 12px;
		padding: 6px 10px;
		background-color: #5bbf74;
		border: none;
		color: white;
		border-radius: 3px;
		float: left;
		animation: 3s suksesfade cubic-bezier(1, 0, 1, 0);
		opacity: 0;
	}

	@keyframes suksesfade {
		0% { opacity: 1 }
		100% { opacity: 0 }
	}

	.pesan_del {
		display: block;
		animation: 5s suksesdelete cubic-bezier(1, 0, 1, 0);
		opacity: 0;
	}
	@keyframes suksesdelete {
		0% { opacity: 1 }
		100% { opacity: 0 }
	}

	.item {
		color: #5f5f5f;
		font-size: 16px;
		width: 460px;
		margin-bottom: 5px;
		padding: 0px 20px 20px 20px;
	}
	.item .tgl {
		text-align: right;
		width: 100px;
		float: left;
	}
	.item .nama {
		padding-left: 10px;
		width: 266px;
		float: left;
	}
	.item .qty {
		padding-right: 10px;
		text-align: right;
		width: 40px;
		float: left;
	}
	.item .control {
		text-align: center;
		width: 17px;
		float: left;
	}
	.item .control a {
		text-decoration: none;
		color: #5f5f5f;
	}

	.item:hover {
		font-weight: bold;
		background-color: #d8d8d8;
		cursor: pointer;
	}

	.notfound {
		text-align: center;
		color: #d0d0d0;
	}

	h3 { padding: 0; }

	.total {
		text-align: right;
		font-size: 12px;
	}
	.angka {
		font-style: italic;
		text-align: right;
		font-size: 28px;
	}
	.l-1 { width: 20px; }
	.l-2 { width: 50px; }
	.l-3 { width: 100px; }
	.l-4 { width: 150px; }
	.l-5 { width: 200px; }
	.l-6 { width: 250px; text-overflow: ellipsis; white-space: nowrap; }
	.l-7 { width: 300px; text-overflow: ellipsis; white-space: nowrap; }
	.l-8 { width: 350px; text-overflow: ellipsis; white-space: nowrap; }

	.divkanan {
		float: right;
	}

	.popup_bg {
		display: none;
		width: 100%;
		height: 100%;
		background-color: hsla(0, 0%, 0%, 0.8);
		z-index: 2;
		position: absolute;
	}
	.popup_title {
		text-align: center;
		font-weight: bold;
		font-size: 18px;
		margin: 10px 0px 10px 0px;
	}
	.popup_wrapper {
		width: 400px;
		height: 580px;
		background-color: white;
		margin: 0 auto;
		padding: 10px;
		border-radius: 10px;
	}

	table {
		font-size: 14px;
		float: left;
	}

	.tb_blue { background-color: #e2e2ff }
	.tb_t_blue { background-color: #b6b6ff }

	.tb_green1 { background-color: #eafff0 }
	.tb_t_green1 { background-color: #b3ffc9 }

	.tb_green { background-color: #e2e2ff }
	.tb_t_green { background-color: #b6b6ff }

	.tb_orange { background-color: #fff0ab }

	.tb_green2 { margin: 10px 0px 10px 0px; color: green }

	.tbl_total {
		font-size: 18px;
		font-weight: bold;
	}
	table tr {
		height: 25px;
	}
	table tr:hover {
		background-color: #e8e8e8;
	}
	.destination_wrapper {
		margin-top: 20px;
		width: 400px;
		float: left;
	}
	.destination_label {
		font-size: 12px;
		padding-bottom: 5px;
	}
	.destination_input {
		margin-bottom: 10px;
	}
	.destination_input textarea {
		min-width: 390px;
		max-width: 390px;
		min-height: 50px;
		max-height: 50px;
	}
	.destination_input input {
		margin: 0;
		width: 380px;
		margin-bottom: 10px;
	}
	.pesan_del {
		background-color: #3fb93f;
		color: white;
		padding: 5px;
		text-align: center;
	}
</style>
<body>
<div class="header">
<div class="header-box">
			<div class="header-logo"><a href="../../index.php">DEPO AIR ISI ULANG BAMBANG</a></div>
			<div class="header-nav">
				<ul>
                    <li><a href="cek_pemesanan.php">Cek Pesanan</a></li>
					<li><a href="logout.php">Logout (<?php echo $np;?>)</a></li>
				</ul>
			</div>
		</div>
</div>
<?php
// include "../../kon.php"; #ini ga kepanggil

function produk() {
	include "../../kon.php"; #taro disini
	$q = mysqli_query($con, "SELECT nama_barang, hrg_20, id_barang FROM tb_barang_new");

	echo "<select name='produk' required>";
	if (mysqli_num_rows($q) >= 1) {
		echo "<option value='' selected>Pilih Produk...</option>";
		while ($d = mysqli_fetch_array($q)) {
			echo "<option value='".$d['nama_barang']."-".$d['hrg_20']."-".$d['id_barang']."'>Air Mineral ".$d['nama_barang']."</option>";
		}
	} else {
		echo "<option value='' selected>No data found.</option>";
	}
	echo "</select>";
}

function pesan() {
	if (isset($_GET['i'])) {
		switch ($_GET['i']) {
			case 'sukses':
				echo "<div class='pesan_del'>Barang #<strong>".$_GET['id']."</strong> Sukses Dihapus</div>";
				break;
			case 'ORDER_SUCCESSFULLY':
				echo "<div class='pesan_del'>Barang Telah Dipesan</div>";
		}

	}
}
pesan();
?>

<div class="pesan">
	Pesen barang<hr/>
		<form method="post">
			<?php produk() ?>
			<input class="l-2" type="number" name="qty" min="1" max="999" step="1" placeholder="QTY..." required>
			<input class="divkanan" type="submit" name="simpan" value="+ ke Keranjang Belanja">
		</form>

		<?php
		include"../../kon.php";

		if (isset($_POST['simpan'])) {
			$session 	= $_SESSION['pelanggan'];
			$get_id 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT id_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$session'"));
			$id 		= $get_id['id_pelanggan'];
			$prod 	 	= explode("-", $_POST['produk']);
			$id_brg 	= $prod[2];
			$harga 		= $prod[1];
			$nama 		= $prod[0];
			$qty 		= $_POST['qty'];
			$tgl 		= date("y-m-d H:i:s");

			mysqli_query($con,"INSERT INTO tb_keranjang_new (id_pelanggan, id_barang, harga_produk, qty_produk, tgl_produk) VALUES ('$id', '$id_brg', '$harga', '$qty', '$tgl')") or die (mysqli_error());
			echo "<div class='sukses' id='sukses'>&#10003; Sukses Ditambahkan</div>";

		}
		?>
</div>
<div class="keranjang">
	Keranjang Belanja<hr/>
	<?php
			$session 	= $_SESSION['pelanggan'];
			$get_id 	= mysqli_fetch_assoc(mysqli_query($con, "SELECT id_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$session'"));
			$id 		= $get_id['id_pelanggan'];
			$q 			= mysqli_query($con, "SELECT id_keranjang, id_barang, qty_produk, tgl_produk FROM tb_keranjang_new WHERE id_pelanggan='$id' ORDER bY tgl_produk ASC");

			if (mysqli_num_rows($q) >= 1) {
				
				while ($d = mysqli_fetch_array($q)) {
					$id 	= $d['id_keranjang'];
					$nama 	= $d['id_barang'];
					$qty 	= $d['qty_produk'];
					$stamp 	= $d['tgl_produk'];
					$nb 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_barang FROM tb_barang_new WHERE id_barang='$nama'"));
					$nm_brg = $nb['nama_barang'];
					$id_s 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT id_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$session'"));
					$ids	= $id_s['id_pelanggan'];
					
					$bln 	= array('', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des');
					$tgl_st	= explode(" ", $stamp);
					$tgl_t 	= explode("-", $tgl_st[0]);
					$tgl_j 	= explode(":", $tgl_st[1]);
					$tanggal= $tgl_t[1] . " " . $bln[3] . " " . $tgl_j[0] . ":" . $tgl_j[1];
					

					echo "	<div class='item'>
								<div class='list'>
									<div class='tgl'>" . $tanggal . "</div>
									<div class='nama'>" . ucfirst(strtolower($nm_brg)) . "</div>
									<div class='qty'>" . $qty . "</div>
									<div class='control'><a href='x.php?id_keranjang=".$id."'><strong>&#215;</strong></a></div>
								</div>
							</div>"
					;
				}
				$total = mysqli_fetch_assoc(mysqli_query($con,"SELECT (SUM(harga_produk * qty_produk) + SUM(qty_produk * 2000)) AS 'grand_total', SUM(harga_produk) AS 'total_harga', SUM(qty_produk) AS 'total_qty' FROM tb_keranjang_new WHERE id_pelanggan='$ids'"));

				echo "<hr/><div><div class='total'>total </div><div class='angka'>Rp ".number_format($total['grand_total'], 0, 0, '.').",- (".$total['total_qty']." Unit)</div></div>";
				echo "<input class='divkanan' type='submit' id='beli' name='beli' value='Checkout Barang'>";
			} else {
				echo "<div class='notfound'>List Tidak Ada</div>";
			}
	?>

</div>
<div class="popup_bg" id="popup">
	<div class="popup_wrapper">
		<div class="popup_title">Konfirmasi pembelian anda</div><br/>
		<table cellspacing='0' border='0' width='100%'>
		<?php
		include"../../kon.php";
		$session = $_SESSION['pelanggan'];
		$id_s 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT id_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$session'"));
		$ids	= $id_s['id_pelanggan'];
		
		$qget_qty 	= mysqli_query($con,"SELECT id_barang, sum(qty_produk) AS 'QTY' FROM tb_keranjang_new WHERE id_pelanggan='$ids' GROUP BY id_barang");
		$qget_s_qty = mysqli_query($con,"SELECT id_barang, sum(harga_produk * qty_produk) AS 'tot_s_qty' FROM tb_keranjang_new WHERE id_pelanggan='$ids' GROUP BY id_barang");
		$qget_t_qty = mysqli_fetch_assoc(mysqli_query($con,"SELECT sum(qty_produk) AS 'quantity' FROM tb_keranjang_new WHERE id_pelanggan='$ids'"));
		$qget_s_gln = mysqli_fetch_assoc(mysqli_query($con,"SELECT sum(harga_produk * qty_produk) AS 'galon' FROM tb_keranjang_new WHERE id_pelanggan='$ids'"));
		$qget_s_ogk = mysqli_fetch_assoc(mysqli_query($con,"SELECT sum(2000 * qty_produk) AS 'ongkir' FROM tb_keranjang_new WHERE id_pelanggan='$ids'"));
		$qget_grand = mysqli_fetch_assoc(mysqli_query($con,"SELECT ((sum(qty_produk) * 2000) + sum(harga_produk * qty_produk)) AS 'grand' FROM tb_keranjang_new WHERE id_pelanggan='$ids'"));	   
		$qget_info 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_pelanggan, alamat_pelanggan, hp_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$session'"));
		
		echo "<form method='post'>";
		
		if (mysqli_num_rows($qget_qty) >= 1) {
			while ($dqty = mysqli_fetch_array($qget_qty)) {
			$nama	= $dqty['id_barang'];
			$nb 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_barang FROM tb_barang_new WHERE id_barang='$nama'"));
			$nm_brg = $nb['nama_barang'];
		echo "
			<tr class='tb_blue'>
				<td class='l-6'>Unit ".$nm_brg."<input type='hidden' name='".$dqty['id_barang']."' value='".$dqty['QTY']."'></td>
				<td align='right'>".$dqty['QTY']."</td>
			</tr>
				";
			}
		}
		echo "
			<tr class='tb_t_blue'>
				<td>Total Unit Pembelian</td>
				<td align='right'>".$qget_t_qty['quantity']."</td>
			</tr>";
		if (mysqli_num_rows($qget_s_qty) >= 1) {
			while ($dqty = mysqli_fetch_array($qget_s_qty)) {
			$nama	= $dqty['id_barang'];
			$nb 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_barang FROM tb_barang_new WHERE id_barang='$nama'"));
			$nm_brg = $nb['nama_barang'];
				echo "
			<tr class='tb_green1'>
				<td class='l-6'>sub-total ".$nm_brg." (Rp)</td>
				<td align='right'>".number_format($dqty['tot_s_qty'], 0, 0, '.')."</td>
			</tr>
				";
			}
		}
		echo "
			<tr class='tb_t_green1'>
				<td>sub-total Unit yang dibeli (Rp)</td>
				<td align='right'>".number_format($qget_s_gln['galon'], 0, 0, '.')."</td>
			</tr>";
		echo "
			<tr class='tb_orange'>
				<td>Ongkos Kirim (Rp)</td>
				<td align='right'>".number_format($qget_s_ogk['ongkir'], 0, 0, '.')."</td>
			</tr>";
		echo "
			<tr class='tb_green2'>
				<td class='tbl_total'>Grand Total (Rp)</td>
				<td class='tbl_total' align='right'>".number_format($qget_grand['grand'], 0, 0, '.')."</td>
			</tr>";
		echo "
			</table>
			<div class='destination_wrapper'>
				<div class='destination_label'>Nama Pengirim</div>
				<div class='destination_input'><input type='text' name='nama' value='" . $qget_info['nama_pelanggan'] . "' placeholder='Nama Lengkap...' required></div>
				<div class='destination_label'>Nama Pengirim</div>
				<div class='destination_input'><textarea name='alamat' placeholder='ALamat Lengkap...' required>" . $qget_info['alamat_pelanggan'] . "</textarea></div>
				<div class='destination_label'>No. HP Pengirim</div>
				<div class='destination_input'><input type='text' name='nohp' placeholder='Nomer Ponsel... (08xxxxx)' value='" . $qget_info['hp_pelanggan'] . "' required></div>
				<button id='cancel'>Cancel</button>
				<input type='submit' name='sayapesan' style='float: right;' value='Beli pesanan sekarang'>
			</div>
		";
		echo "</form>";
		?>
		
		<?php
			if (isset($_POST['sayapesan'])) {
				$session 	  = $_SESSION['pelanggan'];
				$get_id 	  = mysqli_fetch_assoc(mysqli_query($con,"SELECT id_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$session'")) or die (mysqli_error());
						$id   = $get_id['id_pelanggan'];
						$konv = $_POST['3'];
						$ozon = $_POST['1'];
						$ro   = $_POST['2'];
						$nama = $_POST['nama'];
						$alam = $_POST['alamat'];
						$nohp = $_POST['nohp'];
						$tgl  = date("y-m-d H:i:s");

				echo "<script>window.location.href='order.php?i=".$id."&k=".$konv."&o=".$ozon."&r=".$ro."&n=".$nama."&a=".$alam."&no=".$nohp."'</script>";
			}
		?>
	</div>
</div>
<script type="text/javascript">
	var tombol 	= document.getElementById('beli');
	var popup 		= document.getElementById('popup');
	var cancel 	= document.getElementById('cancel');

	tombol.onclick = function() { popup.style.display = "block"; }
	cancel.onclick = function() { popup.style.display = "none"; }
</script>
</body>
</html>