-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 12:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evince`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `total_price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `buy` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_name`, `qty`, `price`, `total_price`, `image`, `add_time`, `buy`) VALUES
(38, 60, 76, 'Infinix Hot 10 Play (7° Purple, 64 GB)  (4 GB RAM)', 4, 8499, 33996, 'hot-10.jpeg', '2021-06-03 05:43:12', 0),
(39, 60, 104, 'MSI GF63 Thin Core i5 9th Gen - (8 GB/1 TB HDD/Windows 10 Home/4 GB Graphics/NVIDIA GeForce GTX 1650 Ti Max Q/60 Hz) GF63 Thin 9SCSR-1608IN Gaming Laptop  (15.6 inches, Black, 1.86 kg)', 3, 51990, 155970, 'gf63-thin-10scxr-1616in-notebook-msi-original-imag2q55h6w2avfr.jpeg', '2021-06-03 05:44:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `status`) VALUES
(1, 'Mobile', 0, 1),
(2, 'Laptop', 0, 1),
(4, 'Samsung', 1, 1),
(5, 'Mi', 1, 1),
(6, 'Hp', 2, 1),
(11, 'Samsung s6', 4, 1),
(12, 'Mi10', 5, 1),
(13, 'Hp i3', 6, 1),
(14, 'Hp i5', 6, 1),
(15, 'Hp i7', 6, 1),
(20, 'Dell i3', 7, 0),
(25, 'I-ball', 2, 1),
(27, 'Smart Watch', 0, 1),
(29, 'Fan', 0, 1),
(48, 'Bazaj', 29, 1),
(49, 'Tv', 0, 1),
(52, 'MSI', 2, 1),
(53, 'Infinix', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `skus` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `p_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `color`, `price`, `qty`, `image`, `category_id`, `skus`, `description`, `admin_id`, `status`, `p_time`) VALUES
(76, 'Infinix Hot 10 Play (7° Purple, 64 GB)  (4 GB RAM)', 'purple', 8499, 50, 'hot-10.jpeg', 1, 'infinix-h10-purple-4-64', 'Dont miss out on lifes precious moments by bringing home the Infinix Hot 10 Play smartphone. You can capture memories, moments, and much more on this smartphone as it comes with AI-powered 13 MP dual rear camera setup and an 8 MP selfie camera. This phones large 17.3 cm 6.8 display makes it a delight to scroll through photos and watch videos. Powered by a high-capacity 6000 mAh battery, the Hot 10 Play offers long-lasting battery life to help you sail through your day.', 46, 1, '2021-06-02 05:48:48'),
(104, 'MSI GF63 Thin Core i5 9th Gen - (8 GB/1 TB HDD/Windows 10 Home/4 GB Graphics/NVIDIA GeForce GTX 1650 Ti Max Q/60 Hz) GF63 Thin 9SCSR-1608IN Gaming Laptop  (15.6 inches, Black, 1.86 kg)', 'black', 51990, 5, 'gf63-thin-10scxr-1616in-notebook-msi-original-imag2q55h6w2avfr.jpeg', 2, 'msi-gf63-i5-9-8-1tb', 'The MSI GF63 Thin 9SCSR-1608IN is the right device for on-the-move gaming. This gaming laptop features the GeForce GTX 1650Ti Max -Q for smooth gaming, a built-in AMP (Audio Power Amplifier) for exciting audio, and a 9th Gen Intel Core Processor for high-speed performance.', 46, 1, '2021-06-03 05:44:27'),
(105, 'SAMSUNG Galaxy F41 (Fusion Green, 128 GB)  (6 GB RAM)', 'fusion black', 14499, 10, 'samsung-galaxy-f41-sm-f415fzgdins-original-imafwbnhbywwg5gh.jpeg', 4, 'samsung-g-f41-fusionblack', 'The Samsung Galaxy F41 is a phone you can count on for almost everything! When you have to click a picture of your family, you can fit everyone into the frame with the help of its 8 MP ultra-wide camera. Oh, and if you want to capture the beauty of your surroundings, the 64 MP camera will do the work for you! Not to forget, it is sleek and lightweight, so you can carry it around effortlessly.', 46, 1, '2021-06-03 08:41:06'),
(106, 'Redmi 9 (Sky Blue, 64 GB)  (4 GB RAM)', 'Sky Blue', 8926, 5, 'mi-redmi-9-lpddr4x-original-imafv5kypkgfqupf.jpeg', 5, 'redmi-9-skyblue-4-64', '13+2MP Rear camera with AI Portrait, AI scene recognition, HDR, Pro mode | 5MP front facing camera 16.58 centimeters (6.53-inch) HD+ multi-touch capacitive touchscreen with 1600 x 720 pixels resolution, 268 ppi pixel density, 20:9 aspect ratio Memory, Storage &amp; SIM: 4GB RAM | 64GB storage expandable up to 512GB| Dual SIM with dual standby (4G+4G) Android v10 operating system with 2.3GHz Mediatek Helio G35 octa core processor 5000mAH lithium-polymer battery with 10W wired charger in-box', 46, 1, '2021-06-04 04:51:46'),
(107, 'Redmi 10 (Sky Blue, 64 GB)  (4 GB RAM)', 'Sky Blue', 10000, 10, 'samsung-galaxy-f41-sm-f415fzgdins-original-imafwbnhbywwg5gh.jpeg', 5, 'redmi-10-skyblue-4-64', '13+2MP Rear camera with AI Portrait, AI scene recognition, HDR, Pro mode | 5MP front facing camera 16.58 centimeters (6.53-inch) HD+ multi-touch capacitive touchscreen with 1600 x 720 pixels resolution, 268 ppi pixel density, 20:9 aspect ratio Memory, Storage &amp; SIM: 4GB RAM | 64GB storage expandable up to 512GB| Dual SIM with dual standby (4G+4G) Android v10 operating system with 2.3GHz Mediatek Helio G35 octa core processor 5000mAH lithium-polymer battery with 10W wired charger in-box', 46, 1, '2021-06-04 07:56:13'),
(112, 'dgfdg', 'fusion black', 8499, 0, 'AUS_0_1200x768.png', 1, 'infinix-h10-purple-4-64fghfgh', 'ghgfh', 46, 1, '2021-05-31 14:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `uniqid`
--

CREATE TABLE `uniqid` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `random_str` varchar(255) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `link_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uniqid`
--

INSERT INTO `uniqid` (`id`, `email`, `random_str`, `otp`, `link_time`) VALUES
(2, 'pankajrathore9424@gmail.com', '60adecd42ddb5', '9798', '2021-05-26 06:38:18'),
(3, 'pankajrathore9424@gmail.com', '60adee83748b2', '3117', '2021-05-26 06:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_level` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `email`, `password`, `age`, `phone`, `gender`, `reg_date`, `user_level`) VALUES
(46, 'Pankaj', 'prathore9669@gmail.com', '$2y$10$Qlfed5bdIkAQSFBXNpQZNOAGyHSpiePYuthc41XP3xyAZYXu12H6i', 20, '9999999999', 'male', '2021-05-25 11:09:15', 0),
(59, 'vikas', 'vikas@gmail.com', '$2y$10$k2YSSFewOWR1ZKGR5GiV6euI9k7OnNR1K5J8ouVQCn40kOv7ts/Tm', 20, '9243345443', 'male', '2021-05-25 10:12:44', 0),
(60, 'sonu', 'pankajrathore9424@gmail.com', '$2y$10$gb1fORTykhUFsF8JBO8AqOByOt70bwWmzFlmmTHYUUsjo4LmQNMwK', 20, '8827612115', 'male', '2021-05-26 07:11:06', 0),
(67, 'Ranu', 'ranu@gmail.com', '$2y$10$P8ib9aKOMBr7Z.WkKmFG5OoWM7.VJOsu/OydTLTMDqvThEUZ73Ql6', 19, '9243345443', 'Female', '2021-05-31 11:30:08', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_ibfk_1` (`user_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `carts_ibfk_2` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `skus` (`skus`);

--
-- Indexes for table `uniqid`
--
ALTER TABLE `uniqid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `uniqid`
--
ALTER TABLE `uniqid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
