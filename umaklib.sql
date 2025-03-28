-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 09:15 AM
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
  `ID` int(11) NOT NULL,
  `book_name` varchar(40) NOT NULL,
  `book_author` varchar(40) NOT NULL,
  `book_callno` int(250) NOT NULL,
  `book_rating` int(3) NOT NULL,
  `book_cover` varchar(100) NOT NULL,
  `book_genre` varchar(50) NOT NULL,
  `book_ISBN` int(50) NOT NULL,
  `book_summary` text NOT NULL,
  `book_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookinfo`
--

INSERT INTO `bookinfo` (`ID`, `book_name`, `book_author`, `book_callno`, `book_rating`, `book_cover`, `book_genre`, `book_ISBN`, `book_summary`, `book_status`) VALUES
(1, 'THE CALL OF CHUTHULU', 'H.P Lovecraft', 123456789, 4, '1.JPG', 'SCI-FI', 1234567890, 'The Call of Cthulhu chronicles Francis Wayland Thurston as he goes through notes of his dead uncle and other accounts of a mysterious cult. The cult worships Cthulhu, a monstrous human, octopus, dragon hybrid that lives in the sunken corpse city of R\'lyeh, who\'s dreams influence reality.', 'AVAILABLE'),
(2, 'THE LORD OF THE RINGS', 'JRR TOLKIEN', 1234567890, 5, '2.JPG', 'HIGH FANTASY, ADVENTURE', 1234567890, 'The future of civilization rests in the fate of the One Ring, which has been lost for centuries. Powerful forces are unrelenting in their search for it. But fate has placed it in the hands of a young Hobbit named Frodo Baggins (Elijah Wood), who inherits the Ring and steps into legend. A daunting task lies ahead for Frodo when he becomes the Ringbearer - to destroy the One Ring in the fires of Mount Doom where it was forged.', 'AVAILABLE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookinfo`
--
ALTER TABLE `bookinfo`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinfo`
--
ALTER TABLE `bookinfo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
