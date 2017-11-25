<?php

session_start();
//ti?n h�nh ki?m tra l� ngu?i d�ng d� dang nh?p hay chua
//n?u chua, chuy?n hu?ng ngu?i d�ng ra l?i trang dang nh?p
if (!isset($_SESSION['Username'])) {
	 header('Location: projectc.php');
}
?>
<html>
<head>
     <meta charset="utf-8">
	<title><?php echo $_SESSION['Username'];  ?></title>
    <meta name="author" content="MiTa" />

    <link type="text/css" rel="stylesheet" href="style.css" />
    <link type="text/css" rel="stylesheet" href="normalize.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body,td,th {
	color: #CFF;
}
</style>
</head>
<body id="page" class="page" >

<div id="container">
                 <div id="menu">
                </div><!--#menu-->
          <h1 id="e6" class="header">MY DATA</h1>

        <div class="graph_action">
			<button onClick="window.location.href= 'projectc.php' ">Log out</button>
        </div>
	      Hello: <?php echo $_SESSION['Username'];  ?>

    <script>

    function changeImage() {
        var image = document.getElementById('myImage');
        image.src = "http://phuoc.esy.es/plit.php?" + new Date().getTime();
    }

    function countdown() {
    // your code goes here
    var count = 2;
    var timerId = setInterval(function() {
        count--;
       // console.log(count);
       document.getElementById("cdown").innerHTML = count.toString();
 
        if(count == 0) {
            changeImage();
            count = 2;
        }
    }, 1000);
}
 
countdown();

    </script>
    <p>Time update : <span id="cdown" style="color:blue; font-size:20px"></span></p>
    </br>
    <center><p>Stepper's motor position</p></center>
    <img id="myImage" src="http://phuoc.esy.es/plit.php?" width="800" height="400" />

    <center><p>DC Motor's speed: <span id="cdown" style="color:blue; font-size:20px"></span></p></center>
	 <img id="myImage" src="http://phuoc.esy.es/plit1.php?" width="800" height="400" />

<div class="result"></div>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>
    		function refresh_div() {
        		jQuery.ajax({
            		url:'gettable.php',
            		type:'POST',
            		success:function(results) {
                		jQuery(".result").html(results);
            		}
        		});
    		}

    		t = setInterval(refresh_div,1000);
		</script>

<form  method="post">
</br>
Position (*00000 - *30000) :<input  type="text" name="red"><br>
Devices(3 bits): <input type="text" name="green"><br>
Sensors(2 bits) <input type="text" name="blue"><br>
  <input type="submit" name="send">
</form>
<?php
echo $_POST["red"]; 
echo $_POST["green"]; 
echo $_POST["blue"]; 

$red = "OFF";
$green = "OFF";
$blue = "OFF";

$savedDoneR = "0";
$savedDoneG = "0";
$savedDoneB = "0";

$servername = "mysql.hostinger.vn";
$username = "u253182397_root";
$password = "1231110009";
$dbname = "u253182397_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE ledstatus SET State='" .$_POST["red"]."' WHERE Color= 'red'";
$sql1 = "UPDATE ledstatus SET State='" .$_POST["green"]."' WHERE Color= 'green'";
$sql2 = "UPDATE ledstatus SET State='" .$_POST["blue"]."' WHERE Color= 'blue'";

if($conn->query($sql) === TRUE)
{
 $savedDoneR = "1";
}
else 
{
echo $sql;
    echo "Error updating record: " . $conn->error;
 $savedDoneR = "0";
}
$conn->close();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if($conn->query($sql1) === TRUE)
{
 $savedDoneG = "1";
}
else
{
 $savedDoneG = "0";
}
$conn->close();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if($conn->query($sql2) === TRUE)
{
 $savedDoneB = "1";
}
else
{
 $savedDoneB = "0";
}
$conn->close();



if ($savedDoneB == "1" && $savedDoneG == "1" && $savedDoneR == "1") 

{
    echo " Record updated successfully";
		 if($_POST["red"] == "1")
		{
		$red = "ON";
		}
		else
		{
		 $red = "OFF";
		}
		if($_POST["green"] == "1")
		{
		$green = "ON";
		}
		else
		{
		$green = "OFF";
		}
		if($_POST["blue"] == "1")
		{
		$blue = "ON";
		}
		else
		{
		$blue = "OFF";
		}
} 

?>



    <div id="footer">
                <p>Chung ta chi that su that bai khi chung ta tu bo moi co gang</p>
                </div><!--#footer-->
  </div><!--#container-->
</body>
</html>