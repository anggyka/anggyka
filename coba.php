<?php
$no = "081255461907";
 if(!preg_match('/[^+0-9]/',trim($no)))
 // cek apakah no hp mengandung karakter + dan 0-9
 {
 if(substr(trim($no), 0, 3)=='+62')
 // cek apakah no hp karakter 1-3 adalah +62
 {
 $hp = trim($no);
 }
 elseif(substr(trim($no), 0, 1)=='0')
 // cek apakah no hp karakter 1 adalah 0
 {
 $hp = '+62'.substr(trim($no), 1);
 }
 // fungsi trim() untuk menghilangan
 // spasi yang ada didepan/belakang
 }
 else
 {
 $hp = 'Format no hp yang dimasukkan tidak lengkap atau salah!';
 }
 echo $hp;
?>