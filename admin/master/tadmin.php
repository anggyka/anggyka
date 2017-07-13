<!DOCTYPE html>
<?php
include "../kon.php";
session_start();
if (!isset($_SESSION['admin'])){
header ("location:login_admin.php");
}
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
<li><a href="index.php">Home</a></li>
<li><a href="logout.php">Logout&nbsp;&nbsp;(<?php echo $_SESSION['admin'];  ?>)</a></li>
</ul>
<nav>
<ul>
<li><a href="../index.php">Depo Air Isi Ulang Bambang</a>
</li>  
</nav>
		</div>
        </div>
<body>
    <div id="login">
        <h2>Data Admin</h2>
        <div class="border-p"></div>
         <?php
include "../kon.php";
//untuk memanggil koneksi database
if (isset($_POST['simpan'])){
		$nama_admin=$_POST['nama_admin'];
		$username_admin=$_POST['username_admin'];
		$email_admin=$_POST['email_admin'];
		$alamat_admin=$_POST['alamat_admin'];
		$hp_admin=$_POST['hp_admin'];
		$pass=$_POST['pass'];
		
//Mencek data yang sama
$q =mysql_query("select * from tb_admin where username_admin='$username_admin'") or die (mysql_error());
$k =mysql_num_rows($q);
if ($k>0){
	echo "<script>alert('username sudah ada, gagal disampan!!')</script>";
	}
	else{
	
//Proses simpan 
$query = mysql_query("insert into tb_admin (nama_admin,username_admin,alamat_admin,hp_admin,pass) values ('$nama_admin','$username_admin','$alamat_admin','$hp_admin','$pass')") or die(mysql_error());
if (!mysql_query($query)){
echo "<script>alert('Berhasil Disimpan.'); document.location='tadmin.php';</script>";
}else{
echo "<script>alert('Gagal Disimpan.'); document.location='tadmin.php';</script>"; 
	}
	
	}
	
}
?>
        <fieldset>
            <form method="post" name="tadmin" action="">
            Nama Lengkap:
                <input type="text" name="nama_admin" placeholder="Masukan Nama Lengkap Anda" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" autofocus required>
            <p></p> Username :
                <input type="text" name="username_admin" placeholder="Masukan Username" required>
                <p></p> Email :
                <input type="email" name="email" placeholder="Masukan Email" required>
            <p></p>Alamat :
                <textarea type="text" name="alamat_admin" placeholder="Masukan Alamat Anda" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required></textarea>
            <p></p>Nomor Hp :
                <input type="text" name="hp_admin" placeholder="Masukan Nomor HP (08xxx)" pattern="[0.0-9.0]+" oninvalid="this.setCustomValidity('Hanya Angka!')" oninput="setCustomValidity('')" required>
            <p></p>Password :
                <input type="password" name="pass" placeholder=" Masukan Password" oninvalid="this.setCustomValidity('Tidak boleh Kosong!')" oninput="setCustomValidity('')" required>
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
                        			onClick="document.location='admin.php?tampil'" value="Lihat Data"  />
            </form>
        </fieldset>
    </div>
</body>
</html>
