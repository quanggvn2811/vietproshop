<?php 
if (isset($_GET['id_cate'])) {
	$id_cate = $_GET['id_cate'];

	// Sql to select name category
	$sql_cate = "SELECT name_categories FROM categories WHERE id_categories = '$id_cate'";
	$result_cate = $conn->query($sql_cate);
	$row_cate = $result_cate->fetch_assoc();


	// Pagination
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	$rowPerPage = 8;
	$perRow = $page*$rowPerPage - $rowPerPage;

	$result_pagi = $conn->query("SELECT COUNT(*) AS count FROM products WHERE id_categories = '$id_cate'");
	$row_pagi = $result_pagi->fetch_assoc();
	$totalRow = $row_pagi['count'];
	$totalPage = ceil($totalRow/$rowPerPage); 

	$listPage = "";
	for($i=1; $i<=$totalPage; $i++){
		if ($i == $page) {
			$listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=category&id_cate='.$id_cate.'&page='.$i.'">'.$i.'</a></li>';
		} else {
			$listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&id_cate='.$id_cate.'&page='.$i.'">'.$i.'</a></li>';
	}
}
	// Next and previous page
	if ($page == 1){
		$prevPage = 1;
	} else {
		$prevPage = $page - 1;
	}
	if ($page == $totalPage) {
		$nextPage = $totalPage;
	} else {
		$nextPage = $page + 1;
	}

	// Sql to select products of category
	$sql = "SELECT * FROM products WHERE id_categories = '$id_cate' ORDER BY id_product DESC LIMIT $perRow,$rowPerPage";
	$result = $conn->query($sql);

}

 ?>

<div id="wrap-inner">
	<div class="products">
		<h3><?php echo $row_cate['name_categories'] ?></h3>
		<div class="product-list row">
			<?php while ($row = $result->fetch_assoc()) { ?>
			<div class="product-item col-md-3 col-sm-6 col-xs-12">
				<a href="#"><img src="./admin/img/<?php echo $row['pic_product'] ?>" class="img-thumbnail"></a>
				<p><a href="#"><?php echo $row['name_product'] ?></a></p>
				<p class="price"><?php echo number_format($row['price_product']) ?></p>	  
				<div class="marsk">
					<a href="index.php?page_layout=details&id_product=<?php echo $row['id_product'] ?>">Xem chi tiết</a>
				</div>                                    
			</div>
		<?php } ?>
			</div>                	                	
	</div>

	<div id="pagination">
		<ul class="pagination pagination-lg justify-content-center">
			<li class="page-item">
				<a class="page-link" href="index.php?page_layout=category&id_cate=<?php echo $id_cate ?>&page=<?php echo $prevPage ?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
				</a>
			</li>
			<?php echo $listPage; ?>
			<li class="page-item">
				<a class="page-link" href="index.php?page_layout=category&id_cate=<?php echo $id_cate ?>&page=<?php echo $nextPage ?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
		</ul>
	</div>
</div>