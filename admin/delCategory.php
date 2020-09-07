<?php 
session_start();
$id_category = $_GET['id_category'];
if (isset($_SESSION['email']) && isset($_SESSION['password']) && isset($id_category)) {
	include_once './connect.php';

		//sql to delete category
	$sql = "DELETE FROM categories WHERE id_categories = '$id_category'";
	if ($conn->query($sql) === TRUE) {
		header('location: ./home.php?page_layout=category');
	}else{
		echo "<script>alert('Delete category failed!')</script>";
	}
}
$conn->close();


?>