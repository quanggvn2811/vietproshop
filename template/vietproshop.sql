-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 29, 2020 lúc 05:16 PM
-- Phiên bản máy phục vụ: 5.7.31-0ubuntu0.18.04.1
-- Phiên bản PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vietproshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id_categories` int(10) UNSIGNED NOT NULL,
  `name_categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id_categories`, `name_categories`) VALUES
(1, 'iPhone'),
(2, 'Samsung'),
(3, 'LG'),
(7, 'Nokia'),
(15, 'HTC'),
(16, 'Bakery'),
(17, 'Sony'),
(18, 'Lumia'),
(19, 'BPhone'),
(20, 'ZTE'),
(21, 'Huawei'),
(22, 'Lenovo'),
(23, 'TCL Communication'),
(25, 'Google'),
(26, 'Vertu'),
(27, 'BlackBerry'),
(28, 'Acer'),
(29, 'BBK'),
(31, 'ABCD'),
(32, 'Oppo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `id_product`, `email`, `name`, `content`, `created_at`) VALUES
(11, 15, 'attacsdker@gmail.com', 'Attacker', 'Comment 1', '2020-08-20 07:59:53'),
(12, 13, 'tommr@gmail.com', 'Tom', 'Sáº£n pháº©m Ä‘áº¯t quÃ¡ áº¡.', '2020-08-20 08:01:45'),
(13, 13, 'attacker@gmail.com', 'Attacker', 'Hacked by me.', '2020-08-20 08:18:55'),
(14, 13, 'admin@gmail.com', 'admin', 'Admin test comment ABC.', '2020-08-20 08:19:50'),
(15, 13, 'giapvanngocquang@gmail.com', 'Quang', 'TÃ´i khÃ´ng thÃ­ch sáº£n pháº©m nÃ y. NhÃ¬n tháº­t xáº¥u mÃ  giÃ¡ láº¡i Ä‘áº¯t.', '2020-08-20 08:21:05'),
(16, 13, 'maianh@gmail.com', 'Mai Anh', 'Äá»£i giÃ¡ xuá»‘ng 20tr thÃ¬ mua ahihi.', '2020-08-20 08:24:18'),
(17, 12, 'admin@gmail.com', 'admin', 'Admin test.', '2020-08-20 11:59:21'),
(18, 15, 'attacker@gmail.com', 'Attacker', 'Test abcd', '2020-08-20 12:05:14'),
(19, 15, 'admin@gmail.com', 'admin', 'admin test 1.', '2020-08-20 12:05:57'),
(20, 13, 'attacsdker@gmail.com', 'attack xss', 'Demo test', '2020-08-20 12:07:09'),
(21, 15, 'attacker@gmail.com', 'Attacker', 'Test XSS', '2020-08-20 12:33:17'),
(22, 17, 'admin@gmail.com', 'admin', 'admin test', '2020-08-20 12:39:56'),
(23, 15, 'tom@gmail.com', 'Tom', 'Sáº£n pháº©m Ä‘áº¹p.', '2020-08-20 12:41:03'),
(24, 13, 'cobemuadong@gmail.com', 'Dung', 'sao khÃ´ng cÃ³ nÃºt home', '2020-08-20 12:47:39'),
(25, 17, 'carlos@gmail.com', 'Carlos', 'Look sound good.', '2020-08-20 12:49:49'),
(26, 15, 'attacker@gmail.com', 'admin', 'Very good.', '2020-09-05 13:55:57'),
(27, 15, 'tommr@gmail.com', 'Tommr', 'GiÃ¡ Ä‘áº¯t quÃ¡.', '2020-09-07 02:39:25'),
(28, 15, 'attacker@gmail.com', 'Attacker', '&lt;script&gt;alert(1)&lt;/script&gt;', '2020-09-07 02:39:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id_product` int(10) UNSIGNED NOT NULL,
  `id_categories` int(10) UNSIGNED NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic_product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `warranty` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accessories` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `promotion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instock` tinyint(1) DEFAULT NULL,
  `fancy` tinyint(1) DEFAULT NULL,
  `details` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id_product`, `id_categories`, `name_product`, `pic_product`, `price_product`, `warranty`, `accessories`, `status`, `promotion`, `instock`, `fancy`, `details`) VALUES
(2, 1, 'iphone7-plus-black-2016', 'iphone7-plus-black-select-2016.jpg', '12000000', '6 tháng', 'Cáp, sạc, tai nghe', 'Like new', '10%', 1, 1, 'Sản phẩm chính hãng của Apple.'),
(3, 1, 'iphone7-plus-black-2016', 'iphone7-plus-black-select-2016.jpg', '15000000', '1 năm', 'Full box', 'New', '10%', 1, 1, 'Sản phẩm mới 100% chính hãng của Apple.'),
(5, 1, 'IPhone 8 Plus ', '8p-hong.jpg', '8899000', ' Báº£o hÃ nh 1 Ä‘á»•i 1 trong vÃ²ng 30 ngÃ y.', 'Táº·ng Fullbox: Cá»§ â€“ CÃ¡p Sáº¡c â€“ Tai nghe 3.5mm â€“ Há»™p', 'Likenew', '20%', 0, 0, 'iPhone 8 vÃ  8 Plus ra máº¯t: Máº·t lÆ°ng kÃ­nh, camera hoÃ n toÃ n má»›i\r\nSau ráº¥t nhiá»u Ä‘á»“n Ä‘oÃ¡n, iPhone 8 vÃ  8 Plus Ä‘Ã£ xuáº¥t hiá»‡n vá»›i máº·t lÆ°ng kÃ­nh vÃ  há»‡ thá»‘ng camera hoÃ n toÃ n má»›i.\r\n\r\nKhi iPhone 8 vÃ  iPhone 8 Plus xuáº¥t hiá»‡n trÃªn mÃ n hÃ¬nh, tiáº¿ng hÃ² reo bÃªn dÆ°á»›i khÃ¡n Ä‘Ã i khÃ¡ yáº¿u á»›t. Kiá»ƒu dÃ¡ng cá»§a hai máº«u iPhone nÃ y giá»‘ng há»‡t iPhone 7 vÃ  7 Plus, dÃ¹ pháº§n khung nhÃ´m Ä‘Æ°á»£c lÃ m tá»« cháº¥t liá»‡u bá»n hÆ¡n vÃ  cÃ³ thÃªm lá»›p kÃ­nh á»Ÿ máº·t lÆ°ng.'),
(6, 1, 'IPhone XS Max 64 GB Quá»‘c Táº¿', 'xsmx-vang.jpg', '16800000', 'Má»™t Ä‘á»•i má»™t trong 3 thÃ¡ng', 'Fullbox', 'Likenew', '10%', 1, 1, 'Sáº£n pháº©m chÃ­nh hÃ£ng Apple'),
(7, 1, 'IPhone 5S 32GB Quá»‘c Táº¿', '5s-trang.jpg', '3200000', 'Báº£o hÃ ng 6 thÃ¡ng ', 'CÃ¡p-sáº¡c-tai nghe', 'Likenew', '30%', 0, 0, 'Sáº£n pháº§m tuy ra máº¯t tá»« nÄƒm 2014 nhÆ°ng váº«n cÃ²n ráº¥t hÃ³t.'),
(8, 1, 'IPhone 11 Pro Max 256 GB', '11-pro-max.jpg', '25600000', '1 Ä‘á»•i 1 trong 3 thÃ¡ng, báº£o hÃ nh pháº§n má»m trá»ng Ä‘á»i, báº£o hÃ ng pháº§n cá»©ng 24 thÃ¡ng', 'Fullbox', 'New', '10%', 1, 1, 'Sáº£n pháº©m má»›i nháº¥t cá»§a Apple.'),
(9, 1, 'IPhone 4S 16 GB Quá»‘c Táº¿', '4s-den-1.jpg', '1200000', 'Báº£o hÃ nh 3 thÃ¡ng', 'CÃ¡p-sáº¡c-tai nghe', 'Likenew', '30%', 1, 0, 'Sáº£n pháº©m chÃ­nh hÃ ng Apple.'),
(10, 1, 'IPhone 6S 16GB Quá»‘c Táº¿', '6s-den.jpg', '4990000', ' Báº£o hÃ nh 1 Ä‘á»•i 1 trong vÃ²ng 30 ngÃ y.', 'CÃ¡p-sáº¡c-tai nghe', 'Likenew', '10%', 1, 0, 'Sáº£n pháº©m chÃ­nh hÃ ng Apple.'),
(11, 2, 'Samsung Galaxy Note 10+ ', 'samsung-galaxy-note-10-plus-031220-101226-400x460.png', '26990000', '1 nÄƒm', 'Fullbox', 'New', '10%', 1, 1, 'Sáº£n pháº©m má»›i nháº¥t cá»§a nhÃ  Samsung, sá»­ dá»¥ng cÃ´ng nghá»‡ máº¡ng 5G siÃªu nhanh.'),
(12, 2, 'Samsung Galaxy A21s', 'samsung-galaxy-a21s-055620-045627-400x460.png', '5690000', 'Báº£o hÃ nh 3 thÃ¡ng', 'Fullbox', 'Likenew', '30%', 1, 0, 'Sáº£n pháº©m chÃ­nh hÃ ng Samsung.'),
(13, 2, 'Samsung Galaxy Z-Flip', 'samsung-galaxy-z-flip-chitiet-2-788x544.png', '36000000', '3 nÄƒm', 'Fullbox', 'New', '10%', 1, 1, 'Sáº£n pháº©m Ä‘áº³ng cáº¥p nháº¥t cá»§a Sumsung.'),
(14, 1, 'IPhone 11 64GB Quá»‘c Táº¿', '11.jpg', '14890000', '1 nÄƒm', 'Fullbox', 'Likenew', '23%', 0, 1, 'Sáº£n pháº©m chÃ­nh hÃ£ng Apple.'),
(15, 1, 'IPhone 11 64GB Quá»‘c Táº¿', '11.jpg', '18290000', '1 nÄƒm', 'Fullbox', 'New', '10%', 1, 1, 'Sáº£n pháº©m fullbox chÃ­nh hÃ£ng Apple chÆ°a bÃ³c há»™p.'),
(16, 1, 'IPhone 6 Plus 64GB Quá»‘c Táº¿', '6-den.jpg', '4790000', 'Báº£o hÃ nh 3 thÃ¡ng', 'CÃ¡p-sáº¡c-tai nghe', 'Likenew', '20%', 1, 0, 'Sáº£n pháº©m chÃ­nh hÃ£ng Apple.'),
(17, 1, 'IPhone 6 16GB Quá»‘c Táº¿ - Likenew', '6-den.jpg', '2890000', 'Báº£o hÃ nh 6 thÃ¡ng', 'CÃ¡p-sáº¡c-tai nghe', 'Likenew', '20%', 1, 0, '<p>Sáº£n pháº©m ch&iacute;nh h&atilde;ng<strong> Apple</strong>, nguy&ecirc;n zin.</p>\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permission`) VALUES
(1, 'admin@gmail.com', 'admin@123', 1),
(2, 'root@gmail.com', 'admin@123', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categories`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_categories` (`id_categories`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categories` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id_categories`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
