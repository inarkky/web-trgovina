<?php
    if (isset($_SESSION["id"]) && $user_ok == true && $isAdmin == true) { ?>

    <div class="col-md-3 content">
    <h2 align="left">Izbornik</h2><br>
    <div class="btn-group-vertical">
        <a href="admin/index.php" class="btn btn-warning" style="text-align: left;">INFO O PODUZEĆU</a>
        <a href="admin/products.php" class="btn btn-warning" style="text-align: left;">PROIZVODI</a>
        <a href="admin/narudzbe.php" class="btn btn-warning" style="text-align: left;">NARUDŽBE</a>
        <a href="admin/news.php" class="btn btn-warning" style="text-align: left;">NOVOSTI</a>
        <a href="logout.php" class="btn btn-warning" style="text-align: left;">LOGOUT</a>
    </div>
</div>

<?php }else{ ?>

<div class="col-md-3 content">
    <h2 align="center">Izbornik</h2><br>
    <div class="btn-group-vertical">
        <?php if($user_ok == true){ 
            echo '<a href="cart.php" class="btn btn-warning" style="text-align: left;"><img src="css/cart.png" style="padding-right: 10px;">VAŠA KOŠARICA</a>'; 
        } ?>
        <a href="products.php?category=0" class="btn btn-warning" style="text-align: left;"><img src="css/link0.png" style="padding-right: 10px;">TRADICIONALNE IGRE</a>
        <a href="products.php?category=1" class="btn btn-warning" style="text-align: left;"><img src="css/link3.png" style="padding-right: 10px;">KARTAŠKE IGRE</a>
        <a href="products.php?category=2" class="btn btn-warning" style="text-align: left;"><img src="css/link1.png" style="padding-right: 10px;">IGRE NA PLOČI</a>
        <a href="products.php?category=3" class="btn btn-warning" style="text-align: left;"><img src="css/link2.png" style="padding-right: 10px;">DODATNA OPREMA</a>
    </div>
<hr>
    <div style="background: #402000;-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
padding: 1px 12px 12px 12px;
width: 265px;
">
    	<form class="form-signin" action="scripts/rss.php" method="POST">
        <h2  align="center" style="color: orange">Newsletter</h2>
        <input type="hidden" name="cur_page" value="<?php echo basename($_SERVER['PHP_SELF']); ?>">
        <input type="email" name="rss" id="rss" class="form-control" placeholder="Unesite svoju e-mail adresu!" required style="margin-bottom: 10px;">
        <input class="btn btn-warning" type="submit" value="Prijavi se">
      </form>
    </div>
</div>
<?php } ?>