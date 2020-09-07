<?php 
session_start();
if (isset($_GET['id_product'])) {
	$id_product = $_GET['id_product'];
	if ($id_product == 0 ) {
		unset($_SESSION['cart']);
	} else {
		unset($_SESSION['cart'][$id_product]);
	}
	header('location:../../index.php?page_layout=cart');
}
?>