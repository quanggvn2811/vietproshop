<?php 
// Fancy product
$sql = "SELECT * FROM products WHERE fancy=1 ORDER BY id_product DESC LIMIT 8;";
$result = $conn->query($sql);


// New product
$sqlNew = "SELECT * FROM products ORDER BY id_product DESC LIMIT 8";
$resultNew = $conn->query($sqlNew);
?>
<div id="wrap-inner">
	<div class="products">
		<h3>sản phẩm nổi bật</h3>
		<div class="product-list row">
			<?php while ($row = $result->fetch_assoc()) {
				?>
				<div class="product-item col-md-3 col-sm-6 col-xs-12">
					<a href="index.php?page_layout=details&id_product=<?php echo $row['id_product'] ?>"><img src="./admin/img/<?php echo $row['pic_product'] ?>" class="img-thumbnail"></a>
					<p><a href="index.php?page_layout=details&id_product=<?php echo $row['id_product'] ?>"><?php echo $row['name_product'] ?></a></p>
					<p class="price"><?php echo number_format($row['price_product']) ?></p>	  
					<div class="marsk">
						<a href="index.php?page_layout=details&id_product=<?php echo $row['id_product'] ?>">Xem chi tiết</a>
					</div>                                    
				</div>
			<?php } ?>
		</div>                	                	
	</div>

	<div class="products">
		<h3>sản phẩm mới</h3>		
		<div class="product-list row">
			<?php while($rowNew = $resultNew->fetch_assoc()){ ?>
				<div class="product-item col-md-3 col-sm-6 col-xs-12">
					<a href="index.php?page_layout=details&id_product=<?php echo $rowNew['id_product'] ?>"><img src="./admin/img/<?php echo $rowNew['pic_product'] ?>" class="img-thumbnail"></a>
					<p><a href="index.php?page_layout=details&id_product=<?php echo $rowNew['id_product'] ?>"><?php echo $rowNew['name_product'] ?></a></p>
					<p class="price"><?php echo number_format($rowNew['price_product']) ?></p>	  
					<div class="marsk">
						<a href="index.php?page_layout=details&id_product=<?php echo $rowNew['id_product'] ?>">Xem chi tiết</a>
					</div>                      	                        
				</div>
			<?php } ?>                 	                      
		</div>   
	</div>
</div>
