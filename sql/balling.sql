-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 11:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `balling`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `role`, `password`) VALUES
(1, 'test@gmail.com', 'test', 'admin', '$2y$10$cjZSKEqf.6bRzAdPa2yCXeSj.yhl2yhZpqnJUY.Vlkpdnl1ck49pO'),
(2, 'test2@gmail.com', 'test2', '', '$2y$10$PKkRxYbNN.OYfDev7bVqnOR2RRBLs.5rxkVH/2Oxxc93qzLCQCgKi');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) NOT NULL,
  `file_path` varchar(4096) NOT NULL,
  `size` int(11) NOT NULL,
  `likes` int(255) NOT NULL,
  `valid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `time`, `name`, `file_path`, `size`, `likes`, `valid`) VALUES
(1, '2024-01-10 08:16:15', 'Phonk', 'videos/6576fad8bdf8c_VID_20230928_123644.mp4', 0, 1, ''),
(2, '2024-01-10 08:15:05', 'rc2 meme1', 'videos/6576fbaa8913a_Editor80.mp4', 0, 1, ''),
(3, '2024-01-10 09:59:26', 'rc2 meme2', 'videos/6576fd7f86ce2_0001-0300.mp4', 0, 0, ''),
(4, '2024-01-10 08:16:21', 'rivals failed combo', 'videos/657706187ce3d_almost beatifel clip.mp4', 0, 1, 'valid'),
(8, '2024-01-10 09:59:40', '???', 'videos/657851f79f425_Snaptik_6938351273351630086_lily-cpr-1.mp4', 0, 0, 'valid'),
(9, '2024-01-10 10:28:38', 'pipes', 'videos/657852a1823a1_the_king_of_pipes.mp4', 0, 2, 'flagged'),
(10, '2024-01-10 13:20:53', 'rivals clip', 'videos/659e515ec9b6e_2023-12-28_00-53-05.mp4', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `video_likes`
--

CREATE TABLE `video_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video_likes`
--

INSERT INTO `video_likes` (`id`, `user_id`, `video_id`) VALUES
(2, 1, 1),
(3, 1, 2),
(4, 1, 4),
(1, 1, 9),
(5, 2, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_likes`
--
ALTER TABLE `video_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`user_id`,`video_id`),
  ADD KEY `video_id` (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `video_likes`
--
ALTER TABLE `video_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `video_likes`
--
ALTER TABLE `video_likes`
  ADD CONSTRAINT `video_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `video_likes_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
