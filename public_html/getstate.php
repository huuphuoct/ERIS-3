<?php
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

if($_GET["color"] != "All")
{
$sql = "SELECT State FROM ledstatus WHERE Color= '".$_GET["color"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["State"];
    }
} 

}

else
{
  $sql = "SELECT State FROM ledstatus WHERE Color= 'red'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["State"];
    }
} 

$sql = "SELECT State FROM ledstatus WHERE Color= 'green'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["State"];
    }
} 

$sql = "SELECT State FROM ledstatus WHERE Color= 'blue'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["State"];
    }
} 

}
$conn->close();
?>	