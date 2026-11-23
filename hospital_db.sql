-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2026 at 04:28 PM
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
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `patient_name`, `doctor_id`, `dept_id`, `slot_id`, `appointment_date`, `status`) VALUES
(1, 'Rahul', 1, 1, 1, '2026-03-20', 'confirmed'),
(2, 'Amit', 2, 2, 2, '2026-03-21', 'pending'),
(3, 'Suraj', 3, 3, 3, '2026-03-22', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `checkout_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `checkout_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `appointment_id`, `patient_name`, `total_amount`, `payment_method`, `payment_status`, `checkout_date`) VALUES
(1, 15, 'Rahul', 350.00, 'online', 'success', '2026-03-19 15:27:05'),
(2, 16, 'Amit', 400.00, 'offline', 'success', '2026-03-19 15:27:38'),
(3, 17, 'Vicky', 500.00, 'online', 'pending', '2026-03-19 15:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Avinash', 'avinash@gmail.comm', 'appointment', 'need appointment details', '2026-03-19 15:53:13'),
(2, 'Rahul', 'rahul@gmail.com', 'Query', 'Doctor availability', '2026-03-19 15:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `description`) VALUES
(6, 'cardiologist', 'Heart department'),
(7, 'neurology', 'Brain department'),
(8, 'orthopedic', 'Bones department'),
(9, 'Radiology', 'X-ray');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doct_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doct_id`, `name`, `specialization`, `contact`, `dept_id`) VALUES
(1, 'Dr.Sharma', 'cardiologist', '9870654325', 101),
(2, 'Dr.Singh', 'Neurologist', '9876567854', 102),
(3, 'Dr.verma', 'orthopedic', '8767097265', 103),
(4, 'Dr.Gupta', 'Pediatrician', '8767987643', 104);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `medicine` text NOT NULL,
  `dosage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `appointment_id`, `doctor_id`, `patient_name`, `medicine`, `dosage`) VALUES
(1, 15, 1, 'Amit', 'combiflame', '1*1'),
(2, 16, 2, 'sonu', 'paracetamol', '1*2'),
(3, 17, 3, 'javed', 'A to z', '1*3');

-- --------------------------------------------------------

--
-- Table structure for table `sign up`
--

CREATE TABLE `sign up` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sign up`
--

INSERT INTO `sign up` (`user_id`, `name`, `phone`, `Gender`, `username`, `password`, `role`, `created_at`) VALUES
(12, 'Avinash', '9810656120', 'm', 'avi12', 'avi@123', 'admin', '2026-03-19 10:20:48'),
(13, 'amit', '7654749870', 'm', 'amit12', 'amit12@', 'user', '2026-03-19 10:29:09'),
(14, 'sriniwas', '6878987656', 'm', 'sri12', 'sri12@', 'user', '2026-03-19 10:30:55'),
(15, 'roshan', '9876565654', 'm', 'rosh21', 'rosh21@', 'user', '2026-03-19 10:34:29'),
(16, 'suresh', '7865564326', 'm', 'sure12', 'sure12@', 'user', '2026-03-19 10:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `slot_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`slot_id`, `start_time`, `end_time`, `status`) VALUES
(1, '09:00:00', '10:00:00', 'Available'),
(2, '10:00:00', '11:00:00', 'Available'),
(3, '11:00:00', '12:00:00', 'Available'),
(4, '12:00:00', '01:00:00', 'Available'),
(5, '01:00:00', '02:00:00', 'Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doct_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `sign up`
--
ALTER TABLE `sign up`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`slot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
