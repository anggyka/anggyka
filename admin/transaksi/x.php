<?php 
include"../kon.php";
$id = $_GET['id_resi'];

mysql_query("DELETE FROM resi_new WHERE id_resi = '$id'");
header("location: kasir.php#SUKSES_HAPUS");
?>