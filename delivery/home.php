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
        <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=kolam&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://mcpenation.com/">Minecraft Website</a></div><style>.mapouter{position:relative;text-align:right;width:1100px;height:800px;}.gmap_canvas {overflow:hidden;background:none!important;width:1100px;height:800px;}.gmap_iframe {width:1100px!important;height:800px!important;}</style></div>
            
        </div>
    </div>

</section>
<?php include 'inc/footer.php' ?>