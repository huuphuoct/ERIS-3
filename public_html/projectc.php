<head>
	<title></title>
    <script type="text/javascript" src="script.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
body{
	background-image: url(ocean.jpg);
	background-size: cover;
}
.aa{
	margin:0 auto;
	width:270px;
	height: 250px;
	background-color: rgba(0,0,0,0.2);
	margin-top: 30px;
	padding-left: 70px;
	padding-top: 20px;
	border-radius: 10px;
	color:white;
	font-weight: bolder;
	font-size: 18px;
	box-shadow: inset -5px -5px rgba(0,0,0,0.2);
}
.aa input[type="text"]{
	width: 220px;
	height: 35px;
	border-radius: 5px;
	padding-left: 5px;
	border:0;
}
.aa input[type="password"]{
	width: 220px;
	height: 35px;
	border-radius: 5px;
	padding-left: 5px;
	border:0;
}
.aa input[type="submit"]{
	width: 100px;
	height: 35px;
	border-radius: 5px;
	background-color: skyblue;
	border:0;
	
	font-weight: bolder;
}
.aa input[type="submit"]:hover{
	mouse:pointer;
}
	</style>
</head>


</script>
<script type="text/javascript">
 	function Check(){
		if(document.frmlogin.user.value==""){
			alert("Tên đăng nhập không được trống");
			document.frmlogin.user.focus();
			return false;
		}
		if(document.frmlogin.pass.value==""){
			alert("Mật khẩu không được trống");
			document.frmlogin.pass.focus();
			return false;
		}
		else{
			return true;
		}
	}
</script>


<?php 

if(isset($_POST['login'])){
	$user= $_POST['user'];
	$pass= $_POST['pass'];
	
	if($user & $pass)
	{
		mysql_connect("mysql.hostinger.vn","u253182397_root","1231110009") or die("Không thể kết nối");
		mysql_select_db("u253182397_data") or die("Không thể kết nối db1");	
		$sql= mysql_query("SELECT * FROM users WHERE Username='$user' and Password='$pass'");
		if(mysql_num_rows($sql)==0){
			echo "<script> alert('Tên đăng nhập hoặc mật khẩu chưa đúng')</script>";
		}
		else{
			$row = mysql_fetch_array($sql);
			session_start();
			$_SESSION['Username'] = $row['Username'];
			header("location:main.php");
		}
	}
	
}
?>



<fieldset style="width:500px; margin:auto; ">
	<legend>
<center><strong>Xin Hãy Nhập Tên Và Mật Khẩu</strong></center> </legend>
    <form name="frmlogin" action="" method="post" onSubmit="return Check()">
    	<table>
        
			<tr>
            	<td>
                Tên Đăng Nhập:
                </td>
                	
                <td>
                	  <input type="text" name="user" placeholder="Ten dang nhap...."/>
				</td>
            </tr>
            
            
			<tr>
            	<td>
                Mật khẩu:
				</td>
                <td>
                	<input type="password" name="pass" placeholder="Mật khẩu...."/>
                </td>
            </tr>
            
             
            <tr>
            	<td colspan="2" style="text-align:left">
                	<input type="submit" name="login" value="Access To System">
                </td>
            </tr>
        <table>
        <form>
</fieldset>
