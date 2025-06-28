-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 03:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee-blend`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `phone` int(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `firstname`, `lastname`, `date`, `time`, `phone`, `message`, `user_id`, `status`, `created_at`) VALUES
(8, 'test', 'world', '2025-05-31', '12:00:00', 2147483647, 'test', 2, 'Pending', '2025-05-29 14:53:18'),
(9, 'test', 'worldGHG', '2025-06-03', '07:00:00', 2147483647, 'FGHGFH', 2, 'Pending', '2025-05-30 12:21:54'),
(10, 'Veda', 'deva', '2025-06-25', '01:30:00', 2147483647, 'DFGDFGDFG', 2, 'Pending', '2025-06-19 10:48:45'),
(11, 'Priyanshek', 'devo', '2025-06-26', '01:30:00', 2147483647, 'testere', 2, 'Pending', '2025-06-19 10:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffee-shop-admins`
--

CREATE TABLE `coffee-shop-admins` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffee-shop-admins`
--

INSERT INTO `coffee-shop-admins` (`id`, `name`, `password`, `created_at`) VALUES
(4, 'admin', '$2y$10$GuIi/c/naJT7srjpiKah.ePole87L1t4RpbsaM15EGE2zTO05AVVa', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `town` varchar(80) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `total_price` decimal(11,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `country`, `address`, `town`, `zipcode`, `phone`, `email`, `total_price`, `user_id`, `status`, `created_at`) VALUES
(2, 'Ulagambigai world', 'South Korea', '45,st', 'test', '695847', '9685744758', 'uma@gmail.com', 37.00, 2, 'Pending', '2025-06-10 08:25:09.449778'),
(4, 'Ulagambigai world', 'South Korea', '45,st', 'test', '695847', '9685744758', 'firstuser@gmail.com', 7.00, 2, 'Pending', '2025-06-10 13:15:54.516718');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `category`, `price`, `created_at`) VALUES
(1, 'Coffee Capuccino', 'menu-1.jpg', 'A small river named Duden flows by their place and supplies', 'drinks', '6', '2025-05-30 13:18:23'),
(2, 'Ice Coffee', 'menu-2.jpg', 'A small river named Duden flows by their place and supplies', 'drinks', '10', '2025-05-30 13:29:03'),
(3, 'Oreo Coffee', 'menu-3.jpg', '\r\nA small river named Duden flows by their place and supplies', 'drinks', '12', '2025-05-30 13:31:24'),
(4, 'Barborn Biscuit Coffee', 'menu-4.jpg', 'A small river named Duden flows by their place and supplies', 'drinks', '15', '2025-05-30 14:25:36'),
(5, 'Hot Cake Honey', 'dessert-1.jpg', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.', 'desserts', '3', '2025-06-19 10:59:10'),
(6, 'Fruit Cake', 'dessert-2.jpg', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.', 'desserts', '6', '2025-06-19 11:00:42'),
(7, 'Icecream cake ', 'dessert-5.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, ', 'desserts', '15', '2025-06-23 13:40:41'),
(8, 'Honey Fruite Cake ', 'dessert-6.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'desserts', '20', '2025-06-24 11:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `username` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `review`, `username`, `created_at`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', 'firstuser', '2025-06-21 10:34:29'),
(2, 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'firstuser', '2025-06-21 10:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(2, 'firstuser', 'firstuser@gmail.com', '$2y$10$mdprivXCjf6AlssqqIfpx.EidLnILGTkstNAzQ/yPuB6Z8yy3wd.u', '2025-05-27 08:16:45.043658');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coffee-shop-admins`
--
ALTER TABLE `coffee-shop-admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `coffee-shop-admins`
--
ALTER TABLE `coffee-shop-admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
