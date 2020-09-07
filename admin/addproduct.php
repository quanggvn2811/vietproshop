<?php 
include_once './connect.php';

	//Select category
$sql = "SELECT * FROM categories ORDER BY id_categories ASC";
$result = $conn->query($sql);

if (isset($_POST['submit'])) {
	$name_pord = $_POST['name'];
	$price = $_POST['price'];
		//$img = $_POST['img'];
	$accessories = $_POST['accessories'];
	$warranty = $_POST['warranty'];
	$promotion = $_POST['promotion'];
	$status = $_POST['status'];
		//$instock = $_POST['instock'];
	$description = $_POST['description'];
		//$category = $_POST['cate'];
	$fancy = $_POST['featured'];

		// Check img
	if ($_FILES["img"]["name"] == "") {
		$error_img = "<span style='color: red;'>(*)</span>";
	} else {
		$img = $_FILES["img"]["name"];
		$tmp_name = $_FILES["img"]["tmp_name"];
	}
		//Check instock
		// Check category
	if ($_POST["instock"] == "unselect" ) {
		$error_id_cate = "<span style='color: red;'>(*)</span>";
	} else {
		$instock = $_POST['instock'];
	}

		// Check category
	if ($_POST["id_cate"] == "unselect" ) {
		$error_id_cate = "<span style='color: red;'>(*)</span>";
	} else {
		$id_cate = $_POST["id_cate"];
	}

		//check empty
	if (isset($name_pord) && isset($price) && isset($img) && isset($accessories) && isset($warranty) && isset($promotion) && isset($status) && isset($instock) && isset($description) && isset($id_cate) && isset($fancy)) {
		move_uploaded_file($tmp_name, 'img/'.$img);
		$sqlProd = "INSERT INTO products (id_categories, name_product, pic_product, price_product, warranty, accessories, status, promotion,
		instock, fancy, details) VALUES('$id_cate', '$name_pord', '$img', '$price', '$warranty', '$accessories', '$status', '$promotion', '$instock', '$fancy', '$description' )";
		if ($conn->query($sqlProd) === TRUE) {
			header('location: ./home.php?page_layout=product');
		} else {
			echo "<script>alert('Thêm mới thất bại!')</script>";
		}
	}
	

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
				<div class="panel-heading">Thêm sản phẩm</div>
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data" action="">
						<div class="row" style="margin-bottom:40px">
							<div class="col-xs-8">
								<div class="form-group" >
									<label>Tên sản phẩm</label>
									<input required type="text" name="name" class="form-control">
								</div>
								<div class="form-group" >
									<label>Giá sản phẩm</label>
									<input required type="number" name="price" class="form-control">
								</div>
								<div class="form-group" style="position: relative;">
									<label>Ảnh sản phẩm</label>
									<input required id="img" type="file" name="img" class="form-control " onchange="changeImg(this)" style="width: 250px; height: 250px; background-image: url(./img/new_seo-10-512.png); background-size: 96%;">
									<!--   <img id="avatar" class="thumbnail" width="300px" src="img/new_seo-10-512.png"> -->
								</div>
								<div class="form-group" >
									<label>Phụ kiện</label>
									<input required type="text" name="accessories" class="form-control">
								</div>
								<div class="form-group" >
									<label>Bảo hành</label>
									<input required type="text" name="warranty" class="form-control">
								</div>
								<div class="form-group" >
									<label>Khuyến mãi</label>
									<input required type="text" name="promotion" class="form-control">
								</div>
								<div class="form-group" >
									<label>Tình trạng</label>
									<input required type="text" name="status" class="form-control">
								</div>
								<div class="form-group" >
									<label>Trạng thái</label>
									<select required name="instock" class="form-control">
										<option value="1">Còn hàng</option>
										<option value="0">Hết hàng</option>
									</select>
								</div>
								<div class="form-group" >
									<label>Miêu tả</label>
									<textarea required name="description" style="width: 100%; height: 200px;"></textarea>
								</div>
								<div class="form-group" >
									<label>Danh mục</label>
									<select required name="id_cate" class="form-control">
										<?php 
										while ($rowCate = $result->fetch_assoc()) {
											
											?>
											<option value="<?php echo $rowCate['id_categories'] ?>"><?php echo $rowCate['name_categories']; ?></option>

										<?php } ?>
									</select>
								</div>
								<div class="form-group" >
									<label>Sản phẩm nổi bật</label><br>
									Có: <input type="radio" name="featured" value="1">
									Không: <input type="radio" checked name="featured" value="0">
								</div>
								<input type="submit" name="submit" value="Thêm" class="btn btn-primary">
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
