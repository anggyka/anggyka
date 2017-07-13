<!DOCTYPE html>
<?php
include "kon.php";
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
	<link rel="stylesheet" type="text/css" href="css/halaman_admin.css">
</head>
<body>
	<div class="wrap">
<div class="menu">
<ul>
<li><a href="logout.php">Logout&nbsp;&nbsp;(<?php echo $nd;  ?>)</a></li>
</ul>
<nav>
<ul>
<li><a href="index.php">Depo Air Isi Ulang Bambang</a>
</li>  
</nav>
		</div>
        </div>
		<div class="badan">			
			<div id='cssmenu'>
<ul>
   <li><b><span><img src="img/user-icon.png" width="150" height="150"></span></b></li>
   <li class='active has-sub'><a href='#'><span>--<?php echo $nd; ?>--</span></a></li>
   <li><a href='#'><span>Master</span></a>
    <ul>
         <li class='has-sub'><a href='daftar.php'><span>Admin</span></a>
         </li>
         <li class='has-sub'><a href='master/tpelanggan.php'><span>User</span></a>
         </li>
         <li class='has-sub'><a href='master/tbarang.php'><span>Barang</span></a>
         </li>
         <li class='has-sub'><a href='master/tkeluar.php'><span>Keluar</span></a>
         </li>
      </ul>
   </li>
   <li class='last'><a href='#'><span>Transaksi</span></a>
  	 <ul>
   		<li class='has-sub'><a href='transaksi/kasir.php'><span>Penjualan</span></a>
         </li>
        <li class='has-sub'><a href='transaksi/tpengeluaran.php'><span>Pengeluaran</span></a>
         </li>
        <li class='has-sub'><a href='transaksi/sms.php'><span>SMS</span></a>
         </li>
  	 </ul>
   </li>
    <li class='last'><a href='#'><span>Laporan</span></a>
  	 <ul>
   		<li class='has-sub'><a href='laporan/laporan3.php'><span>Pendapatan</span></a>
         </li>
  	 </ul>
   </li>
</ul>
</div>
<div id="login">
<h3>Administrator Depo air isi ulang bambang</h3>
<h4>Admin <?php echo $nd;  ?></h4>
 </div>
 <div id="login2">
<div class="box-icon"><div class="icon" id="icon1" style="background-image: url('img/order.png');"><div class="angka" id="pemesanan"></div></div><div class="label">Orderan</div></div>
<div class="box-icon"><div class="icon" id="icon2" style="background-image: url('img/kategori.png');"><div class="angka" id="kategori"></div></div><div class="label">Kategori</div></div>
<div class="box-icon"><a href=""><div class="icon" id="icon3" style="background-image: url('img/sms.jpg');"><div class="angka" id="sms"></div></div></a><div class="label">SMS</div></div>


<div class="bg-pesanan" id="bg-pesanan">
	<div class="listpesanan">
		<div class="header" style="background-color: #c37300"><span>Orderan</span><span class="close" id="c1">X</span></div>
		<div class="box-pesanan">
			<div id="listpesanan" class="table"></div>
		</div>
	</div>	
</div>

<div class="bg-pesanan" id="bg-kategori">
	<div class="listpesanan">
		<div class="header" style="background-color: #27ae60"><span>Kategori</span><span class="close" id="c2">X</span></div>
		<div class="box-pesanan">
			<div id="listkategori"></div>
		</div>
	</div>	
</div>

<div class="bg-pesanan" id="bg-sms">
	<div class="listpesanan">
		<div class="header" style="background-color: #27ae60"><span>SMS</span><span class="close" id="c3">X</span></div>
		<div class="box-pesanan">
			<div id="listsms"></div>
		</div>
	</div>	
</div>


<script src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	function countOrderan(){
		$('#pemesanan').load('update.php?i=count_orderan');
	} setInterval( "countOrderan()", 1000 );

	function updatelistpemesanan() {
		$('#listpesanan').load('update.php?i=list_orderan');
	} setInterval( "updatelistpemesanan()", 1000 );

	function listkategori() {
		$('#listkategori').load('update.php?i=list_kategori');
	} setInterval( "listkategori()", 1000 );

</script>

<script type="text/javascript">
	var ico1 	= document.getElementById('icon1');
	var ico2 	= document.getElementById('icon2');
	var ord 	= document.getElementById('bg-pesanan');
	var kat 	= document.getElementById('bg-kategori');
	var c1 	= document.getElementById('c1');
	var c2 	= document.getElementById('c2');
	
	ico1.onclick = function() { ord.style.display = 'block' }
	c1.onclick = function() { ord.style.display = 'none' }

	ico2.onclick = function() { kat.style.display = 'block' }
	c2.onclick = function() { kat.style.display = 'none' }
	
</script>

 </div>
		</div>


 <div id="login3">
<h3>  <SCRIPT language=JavaScript>var d = new Date();
var h = d.getHours();
if (h < 11) { document.write('Selamat pagi, Admin...'); }
else { if (h < 15) { document.write('Selamat siang, Admin...'); }
else { if (h < 19) { document.write('Selamat sore, Admin...'); }
else { if (h <= 23) { document.write('Selamat malam, Admin...'); }
}}}</SCRIPT></h3>
<h4><script type="text/javascript">        
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
    var waktu = new Date();            //membuat object date berdasarkan waktu saat 
    var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
    var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
    var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
<?php
$hari = date('l');
/*$new = date('l, F d, Y', strtotime($Today));*/
if ($hari=="Sunday") {
 echo "Minggu";
}elseif ($hari=="Monday") {
 echo "Senin";
}elseif ($hari=="Tuesday") {
 echo "Selasa";
}elseif ($hari=="Wednesday") {
 echo "Rabu";
}elseif ($hari=="Thursday") {
 echo("Kamis");
}elseif ($hari=="Friday") {
 echo "Jum'at";
}elseif ($hari=="Saturday") {
 echo "Sabtu";
}
?>,
<?php
$tgl =date('d');
echo $tgl;
$bulan =date('F');
if ($bulan=="January") {
 echo " Januari ";
}elseif ($bulan=="February") {
 echo " Februari ";
}elseif ($bulan=="March") {
 echo " Maret ";
}elseif ($bulan=="April") {
 echo " April ";
}elseif ($bulan=="May") {
 echo " Mei ";
}elseif ($bulan=="June") {
 echo " Juni ";
}elseif ($bulan=="July") {
 echo " Juli ";
}elseif ($bulan=="August") {
 echo " Agustus ";
}elseif ($bulan=="September") {
 echo " September ";
}elseif ($bulan=="October") {
 echo " Oktober ";
}elseif ($bulan=="November") {
 echo " November ";
}elseif ($bulan=="December") {
 echo " Desember ";
}
$tahun=date('Y');
echo $tahun;
?>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">        
<span id="clock"></span> 
</h4>
 </div>
		<div class="clear"></div>
		<div class="footer">
		<div class="footer-box">
			<div class="footer-text">Hak Cipta &copy; 2017<br/>DEPO AIR ISI ULANG BAMBANG<br/>JL. SUPRAPTO NO.43 SAMPIT KAL-TENG</div>
		</div>
	</div>
	</div>
</body>
</html>