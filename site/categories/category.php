<?php 
$sql_cate = "SELECT * FROM categories LIMIT 12";
$result_cate = $conn->query($sql_cate);

 ?>
<nav id="menu">
	<ul>
		<li class="menu-item">danh mục sản phẩm</li>
		<?php while ($row_cate = $result_cate->fetch_assoc()) { ?>
		<li class="menu-item"><a href="index.php?page_layout=category&id_cate=<?php echo $row_cate['id_categories'] ?>" title=""><?php echo $row_cate['name_categories'] ?></a></li>
		<?php } ?>					
	</ul>
	<!-- <a href="#" id="pull">Danh mục</a> -->
</nav>