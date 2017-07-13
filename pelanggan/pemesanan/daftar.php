<!DOCTYPE html>
<html>
<head>
	<title>Daftar pelanggan</title>
</head>
<link rel="stylesheet" type="text/css" href="../../style.css">
<body>
<div class="header">
<div class="header-box">
			<div class="header-logo"><a href="../../index.php">DEPO AIR ISI ULANG BAMBANG</a></div>
			<div class="header-nav">
				<ul>
					<li>Kategori Produk</li>
					<li><a href="pelanggan/pemesanan/index.php">Pemesanan</a></li>
					<li><a href="logout.php">Login</a></li>
				</ul>
			</div>
		</div>
</div>
<div class="login-wrapper">
	<div class="login-header">DAFTAR <a href="login.php" style="float: right;">LOGIN</a></div>
	<div class="login-content">
		<form method="post">
		<span class="span-inp">Nama Lengkap</span>
		<input type="text" class="log-inp" name="nama" placeholder="Nama Lengkap (ex: Sujono Marjino)" required><br/>
		<span class="span-inp">Username</span><br/>
		<input type="text" class="log-inp" name="username" placeholder="Username (ex: sujono123)" required><br/>
		<span class="span-inp">Email</span><br/>
		<input type="email" class="log-inp" name="email" placeholder="Email (ex: sujonomarjino@gmail.com)" required><br/>
		<span class="span-inp">Alamat</span><br/>
		<input type="text" class="log-inp" name="alamat" placeholder="Alamat (ex: jl. pelita no.09)"><br/>
		<span class="span-inp">Nomer Handphone</span><br/>
		<input type="text" class="log-inp" name="nohp" placeholder="Nomer Handphone (ex: 0852xxxx...)" value="08" required><br/>
		<span class="span-inp">Password</span><br/>
		<input type="password" class="log-inp" name="password" placeholder="Kata Sandi..." required><br/>
		<span class="span-inp">Konfirmasi Password</span><br/>
		<input type="password" class="log-inp" name="kpassword" placeholder="Ketik Ulang kata sandi..." required><br/>
		<input type="submit" name="daftar" value="Daftar"><p>
		</form>
	</div>
	<?php
		include "../../kon.php";

		session_start();
		if (isset($_POST['daftar'])) {
			$n 		= mysqli_real_escape_string($con, $_POST['nama']);
			$u 		= $_POST['username'];
			$e 		= $_POST['email'];
			$a 		= mysqli_real_escape_string($con, $_POST['alamat']);
			$no 	= $_POST['nohp'];
			$p 		= $_POST['password'];
			$kp 	= $_POST['kpassword'];
			$err 	= 0;
			$qu 	= mysqli_num_rows(mysqli_query($con, "SELECT username_pelanggan FROM tb_pelanggan_new WHERE username_pelanggan='$u'"));
			$qe 	= mysqli_num_rows(mysqli_query($con, "SELECT email_pelanggan FROM tb_pelanggan_new WHERE email_pelanggan='$e'"));
			$err_n 	= "";
			$err_e  = "";
			$err_u 	= "";
			$err_no = "";
			$err_p 	= "";

			// validasi nama
			if (strlen($n) <= 3 || (preg_match("/[0-9]+/", $n)) || $qu >= 1) { $err_n = "Nama sudah ada atau format tidak boleh kurang dari 3 huruf serta dilarang simbol!"; $err++; }

			// validasi email
			if ($qe >= 1) { $err_e = "Alamat Email sudah ada"; }

			// validasi username
			if (strlen($u) <= 3 || strlen($u) >=10 || (!preg_match("/[a-zA-Z0-9]+/", $u))) { $err_u = "Username hanya 4-10 karakter saja (huruf dan angka tanpa simbol)"; $err++; }

			// validasi nomer HP
			if (!preg_match("/[0-9]+/", $no) || strlen($no) < 11 || strlen($no) > 12) { $err_no = "Format nomer hp tidak sesuai!"; $err++; }
			$hp = '+62'.substr(trim($no), 1);

			// validasi password
			if ($p != $kp || strlen($p) < 8) { $err_p = "Password kurang tidak sama (min 8 karakter)"; $err++; }


			if ($err >= 1) {
				echo "
					<div class='login-wrapper'>
						<div class='login-header'><a href='#'>TERJADI KESALAHAN</a></div>
						<div class='login-content'>
						" . $err_n . "<br/>
						" . $err_e . "<br/>
						" . $err_u . "<br/>
						" . $err_no . "<br/>
						" . $err_p . "<br/>
						</div>
					</div>
				";
			} else {
				$pass 	= password_hash($p, PASSWORD_DEFAULT);
				$q 		= mysqli_query($con, "INSERT INTO tb_pelanggan_new (nama_pelanggan, username_pelanggan, email_pelanggan, alamat_pelanggan, hp_pelanggan, pass)
										VALUES ('$n', '$u', '$e', '$a', '$hp', '$pass')") or die (mysqli_error());
				echo "SUKSES DAFTAR!";
	
			}
		}
		?>
</div>
</body>
</html>