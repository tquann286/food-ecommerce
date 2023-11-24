-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 07:22 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

-- INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
-- (4, 'Pizza', 'Food_Category_790.jpg', 'Yes', 'Yes'),
-- (5, 'Burger', 'Food_Category_344.jpg', 'Yes', 'Yes'),
-- (6, 'MoMo', 'Food_Category_77.jpg', 'Yes', 'Yes'),
-- (8, 'Quia est ipsum id id', 'Food_Category_929.jpg', 'No', 'Yes');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

-- INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
-- (3, 'Phở', 'Phở là một món ăn truyền thống của Việt Nam', '30000', 'Food-Name-3649.jpg', 6, 'Yes', 'Yes'),
-- (4, 'Bánh Mì Ngon', 'Bánh mì với giò lụa, pate và nhiều phô mai.', '25000', 'Food-Name-6340.jpg', 5, 'Yes', 'Yes'),
-- (5, 'Bánh Xèo', 'Bánh xèo chiên giòn, ăn kèm với rau sống.', '35000', 'Food-Name-8298.jpg', 4, 'No', 'Yes'),
-- (6, 'Bún Riêu Cua', 'Bún riêu cua thơm ngon với nước dùng đậm đà.', '40000', 'Food-Name-7387.jpg', 6, 'Yes', 'Yes'),
-- (7, 'Bánh Tráng Trộn', 'Bánh tráng trộn cay nồng với nhiều loại gia vị.', '20000', 'Food-Name-7833.jpg', 4, 'Yes', 'Yes'),
-- (8, 'Cơm Niêu', 'Cơm niêu thơm ngon với các loại thịt và rau sống.', '52000', '', 5, 'No', 'No');


-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

-- INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES

-- (1, 'Bún Riêu Cua', '40000', 3, '120000', '2023-02-15 03:49:48', 'Đã Huỷ', 'Nguyễn Thị An', '+84 912 345 678', 'nguyenthi.an@mailinator.com', '123 Đường ABC, Quận 1, TP.Hồ Chí Minh'),

-- (2, 'Bánh Mì Ngon', '25000', 4, '100000', '2023-04-20 03:52:43', 'Đã giao', 'Trần Văn Bình', '+84 987 654 321', 'tranvanbinh@mailinator.com', '456 Đường XYZ, Quận 3, TP.Hồ Chí Minh'),

-- (3, 'Bánh Tráng Trộn', '20000', 2, '40000', '2023-08-10 04:07:17', 'Đã giao', 'Lê Thị Mai', '+84 933 222 111', 'lethimai@mailinator.com', '789 Đường KLM, Quận 5, TP.Hồ Chí Minh');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
