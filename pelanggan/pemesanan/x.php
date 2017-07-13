<?php
include"../../kon.php";
session_start();
if (!isset($_SESSION['pelanggan'])){
header ("location:login.php");
}

$get_id		= $_GET['id_keranjang'];
$username	= $_SESSION['pelanggan'];

$q_id 		= mysql_fetch_assoc(mysql_query("SELECT id_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$username'")) or die (mysql_error());
$id_user 	= $q_id['id_pelanggan'];

$q_delete	= mysql_query("DELETE FROM tb_keranjang_new WHERE id_keranjang='$get_id' AND id_pelanggan='$id_user'") or die (mysql_error());
echo "<script>window.location.href='index.php?id=".$get_id."&i=sukses'</script>";
