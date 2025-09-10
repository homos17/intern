-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2025 at 10:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `PASSWORD`, `created_at`) VALUES
(1, 'mo', 'mo@gmail.com', '$2y$10$xCvVukGq9LPJZhGfoNwzveJKDmD/0eXK54WcV0cTQQvDD6IG1jm2S', '2025-09-10 07:42:14'),
(2, 'yomna', 'yo@gmail.com', '$2y$10$wwzXogPqIw2E5nrS1zgAD.UMvRFQ.qrpV9Vq26.TMMlBh14rnUZdq', '2025-09-10 07:57:17'),
(3, 'a', 'a@gmail', '$2y$10$CfSXeXyY0/N/UE4pgG9gRejHOYn79WTbRQFo9gsJpxUZ.1vrzm/SK', '2025-09-10 08:29:52'),
(4, 'h', 'h@g.com', '$2y$10$8xX3soz83hUKNB4L/MjZ.u8EiAtOKoBRiK2./X03tdxyiPywiTbNu', '2025-09-10 19:44:03'),
(5, 'homos', 'homos@gmail.com', '$2y$10$JN/OMV3wNz5NVWgo9.Ii8OmmJF6BJ2jGcc1G6WUJetVMMZzgs0gUq', '2025-09-10 19:47:13'),
(6, 'hagor', 'hagor@gmail.com', '$2y$10$s.NB2aYpuyOM3vWrndqBd.MbDBBt6zBbctYuGRy/2bZhwTnhfdSmq', '2025-09-10 20:37:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
