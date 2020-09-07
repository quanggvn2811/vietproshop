<?php 
if (isset($_SESSION['cart'])) {
	// Update cart
	if (isset($_POST['qty'])) {
		foreach ($_POST['qty'] as $id_product => $qty) {
			if ($qty === 0) {
				unset($_SESSION['cart'][$id_product]);
			} elseif ($qty > 0) {
				$_SESSION['cart'][$id_product] = $qty;
			}
		}
	}


	// Show list product in cart
	$idArr = array();
	foreach ($_SESSION['cart'] as $id_prod => $qty) {
		$idArr[] = $id_prod;
	}
	$idStr = implode(",", $idArr);
	//echo $idStr;
	$sql = "SELECT * FROM products WHERE id_product IN ($idStr) ORDER BY id_product DESC";

	$result = $conn->query($sql) or die($conn->error);
	?>
	<div id="wrap-inner">	
		<div id="list-cart">
			<h3>Giỏ hàng</h3>
			<form action="" method="post" id="cartUpdate">
				<table class="table table-bordered .table-responsive text-center">
					<tr class="active">
						<td width="11.111%">Ảnh mô tả</td>
						<td width="33.333%">Tên sản phẩm</td>
						<td width="11.111%">Số lượng</td>
						<td width="16.6665%">Đơn giá</td>
						<td width="16.6665%">Thành tiền</td>
						<td width="11.112%">Xóa</td>
					</tr>
					<?php 
					$totalPriceAll = 0;
					while ($row = $result->fetch_assoc()) {
						$totalPrice = $row['price_product']* $_SESSION['cart'][$row['id_product']];
						$totalPriceAll += $totalPrice;
						?>
						<tr>
							<td><img style="width: 120px; height: 120px;" class="img-responsive" src="admin/img/<?php echo $row['pic_product']; ?>"></td>
							<td><?php echo $row['name_product']; ?></td>
							<td>
								<div class="form-group">
									<input class="form-control" name="qty[<?php echo $row['id_product']; ?>]" type="number" 
									value="<?php echo $_SESSION['cart'][$row['id_product']]; ?>">
								</div>
							</td>
							<td><span class="price"><?php echo number_format($row['price_product']); ?> VNĐ</span></td>
							<td><span class="price"><?php echo number_format($totalPrice); ?> đ</span></td>
							<td><a href="site/shopping/deleteCart.php?id_product=<?php echo $row['id_product'] ?>">Xóa</a></td>
						</tr>
					<?php } ?>
				</table>
				<div class="row" id="total-price">
					<div class="col-md-6 col-sm-12 col-xs-12">										
						Tổng thanh toán: <span class="total-price"><?php echo number_format($totalPriceAll); ?> VNĐ</span>

					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<a href="index.php" class="my-btn btn">Mua tiếp</a>
						<a  onclick="document.getElementById('cartUpdate').submit();" href="#" class="my-btn btn">Cập nhật</a>
						<!-- <input type="submit" name="update" value="Cập nhật" class="btn my-btn"> -->
						<a href="site/shopping/deleteCart.php?id_product=0" onclick="return confirm('Xóa giỏ hàng của bạn?');" class="my-btn btn">Xóa giỏ hàng</a>
					</div>
				</div>
			</form>             	                	
		</div>

		<div id="xac-nhan">
			<h3>Xác nhận mua hàng</h3>
			<form action="index.php?page_layout=email" method="post">
				<div class="form-group">
					<label for="email">Email address:</label>
					<input required type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="name">Họ và tên:</label>
					<input required type="text" class="form-control" id="name" name="name">
				</div>
				<div class="form-group">
					<label for="phone">Số điện thoại:</label>
					<input required type="number" class="form-control" id="phone" name="phone">
				</div>
				<div class="form-group">
					<label for="add">Địa chỉ:</label>
					<input required type="text" class="form-control" id="addr" name="addr">
				</div>
				<div class="form-group text-right">
					<button type="submit" name="submit" class="btn btn-default">Thực hiện đơn hàng</button>
				</div>
			</form>
		</div>
	</div>

	<?php  
} else {
	//echo "<script>alert('Giỏ hàng trống!')</script>";
	echo "<h6 style='text-align: right; margin-top: 10px;'><a href='index.php'>Về trang chủ</a></h6>";
}
?>