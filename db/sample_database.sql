-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 06:45 PM
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
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `first_name`, `last_name`, `email`, `type`, `message`) VALUES
(1, 'Someone', 'S1', 0, 'Feedback', 'Something here'),
(2, 'Someone', 'S2', 0, 'Report a bug', 'Some more thing here'),
(3, 'Someone', 'S3', 0, 'Feature Request', 'So much here');

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
(1, 'Admin', 'A1', 'admin1@email.com', '43192475f95e3820fe441daaff7c84d9b73ca3a5afc7309ae03f783151b6b0976e4d68cd990f97ad0d65ca640d35a407199d6d7510f1dff5477b8cfce1531475'),
(2, 'Admin', 'A2', 'admin2@email.com', 'f08bf04ffe5c88a8961792dd8de4442c6b9bcee2bd89a41d54bdd6eae0e9d201af5c12921f72a147636f9493ef4b6448608316b3a9a962b1b8df2fb06f1f6743'),
(3, 'Doctor', 'D1', 'doctor1@email.com', '265eec157c4004d1da2535def1ff5c0dd58cd6ae86e6bb87f836433fa7920c0073ba277f70678e9efa00e62ab0a51706afe3559a68a1c1640a999b6082e98a82'),
(4, 'Doctor', 'D2', 'doctor2@email.com', '265eec157c4004d1da2535def1ff5c0dd58cd6ae86e6bb87f836433fa7920c0073ba277f70678e9efa00e62ab0a51706afe3559a68a1c1640a999b6082e98a82'),
(5, 'Nurse', 'N1', 'nurse1@email.com', '57998f8b306cae8fd7244eb15d564766f0c0f12ddf9fedf786a142f615055ba4943f02c7e4af4f51302a6845224f3d7c6dc55ab6116f0dbf1ce69cc075efacff'),
(6, 'Nurse', 'N2', 'nurse2@email.com', '57998f8b306cae8fd7244eb15d564766f0c0f12ddf9fedf786a142f615055ba4943f02c7e4af4f51302a6845224f3d7c6dc55ab6116f0dbf1ce69cc075efacff'),
(7, 'Nurse', 'N3', 'nurse3@email.com', '57998f8b306cae8fd7244eb15d564766f0c0f12ddf9fedf786a142f615055ba4943f02c7e4af4f51302a6845224f3d7c6dc55ab6116f0dbf1ce69cc075efacff'),
(8, 'Patient', 'P1', 'patient1@email.com', 'fd658b2115aaf6592720b9ecfb35cdc86079b5040528c62adaa2d07d1910da56f38ea61ff66b72cf30eac023da52a7d599d5fe47dbe83350148b870d371772d6'),
(9, 'Patient', 'P2', 'patient2@email.com', 'fd658b2115aaf6592720b9ecfb35cdc86079b5040528c62adaa2d07d1910da56f38ea61ff66b72cf30eac023da52a7d599d5fe47dbe83350148b870d371772d6');

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
(1, 3),
(1, 4),
(3, 5),
(3, 6),
(4, 7),
(5, 8),
(7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `aadhaar_no` bigint(20) DEFAULT NULL,
  `mobile` bigint(11) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `aadhaar_no`, `mobile`, `address`, `date_of_birth`, `gender`) VALUES
(1, 411111111111, 4111111111, 'Somewhere in US', '2021-06-23', 'Male'),
(2, 422222222222, 4222222222, 'Somewhere in UK', '2021-06-23', 'Female'),
(3, 311111111111, 3111111111, 'Somewhere in Asia', '2021-06-23', 'Male'),
(4, 322222222222, 3222222222, 'Somewhere in Europe', '2021-06-23', 'Female'),
(5, 211111111111, 2111111111, 'Somewhere in China', '2021-06-23', 'Male'),
(6, 222222222222, 2222222222, 'Somewhere in Korea', '2021-06-23', 'Female'),
(7, 233333333333, 2333333333, 'Somewhere in Hong Kong', '2021-06-23', 'Male'),
(8, 111111111111, 1111111111, 'Somewhere in Nigeria', '2021-06-23', 'Male'),
(9, 122222222222, 1222222222, 'Somewhere in Swiden', '2021-06-23', 'Female');

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
(1, 4),
(2, 4),
(3, 3),
(4, 3),
(5, 2),
(6, 2),
(7, 2),
(8, 1),
(9, 1);

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
(8, 1, 1, 1, 3, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, '2021-04-16 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 1, 0, 0, '2021-06-23 22:14:35');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
