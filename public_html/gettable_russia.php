<html>
  <head>
  </head>
  <body>
  <div class = "rec_table">
	<table border=1></br>
	<tr>
	<th bgcolor="#FF0000">?????? ??????</th>
	<th bgcolor="#66FF00">Sp02</th>
<th bgcolor="#66FF00">???????????</th>
	<th bgcolor="#CCFF00">&#1074;&#1088;&#1077;&#1084;&#1103; (GMT+0)</th>
	</tr>
<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & E_WARNING);

require_once("src/jpgraph.php");
require_once("src/jpgraph_line.php");
require_once("src/jpgraph_date.php" );

date_default_timezone_set('Asia/Ho_Chi_Minh');
$current_date = date_default_timezone_get();
$date = date('Y-m-d H:i:s',strtotime($current_date)) ;

$servername = "mysql.hostinger.vn";
$username = "u565882034_root";
$password = "1231110009";
$dbname = "u565882034_data";

$x_data = array();
$y_data = array();

	////////////////// KET NOI CSDL /////////////////

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	////////////////// LAY CHIEU DAI BANG //////////////

$sql = "SELECT * FROM nhandata";
$result = $conn->query($sql);
$length=$result->num_rows;

	////////////////// LAY DU LIEU TU BANG //////////////

$sql = "SELECT * FROM nhandata ORDER BY time ASC LIMIT ".($length-5).",5";
$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
	printf("<tr>
            <td> &nbsp;%s&nbsp </td>
			<td> &nbsp;%s&nbsp </td>
  <td> &nbsp;%s&nbsp </td>
            <td> &nbsp;%s&nbsp </td>

	    	</tr>",
$row['cb1'],
$row['cb2'],
$row['cb3'],
$row['time']);
}





$conn->close();
?>


</table>
</div>







</body>
</html>



	