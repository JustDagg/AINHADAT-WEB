-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:4306
-- Thời gian đã tạo: Th5 08, 2024 lúc 12:36 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ainhadatstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(3, 'Tuandang', 'tuandang@gmail.com', '$2y$10$9OMyQbuGRfg.Qy3JUsVwh.SvRfhzDCgpF5jRIltP5.gA56gyXrJX.'),
(5, 'Duc Quang', 'ducquang@gmail.com', '$2y$10$iSkCepN/OU50AMZOnmCpwu4mQJQKoQJETFIcZjh4BSNbWgA4PKxR6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(2, 'Nhà đất bán Quận Hoàn Kiếm'),
(3, 'Nhà đất bán Quận Tây Hồ'),
(11, 'Nhà đất bán Quận Ba Đình'),
(12, 'Nhà đất bán Huyện Hoài Đức'),
(13, 'Nhà đất bán Quận Long Biên'),
(14, 'Nhà đất bán Quận Nam Từ Liêm'),
(15, 'Nhà đất bán Quận Bắc Từ Liêm'),
(16, 'Nhà đất bán Quận Cầu Giấy'),
(17, 'Nhà đất bán Huyện Sóc Sơn'),
(18, 'Nhà đất bán Huyện Gia Lâm'),
(19, 'Nhà đất bán Quận Thanh Xuân '),
(20, 'Nhà đất bán Quận Hà Đông'),
(21, 'Nhà đất bán Huyện Đông Anh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(300) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(14, 'Bán căn hộ chung cư'),
(15, 'Bán nhà trong ngõ'),
(16, 'Bán nhà mặt phố'),
(17, 'Bán nhà biệt thự, liền kề'),
(18, 'Bán đất nền dự án'),
(19, 'Bán đất ở, đất thổ cư'),
(20, 'Bán khách sạn, nhà hàng, nhà nghỉ'),
(22, 'Bán kho, nhà xưởng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `product_keywords` varchar(300) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(300) NOT NULL,
  `product_image2` varchar(300) NOT NULL,
  `product_image3` varchar(300) NOT NULL,
  `product_price` varchar(300) NOT NULL,
  `product_land_size` varchar(300) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `product_land_size`, `date`, `status`) VALUES
(1, 'Căn hộ chung cư Thăng Long Number One', '                - Chào mừng quý khách đến với căn hộ 3 phòng ngủ, 2 phòng vệ sinh diện tích 131m2 tại chung cư cao cấp Thăng Long Number One. \r\n- Căn hộ được thiết kế hiện đại, nội thất cơ bản đầy đủ. \r\n- Chung cư Thăng Long Number One tọa lạc tại khu đô thị Yên Hòa Thăng Long, một dự án cao cấp với đầy đủ tiện ích, môi trường                        ', 'Căn hộ chung cư Thăng Long Number One, Căn hộ chung cư Quận Cầu Giấy, Căn hộ chung cư', 14, 16, 'canhochungcuquancaugiay1.jpg', 'canhochungcuquancaugiay2.jpg', 'canhochungcuquancaugiay3.jpg', '6 ', '131 mét vuông', '2024-05-02 04:35:58', 'true'),
(2, 'Nhà trong ngõ 4 tầng ', 'Chào mừng quý khách đến với dự án bất động sản cao cấp của chúng tôi. Chúng tôi xin giới thiệu ngôi nhà 4 tầng với thiết kế hiện đại, tiện nghi. Ngôi nhà nằm trong khu dân cư thân thiện, yên tĩnh, gần trung tâm thương mại và các tiện ích công cộng như chợ, ủy ban phường, trạm y tế.  Đây là cơ hội tuyệt vời', 'Nhà trong ngõ quận Long Biên, Bán nhà trong ngõ', 15, 13, 'nhatrongngo1.1.jpg', 'nhatrongngo1.2.jpg', 'nhatrongngo1.jpg', '3', '34 mét vuông', '2024-02-21 07:45:23', 'true'),
(3, 'Căn hộ chung cư Quận Tây Hồ', 'Đây là căn hộ góc với diện tích 89m2, gồm 2 phòng ngủ, 2 nhà vệ sinh, phòng khách và bếp.  Căn hộ được thiết kế hiện đại, nội thất đầy đủ như tủ lạnh, máy giặt, bàn ghế, bếp, tivi, etc. Pháp lý sổ riêng, công chứng sẵn sàng.', 'Căn hộ chung cư, Bán căn hộ chung cư Quận Tây Hồ', 14, 3, 'canhochungcu2.jpg', 'canhochungcu2.1.jpg', 'canhochungcu2.2.jpg', '2', '79 mét vuông', '2024-02-21 07:45:49', 'true'),
(4, 'Nhà phố thương mại 4 tầng Huyện Hoài Đức', 'Chào mừng quý khách! Tôi có căn nhà phố 4 tầng rộng 38m2, vị trí đắc địa tại xã Vân Canh, huyện Hoài Đức, Hà Nội.  Điểm nổi bật: - Vị trí góc 2 mặt tiền thuận lợi, cách mặt đường ô tô 30m. - Thiết kế hiện đại, thông thoáng. - Cách UBND xã, trường học gần. - Cách Mỹ Đình 10 phút, thuận tiện đi lại. -', 'Nhà trong ngõ, Bán nhà Huyện Hoài Đức', 15, 12, 'nhatrongngo2.jpg', 'nhatrongngo2.1.jpg', 'nhatrongngo2.2.jpg', '3', '38 mét vuông', '2024-02-21 07:46:10', 'true'),
(5, 'Bán đất nền dự án Bắc Từ Liêm', 'Diện tích đất 102m2 (5x20m) thông thoáng, có lối đi riêng 3.5m thuận tiện cho các loại xe nhỏ ra vào.  Giá cả hợp lý, 45 triệu đồng/m2, phù hợp để ở hoặc cho thuê. Hỗ trợ vay vốn ngân hàng lên tới 80% giá trị.', 'Đất nền dự án, Bán đất nền Bắc Từ Liêm', 18, 15, 'bandatnenduan1.jpg', 'bandatnenduan1.1.jpg', 'bandatnenduan1.2.jpg', '4', '102 mét vuông', '2024-02-21 07:46:34', 'true'),
(6, 'Căn hộ chung cư Thăng Long Number One Nam Từ Liêm', 'Tôi hiện đang có căn hộ ở chung cư Thăng Long Number One, nằm tại vị trí đắc địa của trung tâm Hà Nội, cần bán gấp.  Đây là căn hộ 3 phòng ngủ rộng 139m2, thiết kế thông thoáng, tầm nhìn đẹp. Tòa nhà được xây dựng khang trang hiện đại, nằm gần trường học, bệnh viện, tiện ích sinh hoạt. Giao thông rấ', 'Căn hộ chung cư, Bán căn hộ chung cư Quận Nam Từ Liêm', 14, 14, 'canhochungcu3.1.jpg', 'canhochungcu3.2.jpg', 'canhochungcu3.3.jpg', '7', '139 mét vuông', '2024-02-21 07:46:55', 'true'),
(11, 'Căn nhà đẹp trong ngõ Vương Thừa Vũ', 'Tọa lạc tại vị trí đắc địa của quận Thanh Xuân, Hà Nội, căn nhà tại ngõ 168 phố Vương Thừa Vũ đang là cơ hội đầu tư hấp dẫn cho các gia đình trẻ và các nhà đầu tư bất động sản. Với diện tích 48m2 và 5 tầng xây dựng chắc chắn, ngôi nhà mang đến không gian sống tiện nghi và đẳng cấp.  Điểm nổi bật của căn nhà:  - Kết cấu vững chãi với móng bè, khung cột chịu lực và đổ bê tông đầy đủ 5 tầng - Thiết kế thông minh, tối ưu hóa không gian sử dụng: + Tầng 1 để xe ô tô thuận tiện + Tầng 2, 3, 4 mỗi tầng ', 'Nhà trong ngõ, Bán nhà trong ngõ Phường Khương Trung, Bán nhà trong ngõ Quận Thanh Xuân', 15, 19, 'nhatrongngo4.jpg', 'nhatrongngo4.1.jpg', 'nhatrongngo4.2.jpg', '11', '47 mét vuông', '2024-03-10 04:32:42', 'true'),
(12, 'Bán đất mặt tiền Huyện Gia Lâm', 'Đất mặt tiền đường chính kinh doanh buôn bán tại Gia Lâm. Diện tích: 133m2 Mặt tiền: 6m hậu 6m vuông vắn. Hướng: Đông Nam. Lộ giới: 28m có 4 làng xe. Vị trí: ngay mặt tiền đường chính langbian, xung quanh bán kính 1km đầy đủ tất cả các tiện ích như trường học, chợ, ủy ban, ngân hàng, trạm y tế....', 'Bán đất ở, đất thổ cư Huyện Gia Lâm', 19, 18, 'datodatthocu1.jpg', 'datodatthocu1.1.jpg', 'datodatthocu1.1.jpg', '8', '133 mét vuông', '2024-03-10 04:41:15', 'true'),
(13, 'Căn hộ chung cư thăng long Number Two', 'Do thay đổi công việc, chủ nhà cần bán gấp căn hộ chung cư Thăng Long Number Two. Căn hộ 3 phòng ngủ, 108m2, nội thất đầy đủ, hướng đẹp. Vị trí thuận lợi, gần chợ, trường học và có giao thông thuận tiện. Lý tưởng cho gia đình có nhu cầu an cư.', 'Bán căn hộ chung cư, Bán căn hộ chung cư Quận Cầu Giấy', 14, 16, 'canhochungcu5.jpg', 'canhochungcu5.1.jpg', 'canhochungcu5.2.jpg', '5', '108 mét vuông', '2024-03-10 04:45:02', 'true'),
(14, 'Căn hộ chung cư Thăng Long Vàng', 'Tôi hiện đang có căn hộ ở chung cư Thăng Long Vàng, nằm tại vị trí đắc địa của trung tâm Hà Nội, cần bán gấp.  Đây là căn hộ 3 phòng ngủ rộng 139m2, thiết kế thông thoáng, tầm nhìn đẹp. Tòa nhà được xây dựng khang trang hiện đại, nằm gần trường học, bệnh viện, tiện ích sinh hoạt. Giao thông rất thuận lợi di chuyển đi lại.', 'Căn hộ chung cư, Bán căn hộ chung cư Quận Nam Từ Liêm', 0, 0, 'canhochungcu6.jpg', 'canhochungcu6.1.jpg', 'canhochungcu6.2.jpg', '8', '139 mét vuông', '2024-03-10 04:50:48', 'true'),
(15, 'Căn hộ cao cấp tại Thăng Long Silver', 'Đây là dự án do Tổng Công ty Viglacera làm chủ đầu tư, sở hữu vị trí đắc địa tại số 1 Đại Lộ Thăng Long, Hà Nội.  Căn hộ rộng rãi, thông thoáng với 3 phòng ngủ, ban công, phòng khách liền bếp và 2 phòng vệ sinh. Nội thất đầy đủ, sang trọng, chủ nhà tặng kèm khi mua.  Khu vực xung quanh thuận tiện giao thông, nhiều tiện ích và dịch vụ. Căn hộ phù hợp làm nơi an cư lẫn đầu tư kinh doanh.', 'Bán căn hộ chung cư, Bán căn hộ chung cư Quận Nam Từ Liêm', 14, 14, 'canhochungcu7.jpg', 'canhochungcu7.1.jpg', 'canhochungcu7.2.jpg', '8', '117 mét vuông', '2024-03-10 04:54:03', 'true'),
(16, 'Bán căn hộ chung cư Sunrise City', 'Đầy đủ nội thất cao cấp, nhà mới deco rất đẹp. Tiện ích. - Khu dân trí cao, an ninh luôn đảm bảo tuyệt đối. - TTTM, sân chơi trẻ em, spa, nhà hàng, cafe,... - Hệ thống nhà hàng cao cấp: Thái, Việt, Sing. - Liền kề ngân hàng: Vietinbank, Vietcombank, VPBank... Và còn vô vàn tiện ích khác...', 'Bán căn hộ chung cư, Bán căn hộ chung cư Quận Ba Đình', 14, 11, 'canhochungcu8.jpg', 'canhochungcu8.1.jpg', 'canhochungcu8.2.jpg', '8', '162 mét vuông', '2024-03-10 04:56:44', 'true'),
(17, 'Căn hộ 3 phòng ngủ tại Hoàn Kiếm Tower', 'Căn hộ có diện tích 120m2, nội thất đầy đủ tiện nghi. Căn hộ hiện đang trống và có thể dọn vào ở ngay.', 'Bán căn hộ chung cư, Bán căn hộ chung cư Quận Hoàn Kiếm', 14, 2, 'canhochungcu9.jpg', 'canhochungcu9.1.jpg', 'canhochungcu9.2.jpg', '11', '120 mét vuông', '2024-03-10 05:02:24', 'true'),
(18, 'Kho xưởng rộng rãi tại Huyện Sóc Sơn', 'Khuôn viên rộng rãi có sân bãi đỗ xe, không gian làm việc, nhà vệ sinh và hệ thống an ninh 24/7. Thích hợp làm xưởng sản xuất, kho bãi, tổng kho.', 'Bán kho, Bán kho Huyện Sóc Sơn', 22, 17, 'bankho1.jpg', 'bankho1.1.jpg', 'bankho1.1.jpg', '30', '540 mét vuông', '2024-03-10 05:47:15', 'true'),
(19, 'Kho xưởng thuận tiện giao thông Huyện Gia Lâm', 'Cơ sở vật chất khang trang, hiện đại gồm kết cấu kiên cố, mái cao thoáng, có nhà vệ sinh và hệ thống PCCC. Sân bãi rộng rãi, thuận lợi cho xe container, xe tải ra vào. Đảm bảo an ninh 24/24.  Thích hợp làm kho chứa hàng, xưởng sản xuất không gây ô nhiễm.', 'Bán kho, nhà xưởng Huyện Gia Lâm, Bán kho, nhà xưởng', 22, 18, 'bankho2.jpg', 'bankho2.1.jpg', 'bankho2.1.jpg', '50', '1200 mét vuông', '2024-03-10 05:50:54', 'true'),
(20, 'Nhà mặt phố Xuân Đỉnh quận Bắc Từ Liêm', '– Vị trí kinh doanh các loại hình, oto 16 chỗ thông  + T1: Cửa hàng kinh doanh  + T2,: Phòng khách, 01 phòng ngủ + wc  + T3: 02 phòng ngủ, wc  + T4: bếp, phòng thờ và 01 phòng ngủ, wc khép kín  + T5: sân vườn', 'Bán nhà mặt phố, Bán nhà mặt phố Quận Bắc Từ Liêm', 16, 15, 'nhamatpho1.jpg', 'nhamatpho1.1.jpg', 'nhamatpho1.2.jpg', '9', '50 mét vuông', '2024-03-10 05:57:11', 'true'),
(21, 'Bán Nhà mặt phố đầu phố Hà Trung Hoàn kiếm', 'BÁN NHÀ HÀ TRUNG - PHỐ CỔ TRUNG TÂM Địa chỉ: Hà Trung, Hoàn Kiếm, Hà Nội (Đi bộ 10 phút lên Hồ Hoàn Kiếm) Diện tích sổ đỏ: 51.6m2 Số tầng: 5 tầng Mặt tiền: 4.04m', 'Bán nhà mặt phố Quận Hoàn Kiếm', 16, 2, 'nhamatpho2.jpg', 'nhamatpho2.1.jpg', 'nhamatpho2.2.jpg', '50', '52 mét vuông', '2024-03-10 06:01:31', 'true'),
(22, 'Bán biệt thự IMPERIA GARDEN', '+ Diện tích 165m² - 5 tầng - 5m mặt tiền + Pháp lý chuẩn, sẵn sàng giao dịch + Đang cho thuê 700tr/năm, hợp đồng mới ký + Chào 45 tỷ thương lượng', 'Bán nhà biệt thự, liền kề Quận Thanh Xuân', 17, 19, 'bietthu1.jpg', 'bietthu1.1.jpg', 'bietthu1.2.jpg', '45', '165 mét vuông', '2024-03-10 06:05:34', 'true'),
(23, 'Bán biệt thự Vinhomes Riverside', '- Dạng biệt thự đơn lập 310m² nằm ở phân khu Hoa Sữa - XD 130m²/sàn *4 tầng - Mặt tiền 12m - Đường trước nhà hình bàn cờ rộng 15m - Sông view nội khu gần ngã ba: rộng thoáng đẹp và trong sạch - Gia chủ xác định hoàn thiện ở nên thiết kề và hoàn thiện rất cần thẩn và đầu tư - Nhà thiết kế 04PN + 01 phòng đa năng + có hầm + 01 phòng thờ', 'Bán biệt thự, liền kề Quận Long Biên', 17, 13, 'bietthu2.jpg', 'bietthu2.1.jpg', 'bietthu2.2.jpg', '90', '310 mét vuông', '2024-03-10 06:08:47', 'true'),
(24, 'Bán biệt thự Khu A Nam Cường', '- Dt 200m². - Xây 1 hầm 4T nổi. - Ngay Cạnh Hồ Công Viên ! - Sổ đỏ sẵn sàng giao dịch.', 'Bán biệt thự, liền kề Quận Hà Đông', 17, 20, 'bietthu3.jpg', 'bietthu3.1.jpg', 'bietthu3.2.jpg', '25', '200 mét vuông', '2024-03-10 06:13:56', 'true'),
(25, 'Nhà trong ngõ Giảng Võ, Ba Đình', '- Nhà 3 tầng 1 tum. - Tầng 1 : 20m2 có lửng. - Tầng 2, 3: 26m2. - Nội thất cơ bản: Nóng lạnh, điều hòa, wc, tủ bếp, tủ quần áo. - Ô tô vào sát nhà. - Ngõ rộng, thoáng. - Tiện ở, kinh doanh. - Giao nhà ngay.', 'Nhà trong ngõ, Bán nhà trong ngõ Quận Ba Đình', 15, 11, 'nhatrongngo5.jpg', 'nhatrongngo5.1.jpg', 'nhatrongngo5.2.jpg', '4', '30 mét vuông', '2024-04-16 04:22:55', 'true'),
(26, 'Căn hộ 3 phòng ngủ cực đẹp tại thăng long Number One', 'Chào mừng quý khách quan tâm đến căn hộ 3 phòng ngủ, diện tích 117m2 tại tòa Thăng Long Number One thuộc dự án chung cư Yên Hòa Thăng Long.  Căn hộ được thiết kế hiện đại với đầy đủ nội thất, bao gồm 3 phòng ngủ, 2 phòng vệ sinh. Chúng tôi rất hân hạnh được đón tiếp quý khách tại dự án!', 'Bán căn hộ chung cư', 0, 0, 'canhochungcu10.jpg', 'canhochungcu10.1.jpg', 'canhochungcu10.2.jpg', '6', '117 mét vuông', '2024-04-16 04:35:11', 'true');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_error`
--

CREATE TABLE `user_error` (
  `error_id` int(11) NOT NULL,
  `error_title` varchar(500) NOT NULL,
  `error_username` varchar(100) NOT NULL,
  `error_mobile` varchar(20) NOT NULL,
  `error_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`, `token`) VALUES
(2, 'TuanDang', 'tuandang@gmail.com', '$2y$10$h0uo20oWzwjmvx.A2bO3KOXdGkxJzuzJIxrYgQhT7aA04o0EtK4Ga', 'z5165764038527_2eb506254eb94eaa6cc23aa40165b857.jpg', '::1', 'Xuan Dinh', '0869249390', ''),
(4, 'DucQuang', 'wang@gmail.com', '$2y$10$Xf5ue30uEzVNWWPvfsok5O0CJ/fGQXg/dA71Hmlu7/5XxnrfwG97O', '322128604_1501255300397884_3260951349482777246_n.jpg', '::1', 'Xuan Tao', '0859499603', ''),
(5, 'VuNgo', 'vu@gmail.com', '$2y$10$yXfSf.hZF.aozxCX5CxiyOyh8OPPpOq6zp.CYyPZ0vtS2gvfF9b3W', 'z4773942154533_990d692531e6966c1006010e7cefd21e.jpg', '::1', 'Hoang Mai', '0839123456', ''),
(20, 'DangMinh', 'tuandang1212@gmail.com', '$2y$10$HiOfG3RHQ.xB9Y0AlEe4xuPd/Vdn5RZ6FAtxyZZBOmWVwpt6UrHhO', 'z5153518100393_a1a5a421b85bfef0a3001d56983c1238.jpg', '::1', 'Co Nhue', '0869249797', ''),
(22, 'HoangDung', 'hoangdung@gmail.com', '$2y$10$SxiYh8DUzBODQ5RAlXpEnOIMZ2dFZxnObTxxaEev7BSuxlVInHkaS', 'dagg.jpg', '::1', 'Cau Giay', '0859231040', ''),
(25, 'Đặng Minh Tuấn', 'tuandang2k2@gmail.com', '', '', '', 'Xuan Tao', '0888888888', '35245'),
(43, 'Tuấn Đặng Minh', 'tuandangg1006@gmail.com', '', 'https://lh3.googleusercontent.com/a/ACg8ocKbtUw4i1MDNF_ouneEkwOtfQ4MIecLPmjkwQEEHORkw9VT6Kg=s96-c', '', '', '', '15435');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `user_error`
--
ALTER TABLE `user_error`
  ADD PRIMARY KEY (`error_id`);

--
-- Chỉ mục cho bảng `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Chỉ mục cho bảng `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `user_error`
--
ALTER TABLE `user_error`
  MODIFY `error_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
