<?php 
include_once 'connect.php';
//Option catagories
$sql_cate = "SELECT * FROM categories";
$result_cate = $conn->query($sql_cate);

//show product
$id_product = $_GET['id'];
if (isset($id_product)) {
	$sql = "SELECT * FROM products WHERE id_product = '$id_product'";
	$result = $conn->query($sql);
	$rows = $result->fetch_assoc();
}
if (isset($_POST['update'])) {
	$name_pord = $_POST['name'];
	$price = $_POST['price'];
	$accessories = $_POST['accessories'];
	$warranty = $_POST['warranty'];
	$promotion = $_POST['promotion'];
	$status = $_POST['status'];
	$instock = $_POST['instock'];
	$description = $_POST['description'];
	$category = $_POST['cate'];
	$fancy = $_POST['featured'];

		// Check img
	if ($_FILES["img"]["name"] == "") {
		$img = $_POST['img'];
	} else {
		$img = $_FILES["img"]["name"];
		$tmp_name = $_FILES["img"]["tmp_name"];
	}

		//check empty
	if (isset($name_pord) && isset($price) && isset($img) && isset($accessories) && isset($warranty) && isset($promotion) && isset($status) && isset($instock) && isset($description) && isset($category) && isset($fancy)) {
			// Move img
		if (isset($tmp_name)) {
			move_uploaded_file($tmp_name, 'img/'.$img);
		}
		$sqlUpdate = "UPDATE products SET name_product='$name_pord', price_product='$price', pic_product='$img', accessories='$accessories', warranty='$warranty', promotion='$promotion', status='$status', instock='$instock', details='$description', id_categories='$category', fancy='$fancy' WHERE id_product='$id_product'";
		if ($conn->query($sqlUpdate) === TRUE) {
			header('location: ./home.php?page_layout=product');
		} else {
			echo "<script>alert('Thêm mới thất bại!')</script>";
		}
	}
	$conn->close();

}
?>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Sản phẩm</h1>
		</div>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			
			<div class="panel panel-primary">
				<div class="panel-heading">Sửa sản phẩm</div>
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data">
						<div class="row" style="margin-bottom:40px">
							<div class="col-xs-8">
								<div class="form-group" >
									<label>Tên sản phẩm</label>
									<input required type="text" name="name" class="form-control" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} else { echo $rows['name_product'];} ?>">
								</div>
								<div class="form-group" >
									<label>Giá sản phẩm</label>
									<input required type="number" name="price" class="form-control" value="<?php if(isset($_POST['price'])) {echo $_POST['price'];} else { echo $rows['price_product'];} ?>">
								</div>
								<div class="form-group" >
									<label>Ảnh sản phẩm</label>
									<input id="img" type="file" name="img" class="form-control" onchange="changeImg(this)" style="width: 200px; height: 200px; background-image: url(./img/<?php echo $rows['pic_product']; ?>); background-size: 96%;">
									<input type="hidden" name="img" value="<?php echo $rows['pic_product'] ?>">
									<!-- <img id="avatar" class="thumbnail" width="300px" src="img/iphone7-plus-black-select-2016.jpg"> -->
								</div>
								<div class="form-group" >
									<label>Phụ kiện</label>
									<input required type="text" name="accessories" class="form-control" value="<?php if(isset($_POST['accessories'])) {echo $_POST['accessories'];} else { echo $rows['accessories'];} ?>">
								</div>
								<div class="form-group" >
									<label>Bảo hành</label>
									<input required type="text" name="warranty" class="form-control" value="<?php if(isset($_POST['warranty'])) {echo $_POST['warranty'];} else { echo $rows['warranty'];} ?>">
								</div>
								<div class="form-group" >
									<label>Khuyến mãi</label>
									<input required type="text" name="promotion" class="form-control" value="<?php if(isset($_POST['promotion'])) {echo $_POST['promotion'];} else { echo $rows['promotion'];}?>">
								</div>
								<div class="form-group" >
									<label>Tình trạng</label>
									<input required type="text" name="status" class="form-control" value="<?php if(isset($_POST['status'])) {echo $_POST['status'];} else {  echo $rows['status'];}?>">
								</div>
								<div class="form-group" >
									<label>Trạng thái</label>
									<select required name="instock" class="form-control">
										<option value="1" <?php if($rows['instock'] == 1) echo "selected='selected'"; ?>>Còn hàng</option>
										<option value="0" <?php if($rows['instock'] == 0) echo "selected='selected'"; ?>>Hết hàng</option>
									</select>
								</div>
								<div class="form-group" >
									<label>Miêu tả</label>
									<textarea required name="description" style="width: 100%; height: 200px;"><?php if(isset($_POST['description'])) {echo $_POST['description'];} else { echo $rows['details'];} ?></textarea>
									<script type="text/javascript">
										CKEDITOR.replace('description');
									</script>
								</div>
								<div class="form-group" >
									<label>Danh mục</label>
									<select required name="cate" class="form-control">
										<?php while ($rows_cate = $result_cate->fetch_assoc()) {
											?>
											<option <?php if($rows['id_categories'] == $rows_cate['id_categories']) echo 'selected="selected"';?> value="<?php echo $rows_cate['id_categories']; ?>"><?php echo $rows_cate['name_categories']; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group" >
									<label>Sản phẩm nổi bật</label><br>
									Có: <input type="radio" name="featured" <?php if($rows['fancy'] == 1) echo "checked"; ?> value="1">
									Không: <input type="radio" <?php if($rows['fancy'] == 0) echo "checked"; ?> name="featured" value="0">
								</div>
								<input type="submit" name="update" value="Cập nhật" class="btn btn-primary">
								<a href="home.php?page_layout=product" class="btn btn-danger">Hủy bỏ</a>
							</div>
						</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->
