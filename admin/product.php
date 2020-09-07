<?php 
include_once './connect.php';
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$rowsPerPage = 5;
$perRow = $page*$rowsPerPage - $rowsPerPage;
$sql = "SELECT * FROM products INNER JOIN categories ON products.id_categories = categories.id_categories 
ORDER BY id_product DESC LIMIT $perRow,$rowsPerPage";
$result = $conn->query($sql);

// Panigation
$count = $conn->query("SELECT COUNT(*) AS count FROM products");
$rowCount = $count->fetch_assoc();
$totalRows = $rowCount['count'];
$totalPages = ceil($totalRows/$rowsPerPage);

$listPage = "";
for($i=1; $i<=$totalPages; $i++){
	if($page == $i) {
		$listPage .= '<li class="page-item active"><a class="page-link" href="home.php?page_layout=product&page='.$i.'">'. $i . '</a></li>';
	} else {
		$listPage .= '<li class="page-item"><a class="page-link" href="home.php?page_layout=product&page='.$i.'">'. $i . '</a></li>';
	}
	
//next and privious page
	if($page == 1){
		$prvPage = 1;
	} else {
		$prvPage = $page - 1;
	}
	if($page == $totalPages){
		$nextPage = $totalPages;
	} else {
		$nextPage = $page + 1;
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
				<div class="panel-heading">Danh sách sản phẩm</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<div class="table-responsive">
							<a href="./home.php?page_layout=addproduct" class="btn btn-primary">Thêm sản phẩm</a>
							<table class="table table-bordered" style="margin-top:20px; ">				
								<thead>
									<tr class="bg-primary">
										<th>ID</th>
										<th width="30%">Tên Sản phẩm</th>
										<th>Giá sản phẩm</th>
										<th width="20%">Ảnh sản phẩm</th>
										<th>Danh mục</th>
										<th>Tùy chọn</th>
									</tr>
								</thead>
								<tbody>
									<?php while ($row = $result->fetch_assoc()) {
										?>
										<tr>
											<td><?php echo $row["id_product"] ?></td>
											<td><a href="./home.php?page_layout=editproduct&id=<?php echo $row['id_product'] ?>"><?php echo $row["name_product"]; ?></a></td>
											<td><?php echo number_format($row["price_product"]) ?> VNĐ</td>
											<td>
												<img width="200px" src="img/<?php echo $row["pic_product"] ?>" class="thumbnail">
											</td>
											<td><?php echo $row["name_categories"]; ?></td>
											<td>
												<a href="./home.php?page_layout=editproduct&id=<?php echo $row['id_product'] ?>" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
												<a onclick="return confirm('Bạn có chắc chắn muốn xóa?');" href="delProduct.php?id_product=<?php echo $row['id_product'] ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>							
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<ul class="pagination" style="margin-left: 15px; margin-bottom: 20px;">
			<li class="page-item"><a class="page-link" href="home.php?page_layout=product&page=<?php echo $prvPage ?>">Previous</a></li>
			<?php echo $listPage; ?>
			<li class="page-item"><a class="page-link" href="home.php?page_layout=product&page=<?php echo $nextPage ?>">Next</a></li>
		</ul>
	</div><!--/.row-->
	</div>	<!--/.main-->