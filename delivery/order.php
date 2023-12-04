<?php
include "config.php";
include "config/connect.php";


// Check user login or not
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
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Payment Mode</th>
                        <th>Commit</th>
                        <th>Order Placed On</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                <?php   
                    $sql = "SELECT o.id, o.uid, o.totalprice, o.orderstatus, o.paymentmode, o.shipping, o.`timestamp`, u.firstname, u.lastname FROM orders o JOIN usersmeta u WHERE o.uid=u.uid ORDER BY o.id DESC";
                    $res = mysqli_query($connection, $sql); 
                    while ($r = mysqli_fetch_assoc($res)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $r['id']; ?></th>
                        <td><?php echo $r['firstname']. " " . $r['lastname']; ?></td>
                        <td><?php echo $r['totalprice']; ?></td>
                        <td><?php echo $r['orderstatus']; ?>
                            <?php echo $r['uid']; ?>
                        </td>
                        <td><?php echo $r['paymentmode']; ?></td>
                        <td><?php echo '<form action = "acceptdel.php" method = "post" >
                        <input name = "oid" type="hidden" value = '.$r["id"].'>
                         <input name = "del" type="hidden" value = '. $_SESSION["uname"].'>
                        <input type = submit value ="take order">
                        </form>' ?></td>
                        <td><?php echo $r['timestamp']; ?></td>
                        <?php
                        $now = $_SESSION['uname'];
                        $real = $r['shipping'];
                        if ( $now == $real) {
                            ?>
                         
                        <td><?php echo '<form action = "order-process.php" method = "post" >
                        <input name = "oid" type="hidden" value = '.$r["id"].'>
                        <input name = "uid" type="hidden" value = '.$r["uid"].'>
                        <input type = submit value ="view order">
                        </form>' ?></td>
                           
                       <?php 
                   }
                   ?>
                        
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            
        </div>
    </div>

</section>
<?php include 'inc/footer.php' ?>

