<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-device";
echo $oid = $_POST['orderid'];
echo $status = $_POST['status'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `orders` SET `orderstatus` = '$status' WHERE `orders`.`id` = '$oid;'";

if ($conn->query($sql) === TRUE) {
  echo '<script>alert("order is now assigned to you ")</script>';
  header('Location: home.php');
}
 else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>