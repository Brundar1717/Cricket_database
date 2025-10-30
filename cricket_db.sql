-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 01:27 PM
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
-- Database: `cricket_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `match_date` date NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `team1_score` varchar(20) DEFAULT NULL,
  `team2_score` varchar(20) DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `venue` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `match_date`, `team1_id`, `team2_id`, `team1_score`, `team2_score`, `winner_id`, `venue`) VALUES
(18, '2025-05-23', 1, 8, NULL, NULL, NULL, 'Ekana Cricket Stadium'),
(19, '2025-05-03', 1, 9, '213/5', '211/5', 1, 'Chinnaswamy Stadium'),
(29, '2025-05-25', 2, 9, NULL, NULL, NULL, 'Narendra Modi Stadium'),
(49, '2025-05-07', 4, 9, '179/6', '183/8', 9, 'Eden Gardens Stadium'),
(53, '2025-05-18', 5, 3, '219/5', '209/7', 5, 'Sawai Mansingh Stadium'),
(56, '2025-05-26', 5, 6, NULL, NULL, NULL, 'Sawai Mansingh Stadium'),
(57, '2025-05-24', 5, 7, NULL, NULL, NULL, 'Sawai Mansingh Stadium'),
(62, '2025-05-06', 6, 2, '155/8', '147/7(DLS method)', 2, 'Wankhede Stadium'),
(67, '2025-05-21', 6, 7, '180/5', '121', 6, 'Wankhede Stadium'),
(71, '2025-04-27', 7, 1, '162/8', '165/4', 1, 'Arun Jaitley Stadium'),
(72, '2025-05-18', 7, 2, '199/3', '205/0', 2, 'Arun Jaitley Stadium,Delhi'),
(84, '2025-05-25', 8, 4, NULL, NULL, NULL, 'Arun Jaitley Stadium,Delhi'),
(93, '2025-05-20', 9, 3, '187/8', '188/4', 3, 'Arun Jaitley Stadium,Delhi'),
(95, '2025-04-30', 9, 5, '190', '194/6', 5, 'M A Chidambaram Stadium'),
(108, '2025-05-19', 10, 8, '205/7', '206/4', 8, 'Lucknow'),
(110, '2025-05-27', 1, 10, NULL, NULL, NULL, 'Ekana Cricket Stadium'),
(210, '2025-05-22', 2, 10, NULL, NULL, NULL, 'Narendra Modi Stadium');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL,
  `player_name` varchar(50) NOT NULL,
  `team_id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL,
  `runs` int(11) NOT NULL,
  `wickets` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `player_name`, `team_id`, `role`, `runs`, `wickets`) VALUES
(169, 'Rishabh Pant', 10, 'Wicket-keeper Batsman', 420, 0),
(170, 'Aiden Markram', 10, 'Batsman', 409, 0),
(171, 'Mitchell Marsh', 10, 'All-rounder', 315, 10),
(172, 'Nicholas Pooran', 10, 'Wicket-keeper Batsman', 377, 0),
(173, 'Ayush Badoni', 10, 'Batsman', 329, 0),
(174, 'David Miller', 10, 'Batsman', 153, 0),
(175, 'Abdul Samad', 10, 'All-rounder', 210, 6),
(176, 'Ravi Bishnoi', 10, 'Bowler', 15, 18),
(177, 'Avesh Khan', 10, 'Bowler', 30, 14),
(178, 'Akash Deep', 10, 'Bowler', 25, 12),
(179, 'Mayank Yadav', 10, 'Bowler', 20, 10),
(180, 'B Sai Sudharsan', 2, 'Batsman', 617, 0),
(181, 'Shubman Gill', 2, 'Batsman', 601, 0),
(182, 'Jos Buttler', 2, 'Batsman', 500, 0),
(183, 'Shahrukh Khan', 2, 'All-rounder', 90, 0),
(184, 'Rahul Tewatia', 2, 'All-rounder', 67, 0),
(185, 'Washington Sundar', 2, 'All-rounder', 85, 0),
(186, 'Ravisrinivasan Sai Kishore', 2, 'Bowler', 1, 15),
(187, 'Mohammed Siraj', 2, 'Bowler', 0, 15),
(188, 'Prasidh Krishna', 2, 'Bowler', 0, 21),
(189, 'Rashid Khan', 2, 'Bowler', 12, 8),
(190, 'KL Rahul', 7, 'Wicket-keeper', 493, 0),
(191, 'Abishek Porel', 7, 'Wicket-keeper', 295, 0),
(192, 'Tristan Stubbs', 7, 'Batsman', 280, 0),
(193, 'Axar Patel', 7, 'All-rounder', 263, 5),
(194, 'Ashutosh Sharma', 7, 'All-rounder', 186, 0),
(195, 'Faf du Plessis', 7, 'Batsman', 173, 0),
(196, 'Karun Nair', 7, 'Batsman', 154, 0),
(197, 'Vipraj Nigam', 7, 'All-rounder', 122, 0),
(198, 'Kuldeep Yadav', 7, 'Bowler', 11, 12),
(199, 'Mitchell Starc', 7, 'Bowler', 6, 14),
(200, 'Shivam Dube', 9, 'All-rounder', 301, 0),
(201, 'Ravindra Jadeja', 9, 'All-rounder', 279, 8),
(202, 'Rachin Ravindra', 9, 'All-rounder', 191, 0),
(203, 'MS Dhoni', 9, 'Wicket-keeper', 180, 0),
(204, 'Ruturaj Gaikwad', 9, 'Batsman', 122, 0),
(205, 'Devon Conway', 9, 'Batsman', 94, 0),
(206, 'Vijay Shankar', 9, 'All-rounder', 118, 0),
(207, 'Dewald Brevis', 9, 'Batsman', 126, 0),
(208, 'Noor Ahmad', 9, 'Bowler', 5, 20),
(209, 'Khaleel Ahmed', 9, 'Bowler', 1, 14),
(210, 'Ajinkya Rahane', 4, 'Batsman', 375, 0),
(211, 'Venkatesh Iyer', 4, 'All-rounder', 167, 3),
(212, 'Rinku Singh', 4, 'Batsman', 197, 0),
(213, 'Andre Russell', 4, 'All-rounder', 167, 9),
(214, 'Sunil Narine', 4, 'All-rounder', 215, 10),
(215, 'Harshit Rana', 4, 'Bowler', 15, 15),
(216, 'Ramandeep Singh', 4, 'All-rounder', 65, 4),
(217, 'Vaibhav Arora', 4, 'Bowler', 8, 16),
(218, 'Anrich Nortje', 4, 'Bowler', 5, 8),
(219, 'Varun Chakravarthy', 4, 'Bowler', 12, 17),
(220, 'Quinton de Kock', 4, 'Wicket-keeper', 465, 0),
(221, 'Pat Cummins', 8, 'All-rounder', 85, 12),
(222, 'Heinrich Klaasen', 8, 'Wicket-keeper', 312, 0),
(223, 'Ishan Kishan', 8, 'Wicket-keeper', 231, 0),
(224, 'Travis Head', 8, 'Batsman', 402, 0),
(225, 'Abhishek Sharma', 8, 'All-rounder', 373, 3),
(226, 'Nitish Kumar Reddy', 8, 'All-rounder', 198, 5),
(227, 'Harshal Patel', 8, 'All-rounder', 95, 14),
(228, 'Kamindu Mendis', 8, 'All-rounder', 112, 7),
(229, 'Mohammed Shami', 8, 'Bowler', 15, 18),
(230, 'Jaydev Unadkat', 8, 'Bowler', 8, 9),
(231, 'Rahul Chahar', 8, 'Bowler', 12, 11),
(232, 'Yashasvi Jaiswal', 3, 'Batsman', 523, 0),
(233, 'Riyan Parag', 3, 'All-rounder', 390, 3),
(234, 'Sanju Samson', 3, 'Wicket-keeper', 244, 0),
(235, 'Dhruv Jurel', 3, 'Wicket-keeper', 302, 0),
(236, 'Shimron Hetmyer', 3, 'Batsman', 227, 0),
(237, 'Vaibhav Suryavanshi', 3, 'All-rounder', 195, 0),
(238, 'Shubham Dubey', 3, 'Batsman', 106, 0),
(239, 'Wanindu Hasaranga', 3, 'Bowler', 9, 10),
(240, 'Maheesh Theekshana', 3, 'Bowler', 10, 11),
(241, 'Jofra Archer', 3, 'Bowler', 63, 11),
(242, 'Shreyas Iyer', 5, 'Batsman', 435, 0),
(243, 'Glenn Maxwell', 5, 'All-rounder', 320, 6),
(244, 'Marcus Stoinis', 5, 'All-rounder', 290, 8),
(245, 'Harpreet Brar', 5, 'All-rounder', 150, 12),
(246, 'Arshdeep Singh', 5, 'Bowler', 40, 18),
(247, 'Yuzvendra Chahal', 5, 'Bowler', 20, 22),
(248, 'Marco Jansen', 5, 'All-rounder', 100, 15),
(249, 'Azmatullah Omarzai', 5, 'All-rounder', 80, 10),
(250, 'Josh Inglis', 5, 'Wicket-keeper', 210, 0),
(251, 'Prabhsimran Singh', 5, 'Wicket-keeper', 180, 0),
(252, 'Suryakumar Yadav', 6, 'Batsman', 510, 0),
(253, 'Ryan Rickelton', 6, 'Wicket-keeper', 336, 0),
(254, 'Rohit Sharma', 6, 'Batsman', 300, 0),
(255, 'Tilak Varma', 6, 'Batsman', 246, 0),
(256, 'Will Jacks', 6, 'All-rounder', 195, 5),
(257, 'Hardik Pandya', 6, 'All-rounder', 187, 13),
(258, 'Trent Boult', 6, 'Bowler', 0, 18),
(259, 'Jasprit Bumrah', 6, 'Bowler', 0, 13),
(260, 'Deepak Chahar', 6, 'Bowler', 0, 10),
(261, 'Ashwani Kumar', 6, 'Bowler', 0, 8),
(274, 'Virat Kohli', 1, 'Batsman', 505, 0),
(275, 'Rajat Patidar', 1, 'Batsman', 239, 0),
(276, 'Phil Salt', 1, 'Batsman', 239, 0),
(277, 'Tim David', 1, 'Batsman', 186, 0),
(278, 'Devdutt Padikkal', 1, 'Batsman', 247, 0),
(279, 'Krunal Pandya', 1, 'Batsman', 97, 12),
(280, 'Josh Hazlewood', 1, 'Bowler', 0, 16),
(281, 'Bhuvneshwar Kumar', 1, 'Bowler', 10, 9),
(282, 'Yash Dayal', 1, 'Bowler', 0, 8),
(283, 'Liam Livingstone', 1, 'Batsman', 87, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `matches_played` int(11) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `losses` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `nrr` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `matches_played`, `wins`, `losses`, `points`, `nrr`) VALUES
(1, 'Royal Challengers Bengaluru', 12, 8, 3, 17, 0.482),
(2, 'Gujarat Titans', 12, 9, 3, 18, 0.795),
(3, 'Rajasthan Royals', 14, 4, 10, 8, -0.549),
(4, 'Kolkata Knight Riders', 13, 5, 6, 12, 0.193),
(5, 'Punjab Kings', 12, 8, 3, 17, 0.389),
(6, 'Mumbai Indians', 13, 8, 5, 16, 1.292),
(7, 'Delhi Capitals', 12, 6, 5, 13, 0.26),
(8, 'Sunrisers Hyderabad', 12, 4, 7, 9, -1.005),
(9, 'Chennai Super Kings', 13, 3, 10, 6, -1.03),
(10, 'Lucknow Super Giants', 12, 5, 7, 10, -0.506);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `team1_id` (`team1_id`,`team2_id`),
  ADD KEY `team2_id` (`team2_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `team_name` (`team_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`team1_id`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`team2_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
