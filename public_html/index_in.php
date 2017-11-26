<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>&#2344;&#2350;&#2360;&#2381;&#2340;&#2375;</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/lineicons.css">
	<link rel="stylesheet" href="css/styles_india.css">
</head>
</script>
<script type="text/javascript">
 	function Check(){
		if(document.frmlogin.user.value==""){
			alert("Tên &#273;&#259;ng nh&#7853;p không &#273;&#432;&#7907;c tr&#7889;ng");
			document.frmlogin.user.focus();
			return false;
		}
		if(document.frmlogin.pass.value==""){
			alert("M&#7853;t kh&#7849;u không &#273;&#432;&#7907;c tr&#7889;ng");
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
		mysql_connect("mysql.hostinger.vn","u565882034_root","1231110009") or die("Không th&#7875; k&#7871;t n&#7889;i");
		mysql_select_db("u565882034_data") or die("Không th&#7875; k&#7871;t n&#7889;i db1");	
		$sql= mysql_query("SELECT * FROM users WHERE Username='$user' and Password='$pass'");
		if(mysql_num_rows($sql)==0){
			echo "<script> alert('Tên &#273;&#259;ng nh&#7853;p ho&#7863;c m&#7853;t kh&#7849;u ch&#432;a &#273;úng')</script>";
		}
		else{
			$row = mysql_fetch_array($sql);
			session_start();
			$_SESSION['Username'] = $row['Username'];
			header("location:main_in.php");
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
                    <form name="frmlogin" action="" method="post" onSubmit="return Check()">
						<h1 class="main-title">&#2344;&#2350;&#2360;&#2381;&#2340;&#2375;</h1>
						<p>&#2350;&#2375;&#2352;&#2368; &#2357;&#2375;&#2348;&#2360;&#2366;&#2311;&#2335; &#2325;&#2366; &#2313;&#2346;&#2351;&#2379;&#2327; &#2325;&#2352;&#2344;&#2375; &#2325;&#2375; &#2354;&#2367;&#2319; &#2343;&#2344;&#2381;&#2351;&#2357;&#2366;&#2342;, &#2324;&#2352; &#2309;&#2343;&#2367;&#2325; &#2325;&#2368; &#2326;&#2379;&#2332; &#2325;&#2352;&#2344;&#2375; &#2325;&#2375; &#2354;&#2367;&#2319; &#2351;&#2370;&#2332;&#2364;&#2352;&#2344;&#2375;&#2350; &#2324;&#2352; &#2346;&#2366;&#2360;&#2357;&#2352;&#2381;&#2337; &#2342;&#2352;&#2381;&#2332; &#2325;&#2352;&#2375;&#2306;</p>
<div class="graph_action">
		  <a href="in.php" class="forgot-password">&#2357;&#2366;&#2346;&#2360;</a>
        </div>
					</div>
					<div class="col-md-4 col">
						<h1 class="main-title">&#2354;&#2377;&#2327; &#2311;&#2344; &#2325;&#2352;&#2375;&#2306;</h1>
						<form class="main-form">
							<div class="form-group">
								<input type="text" name="user" class="form-control" placeholder="&#2313;&#2346;&#2351;&#2379;&#2327;&#2325;&#2352;&#2381;&#2340;&#2366; &#2344;&#2366;&#2350;">
								<div class="form-icon lin lin-user"></div>
							</div>
							<div class="form-group">
								<input type="password" name="pass" class="form-control" placeholder="&#2346;&#2366;&#2360;&#2357;&#2352;&#2381;&#2337;">
								<div class="form-icon lin lin-key"></div>
							</div>
							<input type="submit" name="login" value="&#2354;&#2377;&#2327; &#2311;&#2344; &#2325;&#2352;&#2375;&#2306;" class="btn btn-default btn-ghost">
						</form>
						<a href="email_india.php" class="forgot-password">&#2346;&#2366;&#2360;&#2357;&#2352;&#2381;&#2337; &#2349;&#2370;&#2354; &#2327;&#2319;?</a>
					</div>
					<div class="col-md-4 col">
						<h1 class="main-title">&#2346;&#2361;&#2354;&#2368; &#2348;&#2366;&#2352;?</h1>
						<form class="main-form">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="&#2313;&#2346;&#2351;&#2379;&#2327;&#2325;&#2352;&#2381;&#2340;&#2366; &#2344;&#2366;&#2350;">
								<div class="form-icon lin lin-user"></div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="&#2312;&#2350;&#2375;&#2354;">
								<div class="form-icon lin lin-envelope-open"></div>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="&#2346;&#2366;&#2360;&#2357;&#2352;&#2381;&#2337;">
								<div class="form-icon lin lin-lock"></div>
							</div>
							<input type="submit" value="&#2352;&#2332;&#2367;&#2360;&#2381;&#2335;&#2352;" class="btn btn-default btn-ghost">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<audio autoplay src="india.mp3">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/canvas.js"></script>
	<script src="js/script.js"></script>
</body>
</html>