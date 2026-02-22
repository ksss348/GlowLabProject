-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2026 at 03:05 AM
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
-- Database: `healthcare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `phone` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `symptoms` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `doctor_id`, `schedule_id`, `patient_name`, `appointment_date`, `appointment_time`, `status`, `phone`, `age`, `gender`, `symptoms`) VALUES
(1, 2, NULL, 'Phoo Phoo', '2026-01-16', '09:00 AM', 'Pending', NULL, NULL, NULL, NULL),
(2, 2, NULL, 'Phoo Phoo', '2026-01-06', '09:00 AM', 'Pending', NULL, NULL, NULL, NULL),
(3, 1, NULL, 'Phoo Phoo', '2026-01-19', '02:00 PM', 'Pending', NULL, NULL, NULL, NULL),
(4, 2, NULL, 'Phoo Phoo', '2026-01-20', '09:00 AM', 'Pending', NULL, NULL, NULL, NULL),
(5, 6, NULL, ' aung', '2026-01-15', '02:00 PM', 'Pending', NULL, NULL, NULL, NULL),
(6, 1, 1, 'Phoo Phoo', NULL, NULL, 'Pending', NULL, NULL, NULL, NULL),
(7, 1, 1, 'Phoo Phoo', NULL, NULL, 'Pending', NULL, NULL, NULL, NULL),
(8, 1, 1, 'Phoo Phoo', '2026-02-09', NULL, 'Pending', '09786689874', NULL, NULL, NULL),
(9, 2, 5, 'Phoo Phoo', NULL, NULL, 'Pending', '09786689874', 21, 'Male', NULL),
(10, 2, 4, ' aung', NULL, NULL, 'Pending', '09786689874', 22, 'Male', NULL),
(11, 2, 6, 'Thet', NULL, NULL, 'Pending', '09786689874', 23, 'Female', NULL),
(12, 2, 6, 'Thet', NULL, NULL, 'Pending', '09786689874', 23, 'Female', NULL),
(13, 1, 2, ' aung', NULL, NULL, 'Pending', '09786689874', 55, 'Other', NULL),
(14, 1, 1, 'Phoo Phoo', NULL, NULL, 'Pending', '09786689874', 22, 'Male', NULL),
(15, 1, 2, ' aung', NULL, NULL, 'Pending', '09786689874', 24, 'Other', NULL),
(16, 2, 4, ' aung', NULL, NULL, 'Pending', '09786689874', 25, 'Male', NULL),
(17, 2, 4, ' aung', NULL, NULL, 'Pending', '09786689874', 25, 'Male', NULL),
(19, 2, 5, 'Mya Thida', NULL, NULL, 'Verified', '09677411617', 21, 'Female', NULL),
(20, 4, 10, 'Mya Thida', NULL, NULL, 'Pending', '09677411617', 21, 'Female', NULL),
(21, 2, 6, 'Mya Thida', NULL, NULL, 'Pending', '09677411617', 21, 'Female', NULL),
(22, 2, 4, 'Mya Thida', NULL, NULL, 'Pending', '09677411617', 21, 'Female', NULL),
(23, 3, 7, 'Mya Thida', NULL, NULL, 'Pending', '09123456789', 21, 'Female', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consultants`
--

CREATE TABLE `consultants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultants`
--

INSERT INTO `consultants` (`id`, `name`, `specialty`, `contact`, `department`, `rating`, `image_url`, `bio`) VALUES
(1, 'Dr. Alexander Bennett', 'Dermatologist (Acne & Scars)', '09780000001', NULL, NULL, 'doctors/alexander.png', 'Specializes in advanced acne treatments and laser scar removal with over 10 years of experience.'),
(2, 'Dr. Sophia Richardson', 'Aesthetic Expert (Dry Skin)', '09780000002', NULL, NULL, 'doctors/sophia.png', 'Expert in skin rejuvenation and hydration therapies for chronically dry and sensitive skin.'),
(3, 'Dr. James Anderson', 'Clinical Dermatologist (Oily Skin)', '09780000003', NULL, NULL, 'doctors/james.png', 'Focused on clinical dermatology, managing oily skin conditions and hormonal acne breakouts.'),
(4, 'Dr. Isabella Garcia', 'Skin Health Specialist', '09780000004', NULL, NULL, 'doctors/lsabella.png', 'Certified aesthetician helping patients find the perfect skincare routine and product compatibility.'),
(5, 'Dr. William Carter', 'Cosmetic Laser Specialist', '09780000005', NULL, NULL, 'doctors/willliam.png', 'Leading specialist in cosmetic laser treatments, pigmentation, and anti-aging procedures.'),
(6, 'Dr. Olivia Martinez', 'Pediatric Dermatology', '09780000006', NULL, NULL, 'doctors/olivia.png', 'Dedicated to gentle skin care for children, treating eczema and neonatal skin conditions.'),
(7, 'Dr. Benjamin Taylor', 'Dermatopathologist', '09780000007', NULL, NULL, 'doctors/benjamin.png', 'Expert in analyzing skin tissues and diagnosing complex dermatological conditions.'),
(8, 'Dr. Charlotte Adams', 'Allergy & Immunology Expert', '09780000008', NULL, NULL, 'doctors/charlotte.png', 'Specialist in identifying skin allergies and providing long-term immunity solutions.'),
(9, 'Dr. Michael Scott', 'Surgical Dermatologist', '09780000009', NULL, NULL, 'doctors/michael.png', 'Specializes in micrographic surgery and the removal of complex skin lesions.'),
(10, 'Dr. Emily Watson', 'Anti-Aging Specialist', '09780000010', NULL, NULL, 'doctors/emily.png', 'Focuses on non-invasive anti-aging treatments, botox, and dermal fillers.'),
(11, 'Lara', 'Acne', NULL, NULL, NULL, 'doctors/1771344059_lara.jpg', 'Acne Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `day_name` varchar(20) DEFAULT NULL,
  `time_slot` varchar(50) DEFAULT NULL,
  `is_booked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_schedules`
--

INSERT INTO `doctor_schedules` (`id`, `doctor_id`, `day_name`, `time_slot`, `is_booked`) VALUES
(1, 1, 'Monday', '08:00 AM', 1),
(2, 1, 'Monday', '09:00 AM', 0),
(3, 1, 'Wednesday', '01:00 PM', 0),
(4, 2, 'Monday', '09:00 AM', 1),
(5, 2, 'Wednesday', '02:00 PM', 1),
(6, 2, 'Friday', '06:00 PM', 1),
(7, 3, 'Tuesday', '10:00 AM', 1),
(8, 3, 'Thursday', '10:00 AM', 0),
(9, 3, 'Saturday', '08:00 AM', 0),
(10, 4, 'Monday', '11:00 AM', 1),
(11, 4, 'Thursday', '02:00 PM', 0),
(12, 4, 'Sunday', '10:00 AM', 0),
(13, 5, 'Wednesday', '09:00 AM', 0),
(14, 5, 'Friday', '09:00 AM', 0),
(15, 5, 'Saturday', '01:00 PM', 0),
(16, 6, 'Tuesday', '04:00 PM', 0),
(17, 6, 'Thursday', '04:00 PM', 0),
(18, 6, 'Friday', '02:00 PM', 0),
(19, 7, 'Monday', '01:00 PM', 0),
(20, 7, 'Wednesday', '08:00 AM', 0),
(21, 7, 'Saturday', '04:00 PM', 0),
(22, 8, 'Tuesday', '08:00 AM', 0),
(23, 8, 'Friday', '10:00 AM', 0),
(24, 8, 'Sunday', '02:00 PM', 0),
(25, 9, 'Wednesday', '11:00 AM', 0),
(26, 9, 'Thursday', '09:00 AM', 0),
(27, 9, 'Saturday', '11:00 AM', 0),
(28, 10, 'Monday', '04:00 PM', 0),
(29, 10, 'Tuesday', '01:00 PM', 0),
(30, 10, 'Friday', '08:00 AM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `payment_method`, `phone_number`, `amount`) VALUES
(1, 1, 'KBZ Pay', 'iiajoij', 50000.00),
(2, 2, 'KBZ Pay', '09786689874', 50000.00),
(3, 3, 'KBZ Pay', '09786689874', 50000.00),
(4, 4, 'AYA Pay', '09786689874', 50000.00),
(5, 5, 'CB Pay', '09786689874', 50000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultants`
--
ALTER TABLE `consultants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `consultants`
--
ALTER TABLE `consultants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
