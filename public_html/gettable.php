<html>
  <head>
  </head>
  <body>
  <div class = "rec_table">
	<table border=1></br>
	<tr>
	<th bgcolor="#FF0000">C&#7843;m bi&#7871;n 1</th>
	<th bgcolor="#66FF00">C&#7843;m bi&#7871;n 2</th>
	<th bgcolor="#0000FF">C&#7843;m bi&#7871;n 3</th>
        <th bgcolor="#0000FF">C&#7843;m bi&#7871;n 4</th>
	<th bgcolor="#CCFF00">Th&#7901;i Gian (GMT+0)</th>
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
$username = "u253182397_root";
$password = "1231110009";
$dbname = "u253182397_data";

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
            <td> &nbsp;%s&nbsp </td>
	    	</tr>",
$row['cb1'],
$row['cb2'],
$row['cb3'],
$row['cb4'],
$row['time']);

}

$conn->close();
?>
</table>
</div>
</body>
</html>



	