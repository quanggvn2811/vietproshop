<?php 
ob_start();
session_start();
include_once './config/connect.php';

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Vietpro Shop - Home</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/home.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php 
	if (isset($_GET['page_layout'])) {
		switch ($_GET['page_layout']) {
			case 'category':
			echo '<link rel="stylesheet" href="css/category.css">';
			break;
			case 'details':
			echo '<link rel="stylesheet" href="css/details.css">';
			break;
			case 'search':
			echo '<link rel="stylesheet" href="css/search.css">';
			break;
			case 'cart': echo '<link rel="stylesheet" href="css/cart.css">';
				break;
			case 'complete': echo '<link rel="stylesheet" href="css/complete.css">';
				break;
			case 'email': echo '<link rel="stylesheet" href="css/email.css">';
				break;
		}
	}


	?>
	<script type="text/javascript">
		$(function() {
			var pull        = $('#pull');
			menu        = $('nav ul');
			menuHeight  = menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});
		});

		$(window).resize(function(){
			var w = $(window).width();
			if(w > 320 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	</script>
</head>
<body>    
	<!-- header -->
	<header id="header">
		<div class="container">
			<div class="row">
				<div id="logo" class="col-md-3 col-sm-12 col-xs-12">
					<h1>
						<a href="./index.php"><img src="img/home/logo.png"></a>						
						<nav><a id="pull" class="btn btn-danger" href="#">
							<i class="fa fa-bars"></i>
						</a></nav>			
					</h1>
				</div>
				<!-- search -->
				<?php include_once 'site/search/search.php'; ?>
				<!-- end search -->
				<!-- cart -->
				<?php include_once 'site/shopping/cart.php'; ?>
				<!-- end cart --> 
			</div>			
		</div>
	</header><!-- /header -->
	<!-- endheader -->

	<!-- main -->
	<section id="body">
		<div class="container">
			<div class="row">
				<div id="sidebar" class="col-md-3">
					
					<!-- category -->
					<?php include_once 'site/categories/category.php'; ?>
					<!-- end category -->
					<!-- banner left -->
					<?php include_once 'site/slideshow/bannerLeft.php'; ?>
					<!-- end banner left -->
				</div>

				<div id="main" class="col-md-9">
					<!-- main -->
					<!-- phan slide la cac hieu ung chuyen dong su dung jquey -->
					<!-- slide -->
					<?php include_once './site/slideshow/slide.php'; ?>
					<!-- end slide -->
					<!-- banner top -->
					<?php include_once './site/slideshow/bannerTop.php'; ?>
					<!-- end banner top -->
					<?php 
					// Master page
					if (isset($_GET['page_layout'])) {
						$page_layout = $_GET['page_layout'];
						switch ($page_layout) {
							case 'category': include_once 'site/products/productSort.php';
							break;
							case 'details': include_once 'site/products/details.php';
							break;
							case 'search': include_once 'site/search/searchList.php';
							break;
							case 'cart': include_once 'site/shopping/cartList.php';
							break;
							case 'complete': include_once 'site/shopping/complete.php';
							break;
							case 'email': include_once 'site/shopping/email.php';
							break;
							default:
							include_once 'site/products/main.php';
							break;
						}
					} else {
						include_once 'site/products/main.php';
					}

					?>
					
					<!-- end main -->
				</div>
			</div>
		</div>
	</section>
	<!-- endmain -->

	<!-- footer -->
	<?php include_once './site/footer/footer.php'; ?>
</footer>
<!-- endfooter -->
</body>
</html>