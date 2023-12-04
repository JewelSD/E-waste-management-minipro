<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greenurban";
echo $expense = $_POST['expense'];
echo $sid = $_POST['sid'];
echo $uid = $_POST['uid'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `service` SET `expense` = '$expense' WHERE `service`.`id` = '$sid;'";
// $sql2 ="UPDATE `usersmeta` SET `balance` = '$expense' WHERE `usersmeta`.`uid` = '$uid;'";
if ($conn->query($sql) === TRUE) {
  echo '<script>alert("Expense added ")</script>';
  header('Location: service.php');
}
 else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}
// if ($conn->query($sql2) === TRUE) {
//   echo '<script>alert("Balance Credited added ")</script>';
// }
//  else 
// {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }


$conn->close();
?>