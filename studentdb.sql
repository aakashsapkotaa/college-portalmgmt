-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2024 at 09:29 PM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
CREATE TABLE IF NOT EXISTS `result` (
  `result_id` int NOT NULL,
  `stud_id` int NOT NULL,
  `grade` varchar(50) NOT NULL,
  `term` varchar(50) NOT NULL,
  `math_social` int NOT NULL,
  `physics_account` int NOT NULL,
  `chemistry_economics` int NOT NULL,
  `computer_biology` int NOT NULL,
  `english` int NOT NULL,
  `nepali` int NOT NULL,
  `total` int NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `class` varchar(50) NOT NULL,
  `result` varchar(10) NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `stud_id` (`stud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_register`
--

DROP TABLE IF EXISTS `student_register`;
CREATE TABLE IF NOT EXISTS `student_register` (
  `stud_id` int NOT NULL,
  `sname` varchar(100) NOT NULL,
  `sgrade` varchar(50) NOT NULL,
  `semail` varchar(100) NOT NULL,
  `spassword` varchar(255) NOT NULL,
  `scontact` varchar(20) NOT NULL,
  `sgender` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Active','Deactive') DEFAULT 'Active',
  PRIMARY KEY (`stud_id`),
  UNIQUE KEY `stud_id` (`stud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_register`
--

INSERT INTO `student_register` (`stud_id`, `sname`, `sgrade`, `semail`, `spassword`, `scontact`, `sgender`, `image`, `status`) VALUES
(1, 'guest', '12 Science', 'g@gmail.com', '1234', '9876543210', 'male', 'uploads/pp.jpg', 'Active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
