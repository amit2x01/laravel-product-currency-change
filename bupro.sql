-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2020 at 07:23 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bupro`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cate_id` bigint(20) NOT NULL,
  `cate_img` varchar(3500) NOT NULL,
  `cate_name` varchar(1200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_img`, `cate_name`, `created_at`, `updated_at`) VALUES
(1, 'img/categories/car-brake-pads.jpg', 'Brake Pads', '2020-06-27 19:19:43', '2020-06-27 19:19:43'),
(2, 'img/categories/car-door-body-beading.jpg', 'Door Body Beadings', '2020-06-27 19:19:43', '2020-06-27 19:19:43'),
(3, 'img/categories/car-engine-mounting.jpg', 'Engine Mountings', '2020-06-27 19:19:43', '2020-06-27 19:19:43'),
(4, 'img/categories/car-pvc-mud-flaps.jpg', 'Car Spark Plug wires', '2020-06-27 19:19:43', '2020-06-27 19:19:43'),
(5, 'img/categories/clutch-cylinder-assembly.jpg', 'Clutch Cylinder Assembly', '2020-06-27 19:19:43', '2020-06-27 19:19:43'),
(6, 'img/categories/combination-switches.jpg', 'Combination Switches', '2020-06-27 19:19:43', '2020-06-27 19:19:43'),
(7, 'img/categories/power-window-switches.jpg', 'Power Window', '2020-06-27 19:19:43', '2020-06-27 19:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` bigint(20) NOT NULL,
  `cust_photo` varchar(1500) DEFAULT NULL,
  `cust_name` varchar(220) NOT NULL,
  `cust_email` varchar(500) NOT NULL,
  `cust_phone` bigint(20) NOT NULL,
  `cust_password` varchar(500) NOT NULL,
  `cust_gender` varchar(30) DEFAULT 'Unknown',
  `cust_dob` date DEFAULT NULL,
  `acc_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_photo`, `cust_name`, `cust_email`, `cust_phone`, `cust_password`, `cust_gender`, `cust_dob`, `acc_status`, `created_at`, `updated_at`) VALUES
(7, NULL, 'Amit Kumar Biswas', 'amit2x16@gmail.com', 1234567890, '4ac006eb38839d015270cbf72fcd140b07e40464', 'Unknown', NULL, 1, '2020-09-24 16:10:33', '2020-09-24 16:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `cust_addresses`
--

CREATE TABLE `cust_addresses` (
  `cust_id` bigint(20) NOT NULL,
  `address_type` varchar(50) DEFAULT NULL,
  `house_no` varchar(50) NOT NULL,
  `address` varchar(1200) NOT NULL,
  `landmark` varchar(500) DEFAULT NULL,
  `city` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cust_addresses`
--

INSERT INTO `cust_addresses` (`cust_id`, `address_type`, `house_no`, `address`, `landmark`, `city`, `state`, `country`, `pincode`, `created_at`, `updated_at`) VALUES
(7, NULL, '41/6', 'Brojonath Lahiri Lane', NULL, 'Howrah', 'West Bengal', 'India', 711104, '2020-09-24 16:10:47', '2020-09-25 10:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` bigint(20) NOT NULL,
  `emp_name` varchar(500) NOT NULL,
  `emp_email` varchar(500) NOT NULL,
  `emp_phone` bigint(20) NOT NULL,
  `role` varchar(500) NOT NULL,
  `emp_salary` int(11) NOT NULL,
  `emp_pass` varchar(500) NOT NULL,
  `verified_document` varchar(120) NOT NULL DEFAULT 'Not Verified',
  `acc_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_email`, `emp_phone`, `role`, `emp_salary`, `emp_pass`, `verified_document`, `acc_status`, `created_at`, `updated_at`) VALUES
(1001, 'Amit Kumar Biswas', 'amit2x16@gmail.com', 9062294221, 'Admin', 500000, '4ac006eb38839d015270cbf72fcd140b07e40464', 'Aadhar Card|NDU1NCA0NTQ1IDQ1NDU=', 1, '2020-09-24 14:02:43', '2020-09-24 16:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` bigint(20) NOT NULL,
  `oid` bigint(20) DEFAULT NULL,
  `pid` bigint(20) NOT NULL,
  `ptitle` varchar(500) NOT NULL,
  `pbrand` varchar(120) DEFAULT NULL,
  `pmodel` varchar(150) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `oid`, `pid`, `ptitle`, `pbrand`, `pmodel`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(14, 40362466130144, 16, 'Product Number Oil 4651', 'HONDA', 'ASP 574811', 3, 5788, '2020-09-24 16:11:16', '2020-09-24 16:11:16'),
(15, 40327130769642, 16, 'Product Number Oil 4651', 'HONDA', 'ASP 574811', 1, 5788, '2020-09-25 10:45:50', '2020-09-25 10:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` bigint(20) NOT NULL,
  `cust_id` bigint(20) NOT NULL,
  `invoice_number` bigint(20) DEFAULT NULL,
  `amount` varchar(550) NOT NULL,
  `payment_mode` varchar(55) NOT NULL DEFAULT 'COD',
  `delivery_address` varchar(1200) NOT NULL,
  `status` varchar(100) DEFAULT 'Ordered',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `cust_id`, `invoice_number`, `amount`, `payment_mode`, `delivery_address`, `status`, `created_at`, `updated_at`) VALUES
(40327130769642, 7, NULL, '5788', 'PREPAID', '41/6, Brojonath Lahiri Lane, Howrah - 711104, State : West Bengal, Country : India', 'Ordered', '2020-09-25 10:45:50', '2020-09-25 10:45:50'),
(40362466130144, 7, 2582016616, '17364', 'PREPAID', '41/6, Brojonath Lahiri Lane, Howrah - 711104, State : West Bengal, Country : India', 'Ordered', '2020-09-24 16:11:16', '2020-09-24 16:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `transaction_id` varchar(500) NOT NULL,
  `txn_ref_no` varchar(500) NOT NULL,
  `cust_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `payment_made_by` varchar(50) NOT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `card_exp_date` varchar(50) DEFAULT NULL,
  `amount` varchar(1200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'PAID',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`transaction_id`, `txn_ref_no`, `cust_id`, `order_id`, `payment_made_by`, `card_number`, `card_exp_date`, `amount`, `status`, `created_at`, `updated_at`) VALUES
('ONTS71393739', '3b0abbd604a1eac97e963e3fee233dd28c4547fb', 7, 40327130769642, 'Debit Card', '4242424242424242', '2505-09', '5788', 'PAID', '2020-09-25 10:45:49', '2020-09-25 10:45:49'),
('ONTS78092632', '6be53663d007b51859cf2582b602dc9a8b74d659', 7, 40362466130144, 'Debit Card', '4242424242424242', '2025-09', '17364', 'PAID', '2020-09-24 16:11:16', '2020-09-24 16:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` bigint(20) NOT NULL,
  `pimage` varchar(5800) DEFAULT NULL,
  `ptitle` varchar(550) NOT NULL,
  `pshortdesc` mediumtext DEFAULT NULL,
  `pdesc` longtext DEFAULT NULL,
  `brand` varchar(45) DEFAULT 'Unknown',
  `model` varchar(55) DEFAULT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `MRP` bigint(20) DEFAULT 0,
  `category_id` varchar(2000) DEFAULT NULL,
  `product_enabled` int(5) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pimage`, `ptitle`, `pshortdesc`, `pdesc`, `brand`, `model`, `price`, `MRP`, `category_id`, `product_enabled`, `created_at`, `updated_at`) VALUES
(3, 'img/products/p1.jpg', 'Power Window Switch For Volkswagen Vento Front Right 8 Pin\r\n							', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem dignissimos voluptate voluptatibus nostrum, ex doloremque magni placeat eos. Culpa facilis tempora vero, odio quod sit numquam ducimus quibusdam praesentium corporis.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero deleniti ipsum accusantium suscipit nobis aliquam autem quaerat animi doloribus, quia veniam velit perferendis reprehenderit a ratione natus nesciunt dicta nulla fugit similique tempore consequatur obcaecati harum officia! Ea, culpa explicabo? Voluptates animi facere ratione quaerat blanditiis et debitis deleniti veritatis illum voluptatum eaque quo suscipit fugiat quas qui doloremque iste culpa, velit inventore? Corrupti, ab? Nesciunt ea enim ad consectetur pli consectetur quis vel repellendus, quia laudantium et, repudiandae quae nemo ut aut incidunt, soluta saepe facere. Nam natus asperiores, voluptatem facere suscipit accusamus modi quidem, minima ipsa error, ipsum adipisci quod. Nihil neque similique quia ad, accusantium quibusdam placeat obcaecati ullam dolorem, possimus expedita nostrum?', 'HONDA', 'A 55478', 5400, 6999, '1', 1, '2020-07-02 12:18:03', '2020-07-02 12:18:06'),
(4, 'img/products/p2.jpeg', 'POWER WINDOW REGULATOR MACHINE/LIFTER FOR HONDA ACCORD FRONT RIGHT (2009 MODEL)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem dignissimos voluptate voluptatibus nostrum, ex doloremque magni placeat eos. Culpa facilis tempora vero, odio quod sit numquam ducimus quibusdam praesentium corporis.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero deleniti ipsum accusantium suscipit nobis aliquam autem quaerat animi doloribus, quia veniam velit perferendis reprehenderit a ratione natus nesciunt dicta nulla fugit similique tempore consequatur obcaecati harum officia! Ea, culpa explicabo? Voluptates animi facere ratione quaerat blanditiis et debitis deleniti veritatis illum voluptatum eaque quo suscipit fugiat quas qui doloremque iste culpa, velit inventore? Corrupti, ab? Nesciunt ea enim ad consectetur pli consectetur quis vel repellendus, quia laudantium et, repudiandae quae nemo ut aut incidunt, soluta saepe facere. Nam natus asperiores, voluptatem facere suscipit accusamus modi quidem, minima ipsa error, ipsum adipisci quod. Nihil neque similique quia ad, accusantium quibusdam placeat obcaecati ullam dolorem, possimus expedita nostrum?', 'BMW', 'B 58445', 1200, 2500, '4', 1, '2020-07-02 12:18:07', '2020-07-02 12:18:09'),
(10, 'img/products/2020_Jul_Thu_9bd92d312848479f6cf605c5793f3a89b5706921d3242343242342233242424ownload.jpg', 'Best Car Brake Parts', '<p><b style=\"font-size: 1rem;\">Lorem ipsum dolor sit amet,</b><span style=\"font-size: 1rem;\"> consectetur adipisicing elit. Quidem dignissimos voluptate voluptatibus nostrum, ex doloremque magni placeat eos. Culpa facilis tempora vero, odio quod sit numquam ducimus quibusdam praesentium corporis.</span></p><p><span style=\"font-size: 1rem;\"><br></span></p><ol><li>A Class Product</li><li>Very Good Product</li></ol>', '<p><span style=\"font-size: 24px;\"><font color=\"#0000ff\">Best Car Brake Parts</font></span><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero deleniti ipsum accusantium suscipit nobis aliquam autem quaerat animi doloribus, quia veniam velit perferendis reprehenderit a ratione natus nesciunt dicta nulla fugit similique tempore consequatur obcaecati harum officia! Ea, culpa explicabo? Voluptates animi facere ratione quaerat blanditiis et debitis deleniti veritatis illum voluptatum eaque quo suscipit fugiat quas qui doloremque iste culpa, velit inventore? Corrupti, ab? Nesciunt ea enim ad <i><b>c</b></i><b><i>onsectetur pli consectetur quis vel repellendus, quia laudantium et, repudiandae quae nemo ut aut incidunt, soluta saepe facere. </i></b>Nam natus asperiores, voluptatem facere suscipit accusamus modi quidem, minima ipsa error, ipsum adipisci quod<font style=\"background-color: rgb(156, 0, 255);\" color=\"#f7f7f7\">. <u style=\"\">Nihil neque similique quia ad, accusantium quibusdam placeat obcaecati ullam dolorem, possimus expedita nostrum?</u></font></p>', 'HONDA', 'A4534543534', 5000, 6799, '2', 1, '2020-07-02 17:16:28', '2020-07-02 17:16:33'),
(12, 'img/products/2020_Jul_Thu_4603f77b5a83f843c5b9b383c2972eb060608655983t8443fjjfujakskopk32ur23wjwjpr32.jpg', 'Product Number 4 new brand', '<p><strong style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><u><font color=\"#731842\">Lorem Ipsum</font></u></strong><span style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"><b><u><font color=\"#731842\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</font></u></b> remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<h2><span style=\"text-align: justify;\"><span style=\"font-size: 24px;\"><b><font color=\"#085294\">Product Number 4</font></b></span></span></h2><h2><span style=\"text-align: justify;\"><span style=\"font-size: 24px;\"><b><font color=\"#085294\"><br></font></b></span></span></h2><p><strong style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'HONDA', 'A 54478', 6500, 7899, '5', 1, '2020-07-02 17:24:42', '2020-07-02 14:12:15'),
(15, 'img/products/2020_Jul_Thu_164de784fbefde5f19c61d688e2226ff2dfe7669p3.jpeg', 'Product NUmber 3 for new Brand', '<p><p style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: baloo, sans-serif; color: rgb(33, 37, 41); font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></p></p><p style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: baloo, sans-serif; color: rgb(33, 37, 41); font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255);\"><strong open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" bolder;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: baloo, sans-serif; font-weight: bolder;\">Lorem Ipsum</strong><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: baloo, sans-serif;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unkn<b style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: baloo, sans-serif; font-weight: bolder;\"><font color=\"#634aa5\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: baloo, sans-serif;\">own printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesettin</font>g</b>, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: baloo, sans-serif;\"></p>', '<p style=\"color: rgb(33, 37, 41);\"><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" bolder;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unkn<span style=\"font-weight: bolder;\"><font color=\"#634aa5\">own printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesettin</font>g</span>, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p><p style=\"color: rgb(33, 37, 41);\"></p><p style=\"color: rgb(33, 37, 41);\"><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" bolder;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\" style=\"font-weight: bolder;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unkn<span style=\"font-weight: bolder;\"><font color=\"#634aa5\">own printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesettin</font>g</span>, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p style=\"color: rgb(33, 37, 41);\"><br></p><table class=\"table table-bordered\" style=\"width: 1110px; background-color: rgb(255, 255, 255); color: rgb(33, 37, 41);\"><tbody><tr><td>type</td><td>A SSS</td></tr><tr><td>Model</td><td>ASP 5748<br></td></tr><tr><td>Brand</td><td>HONDA<br><br></td></tr></tbody></table>', 'HONDA', 'ASP 655255', 5999, 5999, '4', 1, '2020-07-02 20:57:17', '2020-07-02 20:57:17'),
(16, 'img/products/2020_Jul_Thu_9a2ca9d330c4e38d59b3420cff1c3cbd422562c0ed671ca.jpg', 'Product Number Oil 4651', '<p><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" bolder;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\" style=\"font-weight: bolder; color: rgb(33, 37, 41);\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\" style=\"color: rgb(33, 37, 41);\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unkn<span style=\"font-weight: bolder;\"><font color=\"#634aa5\">own printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesettin</font>g</span>, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p style=\"color: rgb(33, 37, 41);\"><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" bolder;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unkn<span style=\"font-weight: bolder;\"><font color=\"#634aa5\">own printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesettin</font>g</span>, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p><p style=\"color: rgb(33, 37, 41);\"></p><p style=\"color: rgb(33, 37, 41);\"><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" bolder;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\" style=\"font-weight: bolder;\">Lorem Ipsum</span><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unkn<span style=\"font-weight: bolder;\"><font color=\"#634aa5\">own printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesettin</font>g</span>, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p style=\"color: rgb(33, 37, 41);\"><br></p><table class=\"table table-bordered\" style=\"width: 1110px; color: rgb(33, 37, 41); background-color: rgb(255, 255, 255);\"><tbody><tr><td>type</td><td>A SSS</td></tr><tr><td>Model</td><td>ASP 574811<br></td></tr><tr><td>Brand</td><td>HONDA<br><br></td></tr></tbody></table>', 'HONDA', 'ASP 574811', 5788, 4877, NULL, 1, '2020-07-02 21:01:18', '2020-07-03 13:28:39'),
(18, 'img/products/2020_Sep_Thu_72b33953be6ed4a1709a570f0d559a47ea9cd6f8redmi-7-64-a-na-mi-2-original-imafg28efxmzxxu7.jpeg', 'Redmi 7', '<p><b>Phone</b></p>', '<div style=\"margin-right: 14.3906px; margin-left: 28.7969px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><p style=\"margin-bottom: 15px; text-align: justify;\">hen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"margin-right: 28.7969px; margin-left: 14.3906px; width: 436.797px; float: right; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">Why do we use it?</h2><p style=\"margin-bottom: 15px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br></div></div>', 'Redmi', '324234', 70000, 80000, '6', 1, '2020-09-24 16:18:48', '2020-09-24 16:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `products_informations`
--

CREATE TABLE `products_informations` (
  `pid` bigint(20) NOT NULL,
  `part_number` varchar(55) DEFAULT NULL,
  `parts_desc` varchar(500) DEFAULT NULL,
  `parts_type` varchar(58) DEFAULT NULL,
  `origin` varchar(55) DEFAULT NULL,
  `engine_type` varchar(550) DEFAULT NULL,
  `chassis_type` varchar(550) DEFAULT NULL,
  `production_year` year(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tracking_services`
--

CREATE TABLE `tracking_services` (
  `order_id` bigint(20) NOT NULL,
  `exp_delivery_date` date DEFAULT NULL,
  `under_processed` datetime DEFAULT NULL,
  `dispatched` datetime DEFAULT NULL,
  `delivered` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracking_services`
--

INSERT INTO `tracking_services` (`order_id`, `exp_delivery_date`, `under_processed`, `dispatched`, `delivered`, `created_at`, `updated_at`) VALUES
(40327130769642, '2020-09-28', NULL, NULL, NULL, '2020-09-25 10:45:50', '2020-09-25 10:45:50'),
(40362466130144, '2020-09-27', '2020-09-24 04:13:17', '2020-09-24 04:14:31', '2020-09-24 04:14:39', '2020-09-24 16:11:16', '2020-09-24 16:14:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_email` (`cust_email`),
  ADD UNIQUE KEY `cust_phone` (`cust_phone`),
  ADD UNIQUE KEY `cust_photo` (`cust_photo`) USING HASH;

--
-- Indexes for table `cust_addresses`
--
ALTER TABLE `cust_addresses`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `txn_ref_no` (`txn_ref_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `pimage` (`pimage`) USING HASH;

--
-- Indexes for table `products_informations`
--
ALTER TABLE `products_informations`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tracking_services`
--
ALTER TABLE `tracking_services`
  ADD PRIMARY KEY (`order_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40387265681979;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cust_addresses`
--
ALTER TABLE `cust_addresses`
  ADD CONSTRAINT `cust_addresses_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD CONSTRAINT `ordered_products_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`ord_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_informations`
--
ALTER TABLE `products_informations`
  ADD CONSTRAINT `products_informations_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tracking_services`
--
ALTER TABLE `tracking_services`
  ADD CONSTRAINT `tracking_services_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ord_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
