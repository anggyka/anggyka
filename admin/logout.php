<?php
session_start();
if (isset($_SESSION['admin'])) {
session_destroy();
echo "<script>window.alert('LOGOUT dari akun anda');window.location='login.php';</script>";
} else {
echo "<script>window.alert('ANDA BELUM LOGIN SAMA SEKALI');window.location='login_admin.php';</script>";	
}