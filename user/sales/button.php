

<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.container {
  position: relative;
  width: 100%;
  max-width: 400px;
  height: 100vh;
  margin: 0 auto; 
}

.container img {
  width: 100%;
  height: auto;
}

.container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #f1f1f1;
  color: black;
  font-size: 16px;
  padding: 16px 16px;
  border: none;
  cursor: pointer;
  border-radius: 10px;
  text-align: center;
  height: 50px;
  width:200px;
  text-align: center;
}


.container .btn:hover {
  background-color: blue;
  color: white;
}
</style>
</head>
<body bgcolor="#98E4FF">
<div class="container">
<div class="page">
 <center><button class="btn">Go Back</button></center>
 </div>
</div>

<?php
session_start();

if (isset($_SESSION['success_message'])) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: '{$_SESSION['success_message']}',
                showConfirmButton: true
            }).then(function() {
                window.location.href = 'button.php';
            });
         </script>";

    unset($_SESSION['success_message']);
}
?>

</body>
</html>