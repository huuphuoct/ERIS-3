<?php

session_start();
//ti?n h�nh ki?m tra l� ngu?i d�ng d� dang nh?p hay chua
//n?u chua, chuy?n hu?ng ngu?i d�ng ra l?i trang dang nh?p
if (!isset($_SESSION['Username'])) {
	 header('Location: index_cn.php');
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
          <h1 id="e6" class="header">&#25105;&#30340;&#25968;&#25454;</h1>

        <div class="graph_action">
			<button onClick="window.location.href= 'index_cn.php' ">&#30331;&#20986;</button>
        </div>
	      &#20320;&#22909;: <?php echo $_SESSION['Username'];  ?>

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
    <p>&#26356;&#26032;&#26102;&#38388;: <span id="cdown" style="color:blue; font-size:20px"></span></p>
                    
    </br>
    <center><p>心脏跳动</p></center>
    <img id="myImage" src="http://phuocdang.esy.es/plit.php?" width="800" height="400" />
</br>
    <center><p>Sp02</center>
	 <img id="myImage1" src="http://phuocdang.esy.es/plit1.php?" width="800" height="400" />

<div class="result"></div>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>
    		function refresh_div() {
        		jQuery.ajax({
            		url:'gettable_china.php',
            		type:'POST',
            		success:function(results) {
                		jQuery(".result").html(results);
            		}
        		});
    		}

    		t = setInterval(refresh_div,1000);
		</script>


</br>
<center><a titlt="print screen" alt="print screen" onclick=
"window.print();"target="_ blank" style="cursor:pointer;">&#25171;&#21360;&#25968;&#25454;</a></center>

<a href="http://phuocdang.esy.es/GPS/place_marker.html">&#22320;&#22270;</a>
    <div id="footer">
                <p>&#25511;&#21046;&#21644;&#25968;&#25454;&#36890;&#36807;&#20114;&#32852;&#32593;&#37319;&#38598;</p>
                </div><!--#footer-->
  </div><!--#container-->
<script type="text/javascript" src="//rf.revolvermaps.com/0/0/6.js?i=5aq4wjbdtwo&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
<audio autoplay src="china_main.mp3">
</body>
</html>