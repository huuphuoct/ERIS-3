<?php

session_start();
//ti?n h�nh ki?m tra l� ngu?i d�ng d� dang nh?p hay chua
//n?u chua, chuy?n hu?ng ngu?i d�ng ra l?i trang dang nh?p
if (!isset($_SESSION['Username'])) {
	 header('Location: index_ru.php');
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
          <h1 id="e6" class="header">данные</h1>

        <div class="graph_action">
			<button onClick="window.location.href= 'index_ru.php' ">выйти</button>
        </div>
	      Здравствуйте: <?php echo $_SESSION['Username'];  ?>

    <script>

    function changeImage() {
        var image = document.getElementById('myImage');
        image.src = "http://phuocdang.esy.es/plit.php?" + new Date().getTime();
        
    }
    function changeImage1() {
        var image1 = document.getElementById('myImage1');
      
        image1.src = "http://phuocdang.esy.es/plit1.php?" + new Date().getTime();
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
            changeImage1();
            count = 2;
        }
    }, 1000);


}


 
countdown();


    </script>
    <p>Update time: <span id="cdown" style="color:blue; font-size:20px"></span></p>
                    
    </br>
    <center><p>биение сердца</p></center>
    <img id="myImage" src="http://phuocdang.esy.es/plit.php?" width="800" height="400" />
</br>
    <center><p>Sp02</center>
	 <img id="myImage1" src="http://phuocdang.esy.es/plit1.php?" width="800" height="400" />

<div class="result"></div>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>
    		function refresh_div() {
        		jQuery.ajax({
            		url:'gettable_russia.php',
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
&#1087;&#1086;&#1079;&#1080;&#1094;&#1080;&#1086;&#1085;&#1085;&#1086;&#1077; &#1091;&#1087;&#1088;&#1072;&#1074;&#1083;&#1077;&#1085;&#1080;&#1077;:<input  type="text" name="red"><br>
&#1082;&#1086;&#1085;&#1090;&#1088;&#1086;&#1083;&#1100; &#1089;&#1082;&#1086;&#1088;&#1086;&#1089;&#1090;&#1080;: <input type="text" name="green"><br>
<br>
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
$username = "u565882034_root";
$password = "1231110009";
$dbname = "u565882034_data";

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
    echo " &#1079;&#1072;&#1087;&#1080;&#1089;&#1100; &#1091;&#1089;&#1087;&#1077;&#1096;&#1085;&#1086; &#1086;&#1073;&#1085;&#1086;&#1074;&#1083;&#1077;&#1085;";
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


</br>
<center><a titlt="print screen" alt="print screen" onclick=
"window.print();"target="_ blank" style="cursor:pointer;">&#1076;&#1072;&#1085;&#1085;&#1099;&#1077; &#1076;&#1083;&#1103; &#1087;&#1077;&#1095;&#1072;&#1090;&#1080;</a></center>
<a href="image_slider.php" class="forgot-password">&#1092;&#1086;&#1090;&#1086;</a>
<a href="http://phuocdang.esy.es/GPS/place_marker.html">&#1082;&#1072;&#1088;&#1090;&#1072;</a>
    <div id="footer">
                <p>управление и сбор данных через Интернет</p>
                </div><!--#footer-->
  </div><!--#container-->
<script type="text/javascript" src="//rf.revolvermaps.com/0/0/6.js?i=5aq4wjbdtwo&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
<audio autoplay src="russia_main.mp3">
</body>
</html>