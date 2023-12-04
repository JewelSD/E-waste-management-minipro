
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; 
// Check user login or not
// if(!isset($_SESSION['uname'])){
//     header('Location: index.php');
// }
?>
<section id="content">
    <div class="content-blog">
        <div class="container">
          <h1>Daily stock collection update</h1>
<form action="stocker.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Plastic </label>
    <input type="text" name="plastic" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Weight in kilogram">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Papper </label>
    <input type="text" name="papper" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Weight in kilogram">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Copper </label>
    <input type="text" name="copper" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Weight in kilogram">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Brass </label>
    <input type="text" name="brass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Weight in kilogram">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Aluminium </label>
    <input type="text" name="aluminium" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Weight in kilogram">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Iron </label>
    <input type="text"name="iron" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Weight in kilogram">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">Check to agree all details provided are valid and will be audited, malpractice will be suded with, penalty of will from GreenUrban Terms and condition applied</label>
  </div>
  <input value="submit" type="submit" class="btn btn-primary">
</form>
</div>
</div>
</section>
<?php include 'inc/footer.php' ?>