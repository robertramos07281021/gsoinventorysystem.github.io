-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 10:31 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsoinventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(22) NOT NULL,
  `dep_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`) VALUES
(1, 'HR'),
(2, 'SB'),
(3, 'ACCOUNTING'),
(4, 'GSO/BAC'),
(5, 'RHU'),
(6, 'BFP'),
(7, 'PNP'),
(8, 'MCR'),
(9, 'BUDGET'),
(10, 'MTO'),
(11, 'BPLO'),
(12, 'MPDO'),
(13, 'ENGINEERING'),
(14, 'COMELEC'),
(15, 'BIR'),
(16, 'ASSESOR'),
(17, 'DILG'),
(18, 'MSWDO'),
(19, 'MENDO'),
(20, 'DA'),
(21, 'MDDRRMO'),
(22, 'MDRRMO'),
(23, 'MMO');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `property_code` varchar(50) DEFAULT NULL,
  `end_user` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `dep_id`, `property_code`, `end_user`, `description`, `created_at`) VALUES
(1, 'Computer', 2, '987-654-177', 'Leymar Madjus', 'Laptop for Graphic 1 design', '2023-07-23 14:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_num` varchar(15) NOT NULL,
  `u_address` varchar(200) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `department` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `phone_num`, `u_address`, `username`, `password`, `department`, `role`, `status`) VALUES
(1, 'joyce', 'bravo', 'cj@gmail.com', '09061033195', 'legazpi', 'brunonotme', 'd41d8cd98f', 'engineering', 'user', 'active'),
(14, 'Joyce', 'Go', 'd@f.com', '09124575124', 'legazpi', 'cjb', '1bbd886460827015e5d605ed44252251', 'HR', 'admin', 'inactive'),
(16, 'Joyce', 'Go', 'ff@g.c', '09124521421', 'legazpi', 'chris', '25d55ad283aa400af464c76d713c07ad', 'HR', 'admin', 'active'),
(18, 'Jose', 'Cruz', 'jose@gmail.com', '09213654789', 'naga city', 'jose01', '25d55ad283aa400af464c76d713c07ad', 'MMO', 'user', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
