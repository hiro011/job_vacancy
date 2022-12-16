-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 03:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs_vacancy`
--

-- --------------------------------------------------------

--
-- Table structure for table `deleted_data`
--

CREATE TABLE `deleted_data` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `posted_in` varchar(100) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `position` varchar(200) DEFAULT NULL,
  `job_type` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `deadline` varchar(100) DEFAULT NULL,
  `save_date` date DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_data`
--

INSERT INTO `deleted_data` (`id`, `user_id`, `posted_in`, `company`, `position`, `job_type`, `place`, `deadline`, `save_date`, `date`) VALUES
(32, 20, 'linkedin', 'canonical', 'web developer', 'Remote-Permanent', 'Remote', '', '2022-12-16', '2022-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `posted_in` varchar(100) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `position` varchar(200) DEFAULT NULL,
  `job_type` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `deadline` varchar(100) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `posted_in`, `company`, `position`, `job_type`, `place`, `deadline`, `date`) VALUES
(1, 20, 'elelanjobs', 'stella construction', 'Junior programmer', 'permanent', 'Addis Ababa', '19-nov', '2022-12-05'),
(2, 20, 'dereja', 'CNET', 'software developer', 'permanent', 'Addis Ababa', '17-Nov', '2022-12-05'),
(3, 20, 'freelance', '360 ground', 'fullstack developer', 'permanent', 'Addis Ababa', NULL, '2022-12-05'),
(5, 20, 'linkedin', 'Addis software', 'fullstack dev', 'permanent', 'Addis Ababa', '30-nov', '2022-12-05'),
(6, 20, 'ethiojobszone', 'gadaa bank', 'IS', 'permanent', 'Addis Ababa', '08-dec', '2022-12-06'),
(9, 20, 'freelance', '', 'it', 'permanent', 'Adama', '', '2022-12-06'),
(10, 20, 'freelance', 'independeent news and media plc', 'fullstack dev', 'permanent', 'Addis Ababa', '30-Nov', '2022-12-06'),
(12, 20, '', 'Dhtechnical', 'software dev', 'intern', 'Addis Ababa', '', '2022-12-06'),
(13, 20, 'freelance', 'Betolo it solution plc', 'website developer', 'permanent', 'Addis Ababa', '13-Dec', '2022-12-06'),
(16, 20, 'linkedin', 'appen', 'social media evaluator', 'Remote-Permanent', 'Remote', '', '2022-12-08'),
(17, 20, 'linkedin', 'canonical', 'python software dev', 'Remote-Permanent', 'Remote', '', '2022-12-09'),
(18, 20, 'freelance', 'Xoka IT solution plc ', 'fullstack dev', 'permanent', 'Addis Ababa', '', '2022-12-12'),
(19, 20, 'elelanjobs', 'WebSprix IT Solutions PLC', 'Customer support engineer', 'permanent', 'Addis Ababa', '18-Dec', '2022-12-13'),
(21, 20, 'freelance', 'COFIX SYSTEMS PLC', 'Innovation and System Development Officer', 'contractual', 'Addis Ababa', '19-Dec', '2022-12-14'),
(26, 20, 'ethiopian vacancy', 'ethiopia commodity exchange', 'Junior IT Support', 'permanent', 'Addis Ababa', '19-Dec', '2022-12-14'),
(27, 21, 'sef', 'sfd', 'it', 'intern', '', '17-Nov', '2022-12-14'),
(28, 21, 'linkedin', 'Addis software', 'ed', '', '', '', '2022-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passcode` varchar(200) NOT NULL,
  `profile` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passcode`, `profile`, `date`) VALUES
(20, 'Ahmed', '1234sddfsd', '6399aee03eb298.70840144.png', '2022-12-14'),
(24, 'Ahmed3', '1234sddfsd2', '639ae57f341169.46642509.', '2022-12-15'),
(21, 'Mehamed', '1234sdfgg', '6399bca4853b02.56997987.png', '2022-12-14'),
(25, 'test', '1234asfdss ', '639c767993f321.28750573.jpg', '2022-12-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`) USING BTREE,
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
