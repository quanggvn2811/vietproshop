<?php
if (isset($_POST['submit'])) {
	$name = addslashes($_POST['name']);
	$email = addslashes($_POST['email']);
	$phone = $_POST['phone'];
	$addr = addslashes($_POST['addr']);
	if (isset($name) && isset($email) && isset($phone) && isset($addr)) {
		if (isset($_SESSION['cart'])) {
			$arrayId = array();
			foreach ($_SESSION['cart'] as $id_prod => $qty) {
				$arrayId[] = $id_prod;
			}
			$strId = implode(',', $arrayId);

			$sql = "SELECT * FROM products WHERE id_product IN ($strId) ORDER BY id_product DESC";
			$result = $conn->query($sql);
			$priceAll = 0;
		}
		$strBody = '';
		$strBody .=		
		'<div id="wrap-inner">
		<div class="str-body">
		<div id="khach-hang">
		<h3>Thông tin khách hàng</h3>
		<p>
		<span class="info">Khách hàng: </span>'. $name .'
		
		</p>
		<p>
		<span class="info">Email: </span>
		'. $email .'
		</p>
		<p>
		<span class="info">Điện thoại: </span>
		'. $phone .'
		</p>
		<p>
		<span class="info">Địa chỉ: </span>
		'. $addr .'
		</p>
		</div>						
		<div id="hoa-don">
		<h3>Hóa đơn mua hàng</h3>							
		<table class="table-bordered table-responsive">
		<tr class="bold">
		<td width="40%">Tên sản phẩm</td>
		<td width="25%">Giá</td>
		<td width="10%">Số lượng</td>
		<td width="15%">Thành tiền</td>
		</tr>';
		while ($row = $result->fetch_assoc()) {
			$qty = $_SESSION['cart'][$row['id_product']];
			$priceProduct = $row['price_product'] * $qty;
			$priceAll += $priceProduct;
			$strBody .= '
			<tr>
			<td>'. $row['name_product'] .'</td>
			<td class="price">'. number_format($row['price_product']) .' VNĐ</td>
			<td>'. $qty .'</td>
			<td class="price">'. number_format($priceProduct) .' VNĐ</td>
			</tr>';
		};
		$strBody .= 
		'<tr>
		<td colspan="3" style="color: red;">Tổng tiền:</td>
		<td class="total-price">'. number_format($priceAll) .' VNĐ</td>
		</tr>
		</table>
		</div>
		<div id="xac-nhan">
		<br>
		<p align="justify">
		<b>Quý khách đã đặt hàng thành công!</b><br />
		• Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
		• Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng.<br />
		<b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</b>
		</p>
		</div>
		</div>
		</div>';


// Send email 

// Thiết lập SMTP Server 
require("PHPMailer_5.2.4/class.phpmailer.php"); // nạp thư viện 

$mailer = new PHPMailer(); // Khởi tạo đối tượng 
$mailer->IsSMTP(); //gọi class SMTP để đăng nhập
$mailer->CharSet = "utf-8";

// Đăng nhập Gma"l
$mailer->Host = "smtp.gmail.com";  // specify main and backup server
$mailer->SMTPAuth = true;     // dang nhap
$mailer->SMTPSecure = "ssl";
$mailer->Port = 465; // port smtp
// email
$mailer->Username = "giapvanngocquang@gmail.com";  // email send
$mailer->Password = "ngocQuang20171!"; // password 
$mailer->AddAddress($email, $name);
$mailer->AddCC("ngocquang97bg@gmail.com");

// set email format to HTML
$mailer->IsHTML(true);
$mailer->FromName = "Vietpro Shop";
$mailer->From = "giapvanngocquang@gmail.com";
$mailer->Subject = "Xác nhận mua hàng từ Vietpro Shop";

$mailer->Body    = $strBody;

if(!$mailer->Send())
{
	echo "Message could not be sent. <p>";
	echo "Mailer Error: " . $mailer->ErrorInfo;
	exit;
} else {
	session_start();
	unset($_SESSION['cart']);
	header('location: index.php?page_layout=complete');
	//echo $strBody;					
}
} } ?>