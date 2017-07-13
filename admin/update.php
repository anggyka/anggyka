<?php
include"kon.php";

$id 	= $_GET['i'];

switch ($id) {
	case 'count_orderan':
		$q = mysqli_query($con, "SELECT status FROM tb_pemesanan_new WHERE status='Belum Diproses'");
		echo mysqli_num_rows($q);
		break;

	case 'list_orderan':
		$q = mysqli_query($con, "SELECT * FROM tb_pemesanan_new WHERE status='Belum Diproses'");

		if (mysqli_num_rows($q) == 0) {
			echo "Tidak ada pesanan";
		} else {

			echo "
					<table cellspacing='0'>
						<tr>
							<td>No.</td>
							<td></td>
							<td>Id Pemesan</td>
							<td>Nama Pemesan</td>
							<td>OZON</td>
							<td>RO</td>
							<td>CONV.</td>
							<td>Action</td>
						</tr>
			";
			$no 	= 1;
			while ($d = mysqli_fetch_array($q)) {
				$idp 	= $d['id_pemesanan'];
				$nama 	= $d['id_pelanggan'];
				$ozon 	= $d['ozon'];
				$ro 	= $d['ro'];
				$conv	= $d['conv'];
				$nb 	= mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_pelanggan FROM tb_pelanggan_new WHERE id_pelanggan='$nama'"));
					$nm_pl = $nb['nama_pelanggan'];

				echo "

						<tr>
							<td>".$no."</td>
							<td></td>
							<td>".$nama."</td>
							<td>".$nm_pl."</td>
							<td>".$ozon."</td>
							<td>".$ro."</td>
							<td>".$conv."</td>
							<td><a href='update.php?i=confirm&id=".$idp."'><button>Confirm</button></a><a href='update.php?i=delete&id=".$idp."'><button>Delete</button></a></td>
						</tr>
				";
				$no++;
			}

			echo "</table>";
		}
	break;
	
	case 'confirm':
		$id = $_GET['id'];
		if(!isset($id)) {
			echo "anda tidak melakukan apapun";
		} else {
			$q = mysqli_query($con, "SELECT status FROM tb_pemesanan_new WHERE id_pemesanan='$id'");
			if(mysqli_num_rows($q) == 0) {
				echo "Tidak ada data";
			} else {
				mysqli_query($con, "UPDATE tb_pemesanan_new SET status = 'Selesai' WHERE id_pemesanan='$id'");
				echo header("location: index.php?e=SUKSES#bg-pesanan");
			}
		}

	break;

	case 'delete':
		$id = $_GET['id'];
		if(!isset($id)) {
			echo "anda tidak melakukan apapun";
		} else {
			$q = mysqli_query($con, "SELECT status FROM tb_pemesanan_new WHERE id_pemesanan='$id'");
			if(mysqli_num_rows($q) == 0) {
				echo "Data tidak ditemukan";
			} else {
				mysqli_query($con, "DELETE FROM tb_pemesanan_new WHERE id_pemesanan='$id'");
				echo header("location: index.php?e=SUKSES_DELETE#bg-pesanan");
			}
		}
	break;

	case 'list_kategori':
		$q = mysqli_query($con, "SELECT nama_barang, deskripsi, gambar FROM tb_barang_new ORDER BY nama_barang ASC");
		if (mysqli_num_rows($q) == 0) {
			echo "tidak ada data";
		} else {
			while ($d = mysqli_fetch_array($q)) {
				echo "
					<div class='bar'>
						<div class='col-1'>
						<div class='gambar'>ini gambar</div>
						</div>
						<div class='col-2'>
							<div class='nama'>".$d['nama_barang']."</div>
							<div class='deskripsi'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
						</div>
					</div>
				";
			}
		}
	break;

	default:
		echo "No data!";
		break;
}
?>

<!-- 						<div class='col-1'>
							<div class='gambar'>".$d['gambar']."</div>
						</div>
						<div class='col-2'>
							<div class='nama'>".$d['nama']."</div>
							<div class='deskripsi'>".$d['deskripsi']."</div> -->