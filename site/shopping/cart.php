<div id="cart" class="col-md-2 col-sm-12 col-xs-12">
	<a class="display" href="./index.php?page_layout=cart">Giỏ hàng</a>
	<a href="./index.php?page_layout=cart"><?php if (isset($_SESSION['cart'])) {echo count($_SESSION['cart']);} else {echo 0;} ?></a>				    
</div>