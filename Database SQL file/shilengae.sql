-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 01:16 AM
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
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city_id` text NOT NULL,
  `name` text NOT NULL,
  `country_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_id`, `name`, `country_id`) VALUES
(1, '603a9e634e7d3', 'Addis Ababa', '6039d14694b2b'),
(2, '603a9e7e5d40d', 'Adama', '6039d14694b2b'),
(3, '603d3b654439d', 'Mobasa', '603a4b4f1af53');

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
  `region` text NOT NULL,
  `country_id` text NOT NULL
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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableoperatingcountrylist`
--

INSERT INTO `tableoperatingcountrylist` (`id`, `country_id`, `country`, `short`, `status`) VALUES
(1, '6039d14694b2b', 'Ethiopia', 'ET', 0),
(2, '603a4b30cd722', 'Egypt', 'EG', 0),
(3, '603a4b4f1af53', 'Kenya', 'KE', 0),
(4, '603a6591ed927', 'Afghanistan', 'AF', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tablepolicies`
--

CREATE TABLE `tablepolicies` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  `SelectedCountry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tableportalusers`
--

CREATE TABLE `tableportalusers` (
  `id` int(11) NOT NULL,
  `admin_id` text NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableportalusers`
--

INSERT INTO `tableportalusers` (`id`, `admin_id`, `username`, `password`) VALUES
(1, '32ed2e3x32e62bxvs53a5r', 'AD', '$2y$10$qxQ4N5jV/cIGYg3WDT4rzeCBhAW5kREPu2pvqS9gEqYN1ScYC5BTu');

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

--
-- Dumping data for table `tableusers`
--

INSERT INTO `tableusers` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `country`, `state`, `city`, `gender`, `birth`, `career`, `experience`, `salary`, `profile_image`, `social_profile_image`, `calling_code`, `language`, `verified`, `mverified`, `email_verified_at`, `business`, `company`, `last_online_at`, `last_logged_in`, `login_attempt`, `time_spent`, `last_seen_ip`, `last_device`, `SelectedCountry`, `joined`, `modified_at`) VALUES
(1, '6047332b41d88/1615278891', 'mikiyas', 'lemlemu', 'mikiyaslemlemu@gmail.com', '941398934', '', 'ET', '', '', '', '', '', '', '', '', NULL, 251, 'en-US', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '', 1615278891, 0),
(2, '604733bef3c21/1615279038', 'mikiyas', 'lemlemu', 'mikiyaslemlemu1@gmail.com', '911223344', '12345678', 'ET', '', '', '', '', '', '', '', '', NULL, 251, 'en-US', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '', 1615279038, 0),
(5, '60486bf679b0a/1615358966', 'fen', 'mul', 'daddybomb37@gmail.com', '910155917', 'abcd1234', 'ET', '', '', '', '', '', '', '', '', NULL, 251, 'en-US', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '', 1615358966, 0),
(6, '60494697134e2/1615414935', 'mike', 'lemu', 'miki@gmail.com', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 'en-US', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '', 1615414935, 0),
(7, '60494731a4718/1615415089', 'MIka', 'Lemlemu', 'mikiyaslemlemu@yahoo.com', '', '', '', '', '', '', '', '', '', '', '', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2837917329826324&height=800&width=800&ext=1618010613&hash=AeQFosV2pZiYl8sDqrY', 0, 'en-US', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '', 1615415089, 1615418615);

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
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
-- Indexes for table `tableusers`
--
ALTER TABLE `tableusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `throttling`
--
ALTER TABLE `throttling`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tablepolicies`
--
ALTER TABLE `tablepolicies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tableportalusers`
--
ALTER TABLE `tableportalusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tableusers`
--
ALTER TABLE `tableusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `throttling`
--
ALTER TABLE `throttling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
