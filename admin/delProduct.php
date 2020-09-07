<?php 
session_start();
$id_product = $_GET['id_product'];
if (isset($id_product) && isset($_SESSION['email']) && isset($_SESSION['password'])) {
	//Connect database
	include_once 'connect.php';

	// Sql to delete product
	$sql = "DELETE FROM products WHERE id_product = '$id_product'";
	$result = $conn->query($sql);
	if ($result === TRUE) {
		header('location: ./home.php?page_layout=product');
	} else {
		echo "<script>alert('Delete product failed!')</script>";
	}
	$conn->close();

}

?>