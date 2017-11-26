<html>
<style type="text/css">
body {
	background-image: url(Par.JPG);
}
body,td,th {
	color: #F00;
        font-size: 18px;
}
</style>
<meta charset="utf-8">
<form  method="post">
</br>
	<strong>电子邮件:</strong> <input type="text" name="to"><br>
</br>
    <input type="submit" name="submit" value="发送">
    </form>

<?php
$to= $_POST['to'];
$from= "huuphuoct1994@gmail.com";
$subject="Password: 123";

$body= "";
$headers = "From: PhuocDang";
mail($to,$subject,$body,$headers);
echo "<a href='index_cn.php'>背部</a>";
?>
</html>