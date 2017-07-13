<?php
	//$con = mysql_connect($mysql_hostname , $mysql_username) 
	$con=mysqli_connect('localhost','root','','daib');
	if (!$con){die('kada konek bro' . mysqli_error());}
	mysqli_select_db($con, 'daib')

	?>
