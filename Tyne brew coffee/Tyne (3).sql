-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 12:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tyne`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `users_id` int(50) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `users_id`, `order_date`, `total_price`) VALUES
(8, 8, '2025-01-09 15:21:17', 30),
(9, 8, '2025-01-09 15:24:35', 20),
(10, 8, '2025-01-09 15:26:30', 20),
(11, 8, '2025-01-09 15:27:59', 30),
(12, 8, '2025-01-09 15:31:11', 15),
(13, 8, '2025-01-09 15:32:03', 45),
(14, 8, '2025-01-09 15:36:04', 40),
(15, 8, '2025-01-09 15:43:27', 10),
(16, 8, '2025-01-09 15:43:49', 20),
(17, 8, '2025-01-09 16:00:36', 10),
(18, 8, '2025-01-09 16:17:43', 15),
(19, 8, '2025-01-09 20:52:12', 15),
(20, 14, '2025-01-09 21:19:43', 10),
(22, 13, '2025-01-09 23:16:50', 15),
(23, 8, '2025-01-09 23:17:32', 15),
(24, 8, '2025-01-09 23:21:03', 0),
(25, 8, '2025-01-09 23:21:31', 0),
(26, 8, '2025-01-09 23:21:32', 0),
(27, 8, '2025-01-09 23:21:33', 0),
(28, 8, '2025-01-09 23:21:34', 0),
(29, 8, '2025-01-09 23:21:48', 15),
(30, 8, '2025-01-09 23:21:52', 0),
(31, 8, '2025-01-09 23:22:52', 15),
(32, 8, '2025-01-09 23:25:12', 30),
(33, 8, '2025-01-09 23:27:48', 0),
(34, 8, '2025-01-09 23:28:07', 0),
(35, 8, '2025-01-09 23:28:16', 15),
(36, 8, '2025-01-09 23:29:01', 0),
(37, 8, '2025-01-09 23:29:02', 0),
(38, 8, '2025-01-09 23:29:02', 0),
(39, 8, '2025-01-09 23:29:03', 0),
(40, 8, '2025-01-09 23:29:04', 0),
(41, 8, '2025-01-09 23:29:53', 15),
(42, 8, '2025-01-09 23:30:09', 0),
(43, 8, '2025-01-09 23:30:11', 0),
(44, 8, '2025-01-09 23:30:11', 0),
(45, 8, '2025-01-09 23:30:12', 0),
(46, 8, '2025-01-09 23:30:14', 0),
(47, 8, '2025-01-09 23:31:53', 15);

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `order_info` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`order_info`, `order_id`, `product_id`, `price`) VALUES
(5, 12, 2, 15),
(6, 13, 1, 10),
(7, 13, 2, 15),
(8, 13, 3, 20),
(9, 14, 3, 40),
(10, 15, 1, 10),
(11, 16, 3, 20),
(12, 17, 1, 10),
(13, 18, 2, 15),
(14, 19, 2, 15),
(15, 20, 1, 10),
(17, 22, 2, 15),
(18, 23, 2, 15),
(19, 29, 2, 15),
(20, 31, 2, 15),
(21, 32, 3, 20),
(22, 32, 1, 10),
(23, 35, 2, 15),
(24, 41, 2, 15),
(25, 47, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `flavour` text NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `flavour`, `price`, `quantity`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Lights', 'light coffee', 10, 99, 'image/light.png', '2024-11-19 16:25:45', '2024-11-19 16:25:45'),
(2, 'Medium', 'Medium roast Coffee', 15, 100, 'image\\medium.png', '2024-11-20 15:44:20', '2024-11-20 15:44:20'),
(3, 'Dark', 'dark roast', 20, 100, 'image/dark.png', '2024-12-02 17:24:05', '2024-12-02 17:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'user', 'user@gmail.com', 'user123', 'user'),
(2, 'user', 'burasaagar@gmail.com', '$2y$10$EPtmDdWWE3drAl3O0tfXOeQkqlejSkKra/LWGh52v3PnCJwisdIW.', 'user'),
(3, 'bura', 'sagar@gmail.com', '$2y$10$0DOygF9jEtzk9PAOKkVB.uuEeL8BU/vFKoiWb33zYyEUhE/80WD9G', 'user'),
(4, 'user', 'user@gmail.com', '$2y$10$h2IQ/IXmPkZ57cangt1FkOp38te0G2SxudID3xjaoF3AiX7X77iNa', 'user'),
(5, 'user', 'sagar@gmail.com', '$2y$10$8Qi2hOYe61E1xzOLW9oRReJthyKzdpNbAKyaz36o.A53gDi4U5BR6', 'user'),
(6, 'sagar', 'user@gmail.com', '$2y$10$n4GvHUjzxPu.eBjONO7H7Of4dtZZBNw09wQl78XotB2hROarvrkbe', 'user'),
(7, 'sagar', 'sa@gmail.com', '$2y$10$uXSmBomvO2F3uYEKHKRbl.0Orz0xaF55eP03p.zqwibyzZGryoay6', 'user'),
(8, 'ram', 'ram@gmail.com', '$2y$10$f46B6431Ux7sSsRrMxroIeQIhd/QKnbpqPzjnpdvlyDQJnhbBkWdq', 'user'),
(13, 'admin', 'admin@gmail.com', '$2y$10$zkI3y17yLnnxzSPib4FLFuGM8eJJ3Vh/QWCPKQIX4MwBzCMdohUBK', 'admin'),
(14, 'james', 'james007@gmail.com', '$2y$10$HXnYFFBvvpc0t141r3AhmeiULwIncs/IGnrnHhkWJvH2TpPMks8.u', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders` (`users_id`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`order_info`),
  ADD KEY `order_info` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `order_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_info`
--
ALTER TABLE `order_info`
  ADD CONSTRAINT `order_info` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
