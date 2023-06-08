-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2023 at 06:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `booking_start` datetime NOT NULL,
  `booking_end` datetime NOT NULL,
  `transfer_photo` varchar(50) NOT NULL,
  `booking_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_transfer` double NOT NULL,
  `description_status` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `field_id`, `booking_start`, `booking_end`, `transfer_photo`, `booking_count`, `created_at`, `total_transfer`, `description_status`, `status`) VALUES
(4, 2, 9, '2023-01-30 21:00:00', '2023-01-30 22:00:00', '63d7ce267ac69.jpg', 2, '2023-01-30 17:16:30', 200000, NULL, 'valid'),
(5, 2, 9, '2023-01-31 00:29:00', '2023-01-31 01:29:00', '63d7fe97a59e3.jpg', 1, '2023-01-30 19:29:53', 100000, 'Jam pesan dengan booking tidak sesuai', 'invalid'),
(6, 2, 9, '2023-01-31 11:16:00', '2023-01-31 12:16:00', '63d896583cb66.jpg', 1, '2023-01-31 04:20:50', 100000, 'Upload foto bukti transfer dengan benar', 'invalid');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `facility` varchar(100) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `status`, `type`, `name`, `photo`, `facility`, `price`) VALUES
(9, 1, 'Badminton', 'Garuda 1', '63d7cd38f1a2c.jpg', 'Free air galon 1 pcs, lapangan aspal dengan lampu 3pcs', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `email`, `password`) VALUES
(2, 'iky', '123', 'jalan-jalan yuk', 'yanto.totoyan1@gmail.com', '$2y$10$oVWg9Bme7XTAuoNwFXDlreo97.4.5LVzZIzKsQFOz8CgVagEf9Rwu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
