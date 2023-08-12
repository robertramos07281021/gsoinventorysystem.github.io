-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 08:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `r_id` int(11) NOT NULL,
  `item_id` int(200) NOT NULL,
  `requester` varchar(200) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `dep_name` varchar(200) NOT NULL,
  `property_code` varchar(200) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `end_user` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `r_status` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `date_needed` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`r_id`, `item_id`, `requester`, `item_name`, `dep_name`, `property_code`, `purpose`, `end_user`, `description`, `r_status`, `date`, `date_needed`) VALUES
(1, 7, 'Jose Cruz', 'Printer', 'MMO', '987-654-177', 'need for event', 'Jessa Rosales', 'Computer for office use and Tourism', 'cancelled', '2023-08-09', '2023-08-14'),
(2, 7, 'Jose Cruz', 'Printer', 'MMO', '987-654-177', 'For audit ', 'Jessa Rosales', 'Computer for office use and Tourism', 'pending', '2023-08-09', '2023-08-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
