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

<form  method="post">
</br>
	<strong>ईमेल:</strong> <input type="text" name="to"><br>
</br>
    <input type="submit" name="submit" value="भेजना">
    </form>

<?php
$to= $_POST['to'];
$from= "huuphuoct1994@gmail.com";
$subject="Password: 123";

$body= "";
$headers = "From: PhuocDang";
mail($to,$subject,$body,$headers);
echo "<a href='index_in.php'>यहां क्लिक करे</a>";
?>
</html>