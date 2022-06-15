-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2020 at 12:13 AM
-- Server version: 5.7.21-log
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yokyo`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `statistic` (IN `typeID` INT)  NO SQL
SELECT
 s.sport_name AS name,
 sum(r.number) AS number
FROM
 events e

INNER JOIN
 sports s
ON
 e.sport_id = s.id
INNER JOIN
 records r
ON
 r.event_id = e.id
WHERE
 e.type_id = typeID
GROUP BY 
  s.sport_name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `timetable_class` ()  NO SQL
SELECT
  DISTINCT
  s.sport_name,
  s.sport_slug,
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-02' then e.slug else null end) as '2020 2 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-03' then e.slug else null end) as '2020 3 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-04' then e.slug else null end) as '2020 4 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-05' then e.slug else null end) as '2020 5 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-06' then e.slug else null end) as '2020 6 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-07' then e.slug else null end) as '2020 7 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-08' then e.slug else null end) as '2020 8 August'
FROM
 events e
INNER JOIN
 sports s
ON
 e.sport_id = s.id
WHERE
 e.type_id = 2
GROUP BY 
  s.sport_name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `timetable_competition` ()  SELECT
  DISTINCT
  s.sport_name,
  s.sport_slug,
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-02' then e.result else null end) as '2 August Winner',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-03' then e.result else null end) as '3 August Winner',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-04' then e.result else null end) as '4 August Winner',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-05' then e.result else null end) as '5 August Winner',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-06' then e.result else null end) as '6 August Winner',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-07' then e.result else null end) as '7 August Winner',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-08' then e.result else null end) as '8 August Winner',

  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-02' then e.slug else null end) as '2020 2 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-03' then e.slug else null end) as '2020 3 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-04' then e.slug else null end) as '2020 4 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-05' then e.slug else null end) as '2020 5 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-06' then e.slug else null end) as '2020 6 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-07' then e.slug else null end) as '2020 7 August',
  max(case when DATE_FORMAT(e.time_started, "%Y-%m-%d") = '2020-08-08' then e.slug else null end) as '2020 8 August'
FROM
 events e
INNER JOIN
 sports s
ON
 e.sport_id = s.id
WHERE
 e.type_id = 1
GROUP BY 
  s.sport_name$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `authority`
--

CREATE TABLE `authority` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authority`
--

INSERT INTO `authority` (`id`, `name`) VALUES
(1, 'Staff'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Article', '2020-03-06 21:03:57'),
(2, 'News', '2020-03-06 21:04:20'),
(3, 'Gallery', '2020-03-06 21:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `body`, `created_time`) VALUES
(1, 18, 'Sui Lip Chuan', 'suisui5257@gmail.com', 'lalala', '2020-04-21 20:25:47'),
(2, 19, 'Sui Lip Chuan', 'suisui5257@gmail.com', 'aa', '2020-04-29 10:43:44'),
(3, 2, 'Sui Lip Chuan', 'suisui5257@gmail.com', 'Wow', '2020-05-02 17:45:15'),
(4, 4, 'Sui Lip Chuan', 'suisui5257@gmail.com', 'I have learned so much. Thank you.', '2020-05-15 14:55:20'),
(5, 4, 'Sui Lip Chuan', 'suisui5257@gmail.com', 'Testing comment', '2020-05-15 18:48:19'),
(6, 4, 'Sui Lip Chuan', 'suisui5257@gmail.com', 'Testing cvomment 2', '2020-05-15 18:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `time_started` datetime NOT NULL,
  `type_id` int(11) NOT NULL,
  `number` int(11) NOT NULL DEFAULT '100',
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `slug`, `sport_id`, `venue_id`, `time_started`, `type_id`, `number`, `result`) VALUES
(1, 'Badminton Men\'s Singles Group Play Stage', 'badminton-men-s-singles-group-play-stage', 5, 1, '2020-08-02 10:00:00', 1, 100, 'Japan'),
(2, 'Badminton Men\'s Singles Round of 16', 'badminton-men-s-singles-round-of-16', 5, 1, '2020-08-03 10:00:00', 1, 100, 'Japan'),
(3, 'Badminton Men\'s Singles Quarterfinals', 'badminton-men-s-singles-quarterfinals', 5, 1, '2020-08-04 10:00:00', 1, 100, 'Japan'),
(4, 'Badminton Men\'s Singles Semifinals', 'badminton-men-s-singles-semifinals', 5, 1, '2020-08-05 10:00:00', 1, 94, ''),
(5, 'Badminton Men\'s Singles Bronze Medal', 'badminton_mens_singles_bronze_medal', 5, 1, '2020-08-06 10:00:00', 1, 100, ''),
(6, 'Badminton Men\'s Singles Gold Medal', 'badminton_mens_singles_gold_medal', 5, 1, '2020-08-07 10:00:00', 1, 100, ''),
(7, 'Football Men\'s Singles Group Play Stage', 'football-men-s-singles-group-play-stage', 7, 1, '2020-05-12 11:00:00', 1, 2, ''),
(8, 'Football Men\'s Singles Round of 16', 'football-men-s-singles-round-of-16', 7, 1, '2020-08-03 11:00:00', 1, 100, 'Japan'),
(9, 'Football Men\'s Singles Quarterfinals', 'football-men-s-singles-quarterfinals', 7, 1, '2020-08-04 11:00:00', 1, 100, 'Japan'),
(10, 'Football  Men\'s Singles Semifinals', 'football-men-s-singles-semifinals', 7, 1, '2020-08-05 11:00:00', 1, 99, ''),
(11, 'Football Men\'s Singles Bronze Medal', 'football_mens_singles_bronze_medal', 7, 1, '2020-08-06 12:00:00', 1, 91, ''),
(12, 'Football Men\'s Singles Gold Medal', 'football_mens_singles_gold_medal', 7, 1, '2020-08-07 11:00:00', 1, 100, ''),
(13, 'Badminton Class', 'badminton_class', 5, 1, '2020-08-02 16:00:00', 2, 100, ''),
(14, 'Basketball Men\'s Singles Group Play Stage', 'basketball_mens_singles_group_play_stage', 3, 1, '2020-08-03 00:00:00', 1, 100, 'US'),
(15, 'Basketball Men\'s Singles Round of 16', 'basketball_mens_singles_round_of_16', 3, 1, '2020-08-04 00:00:00', 1, 100, ''),
(16, 'Basketball Men\'s Singles Quarterfinals', 'basketball_mens_singles_quarterfinals', 3, 1, '2020-08-05 00:00:00', 1, 100, ''),
(17, 'Basketball Men\'s Singles Semifinals', 'basketball_mens_singles_semifinals', 3, 1, '2020-08-06 00:00:00', 1, 100, ''),
(18, 'Basketball Men\'s Singles Bronze Medal', 'basketball_mens_singles_bronze_medal', 3, 1, '2020-08-07 00:00:00', 1, 100, 'UK'),
(19, 'Basketball Men\'s Singles Gold Medal', 'basketball_mens_singles_gold_medal', 3, 1, '2020-08-08 00:00:00', 1, 100, ''),
(20, 'Diving Men\'s Singles Group Play Stage', 'diving_mens_singles_group_play_stage', 8, 2, '2020-08-03 00:00:00', 1, 100, ''),
(21, 'Diving Men\'s Singles Round of 16', 'diving_mens_singles_round_of_16', 8, 2, '2020-08-04 00:00:00', 1, 100, ''),
(22, 'Diving Men\'s Singles Quarterfinals', 'diving_mens_singles_quarterfinals', 8, 2, '2020-08-05 00:00:00', 1, 91, ''),
(23, 'Diving Men\'s Singles Semifinals', 'diving_mens_singles_semifinals', 8, 2, '2020-08-06 00:00:00', 1, 100, ''),
(24, 'Diving Men\'s Singles Bronze Medal', 'diving_mens_singles_bronze_medal', 8, 2, '2020-08-07 00:00:00', 1, 100, ''),
(25, 'Diving Men\'s Singles Gold Medal', 'diving_mens_singles_gold_medal', 8, 2, '2020-08-08 00:00:00', 1, 100, ''),
(26, 'Taekwondo Men\'s Singles Group Play Stage', 'taekwondo_mens_singles_group_play_stage', 11, 1, '2020-08-03 00:00:00', 1, 100, ''),
(27, 'Taekwondo Men\'s Singles Round of 16', 'taekwondo_mens_singles_round_of_16', 11, 1, '2020-08-04 00:00:00', 1, 100, ''),
(28, 'Taekwondo Men\'s Singles Quarterfinals', 'taekwondo_mens_singles_quarterfinals', 11, 1, '2020-08-05 00:00:00', 1, 90, ''),
(29, 'Taekwondo Men\'s Singles Semifinals', 'taekwondo_mens_singles_semifinals', 11, 1, '2020-08-06 00:00:00', 1, 100, ''),
(30, 'Taekwondo Men\'s Singles Bronze Medal', 'taekwondo_mens_singles_bronze_medal', 11, 1, '2020-08-07 00:00:00', 1, 100, ''),
(31, 'Taekwondo Men\'s Singles Gold Medal', 'taekwondo_mens_singles_gold_medal', 11, 1, '2020-08-08 00:00:00', 1, 100, ''),
(32, 'Basketball Class', 'basketball_class', 3, 1, '2020-08-04 17:00:00', 2, 90, ''),
(33, 'Archery Class', 'archery_class', 2, 1, '2020-08-06 20:00:00', 2, 90, ''),
(34, 'Fencing Class', 'fencing_class', 14, 1, '2020-08-07 21:00:00', 2, 94, ''),
(35, 'Swimming Men\'s Singles Group Play Stage', 'swimming_mens_singles_group_play_stage', 4, 2, '2020-08-07 08:00:00', 1, 90, ''),
(36, 'History of Badminton', 'history_of_badminton', 16, 2, '2020-08-02 00:00:00', 2, 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `post_image`, `post_id`) VALUES
(1, '1280px-Olympics_2012_Mixed_Doubles_Final.jpg', 1),
(2, '1280px-Olympics_2012_Mixed_Doubles_Final1.jpg', 2),
(3, 'maxresdefault.jpg', 3),
(4, 'badminton620.jpg', 3),
(5, 'b.jpg', 4),
(6, 'maxresdefault1.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `slug`, `body`, `created`, `user_id`, `sport_id`) VALUES
(1, 1, 'History of Badminton', 'history_of_badminton', '<p><strong>Badminton</strong>&nbsp;is a racquet sport played using&nbsp;<a href=\"https://en.wikipedia.org/wiki/Racket_(sports_equipment)\">racquets</a>&nbsp;to hit a&nbsp;<a href=\"https://en.wikipedia.org/wiki/Shuttlecock\">shuttlecock</a>&nbsp;across a&nbsp;<a href=\"https://en.wikipedia.org/wiki/Net_(device)\">net</a>. Although it may be played with larger teams, the most common forms of the game are &quot;singles&quot; (with one player per side) and &quot;doubles&quot; (with two players per side). Badminton is often played as a casual outdoor activity in a yard or on a beach; formal games are played on a rectangular indoor court. Points are scored by striking the shuttlecock with the racquet and landing it within the opposing side&#39;s half of the court.</p>\r\n\r\n<p>Each side may only strike the shuttlecock once before it passes over the net. Play ends once the shuttlecock has struck the floor or if a fault has been called by the umpire, service judge, or (in their absence) the opposing side.<a href=\"https://en.wikipedia.org/wiki/Badminton#cite_note-FOOTNOTEBoga2008-1\">[1]</a></p>\r\n\r\n<p>The shuttlecock is a feathered or (in informal matches) plastic projectile which flies differently from the balls used in many other sports. In particular, the feathers create much higher&nbsp;<a href=\"https://en.wikipedia.org/wiki/Drag_(physics)\">drag</a>, causing the shuttlecock to decelerate more rapidly. Shuttlecocks also have a high top speed compared to the balls in other racquet sports. The flight of the shuttlecock gives the sport its distinctive nature.</p>\r\n\r\n<p>The game developed in&nbsp;<a href=\"https://en.wikipedia.org/wiki/British_India\">British India</a>&nbsp;from the earlier game of&nbsp;<a href=\"https://en.wikipedia.org/wiki/Battledore_and_shuttlecock\">battledore and shuttlecock</a>. European play came to be dominated by&nbsp;<a href=\"https://en.wikipedia.org/wiki/Denmark\">Denmark</a>&nbsp;but the game has become very popular in Asia, with recent competitions dominated by&nbsp;<a href=\"https://en.wikipedia.org/wiki/China\">China</a>. Since 1992, badminton has been a&nbsp;<a href=\"https://en.wikipedia.org/wiki/Summer_Olympics\">Summer</a>&nbsp;<a href=\"https://en.wikipedia.org/wiki/Olympic_sports\">Olympic sport</a>&nbsp;with&nbsp;<a href=\"https://en.wikipedia.org/wiki/Badminton_at_the_Summer_Olympics\">four events</a>: men&#39;s singles, women&#39;s singles, men&#39;s doubles, and women&#39;s doubles,<a href=\"https://en.wikipedia.org/wiki/Badminton#cite_note-2\">[2]</a>&nbsp;with mixed doubles added four years later. At high levels of play, the sport demands excellent fitness: players require&nbsp;<a href=\"https://en.wikipedia.org/wiki/Aerobic_conditioning\">aerobic stamina</a>,&nbsp;<a href=\"https://en.wikipedia.org/wiki/Agility\">agility</a>, strength, speed, and precision. It is also a technical sport, requiring good&nbsp;<a href=\"https://en.wikipedia.org/wiki/Motor_coordination\">motor coordination</a>&nbsp;and the development of sophisticated racquet movements.<a href=\"https://en.wikipedia.org/wiki/Badminton#cite_note-FOOTNOTEGrice2008-3\">[3]</a></p>\r\n', '2020-05-02 17:42:01', 2, 5),
(2, 2, 'Result for Badminton Men\'s Singles Round of 16', 'result_for_badminton_mens_singles_round_of_16', '<p>Japan successfully win against Malaysia.&nbsp;</p>\r\n', '2020-05-02 17:44:32', 2, 5),
(3, 3, 'Gallery for Badminton Men\'s Singles Round of 16', 'gallery_for_badminton_mens_singles_round_of_16', '<p>Gallery for Badminton Men&#39;s Singles Round of 16</p>\r\n', '2020-05-02 17:47:55', 2, 5),
(5, 1, 'History of Taekwondo', 'history_of_taekwondo', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>&nbsp;</h2>\r\n', '2020-05-15 19:09:59', 6, 11),
(6, 1, 'Virus Outbreak Please be carefull', 'virus_outbreak_please_be_carefull', '<h2 style=\"font-style:italic;\"><strong>Please wear mask.</strong></h2>\r\n', '2020-05-15 19:10:55', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `record_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancel` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `event_id`, `record_name`, `email`, `number`, `code`, `timestamp`, `cancel`) VALUES
(1, 13, 'Sui Lip Chuan', 'suisui5257@gmail.com', 2, '2sHFlcGpgj', '2020-05-02 17:50:25', 1),
(2, 10, 'Sui Lip Chuan', 'suisui5257@gmail.com', 1, 'AJnT6rLXzg', '2020-05-03 20:15:27', 0),
(3, 4, 'Sui Lip Chuan', 'suisui5257@gmail.com', 5, 'XGY7JDwSRq', '2020-05-15 12:30:42', 1),
(4, 11, 'Sui Lip Chuan', 'suisui5257@gmail.com', 9, 'Qa5zTvSApL', '2020-05-15 12:31:03', 0),
(5, 34, 'Sui Lip Chuan', 'suisui5257@gmail.com', 6, 'cdoqk72U1w', '2020-05-15 12:56:31', 0),
(6, 4, 'Sui Lip Chuan', 'suisui5257@gmail.com', 6, 'J0LbTYRSMB', '2020-05-15 12:56:58', 0),
(7, 22, 'Sui Lip Chuan', 'suisui5257@gmail.com', 9, 'x1IWZM5qH0', '2020-05-15 12:57:06', 0),
(8, 28, 'Sui Lip Chuan', 'suisui5257@gmail.com', 10, 'dT15cQsL3a', '2020-05-15 12:57:17', 0),
(9, 33, 'Sui Lip Chuan', 'suisui5257@gmail.com', 10, 'Yfe3KTjp6t', '2020-05-15 14:43:19', 1),
(10, 33, 'Sui Lip Chuan', 'suisui5257@gmail.com', 10, 'Jt6QWalDGT', '2020-05-15 14:43:21', 0),
(11, 32, 'Sui Lip Chuan', 'suisui5257@gmail.com', 10, 'EpswS70qZl', '2020-05-15 14:44:06', 0),
(12, 14, 'Sui Lip Chuan', 'suisui5257@gmail.com', 4, 'EZ82lxUBtG', '2020-05-15 19:00:51', 1),
(13, 35, 'Sui Lip Chuan', 'suisui5257@gmail.com', 10, '7qlQsFRzWI', '2020-05-15 19:19:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `sport_name` varchar(255) NOT NULL,
  `sport_slug` varchar(255) NOT NULL,
  `sport_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `sport_name`, `sport_slug`, `sport_img`) VALUES
(1, 'General', 'general', 'general.png'),
(2, 'Archery', 'archery', 'archery.png'),
(3, 'Basketball', 'basketball', 'basketball.png'),
(4, 'Swimming', 'swimming', 'swimming.png'),
(5, 'Badminton', 'badminton', 'badminton.png'),
(7, 'Football', 'football', 'football.png'),
(8, 'Diving', 'diving', 'diving.png'),
(9, 'Beach Volleyball', 'beach_volleyball', 'beach_volleyball.png'),
(10, 'Tennis', 'tennis', 'tennis.png'),
(11, 'Taekwondo', 'taekwondo', 'taekwondo.png'),
(12, 'Surfing', 'surfing', 'surfing.png'),
(13, 'Golf', 'golf', 'golf.png'),
(14, 'Fencing', 'fencing', 'fencing.png'),
(15, 'Hockey', 'hockey', 'hockey.png'),
(16, '100 meter', '100_meter', '100meter.png');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type_name`) VALUES
(1, 'Competition'),
(2, 'Class');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `authority_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `register_date`, `authority_id`) VALUES
(1, 'suisui5257@gmail.com', 'admin', '$2y$10$yNT1q2d6iOdCLWNMD4.d2.wRzW1xtOJ1XWNmJxaLbf9tQKJJX2tY6', '2020-03-19 14:33:08', 2),
(2, 'sui5257@gmail.com', 'staff', '$2y$10$yNT1q2d6iOdCLWNMD4.d2.wRzW1xtOJ1XWNmJxaLbf9tQKJJX2tY6', '2020-03-19 14:33:46', 1),
(3, 'suis57@gmail.com', 'sui', '58b829075beb22dd23c93125930a8d53', '2020-03-21 11:59:53', 1),
(4, 'sui257@gmail.com', 'root', '9f6e6800cfae7749eb6c486619254b9c', '2020-03-21 16:21:51', 1),
(5, '257@gmail.com', 'user2', '9f6e6800cfae7749eb6c486619254b9c', '2020-03-21 16:23:06', 1),
(6, 'suisui@gmail.com', 'bh55xe', '$2y$10$q/pFa9wqKuElaEO1eznApe.wjYq4GSsjZ.eq9Lyom180E94PllJai', '2020-05-15 19:08:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `venue_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `venue_name`) VALUES
(1, 'Stadium of Delight'),
(2, 'Aquatics Palace');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authority`
--
ALTER TABLE `authority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authority`
--
ALTER TABLE `authority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
