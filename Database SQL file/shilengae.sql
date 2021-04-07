-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 08:55 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shilengae`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city_id` text NOT NULL,
  `name` text NOT NULL,
  `country_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ctoggler`
--

CREATE TABLE `ctoggler` (
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ctoggler`
--

INSERT INTO `ctoggler` (`status`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `faq_id` text NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `SelectedCountry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region_id` text NOT NULL,
  `name` text NOT NULL,
  `city_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tableoperatingcountrylist`
--

CREATE TABLE `tableoperatingcountrylist` (
  `id` int(11) NOT NULL,
  `country_id` text NOT NULL,
  `country` text NOT NULL,
  `short` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableoperatingcountrylist`
--

INSERT INTO `tableoperatingcountrylist` (`id`, `country_id`, `country`, `short`, `status`) VALUES
(3, '604b209213b50', 'Kenya', 'KE', 1),
(4, '604b4effe3643', 'Ethiopia', 'ET', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tablepolicies`
--

CREATE TABLE `tablepolicies` (
  `id` int(11) NOT NULL,
  `term_id` text NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  `SelectedCountry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tablepolicies`
--

INSERT INTO `tablepolicies` (`id`, `term_id`, `content`, `created_at`, `updated_at`, `flag`, `SelectedCountry`) VALUES
(1, '604b33e7a77251615541223', 'Privacy Policy Test', 1615541223, 0, 1, 'EN');

-- --------------------------------------------------------

--
-- Table structure for table `tableportalusers`
--

CREATE TABLE `tableportalusers` (
  `id` int(11) NOT NULL,
  `admin_id` text NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `lan` varchar(4) NOT NULL DEFAULT 'en',
  `type` text NOT NULL,
  `added_by` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableportalusers`
--

INSERT INTO `tableportalusers` (`id`, `admin_id`, `username`, `password`, `lan`, `type`, `added_by`, `status`) VALUES
(1, '606bf04c6ca4a-1617686604', 'Ad', '$2y$10$HFHxSwCXqlogNfMJXoBmcuED4XC1M5V6hVJp5klUmSumDqSbanZsS', 'am', 'admin', '', 1),
(9, '606c6800d576b-1617717248', 'Franol', '$2y$10$8qWkgnANcNeNrV.5KxBq1Ot5Jsin/UcV5/4lz/3wZF.lA36JVcdmC', 'en', 'moderator', '606bf04c6ca4a-1617686604', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tableterm`
--

CREATE TABLE `tableterm` (
  `id` int(11) NOT NULL,
  `term_id` text NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  `SelectedCountry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableterm`
--

INSERT INTO `tableterm` (`id`, `term_id`, `content`, `created_at`, `updated_at`, `flag`, `SelectedCountry`) VALUES
(1, '604b33e7a77251615541223', 'Term And Condition Test\r\n', 1615541223, 0, 1, 'EN');

-- --------------------------------------------------------

--
-- Table structure for table `tableusers`
--

CREATE TABLE `tableusers` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `country` text NOT NULL,
  `state` text NOT NULL,
  `city` text NOT NULL,
  `gender` text NOT NULL,
  `birth` text NOT NULL,
  `career` text NOT NULL,
  `experience` text NOT NULL,
  `salary` text NOT NULL,
  `profile_image` text NOT NULL,
  `social_profile_image` text DEFAULT NULL,
  `calling_code` int(11) NOT NULL,
  `language` text NOT NULL DEFAULT 'en-US',
  `verified` int(11) NOT NULL,
  `mverified` int(11) NOT NULL,
  `email_verified_at` int(11) NOT NULL,
  `business` int(11) NOT NULL,
  `company` text NOT NULL,
  `last_online_at` int(11) NOT NULL,
  `last_logged_in` int(11) NOT NULL,
  `login_attempt` int(11) NOT NULL,
  `time_spent` text NOT NULL,
  `last_seen_ip` text NOT NULL,
  `last_device` text NOT NULL,
  `SelectedCountry` text NOT NULL,
  `joined` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `throttling`
--

CREATE TABLE `throttling` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `counter` int(11) NOT NULL,
  `throttled` int(11) NOT NULL,
  `SelectedCountry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableoperatingcountrylist`
--
ALTER TABLE `tableoperatingcountrylist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tablepolicies`
--
ALTER TABLE `tablepolicies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableportalusers`
--
ALTER TABLE `tableportalusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableterm`
--
ALTER TABLE `tableterm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableusers`
--
ALTER TABLE `tableusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `throttling`
--
ALTER TABLE `throttling`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tableoperatingcountrylist`
--
ALTER TABLE `tableoperatingcountrylist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tablepolicies`
--
ALTER TABLE `tablepolicies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tableportalusers`
--
ALTER TABLE `tableportalusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tableterm`
--
ALTER TABLE `tableterm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tableusers`
--
ALTER TABLE `tableusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `throttling`
--
ALTER TABLE `throttling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
