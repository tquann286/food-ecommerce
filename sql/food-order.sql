-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 11:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE `food-order` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `food-order`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Đào Trung Quân', 'trungquan', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(9, 'Huỳnh Phương Thanh Phát ', 'thanhphat', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(10, 'Trương Nhật Huy', 'nhathuy', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(12, 'Nguyễn Hoàng Phước', 'hoangphuoc', '21232f297a57a5a743894a0e4a801fc3'),
(13, 'A', 'sojemulap@mailinator.com', '7aa3262b9526ff30025c2f389263399e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(9, 'Cơm', 'Food_Category_4058.avif', 'Có', 'Có'),
(10, 'Bánh mì', 'banhmi.jpg', 'Không', 'Có'),
(11, 'Thức uống', 'thucuong.avif', 'Có', 'Có'),
(12, 'Tráng miệng', 'dessert.jpg', 'Có', 'Có'),
(13, 'Món nước', 'pho.jpg', 'Không', 'Không'),
(14, 'Món gà', 'chicken.jpg', 'Không', 'Có');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(10) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(9, 'Cơm tấm', 'Cơm sườn, bì, chả, ốp la', 50000, 'Food-Name-1363.jpg', 9, 'Có', 'Có'),
(10, 'Cơm gà xối mỡ', 'Cơm rang, gà ta xối mỡ', 35000, 'Food-Name-5977.jpeg', 9, 'Có', 'Có'),
(11, 'Cơm bò lúc lắc', 'Cơm chiên, bò xào và salad', 55000, 'Food-Name-8949.jpg', 9, 'Không', 'Có'),
(14, 'Bánh mì xíu mại', 'Bánh mì giòn, xíu mại thịt viên', 25000, 'Food-Name-9854.jpg', 10, 'Không', 'Có'),
(15, 'Bánh mì Sài Gòn', 'Bánh mì thịt nguội, thêm bơ và pate gan', 20000, 'Food-Name-1493.jpg', 10, 'Không', 'Có'),
(17, 'Đen đá', 'Cà phê đen đá', 20000, 'Food-Name-4429.jpg', 11, 'Không', 'Có'),
(18, 'Nâu đá', 'Cà phê sữa đá', 25000, 'Food-Name-2035.jpg', 11, 'Không', 'Có'),
(19, 'Trà sữa', 'Trà sữa trân châu', 18000, 'Food-Name-1773.jpg', 11, 'Không', 'Có'),
(20, 'Bánh flan', 'Bánh flan lạnh', 10000, 'Food-Name-9560.jpg', 12, 'Không', 'Có'),
(21, 'Kem', 'Kem ốc quế tự chọn', 22000, 'Food-Name-5691.jpg', 12, 'Không', 'Có'),
(22, 'Xôi xoài', 'Xôi xoài chín và nước cốt dừa', 25000, 'Food-Name-9434.jpg', 12, 'Có', 'Có'),
(23, 'Gà giòn', 'Gà chiên bột', 30000, 'Food-Name-6503.jpg', 14, 'Không', 'Có'),
(24, 'Gà xào chua ngọt', 'Cánh gà xào với sốt chua ngọt', 35000, 'Food-Name-34.jpeg', 14, 'Có', 'Có');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(4, 'Cơm tấm', 50000, 1, 50000, '2023-12-08 11:12:55', 'Đang giao hàng', 'Phát Huỳnh', '0932654804', 'thanhphat02122003@gmail.com', 'Phú Phoàng Anh block A, Nhà Bè, Sài Gòn'),
(5, 'Nâu đá', 25000, 1, 25000, '2023-12-08 11:13:58', 'Đã huỷ', 'Nhựt Huy', '0923556443', 'huytruong@gmail.com', '22 Lê Hoàn, Long An, Bình Chánh'),
(6, 'Bánh flan', 10000, 5, 50000, '2023-12-08 11:14:56', 'Đã giao hàng', 'Bùi Minh Tân', '0932666712', 'tanpun11@gmail.com', '30 Nguyễn Tri Phương, Bến Tre'),
(7, 'Bánh mì xíu mại', 25000, 2, 50000, '2023-12-08 11:15:57', 'Đang giao hàng', 'Hoàng Phước', '0911223256', 'phuongnguyen2103@gmail.com', '66 Mai Chí Thọ, Bù Đăng, Bình Phước'),
(8, 'Gà xào chua ngọt', 35000, 3, 105000, '2023-12-08 11:16:53', 'Đã đặt hàng', 'Đào Trung Quân', '0911228669', 'quantrung286@gmail.com', '88 Mai Chi Phương, Quy Nhơn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
