<?php
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'bnews';
	
	$mysqli = new mysqli($hostname,$username,$password,$database);
	//set font chu TV
	$mysqli -> set_charset('utf8');
	//kiem tra ket noi
	if( mysqli_connect_errno() ){
		echo "Không thể kết nối cơ sở dữ liệu";
	}
?>