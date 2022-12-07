-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 10:17 AM
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
-- Database: `jobs_vacency`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) NOT NULL,
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

INSERT INTO `jobs` (`id`, `posted_in`, `company`, `position`, `job_type`, `place`, `deadline`, `date`) VALUES
(1, 'ellen vacency', 'stella construction', 'Junior programmer', 'permanent', 'Addis Ababa', '19-nov', '2022-12-05'),
(2, 'dereja', 'CNET', 'software developer', 'permanent', 'Addis Ababa', '17-Nov', '2022-12-05'),
(3, 'freelance', '360 ground', 'fullstack developer', 'permanent', 'Addis Ababa', NULL, '2022-12-05'),
(5, 'linkedin', 'Addis software', 'fullstack dev', 'permanent', 'Addis Ababa', '30-nov', '2022-12-05'),
(6, 'ethiojobszone', 'gadaa bank', 'IS', 'permanent', 'Addis Ababa', '08-dec', '2022-12-06'),
(9, 'freelance', '', 'it', 'permanent', 'Adama', '', '2022-12-06'),
(10, 'freelance', 'independeent news and media plc', 'fullstack dev', 'permanent', 'Addis Ababa', '30-Nov', '2022-12-06'),
(12, '', 'Dhtechnical', 'software dev', 'intern', 'Addis Ababa', '', '2022-12-06'),
(13, 'freelance', 'Betolo it solution plc', 'website developer', 'permanent', 'Addis Ababa', '13-Dec', '2022-12-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
