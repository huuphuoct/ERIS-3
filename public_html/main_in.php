<?php

session_start();
//ti?n h�nh ki?m tra l� ngu?i d�ng d� dang nh?p hay chua
//n?u chua, chuy?n hu?ng ngu?i d�ng ra l?i trang dang nh?p
if (!isset($_SESSION['Username'])) {
	 header('Location: index_us.php');
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
          <h1 id="e6" class="header">मेरी जानकारी</h1>

        <div class="graph_action">
			<button onClick="window.location.href= 'index_in.php' ">&#2354;&#2379;&#2327; &#2310;&#2313;&#2335;</button>
        </div>
        नमस्ते: <?php echo $_SESSION['Username'];  ?>

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
    <p>समय सुधारें: <span id="cdown" style="color:blue; font-size:20px"></span></p>
                    
    </br>
    <center><p>दिल धडकना</p></center>
    <img id="myImage" src="http://phuocdang.esy.es/plit.php?" width="800" height="400" />
</br>









    <center><p>Sp02</center>
	 <img id="myImage1" src="http://phuocdang.esy.es/plit1.php?" width="800" height="400" />

<div class="result"></div>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

		<script>
    		function refresh_div() {
        		jQuery.ajax({
            		url:'gettable_in.php',
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
स्थिति नियंत्रण :<input  type="text" name="red"><br>
गति नियंत्रण: <input type="text" name="green"><br>
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
    echo " &#2352;&#2367;&#2325;&#2377;&#2352;&#2381;&#2337; &#2360;&#2347;&#2354;&#2340;&#2366;&#2346;&#2370;&#2352;&#2381;&#2357;&#2325; &#2309;&#2342;&#2381;&#2351;&#2340;&#2344;";
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
"window.print();"target="_ blank" style="cursor:pointer;">प्रिंट डेटा</a></center>
<a href="image_slider.php" class="forgot-password">तस्वीरें</a>
<a href="http://phuocdang.esy.es/GPS/place_marker.html">नक्शा</a>
    <div id="footer">
                <p>नियंत्रण और डाटा अधिग्रहण के माध्यम से इंटरनेट</p>
                </div><!--#footer-->
  </div><!--#container-->
<script type="text/javascript" src="//rf.revolvermaps.com/0/0/6.js?i=5aq4wjbdtwo&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
<audio autoplay src="hindi_main.mp3">
</body>
</html>