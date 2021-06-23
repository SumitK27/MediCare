-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 08:32 PM
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
-- Database: `experteze`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Patient'),
(2, 'Nurse'),
(3, 'Doctor'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_added_by`
--

CREATE TABLE `user_added_by` (
  `nurse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `aadhaar_no` bigint(20) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` int(60) NOT NULL,
  `type` varchar(25) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_symptoms`
--

CREATE TABLE `user_symptoms` (
  `user_id` int(11) NOT NULL,
  `fever` tinyint(1) DEFAULT 0,
  `fever_s` int(11) DEFAULT 0,
  `cough` tinyint(1) DEFAULT 0,
  `cough_s` int(11) DEFAULT 0,
  `tiredness` tinyint(1) DEFAULT 0,
  `tiredness_s` int(11) DEFAULT 0,
  `chest_pain` tinyint(1) DEFAULT 0,
  `chest_pain_s` int(11) DEFAULT 0,
  `head_ache` tinyint(1) DEFAULT 0,
  `head_ache_s` int(11) DEFAULT 0,
  `stomach_ache` tinyint(1) DEFAULT 0,
  `stomach_ache_s` int(11) DEFAULT 0,
  `kidney_failure` tinyint(1) DEFAULT 0,
  `heart_problem` tinyint(1) DEFAULT 0,
  `heart_problem_s` int(11) DEFAULT 0,
  `diabetes` tinyint(1) DEFAULT 0,
  `diabetes_s` int(11) DEFAULT 0,
  `less_oxygen_level` tinyint(1) DEFAULT 0,
  `less_oxygen_level_s` int(11) DEFAULT 0,
  `malignancy_cancer` tinyint(1) DEFAULT 0,
  `malignancy_cancer_s` int(11) DEFAULT 0,
  `hypertension` tinyint(1) DEFAULT 0,
  `hypertension_s` int(11) DEFAULT 0,
  `liver_disease` tinyint(1) DEFAULT 0,
  `liver_disease_s` int(11) DEFAULT 0,
  `immunocompromised_condition` tinyint(1) DEFAULT 0,
  `immunocompromised_condition_s` int(11) DEFAULT 0,
  `vomiting` tinyint(1) DEFAULT 0,
  `vomiting_s` int(11) DEFAULT 0,
  `consume_steroids` tinyint(1) DEFAULT 0,
  `sore_throat` tinyint(1) DEFAULT 0,
  `sore_throat_s` int(11) DEFAULT 0,
  `diarrhea` tinyint(1) DEFAULT 0,
  `diarrhea_s` int(11) DEFAULT 0,
  `congestion` tinyint(1) DEFAULT 0,
  `congestion_s` int(11) DEFAULT 0,
  `sense_loss` tinyint(1) DEFAULT 0,
  `sense_loss_s` int(11) DEFAULT 0,
  `skin_rash_discoloration` tinyint(1) DEFAULT 0,
  `skin_rash_discoloration_s` int(11) DEFAULT 0,
  `trouble_breathing` tinyint(1) DEFAULT 0,
  `trouble_breathing_s` int(11) DEFAULT 0,
  `contact_positive` tinyint(1) DEFAULT 0,
  `is_positive` tinyint(1) DEFAULT 0,
  `is_vaccinated` tinyint(1) DEFAULT 0,
  `is_vaccinated_d` datetime DEFAULT NULL,
  `is_vaccinated_2` tinyint(1) DEFAULT 0,
  `is_vaccinated_2_d` datetime DEFAULT NULL,
  `travelled` tinyint(1) DEFAULT 0,
  `chills` tinyint(1) DEFAULT 0,
  `chills_s` int(11) DEFAULT 0,
  `quarantine` tinyint(1) DEFAULT 0,
  `quarantine_s` int(11) DEFAULT 0,
  `date_tested` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_added_by`
--
ALTER TABLE `user_added_by`
  ADD PRIMARY KEY (`user_id`,`nurse_id`),
  ADD KEY `nurse_id` (`nurse_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_role_ibfk_2` (`role_id`);

--
-- Indexes for table `user_symptoms`
--
ALTER TABLE `user_symptoms`
  ADD PRIMARY KEY (`user_id`,`date_tested`);

--
-- AUTO_INCREMENT for dumped tables
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_added_by`
--
ALTER TABLE `user_added_by`
  ADD CONSTRAINT `user_added_by_ibfk_1` FOREIGN KEY (`nurse_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_added_by_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_symptoms`
--
ALTER TABLE `user_symptoms`
  ADD CONSTRAINT `user_symptoms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
