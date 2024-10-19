-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2022 at 02:45 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `php_guestbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `name`, `title`, `content`) VALUES
(1, 'Max Mustermann', 'Ein erster Eintrag...', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ullamcorper nec metus eu rutrum. Nam nunc mi, bibendum quis pharetra ut, sodales sit amet lectus. In congue orci at mi convallis, vel gravida orci placerat. Phasellus in ullamcorper justo, in elementum purus. Proin ullamcorper rhoncus risus in varius.'),
(2, 'Erika Mustermann', 'Noch ein weiterer Testeintrag', 'Nullam malesuada consectetur risus, in bibendum lectus scelerisque nec. Donec nec mi sit amet enim hendrerit consectetur. Duis luctus, tellus in mattis pharetra, metus urna auctor risus, vel facilisis est erat sed purus. Integer finibus felis sit amet odio convallis convallis. Morbi mattis sollicitudin molestie. Suspendisse potenti. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
