<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<body>
<div class="login-wrapper">
	<div class="login-header">LOGIN ADMIN</div>
	<div class="login-content">
		<form method="post">
		<span class="span-inp">Username</span>
		<input type="text" class="log-inp" name="username" placeholder="Username" required>
		<span class="span-inp">password</span>
		<input type="password" class="log-inp" name="password" placeholder="Password..." required>
		<input type="submit" name="login" value="Login"><p>
		</form>
		<?php
		include "kon.php";
		session_start();
		if (isset($_SESSION['admin'])) {
			echo "<script>window.alert('Anda sudah melakukan login, tidak bisa login 2x');window.location='index.php';</script>";
		}
		if (isset($_POST['login'])) {
			$u 		= mysqli_real_escape_string($con, $_POST['username']);
			$p 		= mysqli_real_escape_string($con, $_POST['password']);
			$v 		= password_verify($u,$p);
			
			$q 		= mysqli_query($con, "SELECT username_admin, nama_admin, pass FROM tb_admin WHERE username_admin='$u'") or die (mysqli_error());
			
			if (mysqli_num_rows($q) == 1) {
			$d = mysqli_fetch_assoc($q);
					$user = $d['username_admin'];
					$pass = $d['pass'];

					if (password_verify($p, $pass) == 1) {
						$_SESSION['admin'] = $d['username_admin'];
						echo "<script>window.alert('LOGIN SUKSES');window.location='index.php';</script>";
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