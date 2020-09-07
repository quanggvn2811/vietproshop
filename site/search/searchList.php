<?php 
function cleanText($txt){
	$txt = trim($txt);
	$txt_arr = explode(' ', $txt);
	$txt = implode('%', $txt_arr);
	$txt = '%'.$txt.'%';
	$txt = addslashes($txt);
	return $txt;
}
if (isset($_POST['sText'])) {
	$sText = cleanText($_POST['sText']);
} else {
	$sText = $_GET['sText'];
}
function convertText($txt){
	$txt = trim($txt);
	//$txt = preg_replace('%', ' ', $txt);
	$txt_arr = explode('%', $txt);
	$txt = implode(' ', $txt_arr);
	return $txt;
}
$sText_tmp = convertText($sText);
	// get page
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$rowPerPage = 8;
$perRow = $page*$rowPerPage - $rowPerPage;

	//pagination
$result_pagi = $conn->query("SELECT * FROM products");
$totalRow = $result_pagi->num_rows;
$totalPage = ceil($totalRow/$rowPerPage);

$listPage="";
for($i=1; $i<=$totalPage; $i++){
	if ($i == $page) {
		$listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=search&sText='.$sText.'&page='.$i.'">'.$i.'</a></li>';
	} else {
		$listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&sText='.$sText.'&page='.$i.'">'.$i.'</a></li>';
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

$sql = "SELECT * FROM products WHERE (name_product LIKE '$sText'OR details LIKE '$sText') ORDER BY id_product DESC LIMIT $perRow,$rowPerPage";
$result = $conn->query($sql);

?>


<div id="wrap-inner">
	<div class="products">
		<h3>Tìm kiếm với từ khóa: <span><?php echo $sText_tmp ?></span></h3>
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
				<a class="page-link" href="index.php?page_layout=search&sText=<?php echo $sText; ?>&page=<?php echo $prevPage; ?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
				</a>
			</li>
			<?php echo $listPage; ?>
			<li class="page-item">
				<a class="page-link" href="index.php?page_layout=search&sText=<?php echo $sText; ?>&page=<?php echo $nextPage; ?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
		</ul>
	</div>
</div>

