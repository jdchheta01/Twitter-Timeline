-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2018 at 07:28 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtcampdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `rtcampdb`
--

CREATE TABLE `rtcampdb` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_token` text COLLATE utf8_unicode_ci NOT NULL,
  `oauth_secret` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rtcampdb`
--

INSERT INTO `rtcampdb` (`id`, `oauth_provider`, `oauth_uid`, `username`, `fname`, `lname`, `locale`, `oauth_token`, `oauth_secret`, `picture`, `created`, `modified`) VALUES
(1, 'twitter', '4638474690', 'MayurPatel_MAC', 'MAYUR', 'PATEL', 'en', '4638474690-kEWWE37AEEQGLXp9d6Wl06sGaOLXgUdGhZ4vurD', 'i7LtCuATESBD2zuwOiNsCqMuWvwd5DfkVkUAYM6adv7DK', 'http://pbs.twimg.com/profile_images/1007323433103847425/VLv4K5yC_normal.jpg', '2018-08-19 19:53:23', '2018-08-20 11:32:51'),
(2, 'twitter', '4857726957', 'Kapil_Kaklotar', 'kapil', 'Kaklotar', 'en', '4857726957-nbytDU6FcfLz6BwukDiaSi8eLdL0uQTmYbZlnQd', 'Pit0RiYk3qxyqYfT91QFERhvmjcNKisRUBnrhLyk7yKpZ', 'http://pbs.twimg.com/profile_images/798973056567775233/4j2t8MiF_normal.jpg', '2018-08-20 14:57:07', '2018-08-20 15:16:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rtcampdb`
--
ALTER TABLE `rtcampdb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rtcampdb`
--
ALTER TABLE `rtcampdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
