-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2018 at 06:40 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metromony_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tab`
--

CREATE TABLE `admin_tab` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_officetype` varchar(255) NOT NULL,
  `admin_office_address` varchar(255) NOT NULL,
  `admin_firstname` varchar(255) NOT NULL,
  `admin_middlename` varchar(255) NOT NULL,
  `admin_lastname` varchar(255) NOT NULL,
  `admin_city` varchar(255) NOT NULL,
  `admin_state` varchar(255) NOT NULL,
  `admin_country` varchar(255) NOT NULL,
  `admin_postal_code` varchar(255) NOT NULL,
  `admin_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_tab`
--

INSERT INTO `admin_tab` (`admin_id`, `username`, `admin_email`, `password`, `admin_officetype`, `admin_office_address`, `admin_firstname`, `admin_middlename`, `admin_lastname`, `admin_city`, `admin_state`, `admin_country`, `admin_postal_code`, `admin_details`) VALUES
(1, 'admin', 'swapnilbirajdar09@gmail.com', 'admin1234', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tab`
--
ALTER TABLE `admin_tab`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tab`
--
ALTER TABLE `admin_tab`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
