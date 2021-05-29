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
(13, 'Nurse', 'N2', 'nurse2@email.com', '3610d74dfd7159dfbc3f1dedb0fe97567bfe7652779b952f69d3e8d450d093d0a3c0e86fbc7921c39348d3808cf3c5d18ce4f961593270a2ed22effccfcee7eb');

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
(2, 6),
(13, 7),
(13, 8),
(13, 9),
(2, 12);

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
  `gender` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_symptoms`
--

CREATE TABLE `user_symptoms` (
  `user_id` int(11) NOT NULL,
  `has_fever` tinyint(1) DEFAULT 0,
  `has_trouble_breathing` tinyint(1) DEFAULT 0,
  `has_cough` tinyint(1) DEFAULT 0,
  `has_nosal_congest_running` tinyint(1) DEFAULT 0,
  `has_sense` tinyint(1) DEFAULT 0,
  `has_sore_throat` tinyint(1) DEFAULT 0,
  `had_contact_with_positive` tinyint(1) DEFAULT 0,
  `is_positive` tinyint(1) DEFAULT 0,
  `has_travelled` tinyint(1) DEFAULT 0,
  `felt_tired` tinyint(1) DEFAULT 0,
  `have_nausea_diarrhea` tinyint(1) DEFAULT 0,
  `has_chills` tinyint(1) DEFAULT 0,
  `has_told_quarantine` tinyint(1) DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
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
  ADD PRIMARY KEY (`user_id`,`date_added`);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
