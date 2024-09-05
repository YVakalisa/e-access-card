-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2022 at 12:01 AM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trevahoj_dbone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `phone_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `phone_number`) VALUES
(1, '0727759771'),
(3, '0732589631'),
(4, '0721789651'),
(5, '0723245567'),
(7, '0827759702'),
(8, '0785524561');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `issue_date` varchar(255) NOT NULL,
  `QR_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `user_id`, `issue_date`, `QR_code`) VALUES
(1, 2, '2022-06-22', 'qr_code/62b38c5822cf4.png'),
(2, 6, '2022-06-22', 'qr_code/62b38d61a2e7d.png'),
(3, 9, '2022-06-22', 'qr_code/62b38e4a22f16.png'),
(4, 10, '2022-06-22', 'qr_code/62b38e51eb36a.png'),
(5, 11, '2022-06-22', 'qr_code/62b38eb5a42f0.png'),
(6, 13, '2022-06-22', 'qr_code/62b38fb606857.png'),
(7, 14, '2022-06-22', 'qr_code/62b38fd68b595.png'),
(8, 16, '2022-06-22', 'qr_code/62b3907c0af03.png'),
(9, 15, '2022-06-22', 'qr_code/62b390aa2a543.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `user_id` int(11) NOT NULL,
  `staff_number` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`user_id`, `staff_number`) VALUES
(6, '216332'),
(9, '219324'),
(10, '223451'),
(12, '229472'),
(13, '236163'),
(15, '279865');

-- --------------------------------------------------------

--
-- Table structure for table `staff_card`
--

CREATE TABLE `staff_card` (
  `card_id` int(11) NOT NULL,
  `office_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_card`
--

INSERT INTO `staff_card` (`card_id`, `office_number`) VALUES
(2, '10-225'),
(3, '10-211'),
(4, '20-111'),
(6, '10-212'),
(9, '10-123');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` int(11) NOT NULL,
  `student_number` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `student_number`) VALUES
(16, '219518045'),
(2, '219518246'),
(14, '219586933'),
(11, '219586940');

-- --------------------------------------------------------

--
-- Table structure for table `student_card`
--

CREATE TABLE `student_card` (
  `card_id` int(11) NOT NULL,
  `residence` tinyint(1) NOT NULL,
  `bus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_card`
--

INSERT INTO `student_card` (`card_id`, `residence`, `bus`) VALUES
(1, 1, 0),
(5, 1, 1),
(7, 0, 0),
(8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `initials` varchar(3) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `campus` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `initials`, `lastname`, `email`, `campus`, `photo`, `password`, `user_type`, `date_created`) VALUES
(1, 'B', 'DUDE', 'bendube@gmail.com', 'Ga-rankuwa Campus', 'upload/pic_20220622213846.jpeg', '$2y$10$VHtwDabHaZ/veY4N9evEku/YGxAEXYbo0NfVyP50ZJGNXRT/j8/NS', 'Admin', '2022-06-22'),
(2, 'S', 'Zulu', 'sizwe@gmail.com', 'Sosh-South Campus', 'upload/pic_20220622204034.jpeg', '$2y$10$rDVYDYCUAMygmWgc8ouJbeBW.EPpEmndAIYzD2BTbK3CLOB.uQ/S6', 'Student', '2022-06-22'),
(3, 'P', 'Thomas', 'pabaltom@gmail.com', 'Pretoria-Main Campus', 'upload/pic_20220622214002.jpeg', '$2y$10$aLqqG0LiUc8TZAHTZ0py7OljA.yW6CBt1Tgvl/SMcrxkFFGmr3E1.', 'Admin', '2022-06-22'),
(4, 'L', 'Phenyo', 'leratos@gmail.com', 'Arcadia Campus', 'upload/pic_20220622214225.jpeg', '$2y$10$saFMK6vYtOOzIEI1RGUgluBKi1cOrcD6i5T5nCFSLZ1Gx5Dh.aN8G', 'Admin', '2022-06-22'),
(5, 'PK', 'Mabuza', 'mnistom@gmail.com', 'Arcadia Campus', 'upload/pic_20220622214306.jpeg', '$2y$10$9PZKnTzhVMcSIiNlvqHChuLxKJ3zcVysdTKpBorlmQFWyCtyGzLGC', 'Admin', '2022-06-22'),
(6, 'P', 'Parker', 'park@gmail.com', 'Art Campus', 'upload/pic_20220622214403.jpeg', '$2y$10$.BMgTABYObLI6fgdaaay3O9rA7f0yu7g3MwN7TbR4v140eJwcWzKS', 'Staff', '2022-06-22'),
(7, 'S', 'DUBE', 'sdube3@gmail.com', 'Mbombela Campus', 'upload/pic_20220622214425.jpeg', '$2y$10$HRchcOXEO7LrL30ZxFgcSelQrXAGaM/edpC6eaHZn5mXauhce3x12', 'Admin', '2022-06-22'),
(8, 'JB', 'Sitole', 'masukunb@gmail.com', 'Art Campus', 'upload/pic_20220622214638.jpeg', '$2y$10$YjkYiy30HryUd2C3jZ7LHOf/DjGCQZonq1w2VUy3Fh89LHPUb5cDy', 'Admin', '2022-06-22'),
(9, 'P', 'ZUMA', 'zuma@gmail.com', 'Sosh-North Campus', 'upload/pic_20220622214733.jpeg', '$2y$10$hXvhvP8i8o6kItm2.cj7C.4CkwGnzTcCXFCy3hbWftsQeVKyK.hTa', 'Staff', '2022-06-22'),
(10, 'J', 'Jakes', 'john@tut.ac.za', 'eMalahleni Campus', 'upload/pic_20220622214755.jpeg', '$2y$10$dEU51mJ2UqQDWowKRVfqTu5PPpKgOTW.WNBJRbNgZAU0x5HTz5Q2q', 'Staff', '2022-06-22'),
(11, 'J', 'Smith', 'jinkly@gmail.com', 'Polokwane Campus', 'upload/pic_20220622214711.jpeg', '$2y$10$SRTFXPcS.a9kLRiDwMy16OoJcAv1PJpcvukOLMNQSGfuvAX8pY1kq', 'Student', '2022-06-22'),
(12, 'M', 'Bongwe', 'mike@gmail.com', 'Sosh-South Campus', 'upload/pic_20220622215233.jpeg', '$2y$10$kM3t9VaEpQZj27WyfaaRD.bJDeXS0AHbZelhth1XpQqNgiYp/OjVy', 'Staff', '2022-06-22'),
(13, 'P', 'RAMPHISA', 'porcia@gmail.com', 'Polokwane Campus', 'upload/pic_20220622215318.jpeg', '$2y$10$IVrJOA7qtwklS/jT1M56/ecILs0Q8XwgBlsIcTkdUF6bNnDDIVzKO', 'Staff', '2022-06-22'),
(14, 'M', 'Ralph', 'musa@gmail.com', 'Ga-rankuwa Campus', 'upload/pic_20220622215435.jpeg', '$2y$10$X3RRemCVL/r.abOCPtekPeZ77EyWiQ9Y22rEvM63m0nh4KMBEu2o2', 'Student', '2022-06-22'),
(15, 'T', 'Jonas', 'tebogo@gmail.com', 'Pretoria-Main Campus', 'upload/pic_20220622215600.jpeg', '$2y$10$mdNWo9yoreZZL3Y30IBXT.7JZMGhiKRPiro7CoYaWkhsP7RXFZL.m', 'Staff', '2022-06-22'),
(16, 'L', 'Forbes', 'lethabo@gmail.com', 'Mbombela Campus', 'upload/pic_20220622215701.jpeg', '$2y$10$XS2RXfbDp4U5L6P94SBiEe/buVjuZId9F3BG.xIafeAv5BTIV0FYO', 'Student', '2022-06-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `student_id` (`user_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `staff_number` (`staff_number`);

--
-- Indexes for table `staff_card`
--
ALTER TABLE `staff_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `student_number` (`student_number`);

--
-- Indexes for table `student_card`
--
ALTER TABLE `student_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
