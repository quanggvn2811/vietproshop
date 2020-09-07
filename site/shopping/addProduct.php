<?php
if (isset($_GET['id_product'])) {
session_start();
$id_product = $_GET['id_product'];
if (isset($_SESSION['cart'][$id_product])) {
	$_SESSION['cart'][$id_product] = $_SESSION['cart'][$id_product] + 1;
} else {
	$_SESSION['cart'][$id_product] = 1;
}
//print_r($_SESSION);
//session_destroy();
header('location:../../index.php?page_layout=cart');

}
 ?>