<?php
include"../../kon.php";
$tgl  		= date("y-m-d H:i:s");
$id 		= $_GET['i'];
$konv 		= $_GET['k'];
$ozon 		= $_GET['o'];
$ro 		= $_GET['r'];
$nama			= $_GET['n'];
$alamat			= $_GET['a'];
$nohp			= $_GET['no'];
$status 	= "Belum Diproses";


// echo $id . "<br/>";
// echo $konv . "<br/>";
// echo $ozon . "<br/>";
// echo $ro . "<br/>";
// echo $nama . "<br/>";
// echo $alamat . "<br/>";
// echo $nohp . "<br/>";
if (isset($konv) && isset($ozon) && isset($ro) && isset($nama) && isset($alamat) && isset($nohp)) {
	mysqli_query($con,"INSERT INTO tb_pemesanan_new (tgl_pemesanan, id_pelanggan, ozon, ro, conv, status) VALueS ('$tgl', '$id', '$ozon', '$ro', '$konv', '$status')") or die (mysql_error());
	mysqli_query($con,"DELETE FROM tb_keranjang_new WHERE id_pelanggan='$id'");
	echo "<script>window.location.href='index.php?i=ORDER_SUCCESSFULLY'</script>";
} else {
	echo "DATA Tydac Lengkap";
}