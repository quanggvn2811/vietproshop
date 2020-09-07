<?php 
if (isset($_GET['id_product'])) {
	$id_product = $_GET['id_product'];
	// select product from db
	$sql = "SELECT * FROM products WHERE id_product = '$id_product'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
}


// comments
if (isset($_POST['comment'])) {
	$email = $_POST['email'];
	$name = $_POST['name'];
	$cmt = $_POST['cmt'];
	$emailErr = $nameErr = "";
	//check input function
	function check_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		$data = addslashes($data);
		return $data;
	}
	// Check email
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email!";
	}

	// Check name
	$name = check_input($name);
	if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  // check if name only contains letters and whitespace
		$nameErr = "Only letters and white space allowed";
	}

	// Check comment
	$cmt = check_input($cmt);

	// If everything ok
	if ($emailErr == "" && $nameErr == "") {
		//sql to insert into table
		$sql_cmt = "INSERT INTO comments (id_product, email, name, content) VALUES ('$id_product', '$email', '$name', '$cmt')";
		if ($conn->query($sql_cmt) === TRUE) {
			header('location: index.php?page_layout=details&id_product='.$id_product);
		} else {
			echo "<script>alert('Gửi bình luận thất bại.')</script>";	
		}

	}
}
// pagination
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$rowPerPage = 3;
$perRow = $page*$rowPerPage - $rowPerPage;

$result_pagi = $conn->query('SELECT * FROM comments WHERE id_product='. $id_product);
$totalRow = $result_pagi->num_rows;
$totalPage = ceil($totalRow/$rowPerPage);
$listPage="";
for($i=1; $i<=$totalPage; $i++){
	if ($i == $page) {
		$listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=details&id_product='.$id_product.'&page='.$i.'">'.$i.'</a></li>';
	} else {
		$listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=details&id_product='.$id_product.'&page='.$i.'">'.$i.'</a></li>';
	}
}
// Previous and next page
if ($page == 1) {
	$prevPage = 1;
} else {
	$prevPage = $page -1;
}
if ($page == $totalPage) {
	$nextPage = $totalPage;
} else {
	$nextPage = $page + 1;
}

// Show comments
$sql_show_cmt = "SELECT * FROM comments WHERE id_product = '$id_product' ORDER BY id DESC LIMIT $perRow,$rowPerPage";
$result_show_cmt = $conn->query($sql_show_cmt);
?>
<div id="wrap-inner">
	<div id="product-info">
		<div class="clearfix"></div>
		<h3><?php echo $row['name_product'] ?></h3>
		<div class="row">
			<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center">
				<img src="./admin/img/<?php echo $row['pic_product'] ?>" style="max-width: 230px; max-height: 500px;">
			</div>
			<div id="product-details" class="col-xs-12 col-sm-12 col-md-9">
				<p>Giá: <span class="price"><?php echo number_format($row['price_product']) ?> VNĐ</span></p>
				<p>Bảo hành: <?php echo $row['warranty'] ?></p> 
				<p>Phụ kiện: <?php echo $row['accessories'] ?></p>
				<p>Tình trạng: <?php echo $row['status'] ?></p>
				<p>Khuyến mại: <?php echo $row['promotion'] ?></p>
				<p>Còn hàng: <?php if($row['instock'] == 1) {echo 'Còn hàng';} else { echo 'Hết hàng';} ?></p>
				<p class="add-cart text-center"><a href="site/shopping/addProduct.php?id_product=<?php echo $id_product ?>">Đặt hàng</a></p>
			</div>
		</div>							
	</div>
	<div id="product-detail">
		<h3>Chi tiết sản phẩm</h3>
		<p class="text-justify"><?php echo $row['details'] ?>  <br> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus minus, pariatur, rem labore, assumenda consequatur quae quia aut, et magnam enim perferendis. Repellat, rem iusto earum unde laboriosam quibusdam, officia dolore molestiae assumenda beatae dignissimos, fugiat dolorem pariatur sequi, esse facere cumque tenetur expedita aliquid explicabo quas blanditiis eaque accusantium veniam veritatis. Tempore dignissimos accusamus optio laudantium nisi velit deserunt inventore numquam aperiam eum. Iure praesentium sit, alias corporis voluptatem accusantium laborum tenetur blanditiis quae dignissimos cumque labore incidunt aliquid, nobis commodi excepturi voluptates explicabo dolores nisi assumenda. Laborum architecto pariatur adipisci natus, voluptatem, corporis eveniet modi vero itaque minus.</p>
	</div>
	<div id="comment">
		<h3>Bình luận</h3>
		<div class="col-md-9 comment">
			<form action="" method="post">
				<div class="form-group">
					<label for="email">Email:</label>
					<input required type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="name">Tên:</label>
					<input required type="text" class="form-control" id="name" name="name">
				</div>
				<div class="form-group">
					<label for="content">Bình luận:</label>
					<textarea required rows="10" id="content" class="form-control" name="cmt"></textarea>
				</div>
				<div class="form-group text-right">
					<button name="comment" type="submit" class="btn btn-primary">Gửi bình luận</button>
				</div>
			</form>
		</div>
	</div>
	<div id="comment-list">
		<?php while ($rows_show_cmt = $result_show_cmt->fetch_assoc()) {

			?>
			<ul>
				<li class="com-title">
					<?php echo $rows_show_cmt['name'] ?>
					<br>
					<span><?php echo $rows_show_cmt['created_at'] ?></span>	
				</li>
				<li class="com-details">
					<?php echo $rows_show_cmt['content'] ?>
				</li>
			</ul>
		<?php } ?>
	</div>
	<div id="pagination">
		<ul class="pagination pagination-lg justify-content-center">
			<li class="page-item">
				<a class="page-link" href="index.php?page_layout=details&id_product=<?php echo $id_product ?>&page=<?php echo $prevPage ?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
				</a>
			</li>
			<?php echo $listPage; ?>
			<li class="page-item">
				<a class="page-link" href="index.php?page_layout=details&id_product=<?php echo $id_product ?>&page=<?php echo $nextPage ?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
		</ul>
	</div>
</div>					
