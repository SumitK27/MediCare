-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2021 at 01:44 PM
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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Patient', 'P1', 'patient1@email.com', '7249334c32fc05f3c7565f315c09f5cb40ba40fccad8a39a7b0e488e34b3db0526e6367615d22378c9e630939dff5037c61cb7cd4ffadb858d44e4ef56e02986'),
(2, 'Nurse', 'N1', 'nurse1@email.com', '879f462eb1c099163979703af179798bd546f9c7f62f454ba0bf9d2728095cb44f937a66345a78815935ecf8a21e63d0f1aa30cef09ac53ea437c05b21ad681f'),
(3, 'Doctor', 'D1', 'doctor1@email.com', '31eaa11290dce6a3707298c0115fb671530f8cb9d7ad96132b61825c5e86d8e3d01a73c9b3d6cf93b7daff017ff961c1fe20388430079d995a9833bde776e2f7'),
(4, 'Admin', 'A1', 'admin1@email.com', '43192475f95e3820fe441daaff7c84d9b73ca3a5afc7309ae03f783151b6b0976e4d68cd990f97ad0d65ca640d35a407199d6d7510f1dff5477b8cfce1531475'),
(6, 'Patient', 'P2', 'patient2@email.com', ''),
(7, 'Patient', 'P3', 'patient3@email.com', ''),
(8, 'Patient', 'P4', 'patient4@email.com', ''),
(9, 'Patient', 'P5', 'patient5@email.com', ''),
(10, 'Patient', 'P6', 'patient6@email.com', ''),
(11, 'Patient', 'P7', 'patient7@email.com', ''),
(12, 'Patient', 'P8', 'patient8@email.com', ''),
(13, 'Nurse', 'N2', 'nurse2@email.com', '3610d74dfd7159dfbc3f1dedb0fe97567bfe7652779b952f69d3e8d450d093d0a3c0e86fbc7921c39348d3808cf3c5d18ce4f961593270a2ed22effccfcee7eb'),
(14, 'Patient', 'P9', 'patient9@email.com', ''),
(15, 'Patient', 'P10', 'patient10@email.com', ''),
(16, 'Patient', 'P11', 'patient11@email.com', ''),
(17, 'Patient', 'P12', 'patient12@email.com', ''),
(18, 'Patient', 'P13', 'patient13@email.com', ''),
(19, 'Patient', 'P14', 'patient14@email.com', ''),
(20, 'Patient', 'P15', 'patient15@email.com', ''),
(21, 'Patient', 'P16', 'patient16@email.com', ''),
(22, 'Patient', 'P17', 'patient17@email.com', ''),
(23, 'Patient', 'P18', 'patient18@email.com', ''),
(24, 'Patient', 'P19', 'patient19@email.com', ''),
(25, 'Patient', 'P20', 'patient20@email.com', ''),
(26, 'Patient', 'P21', 'patient21@email.com', 'a177423349e6e28785622b833b43b291f34e7605daedbd1e7ca6e0da14b5ce88c1e278f9b34631872803b1a0675081eaa89d2cf1565d1a11799b2a14f0dda2e2'),
(27, 'Patient', 'P25', 'patient25@email.com', 'fd658b2115aaf6592720b9ecfb35cdc86079b5040528c62adaa2d07d1910da56f38ea61ff66b72cf30eac023da52a7d599d5fe47dbe83350148b870d371772d6');

-- --------------------------------------------------------

--
-- Table structure for table `user_added_by`
--

CREATE TABLE `user_added_by` (
  `nurse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_added_by`
--

INSERT INTO `user_added_by` (`nurse_id`, `user_id`) VALUES
(2, 1),
(2, 6),
(13, 7),
(13, 8),
(13, 9),
(2, 12),
(13, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(2, 25),
(2, 26),
(2, 27);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `aadhaar_no` bigint(20) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `aadhaar_no`, `mobile`, `address`, `date_of_birth`, `gender`) VALUES
(1, 123456789010, 1234567890, 'Somewhere', '2021-05-31', 'Male'),
(19, 123456789011, 1234567890, 'Something', '2021-05-31', 'Male'),
(20, 123456789012, 1234567890, 'Something Here', '2021-05-31', 'Male'),
(21, 123456789013, 1234567890, 'Something Here too', '2021-05-31', 'Male'),
(22, 123456789014, 123456789, 'Nowhere', '2021-05-31', 'Male'),
(23, 123456789015, 123456789, 'Nowhere', '2021-05-31', 'Male'),
(24, 123456789016, 123456789, 'Nowhere', '2021-05-31', 'Male'),
(25, 123456789009, 1234567890, 'Somewhere', '2010-01-02', 'Female'),
(26, 123456789008, 1234567890, 'Somewhere', '2010-01-19', 'Female'),
(27, 123456789000, 123456789, 'hyadjvasvd', '2021-06-03', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 2),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1);

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
-- Dumping data for table `user_symptoms`
--

INSERT INTO `user_symptoms` (`user_id`, `fever`, `fever_s`, `cough`, `cough_s`, `tiredness`, `tiredness_s`, `chest_pain`, `chest_pain_s`, `head_ache`, `head_ache_s`, `stomach_ache`, `stomach_ache_s`, `kidney_failure`, `heart_problem`, `heart_problem_s`, `diabetes`, `diabetes_s`, `less_oxygen_level`, `less_oxygen_level_s`, `malignancy_cancer`, `malignancy_cancer_s`, `hypertension`, `hypertension_s`, `liver_disease`, `liver_disease_s`, `immunocompromised_condition`, `immunocompromised_condition_s`, `vomiting`, `vomiting_s`, `consume_steroids`, `sore_throat`, `sore_throat_s`, `diarrhea`, `diarrhea_s`, `congestion`, `congestion_s`, `sense_loss`, `sense_loss_s`, `skin_rash_discoloration`, `skin_rash_discoloration_s`, `trouble_breathing`, `trouble_breathing_s`, `contact_positive`, `is_positive`, `is_vaccinated`, `is_vaccinated_d`, `is_vaccinated_2`, `is_vaccinated_2_d`, `travelled`, `chills`, `chills_s`, `quarantine`, `quarantine_s`, `date_tested`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, '2021-06-06 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 1, 0, 0, '2021-06-06 00:33:47'),
(1, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 0, '2021-06-06 15:18:38'),
(1, 1, 1, 1, 2, 1, 3, 1, 1, 1, 2, 1, 3, 1, 1, 3, 1, 1, 1, 1, 1, 2, 1, 3, 1, 0, 1, 1, 1, 2, 1, 1, 2, 1, 3, 1, 3, 1, 1, 1, 0, 1, 2, 1, 1, 1, '2021-04-06 00:00:00', 1, '2021-06-06 00:00:00', 1, 1, 1, 1, 0, '2021-06-06 15:56:49');

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

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
