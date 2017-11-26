<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & E_WARNING);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$current_date = date_default_timezone_get();
$date = date('d:m:y H:i:s',strtotime($current_date)) ;
	$host = "mysql.hostinger.vn";
	$user = "u253182397_root";
	$pass = "1231110009";
	
	$ketnoi = mysql_connect($host,$user,$pass);
	$chon_csdl = mysql_select_db('u253182397_data',$ketnoi);
	
	if($ketnoi){
		echo "Ket Noi Thanh Cong Voi CSDL!";
	} 
	else{
		echo "Chua The Ket Noi Voi CSDL!";
	}
	
	
	$cb3 = $_GET['cb3'];
        $cb4 = $_GET['cb4'];
	
	$sql_insert = "insert into nhandata1 (cb3,cb4) values ($cb3,$cb4)";
	mysql_query($sql_insert);
	if($sql_insert){
		echo "Nhap thanh cong du lieu";
	} else{
		echo "Khong thanh cong du lieu";
	}
	
?>