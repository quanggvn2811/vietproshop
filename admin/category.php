<?php 
include_once './connect.php';
if (isset($_GET['page'])) {
	$page= $_GET['page'];
}
else{
	$page= 1;
}
$rowPerPage= 6;
$perRow = $page*$rowPerPage - $rowPerPage;

$sql = "SELECT * FROM categories ORDER BY id_categories ASC LIMIT $perRow,$rowPerPage";
$result = $conn->query($sql);

	//panigation
$results = $conn->query("SELECT COUNT(name_categories) AS count FROM categories");
$rows = $results->fetch_assoc();
$totalRow = $rows['count'];
$totalPage = ceil($totalRow/$rowPerPage);

$listPage= "";
for($i=1; $i<=$totalPage; $i++){
	if ($i == $page) {
		$listPage.= '<li class="active"><a class="page-link" href="home.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
	}else{
		$listPage.= '<li><a class="page-link" href="home.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
	}
}
	//next and previous button
if ($page == 1) {
	$prevPage = 1;
}else{
	$prevPage = $page -1;
}
if ($page == $totalPage) {
	$nextPage = $page;
}else{
	$nextPage = $page + 1;
}

	//add category
if(isset($_POST['addCategory'])){
	$newCategory = $_POST['addNew'];
	if (isset($newCategory)) {
		$add = "INSERT INTO categories (name_categories) VALUES ('$newCategory')";
		if ($conn->query($add) === TRUE) {				
			header('location: ./home.php?page_layout=category');				
		}else{
			echo "<script>alert('Thêm mới thất bại!')</script>";
		}
	}
}
$conn->close();

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
					Thêm danh mục
				</div>
				<div class="panel-body">
					<form action="" method="POST">
						<div class="form-group">
							<label>Tên danh mục:</label>
							<input type="text" name="addNew" class="form-control" placeholder="Tên danh mục..." required>
							<input type="submit" name="addCategory" value="Thêm mới danh mục" class="btn btn-primary" style="margin-top: 10px;">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-7 col-lg-7">
			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách danh mục</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<table class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th>Tên danh mục</th>
									<th style="width:30%">Tùy chọn</th>
								</tr>
							</thead>
							<tbody>
								<?php while($row = $result->fetch_assoc()){ ?>
									<tr>
										<td><a href="./home.php?page_layout=editcategory&id_category=<?php echo $row['id_categories'] ?>"><?php echo $row['name_categories'] ?></a></td>
										<td>
											<a href="./home.php?page_layout=editcategory&id_category=<?php echo $row['id_categories'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
											<a href="./delCategory.php?id_category=<?php echo $row['id_categories'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
				</div>
				<ul class="pagination" style="margin-left: 1.5rem">
					<li class="page-item"><a class="page-link" href="home.php?page_layout=category&page=<?php echo $prevPage ?>">Previous</a></li>
					<?php 
					echo $listPage;

					?>
					<li class="page-item"><a class="page-link" href="home.php?page_layout=category&page=<?php echo $nextPage ?>">Next</a></li>
				</ul>
			</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->
