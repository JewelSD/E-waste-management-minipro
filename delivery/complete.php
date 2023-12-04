<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greenurban";
echo $sid = $_POST['sid'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `service` SET `status` = '1' WHERE `service`.`id` = '$sid;'";

if ($conn->query($sql) === TRUE) {
  echo '<script>alert("Order completed ")</script>';
  header('Location: service.php');
}
 else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>