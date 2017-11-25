<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & E_WARNING);
date_default_timezone_set('Europe/London');
$current_date = date_default_timezone_get();
$date = date('d:m:y H:i:s',strtotime($current_date)) ;
	$host = "mysql.hostinger.vn";
	$user = "u565882034_root";
	$pass = "1231110009";
	
	$ketnoi = mysql_connect($host,$user,$pass);
	$chon_csdl = mysql_select_db('u565882034_data',$ketnoi);
	
	if($ketnoi){
		echo "Ket Noi Thanh Cong Voi CSDL!";
	} 
	else{
		echo "Chua The Ket Noi Voi CSDL!";
	}
	
	$cb1 = $_GET['cb1'];
	$cb2 = $_GET['cb2'];
        $cb3 = $_GET['cb3'];
	
	$sql_insert = "insert into nhandata (cb1,cb2,cb3) values ($cb1,$cb2,$cb3)";
	mysql_query($sql_insert);
	if($sql_insert){
		echo "Nhap thanh cong du lieu";
	} else{
		echo "Khong thanh cong du lieu";
	}
	
?>