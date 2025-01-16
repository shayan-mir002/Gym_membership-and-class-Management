-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 10:33 PM
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
-- Database: `gym_membership`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `attendance_status` enum('Present','Absent') NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ClassID` int(11) NOT NULL,
  `cl_name` varchar(100) NOT NULL,
  `cl_schedul` datetime NOT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `instructor_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ClassID`, `cl_name`, `cl_schedul`, `PaymentID`, `instructor_name`) VALUES
(1, 'Yoga Basics', '2024-12-20 10:00:00', 1, 'Shayan'),
(2, 'HIIT Workout', '2024-12-20 12:00:00', 2, 'Uzair'),
(3, 'Strength Training', '2024-12-21 09:00:00', 3, 'Izhan'),
(4, 'Cardio', '2024-12-21 11:00:00', 4, 'Tyson'),
(5, 'Gymnastics', '2024-12-22 08:00:00', 5, 'Mike');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `EquipmentID` int(11) NOT NULL,
  `EquipmentName` varchar(100) NOT NULL,
  `Eq_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`EquipmentID`, `EquipmentName`, `Eq_type`) VALUES
(1, 'Treadmill', 'Cardio'),
(2, 'Dumbbells', 'Strength'),
(3, 'Rowing Machine', 'Cardio'),
(4, 'Bench Press', 'Strength'),
(5, 'Stationary Bike', 'Cardio');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `InstructorID` int(11) NOT NULL,
  `Instructor_name` varchar(100) NOT NULL,
  `Contact_info` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`InstructorID`, `Instructor_name`, `Contact_info`) VALUES
(1, 'Ahmed Khan', 'ahmed.khan@example.com'),
(2, 'Sara Ali', 'sara.ali@example.com'),
(3, 'Zainab Malik', 'zainab.malik@example.com'),
(4, 'Usman Tariq', 'usman.tariq@example.com'),
(5, 'Ayesha Shah', 'ayesha.shah@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `specialization`, `email`, `phone`, `bio`, `image`) VALUES
(1, 'Shayan', 'Yoga & Pilates', 'shayan@example.com', '123-456-7890', 'Shayan is an experienced Yoga instructor with 5 years of experience. He specializes in yoga therapy and mindfulness training.', 'shayan.jpg'),
(2, 'Uzair', 'Strength Training', 'uzair@example.com', '234-567-8901', 'Uzair has a passion for bodybuilding and strength training. He helps individuals to achieve their fitness goals through personalized strength programs.', 'uzair.jpg'),
(3, 'Izhan', 'Cardio & HIIT', 'izhan@example.com', '345-678-9012', 'Izhan is a certified fitness trainer specializing in high-intensity interval training (HIIT) and cardio workouts.', 'izhan.jpg'),
(4, 'Tyson', 'Boxing & Martial Arts', 'tyson@example.com', '456-789-0123', 'Tyson is a former professional boxer with over 10 years of experience in training individuals in boxing and mixed martial arts (MMA).', 'tyson.jpg'),
(5, 'Mike', 'CrossFit & Functional Training', 'mike@example.com', '567-890-1234', 'Mike has been practicing CrossFit for over 7 years and now trains others to improve their overall strength and conditioning.', 'mike.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Membership_type` varchar(50) NOT NULL,
  `Monthly_fee` int(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `Name`, `Email`, `Membership_type`, `Monthly_fee`, `password`) VALUES
(0, 'Shayan Ahmed', 'shayanahmedr3@gmail.com', '', NULL, 'ssaj'),
(1, 'John Smith', 'john.smith@example.com', 'Standard', 30, 'ssaj'),
(2, 'Jane Doe', 'jane.doe@example.com', 'Premium', 50, '1234'),
(3, 'Mike Johnson', 'mike.johnson@example.com', 'Standard', 30, ''),
(4, 'Emily Davis', 'emily.davis@example.com', 'VIP', 80, ''),
(5, 'Chris Brown', 'chris.brown@example.com', 'Premium', 50, '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberID`, `Name`, `Email`, `password`, `join_date`) VALUES
(22, 'Shayan Ahmed Mir', 'shayanahmedr3@gmail.com', '1234', NULL),
(23, 'uzair shahid', 'uzair@gmail.com', '1122', NULL),
(24, 'Muhammad Ibraheem', 'ibrahim@gmail.com', '6666', NULL),
(25, 'jawad mir', 'jawadmir78@gmail.com', '1234', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `memberID` int(11) DEFAULT NULL,
  `Monthly_fee` int(255) NOT NULL,
  `Membership_Type` varchar(255) DEFAULT NULL,
  `AMOUNT` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `memberID`, `Monthly_fee`, `Membership_Type`, `AMOUNT`) VALUES
(0, 1, 0, 'basic', 4444),
(1, 2, 30, NULL, NULL),
(2, 3, 50, NULL, NULL),
(3, 4, 30, NULL, NULL),
(4, 5, 80, NULL, NULL),
(5, 1, 50, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ReportID` int(11) NOT NULL,
  `Generated_by` varchar(100) NOT NULL,
  `Report_type` varchar(50) NOT NULL,
  `ClassID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`ReportID`, `Generated_by`, `Report_type`, `ClassID`) VALUES
(1, 'System', 'Attendance', 1),
(2, 'Admin', 'Revenue', 2),
(3, 'Manager', 'Class Popularity', 3),
(4, 'System', 'Membership Status', NULL),
(5, 'Admin', 'Equipment Usage', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ClassID`),
  ADD KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`EquipmentID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`InstructorID`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `fk_memberID` (`memberID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `ClassID` (`ClassID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`PaymentID`) REFERENCES `payment` (`PaymentID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_memberID` FOREIGN KEY (`memberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `class` (`ClassID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
