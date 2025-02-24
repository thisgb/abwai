-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 08:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `employee_id` int(8) NOT NULL,
  `tgl` varchar(255) DEFAULT NULL,
  `clock_in` varchar(255) DEFAULT NULL,
  `clock_out` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `tgl`, `clock_in`, `clock_out`) VALUES
(1, 101, '2023-01-15', '14:56:29', NULL),
(2, 101, '2023-01-16', '14:57:14', NULL),
(35, 101, '2023-01-17', '17:59:26', '19:53:18'),
(36, 102, '2023-01-17', '19:54:42', '19:54:47'),
(39, 102, '2023-01-22', '14:36:41', '14:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `employee_id` int(8) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `leave_type`, `start_date`, `end_date`, `status`, `created_at`) VALUES
(1, 0, 'Lainnya', '2025-02-18', '2025-02-25', 'Pending', '2025-02-18 04:42:38'),
(2, 0, 'Sakit', '2025-02-18', '2025-02-19', 'Pending', '2025-02-18 05:59:23'),
(3, 0, 'Cuti', '2025-01-30', '2025-02-19', 'Pending', '2025-02-18 06:08:30'),
(4, 0, 'Cuti', '2025-02-12', '2025-02-13', 'Pending', '2025-02-18 06:33:51'),
(5, 0, 'Cuti', '2025-02-22', '2025-02-22', 'Pending', '2025-02-18 06:42:01'),
(6, 0, 'Cuti', '2025-02-18', '2025-02-19', 'Pending', '2025-02-18 06:44:06'),
(7, 0, 'Cuti', '2025-02-11', '2025-02-21', 'Pending', '2025-02-18 07:08:23'),
(8, 0, 'males', '2025-02-19', '2025-02-22', 'Pending', '2025-02-18 07:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `employee_id` int(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `email`, `fullname`, `role`, `password`) VALUES
(1, 101, 'altap@mail.com', 'Altap', 'admin', '$2y$10$alm5wQPKmazD76Pbe8KVAuIt7b3cyVeIqKMkIUPaj0AGELG4pMwHG'),
(2, 102, 'ani@mail.com', 'Ani Hanifah', 'packaging', '$2y$10$03mwoSbp83Nrd3BCRcQpVOj8HRDfrK1Bqd7jiCGOF1nO7RvNnNPdK'),
(3, 103, '', 'Sigit Raharjo', 'admin', '$2y$10$sT5u.xTYqIA0b/AuQbCYp.ix.VL3uHWkBYrRck6PK/n8csm5PpIf.'),
(4, 104, '', 'Rania Alia Nefta', 'operator', '$2y$10$xTbBVr1Szal7Re70JL9gK.jAH2dlON8nbfelR6tXNzCrKOQ/.IiPO'),
(5, 105, '', 'Tafta ganteng', 'operator', '$2y$10$ZZZLuC98a3io0V92TertYe8zk1ph2vu5npD8IpCuFHmfFrJnJGoGy'),
(7, 106, '', 'Tafta Junior', 'admin', '$2y$10$1wj5a6cs2L733X2uerwh8eGgecbHPpZZrUBdbi/lJcJpIbG.xc4IW'),
(9, 0, '12345@mail.com', '12345', '', '$2y$10$gocVveijxbaiOAAiNg9yxexcEg7zDg4WhMwk4sr./4qFT4GEsDrWG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
