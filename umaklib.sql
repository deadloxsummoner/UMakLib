-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 01:43 AM
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
-- Database: `umaklib`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookinfo`
--

CREATE TABLE `bookinfo` (
  `id` int(11) NOT NULL,
  `book_name` varchar(40) NOT NULL,
  `book_author` varchar(40) NOT NULL,
  `book_callno` int(250) NOT NULL,
  `book_rating` int(3) NOT NULL,
  `book_cover` varchar(100) NOT NULL,
  `book_genre` varchar(50) NOT NULL,
  `book_ISBN` varchar(250) NOT NULL,
  `book_summary` text NOT NULL,
  `book_status` varchar(50) NOT NULL,
  `book_quantity` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookinfo`
--

INSERT INTO `bookinfo` (`id`, `book_name`, `book_author`, `book_callno`, `book_rating`, `book_cover`, `book_genre`, `book_ISBN`, `book_summary`, `book_status`, `book_quantity`) VALUES
(1, 'THE CALL OF CTHULHU', 'H.P Lovecraft', 123456789, 4, '1.jpg', 'SCI-FI', '1234567890', 'The Call of Cthulhu chronicles Francis Wayland Thurston as he goes through notes of his dead uncle and other accounts of a mysterious cult. The cult worships Cthulhu, a monstrous human, octopus, dragon hybrid that lives in the sunken corpse city of R\'lyeh, who\'s dreams influence reality.', 'AVAILABLE', 3),
(2, 'THE LORD OF THE RINGS', 'JRR TOLKIEN', 1234567890, 5, '2.jpg', 'HIGH FANTASY, ADVENTURE', '1234567890', 'The future of civilization rests in the fate of the One Ring, which has been lost for centuries. Powerful forces are unrelenting in their search for it. But fate has placed it in the hands of a young Hobbit named Frodo Baggins (Elijah Wood), who inherits the Ring and steps into legend. A daunting task lies ahead for Frodo when he becomes the Ringbearer - to destroy the One Ring in the fires of Mount Doom where it was forged.', 'AVAILABLE', 2);

-- --------------------------------------------------------

--
-- Table structure for table `booklog`
--

CREATE TABLE `booklog` (
  `id` int(11) NOT NULL,
  `borrow_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booklog`
--

INSERT INTO `booklog` (`id`, `borrow_id`, `book_id`) VALUES
(3, 1, 1),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `logindata`
--

CREATE TABLE `logindata` (
  `id` int(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `student_section` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logindata`
--

INSERT INTO `logindata` (`id`, `username`, `password`, `email`, `student_id`, `student_section`, `gender`, `name`, `type`) VALUES
(1, 'stan', '100305', 'stan.magallon@gmail.com', 'K12256161', 'ACSAD', 'Bipolar', 'Kris Constantine F. Magallon', 'student'),
(2, 'admin', '123', 'admin', 'N/A', 'N/A', 'N/A', 'Admin pogi', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookinfo`
--
ALTER TABLE `bookinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booklog`
--
ALTER TABLE `booklog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logindata`
--
ALTER TABLE `logindata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinfo`
--
ALTER TABLE `bookinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booklog`
--
ALTER TABLE `booklog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logindata`
--
ALTER TABLE `logindata`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
