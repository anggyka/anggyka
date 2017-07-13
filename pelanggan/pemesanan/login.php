<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
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
	<div class="login-header">LOGIN USER <a href="daftar.php" style="float: right;">DAFTAR</a></div>
	<div class="login-content">
		<form method="post">
		<span class="span-inp">Username</span>
		<input type="text" class="log-inp" name="username" placeholder="Username" required>
		<span class="span-inp">password</span>
		<input type="password" class="log-inp" name="password" placeholder="Password..." required>
		<input type="submit" name="login" value="Login"><p>
		</form>
		<?php
		$con = mysqli_connect('localhost', 'root', '') or die (mysqli_error());
		mysqli_select_db($con, 'daib');
		session_start();
		if (isset($_SESSION['pelanggan'])) {
			echo "<script>window.alert('Anda sudah melakukan login, tidak bisa login 2x');window.location='index.php';</script>";
		}
		if (isset($_POST['login'])) {
			$u 		= mysqli_real_escape_string($con, $_POST['username']);
			$p 		= mysqli_real_escape_string($con, $_POST['password']);
			$v 		= password_verify($u,$p);
			
			$q 		= mysqli_query($con, "SELECT username_pelanggan, nama_pelanggan, pass FROM tb_pelanggan_new WHERE username_pelanggan='$u'") or die (mysqli_error($con));
			
			if (mysqli_num_rows($q) == 1) {
			$d = mysqli_fetch_assoc($q);
					$user = $d['username_pelanggan'];
					$pass = $d['pass'];

					if (password_verify($p, $pass) == 1) {
						$_SESSION['pelanggan'] = $d['username_pelanggan'];
						echo "<script>window.alert('Login berhasil');window.location='index.php';</script>";
					} else {
						echo "GAGAL";
					}
					
			}

			// echo "<div class='notif'>Berhasil Login</div>";
		}
		?>
	</div>
</div>
</body>
</html>