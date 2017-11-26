<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>여보세요</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/lineicons.css">
	<link rel="stylesheet" href="css/styles_korea.css">
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
		mysql_connect("mysql.hostinger.vn","u565882034_root","1231110009") or die("Không thể kết nối");
		mysql_select_db("u565882034_data") or die("Không thể kết nối db1");	
		$sql= mysql_query("SELECT * FROM users WHERE Username='$user' and Password='$pass'");
		if(mysql_num_rows($sql)==0){
			echo "<script> alert('Tên đăng nhập hoặc mật khẩu chưa đúng')</script>";
		}
		else{
			$row = mysql_fetch_array($sql);
			session_start();
			$_SESSION['Username'] = $row['Username'];
			header("location:main_korea.php");
		}
	}
	
}
?>
<body>

	<div class="main-wrapper">
		<div class="main-wrapper-bg" id="main-wrapper-bg"></div>
		<canvas id="my-canvas" class="my-canvas"></canvas>
		<div class="main-wrapper-mask"></div>
		<div class="main-container">
			<div class="container">
				<div class="row row-main">
					<div class="col-md-4 col">
                    

						<h1 class="main-title">여보세요</h1>
						<p>내 웹 사이트를 이용해 주셔서 감사합니다. 사용자 이름과 암호를 입력하십시오.</p>
<form name="frmlogin" action="" method="post" onSubmit="return Check()">

<div class="graph_action">
		  <a href='in.php' class="forgot-password">&#46244;&#47196;</a>
        </div>
					</div>
					<div class="col-md-4 col">
						<h1 class="main-title">로그인</h1>
						<form class="main-form">
							<div class="form-group">
								<input type="text" name="user" class="form-control" placeholder="사용자 이름">
								<div class="form-icon lin lin-user"></div>
							</div>
							<div class="form-group">
								<input type="password" name="pass" class="form-control" placeholder="암호">
								<div class="form-icon lin lin-key"></div>
							</div>
							<input type="submit" name="login" value="입력" class="btn btn-default btn-ghost">
						</form>
						<a href='email_korea.php' class="forgot-password">비밀번호를 잊으 셨나요?</a>
					</div>
					<div class="col-md-4 col">
						<h1 class="main-title">레지스터</h1>
						<form class="main-form">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="이름">
								<div class="form-icon lin lin-user"></div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="이메일">
								<div class="form-icon lin lin-envelope-open"></div>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="암호">
								<div class="form-icon lin lin-lock"></div>
							</div>
							<input type="submit" value="레지스터" class="btn btn-default btn-ghost">
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

<audio autoplay src="korea.mp3">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/canvas.js"></script>
	<script src="js/script.js"></script>
</body>
</html>