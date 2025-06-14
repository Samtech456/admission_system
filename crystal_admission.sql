-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 03:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crystal_admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `previous_school` varchar(100) DEFAULT NULL,
  `grade_level` varchar(20) DEFAULT NULL,
  `program_of_study` varchar(100) DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `document` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `first_name`, `last_name`, `user_email`, `user_id`, `dob`, `gender`, `address`, `previous_school`, `grade_level`, `program_of_study`, `status`, `applied_at`, `document`, `created_at`) VALUES
(1, 'serwaa', 'amihere', 'jum@yahoo.com', 13, '2003-06-12', 'Female', 'kokomlemle', 'daysprint int', '10', 'E-maths', 'Accepted', '2025-04-13 02:19:56', '67fb1f4c619a1.jpg', '2025-04-16 01:15:48'),
(2, 'Samuel', 'Effah', 'Samueleffah@gmail.com', 14, '2025-03-10', 'Male', 'circle', 'morning star', 'Nursery', 'All Subject', 'Accepted', '2025-04-13 02:47:23', '67fb25bbc9502.jpg', '2025-04-16 01:15:48'),
(3, 'Bernard', 'Inkoom', 'bernardinkoom@gmail.com', 15, '2025-04-15', 'Male', 'accra', 'leon senior high ', 'kg', 'All Subject', 'Rejected', '2025-04-13 04:23:11', '67fb3c2fb4c06.jpg', '2025-04-16 01:15:48'),
(4, 'David', 'Asare', 'Davidasare@gmail.com', 16, '2025-04-16', 'Male', 'Nima', 'Hartford School', 'Nursery', 'All Subject', 'Rejected', '2025-04-13 09:50:14', '67fb88d606550.jpg', '2025-04-16 01:15:48'),
(5, 'Joan', 'Osei', 'Joanosei@gmail.com', 17, '2015-06-13', 'Female', 'lapaz', 'Kingsford Int', 'Jhs', 'All Subject', 'Rejected', '2025-04-13 09:58:34', '67fb8acabb84d.jpg', '2025-04-16 01:15:48'),
(9, 'rahill ', 'osei ', 'rahill@gmail.com', 19, '2025-04-16', 'Female', 'circle', 'montessori', 'nursery', 'All Subject', 'Accepted', '2025-04-15 07:26:19', '67fe0a1b1e93e.docx', '2025-04-16 01:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Samuel Effah', 'hello@yahoo.com', 'hello im eric', '2025-04-13 03:16:02'),
(2, 'Samuel Effah', 'hello@yahoo.com', 'hello im theo', '2025-04-13 03:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference_number` varchar(20) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `application_id`, `amount`, `reference_number`, `status`, `created_at`) VALUES
(1, 9, 50.00, 'PAY-20250416-4792', 'completed', '2025-04-16 00:29:39'),
(2, 4, 50.00, 'PAY-20250416-2855', 'completed', '2025-04-16 01:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('applicant','admin') DEFAULT 'applicant',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `user_type`, `created_at`) VALUES
(7, 'Admin User', 'admin@gmail.com', '1234567890', '000', 'admin', '2025-04-11 03:53:58'),
(10, 'Admin User', 'admin@yahoo.com', '1234567890', '$2y$10$Z6sD9zzGYa93NsRDLPQJ6uY8yihW126iciIabAk2lBoFMN.Dut5qG', 'admin', '2025-04-11 04:17:53'),
(13, 'niel giovanni', 'samuelpierce451@gmail.com', '0570112720', '$2y$10$5nnVi4h80Wv0dEs2ASmz3uB8.ADqCUYNGZStOzWTxYSwS2rMJUHey', 'applicant', '2025-04-13 02:11:52'),
(14, 'Samuel Effah', 'Samueleffah@gmail.com', '0552322363', '$2y$10$z8KxCpTa9f3JwpeF/VqlD.JTBdXz9Y6V6QG7vZVASnQihz4tn73oS', 'applicant', '2025-04-13 02:40:53'),
(15, 'bernard inkoom', 'bernardinkoom@gmail.com', '0557784754', '$2y$10$.1t0X0yPouj7GbfCGAjdPevRLWjddlgx75dkwaEfnu90sWkYUQCdi', 'applicant', '2025-04-13 04:21:00'),
(16, 'David Asare', 'Davidasare@gmail.com', '0558874745', '$2y$10$ps1zKqYaJlfwU92flhyDc.Us7BdQQQ1dKqleF5DGgrcpuTTUxmaxC', 'applicant', '2025-04-13 09:47:23'),
(17, 'Joan Osei', 'Joanosei@gmail.com', '053455345', '$2y$10$Ll2tjICxu.pjD6THaBUfPOJ7C.UWRB1XOPzKRU/vWtW.QgJbDVCFq', 'applicant', '2025-04-13 09:56:18'),
(18, 'ernest osei', 'ernest@gmail.com', '0556455463', '$2y$10$RGWHpY0tWvPS6XrFa0nFFuJp/pCQdL3/7wphROMMc3LqZWGlUSOua', 'applicant', '2025-04-15 07:22:30'),
(19, 'rahil', 'rahill@gmail.com', '055434536', '$2y$10$GefetySqFdTzAb9mrCJO6.FgGJQjoit2FfVQqC5s55xy.QquuxP52', 'applicant', '2025-04-15 07:24:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_applied_at` (`applied_at`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
