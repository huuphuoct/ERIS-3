<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & E_WARNING);
require_once("src/jpgraph.php");
require_once("src/jpgraph_line.php");
require_once("src/jpgraph_date.php" );

date_default_timezone_set('Asia/Ho_Chi_Minh');
$current_date = date_default_timezone_get();
$date = date('d:m:y H:i:s',strtotime($current_date)) ;

$servername = "mysql.hostinger.vn";
$username = "u565882034_root";
$password = "1231110009";
$dbname = "u565882034_data";

$x_data = array();
$y_data3 = array();



	////////////////// KET NOI CSDL /////////////////

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
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
    $x_data [] = strtotime($row['time']);
	$y_data3[] = $row['cb3'];


}

$conn->close();

	/////////////////// VE ///////////////////////////////

$graph = new Graph(1000,400);
$graph->SetMargin(40,40,10,50);
$graph->SetScale('datlin',0,100);
$graph->xaxis->scale->SetTimeAlign( MAXADJ_1 );
$graph->xaxis->scale->ticks->Set(0.5*60);
$graph->xaxis->scale->SetDateFormat(' H:i');
$lineplot3 = new LinePlot($y_data3 , $x_data);
$lineplot3->SetColor("green");
$graph->Add($lineplot3);





$graph->Stroke();
?>



