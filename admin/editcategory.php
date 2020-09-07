<?php 
include_once './connect.php';
if (isset($_GET['id_category'])) {
	$id_category = $_GET['id_category'];
	$sql = "SELECT * FROM categories WHERE id_categories = '$id_category'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
	}

	if (isset($_POST['edit']) && isset($_POST['newName'])) {
		$newName = $_POST['newName'];
			//sql to update to db
		$sql = "UPDATE categories SET name_categories = '$newName' WHERE id_categories = '$id_category'";

		if ($conn-> query($sql) === TRUE) {
			header('location: ./home.php?page_layout=category');
		}else{
			echo "<script>alert('Update failed!')";
		}
		$conn->close();
	}
}



?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh mục sản phẩm</h1>
		</div>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-xs-12 col-md-5 col-lg-5">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Sửa danh mục
				</div>
				<div class="panel-body">
					<form accept="" method="POST">
						<div class="form-group">
							<label>Tên danh mục:</label>
							<input type="text" name="newName" required class="form-control" value="<?php echo $row['name_categories'] ?>">
						</div>
						<div class="form-group">
							<input type="submit" value="Sửa danh mục" class="btn btn-warning" name="edit">
							<!-- <button class="btn btn-success" ><a style="text-decoration: none; color: tomato;" href="./home.php?page_layout=category">Hủy thay đổi</a></button> -->
							<a href="./home.php?page_layout=category" class="btn btn-primary">Hủy thay đổi</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->
