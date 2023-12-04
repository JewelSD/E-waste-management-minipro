<?php
include "config.php";
include "config/connect.php";

// Check if the user is logged in
if(!isset($_SESSION['uname'])){
    header('Location: index.php');
}

?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<section id="content">
    <div class="content-blog">
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Device Name</th>
                        <th>Device Description</th>
                        <th>Pickup Address</th>
                        <th>Mobile Number</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php   
                    $sql = "SELECT ewaste.id, ewaste.name, ewaste.description, ewaste.mob, users.address
                            FROM ewaste
                            INNER JOIN users ON ewaste.u_id = users.email
                            WHERE ewaste.status = 'paid'
                            ORDER BY ewaste.id DESC";
                    $res = mysqli_query($connection, $sql); 
                    while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $row['id']; ?></th>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                         <td><?php echo $row['mob']; ?></td>
                         <td><?php echo "<form action='pickstatus.php' method='post'>
                    <input type='hidden' name='id' value={$row['id']}>
                            <button type='submit' class='btn btn-danger'>Click only after Pickup</button>
                    </form>";?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
