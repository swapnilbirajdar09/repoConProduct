-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2019 at 06:02 AM
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
-- Database: `brix_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`setting_id`, `setting_name`, `setting_value`, `status`) VALUES
(1, 'admin_email', 'swapnil.bizmotech@gmail.com', 0),
(2, 'admin_uname', 'admin', 0),
(3, 'admin_passwd', 'admin', 0),
(4, 'logo_path', 'upload/logo/Koala.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_tab`
--

CREATE TABLE `category_tab` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_tab`
--

INSERT INTO `category_tab` (`cat_id`, `cat_name`, `status`) VALUES
(1, 'Landscape', 0),
(2, 'Modern Bungalows', 0),
(3, 'Traditional Bungalows', 0),
(4, 'Flats', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_tab`
--

CREATE TABLE `contact_tab` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_subject` varchar(255) NOT NULL,
  `contact_mobile` bigint(20) NOT NULL,
  `contact_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_tab`
--

INSERT INTO `contact_tab` (`contact_id`, `contact_name`, `contact_email`, `contact_subject`, `contact_mobile`, `contact_message`) VALUES
(1, 'secsdcs', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 987455621545, ' wefwfe  w ew fw  wew fw f wefwfwf w wf'),
(2, 'secsdcs', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 987455621545, ' wefwfe  w ew fw  wew fw f wefwfwf w wf'),
(3, 'secsdcs', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 987455621545, ' wefwfe  w ew fw  wew fw f wefwfwf w wf'),
(4, 'secsdcs', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 987455621545, ' wefwfe  w ew fw  wew fw f wefwfwf w wf'),
(5, 'secsdcs', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 987455621545, ' wefwfe  w ew fw  wew fw f wefwfwf w wf'),
(6, 'wfdewfc', 'mundesamrat@gmail.com', 'ascc dx  d c  sz  ', 9874455214, 'ascsa xd    zs sd  '),
(7, 'wfdewfc', 'mundesamrat@gmail.com', 'ascc dx  d c  sz  ', 9874455214, 'ascsa xd    zs sd  '),
(8, 'wfdewfc', 'mundesamrat@gmail.com', 'ascc dx  d c  sz  ', 9874455214, 'ascsa xd    zs sd  '),
(9, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 9888888, 'deefcdef'),
(10, 'wfdewfc huefhe', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 844484, 'esf'),
(11, 'wfdewfc huefhe', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 844484, 'esf'),
(12, 'wfdewfc huefhe', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 844484, 'esf'),
(13, 'wfdewfc huefhe', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 844484, 'esf'),
(14, 'wfdewfc huefhe', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 844484, 'esf'),
(15, 'wfdewfc huefhe', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 844484, 'esf'),
(16, 'wfdewfc huefhe', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 844484, 'esf'),
(17, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 578825773, 'ettttsts'),
(18, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(19, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(20, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(21, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(22, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(23, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(24, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(25, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(26, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(27, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(28, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(29, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(30, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(31, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(32, 'wfdewfc', 'mundesamrat@gmail.com', 'sdcdv   wfew ew w w w   gw ww ', 545656, 'huhjujkguku'),
(33, 'secsdcs', 'mundesamrat@gmail.com', 'frvfvefvev', 8783686838, 'jyyfyyyyf'),
(34, 'SAmrat Munde', 'mundesamrat@gmail.com', 'Demo Title', 8446524095, 'Demo text description blah blah blah Demo text description blah blah blah Demo text description blah blah blah Demo text description blah blah blah Demo text description blah blah blah Demo text description blah blah blah '),
(35, 'swapnil birajdar', 'swapnilbirajdar09@gmail.com', 'suggestion', 8793590809, 'hello.........!');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_tab`
--

CREATE TABLE `gallery_tab` (
  `gallery_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `img_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_tab`
--

INSERT INTO `gallery_tab` (`gallery_id`, `img_id`, `cat_id`, `img_description`) VALUES
(2, 1, 2, 'blah blah blah '),
(3, 2, 2, 'blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah ');

-- --------------------------------------------------------

--
-- Table structure for table `homeslider`
--

CREATE TABLE `homeslider` (
  `slide_id` int(11) NOT NULL,
  `slide_title` varchar(255) NOT NULL,
  `slide_category` int(11) NOT NULL,
  `link_to` varchar(255) NOT NULL,
  `master_img_id` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeslider`
--

INSERT INTO `homeslider` (`slide_id`, `slide_title`, `slide_category`, `link_to`, `master_img_id`, `position`) VALUES
(2, 'redesign workspace', 2, '', 1, 0),
(3, 'villa on lake', 3, '', 2, 0),
(5, 'farm house', 4, '', 3, 0),
(6, 'farm house', 3, '', 4, 0),
(7, 'farm house', 2, '', 5, 0),
(9, 'farm house', 3, '', 6, 0),
(10, 'farm house', 2, '', 7, 0),
(11, 'villa on lake', 3, '', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `image_master`
--

CREATE TABLE `image_master` (
  `img_id` int(11) NOT NULL,
  `img_path` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_master`
--

INSERT INTO `image_master` (`img_id`, `img_path`, `status`) VALUES
(1, 'upload/image_master/1_R.jpg', 1),
(2, 'upload/image_master/2_R.jpg', 1),
(3, 'upload/image_master/bg2.jpg', 1),
(4, 'upload/image_master/4_R.jpg', 1),
(5, 'upload/image_master/5_R.jpg', 1),
(6, 'upload/image_master/bg3.jpg', 1),
(7, 'upload/image_master/bg5.jpg', 1),
(8, 'upload/image_master/bg4.jpg', 1),
(16, 'upload/image_master/Jellyfish.jpg', 1),
(33, 'upload/image_master/Koala.jpg', 1),
(39, 'upload/image_master/Desert.jpg', 1),
(40, 'upload/image_master/Hydrangeas.jpg', 1),
(42, 'upload/image_master/Penguins.jpg', 1),
(44, 'upload/image_master/Lighthouse.jpg', 1),
(45, 'upload/image_master/Chrysanthemum.jpg', 1),
(47, 'upload/image_master/Tulips.jpg', 1),
(48, 'upload/image_master/Lighthouse.jpg', 1),
(49, 'upload/image_master/2_R.jpg', 1),
(50, 'upload/image_master/bg5.jpg', 1),
(51, 'upload/image_master/l_2.jpg', 1),
(52, 'upload/image_master/l_3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_tab`
--

CREATE TABLE `portfolio_tab` (
  `project_id` int(11) NOT NULL,
  `project_category` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `project_photos` text NOT NULL,
  `view_count` int(11) NOT NULL,
  `project_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio_tab`
--

INSERT INTO `portfolio_tab` (`project_id`, `project_category`, `project_name`, `project_description`, `project_photos`, `view_count`, `project_status`) VALUES
(1, 1, 'Portfolio Landscape 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n', '[{\"image_path\":\"upload/image_master/bg5.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/5_R.jpg\"}]', 0, 1),
(2, 1, 'Portfolio Landscape 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', '[{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/1_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/5_R.jpg\"}]', 0, 1),
(3, 2, 'Modern Bunglow 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', '[{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/1_R.jpg\"},{\"image_path\":\"upload/image_master/5_R.jpg\"}]', 0, 1),
(4, 1, 'Portfolio Landscape 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', '[{\"image_path\":\"upload/image_master/bg3.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/1_R.jpg\"}]', 0, 1),
(5, 3, 'Traditional Bungalow 1 demo name', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', '[{\"image_path\":\"upload/image_master/1_R.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/5_R.jpg\"}]', 0, 1),
(6, 4, 'Matai Chambers Flat', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n', '[{\"image_path\":\"upload/image_master/5_R.jpg\"},{\"image_path\":\"upload/image_master/1_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"}]', 0, 1),
(7, 4, 'cowork Flat', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n', '[{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/1_R.jpg\"},{\"image_path\":\"upload/image_master/5_R.jpg\"}]', 0, 1),
(10, 2, 'hjghhbkjjnjl', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n', '[{\"image_path\":\"upload/image_master/1_R.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/5_R.jpg\"}]', 0, 1),
(14, 1, 'kjfghjdkn', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n', '[{\"image_path\":\"upload/image_master/bg4.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/5_R.jpg\"}]', 0, 1),
(15, 4, 'Mannik Bagh Flat', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n', '[{\"image_path\":\"upload/image_master/5_R.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/1_R.jpg\"}]', 0, 1),
(16, 3, 'sdfghjkjhg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n', '[{\"image_path\":\"upload/image_master/1_R.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg2.jpg\"},{\"image_path\":\"upload/image_master/4_R.jpg\"},{\"image_path\":\"upload/image_master/5_R.jpg\"}]', 0, 1),
(17, 1, 'farm house area 51', 'the farmouse near barvi dam, badalapur, mumbai.', '[{\"image_path\":\"upload/image_master/Lighthouse.jpg\"},{\"image_path\":\"upload/image_master/2_R.jpg\"},{\"image_path\":\"upload/image_master/bg5.jpg\"},{\"image_path\":\"upload/image_master/l_2.jpg\"},{\"image_path\":\"upload/image_master/l_3.jpg\"}]', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_tab`
--

CREATE TABLE `subscriber_tab` (
  `sub_id` int(11) NOT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `subscribed_on` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriber_tab`
--

INSERT INTO `subscriber_tab` (`sub_id`, `mobile_no`, `email_id`, `subscribed_on`, `status`) VALUES
(1, 9874563215, 'mundesamrat@gmail.com', '2018-04-06', 0),
(2, 9874569488, 'vaidehi.bizmotech@gmail.com', '2018-04-06', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `category_tab`
--
ALTER TABLE `category_tab`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact_tab`
--
ALTER TABLE `contact_tab`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `gallery_tab`
--
ALTER TABLE `gallery_tab`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `img_id` (`img_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `homeslider`
--
ALTER TABLE `homeslider`
  ADD PRIMARY KEY (`slide_id`),
  ADD KEY `master_img_id` (`master_img_id`),
  ADD KEY `slide_category` (`slide_category`);

--
-- Indexes for table `image_master`
--
ALTER TABLE `image_master`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `portfolio_tab`
--
ALTER TABLE `portfolio_tab`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `subscriber_tab`
--
ALTER TABLE `subscriber_tab`
  ADD PRIMARY KEY (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_tab`
--
ALTER TABLE `category_tab`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_tab`
--
ALTER TABLE `contact_tab`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `gallery_tab`
--
ALTER TABLE `gallery_tab`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homeslider`
--
ALTER TABLE `homeslider`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `image_master`
--
ALTER TABLE `image_master`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `portfolio_tab`
--
ALTER TABLE `portfolio_tab`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subscriber_tab`
--
ALTER TABLE `subscriber_tab`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery_tab`
--
ALTER TABLE `gallery_tab`
  ADD CONSTRAINT `gallery_tab_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category_tab` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_tab_ibfk_2` FOREIGN KEY (`img_id`) REFERENCES `image_master` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `homeslider`
--
ALTER TABLE `homeslider`
  ADD CONSTRAINT `homeslider_ibfk_1` FOREIGN KEY (`slide_category`) REFERENCES `category_tab` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `homeslider_ibfk_2` FOREIGN KEY (`master_img_id`) REFERENCES `image_master` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
