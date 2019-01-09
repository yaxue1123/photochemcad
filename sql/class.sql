-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2019 at 10:31 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photochemcad`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`) VALUES
(1, 'Aromatic Hydrocarbons'),
(2, 'Oligophenylenes'),
(3, 'Polycyclic Aromatic Hydrocarbons '),
(4, 'Polyenes/Polyynes '),
(5, 'Heterocycles'),
(6, 'Biomolecules'),
(7, 'Quinones'),
(8, 'Coumarins'),
(9, 'Acridines'),
(10, 'Azo Dyes'),
(11, 'Cyanine Dyes'),
(12, 'Arylmethane Dyes'),
(13, 'Perylenes'),
(14, 'Xanthenes'),
(15, 'Miscellaneous Dyes'),
(16, 'Dipyrrins'),
(17, 'Porphyrins'),
(18, 'Oligopyrroles'),
(19, 'Phthalocyanines'),
(20, 'Chlorins/Bacteriochlorins');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
