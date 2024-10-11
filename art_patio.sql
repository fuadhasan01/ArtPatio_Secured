-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 10:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `art_patio`
--

-- --------------------------------------------------------

--
-- Table structure for table `applyevent`
--

CREATE TABLE `applyevent` (
  `application Id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `eventOwner` int(11) NOT NULL,
  `approval` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applyevent`
--

INSERT INTO `applyevent` (`application Id`, `event_id`, `user_id`, `art_id`, `eventOwner`, `approval`) VALUES
(19, 68, 40, 16, 46, 0),
(20, 72, 61, 23, 58, 1),
(21, 72, 61, 25, 58, 1),
(22, 72, 61, 24, 58, 1),
(23, 72, 61, 27, 58, 1),
(24, 72, 61, 28, 58, 1),
(25, 72, 60, 20, 58, 1),
(26, 72, 60, 21, 58, 1),
(27, 72, 60, 22, 58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `arts`
--

CREATE TABLE `arts` (
  `artID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `material` varchar(50) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `bid_amount` int(11) NOT NULL,
  `initalbid` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `img` varchar(400) NOT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `approval` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `owner` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `delivery_status` int(11) NOT NULL,
  `bidding_time` int(11) NOT NULL DEFAULT 5,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arts`
--

INSERT INTO `arts` (`artID`, `user_id`, `title`, `type`, `material`, `height`, `width`, `price`, `bid_amount`, `initalbid`, `description`, `img`, `year`, `approval`, `votes`, `owner`, `status`, `delivery_status`, `bidding_time`, `token`) VALUES
(8, 40, 'Silver', 'Abstract', 'Digital Art', 700, 500, '1000', 200, '800', 'Silver Logo', '570374.jpg', '2023', 1, 6, '44', 'Sold', 0, 5, ''),
(9, 40, 'Invaitational', 'Abstract', 'Digital Art', 700, 500, '2000', 200, '1200', 'Poster Design', 'wallpaperflare.com_wallpaper(2).jpg', '2023', 1, 2, '44', 'Sold', 0, 5, ''),
(10, 40, 'Cyberpunk', 'Landscape', 'Digital Art', 700, 500, '3000', 200, '1200', 'Cyber Jump', 'Screenshot 2023-03-10 234819.png', '2023', 1, 0, '44', 'Sold', 0, 5, ''),
(12, 40, 'q1231', '23123', '123123', 123123, 1321231, '1000', 200, '123123', '23123', '1162203.jpg', '2023', 1, 0, '47', 'Sold', 0, 5, ''),
(13, 40, 'Girl in Saree', 'Digital Art', 'Digital Tool', 800, 1200, '1000', 500, '1200', 'Girl in Saree', 'Spixiiii_sunnyleone_in_saree_ad98225a-5bf3-495f-9262-ec01dbbe69d7.png', '2023', 1, 3, '47', 'Sold', 0, 5, ''),
(14, 40, 'Counter Strick', 'Gaming', 'Digital Tool', 800, 1200, '1000', 300, '1000', 'Gaming Vibe', 'cropped-3840-2160-653557.png', '2023', 1, 1, '47', 'Sold', 0, 5, ''),
(15, 40, 'World', 'Digital Art', 'Digital Tool', 800, 1200, '2000', 500, '2000', 'Cyber Verse', 'Screenshot 2023-03-10 235010.png', '2023', 1, 0, '47', 'Sold', 0, 5, ''),
(16, 40, 'Flame', 'Fire', 'Digital Tool', 1000, 1500, '5000', 500, '3000', 'Scorpion on fire', '516677.jpg', '2023', 1, 1, NULL, 'Available', 0, 5, ''),
(17, 50, 'Chill Caster', 'Fighting', 'Digital Tool', 1000, 1500, '5000', 500, '3000', 'Subzero', '2.jpg', '2023', 1, 0, NULL, 'Available', 0, 5, ''),
(18, 40, 'Red', 'Abstract', 'Acrylic', 1080, 1920, '6500', 500, '6500', 'Color of life', 'slider1.jpg', '2023', 1, 33, '44', 'Sold', 0, 5, ''),
(20, 60, 'Peace', 'Abstract', 'Pencil', 800, 400, '3000', 300, '1200', 'Find your own peace ', 'sketch.png', '2023', 1, 31, NULL, 'Available', 0, 5, ''),
(21, 60, 'Taylor Swift', 'Portrait', 'Pencil', 500, 400, '1800', 100, '900', 'Portrait of Taylor Swift', 'tylor swift.png', '2023', 1, 0, NULL, 'Available', 0, 5, ''),
(22, 60, 'The GOAT', 'Portrait', 'Pencil', 600, 550, '1800', 200, '1200', 'The man, the myth, The legend', 'Messi.png', '2023', 1, 0, '44', 'Sold', 0, 5, ''),
(23, 61, 'Your Path', 'Abstract', 'Pencil', 600, 600, '3500', 400, '2000', 'Choose your own path. Do What your instinct leads to ', 'shishir1.jpg', '2023', 1, 34, NULL, 'Available', 0, 5, ''),
(24, 61, 'Reflection', 'Abstract', 'Charcoal', 500, 500, '3000', 300, '2400', 'Sometimes your Reflection defines you', 'shishir2.jpg', '2023', 1, 0, NULL, 'Available', 0, 5, ''),
(25, 61, 'Alert', 'Abstract', 'Pencil', 800, 500, '2000', 150, '1000', 'Red Alert for You', 'shishir3.jpg', '2023', 1, 1, NULL, 'Available', 0, 5, ''),
(26, 61, 'Humayun Ahmed', 'Digital Art', 'Digital', 600, 600, '2200', 350, '1500', 'One of the finest Writer of Bangladesh', 'shishir5.jpg', '2023', 1, 0, NULL, 'Available', 0, 5, ''),
(27, 61, 'GOAT', 'Portrait', 'Pencil', 800, 600, '200', 100, '200', 'Finest of our generation', 'shishir4.jpg', '2023', 1, 1, '71', 'Sold', 0, 5, ''),
(28, 61, 'Covid 19', 'Abstract', 'Digital', 500, 500, '3000', 200, '2200', 'A life changing time for all. COVID!!!', 'shishir6.jpg', '2023', 1, 1, '44', 'Sold', 0, 5, ''),
(29, 40, 'Color of Life', 'Abstract', 'Acrylic', 800, 600, '3500', 300, '2500', 'Make your life colorful and see the world in a colorful way\r\n', 'k1.jpg', '2023', 1, 0, NULL, 'Available', 0, 5, ''),
(30, 40, 'The Lost city', 'Landscape', 'Watercolor', 800, 700, '2000', 200, '2000', 'The lost ancient city ', 'k2.jpg', '2023', 1, 2, '71', 'Sold', 0, 5, ''),
(31, 40, 'U & ME', 'Abstract', 'Crayon', 600, 1200, '2000', 200, '1000', 'Rain You and me', 'k3.jpg', '2023', 1, 1, '71', 'Sold', 0, 5, ''),
(33, 70, 'Monalisa', 'Painting', 'Oil', 1200, 1200, '2000', 3500, '1500', 'This is the alternative art of Monalisa', 'monalisa.jpg', '2023', 1, 0, NULL, 'Available', 0, 5, ''),
(35, 87, 'Jacqueline with Flowers', 'Art', 'Oil', 500, 500, '5000', 7000, '4500', 'Pablo Picasso, Jacqueline with Flowers / Jacqueline aux Fleurs, June 2, 1954, oil on canvas, 45-11/16\" x 34-13/16\" (116 cm x 88.4 cm) © 2019 Estate of Pablo Picasso / Artists Rights Society (ARS), New', 'pablo.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, ''),
(36, 87, 'Head and Shoulders of a Woman, 1907', 'ART', 'Charcole', 500, 500, '5000', 7000, '4500', 'Pablo Picasso, Head and Shoulders of a Woman, 1907, charcoal on paper, 24-5/8\" × 18-7/8\" (62.5 cm × 47.9 cm), Private Collection Courtesy Fundación Almine y Bernard Ruiz-Picasso para el Arte © 2019 Es', 'pablo2.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, ''),
(37, 87, 'AF', 'AFDS', 'Watercolor', 500, 500, '5000', 7855, '4500', 'ADSFASDFD', 'pablo2.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, '5000'),
(38, 87, 'Hello', 'Art', 'Watercolor', 500, 500, '5000', 1000, '4000', 'Art', 'pablo.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, ''),
(40, 87, 'A man with Guitar', 'Painting', 'Pastel', 50, 50, '5000', 50, '4500', 'Thi is the one of the best art of pablo piccaso', 'piccaaso.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, ''),
(41, 87, 'BEST ART', 'Painting', 'Watercolor', 50, 50, '5000', 50, '500', 'pABLOS ART', 'pablo.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, ''),
(42, 88, 'Pablo', 'painting', 'Acrylic', 50, 50, '50000', 500, '40000', 'Pablo Piccasso Vincida', 'pablo.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, ''),
(43, 87, 'Bird', 'Drawing', 'Pastel', 50, 50, '500', 50, '400', 'Nice biRD', '6700d19801f58-bird.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, ''),
(44, 88, 'Bird', 'Painting', 'Watercolor', 50, 50, '500', 50, '400', 'Nice bird', '6700d237ebb96-bird.jpg', '2024', 1, 0, '87', 'Sold', 0, 5, ''),
(45, 87, 'Painting', 'asdf', 'Watercolor', 50, 50, '5000', 50, '5000', 'ssdf', '67039b750d1cb-magicstudio-art.jpg', '2024', 1, 0, NULL, 'Available', 0, 5, ''),
(46, 90, 'Monalisa', 'Wood color', 'Other', 100, 100, '8000', 500, '7000', 'The greatest art', '670810cf6db53-monalisa.jpg', '2024', 0, 0, NULL, 'Available', 0, 5, ''),
(47, 90, 'Guernica', 'Painting', 'Oil', 50, 50, '6500', 500, '6000', 'Guernica is a large 1937 oil painting by Spanish artist Pablo Picasso. It is one of his best-known works, regarded by many art critics as the most moving and powerful anti-war painting in history. It ', '670812dcd46bd-Guernica.png', '2024', 0, 0, NULL, 'Available', 0, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `description`, `created_at`) VALUES
(1, 87, 'Upload Art', 'Successfully uploaded art: A man with Guitar', '2024-10-04 08:38:06'),
(2, 87, 'Upload Art', 'Successfully uploaded art: BEST ART', '2024-10-05 04:13:52'),
(3, 88, 'Upload Art', 'Successfully uploaded art: Pablo', '2024-10-05 04:37:49'),
(4, 87, 'Upload Art', 'Successfully uploaded art: Bird', '2024-10-05 05:41:44'),
(5, 88, 'Upload Art', 'Successfully uploaded art: Bird', '2024-10-05 05:44:23'),
(6, 87, 'Upload Art', 'Successfully uploaded art: Painting', '2024-10-07 08:27:33'),
(7, 90, 'Upload Art', 'Successfully uploaded art: Monalisa', '2024-10-10 17:37:19'),
(8, 90, 'Upload Art', 'Successfully uploaded art: Guernica', '2024-10-10 17:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bid_count` int(11) NOT NULL,
  `last_bid_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `art_id`, `user_id`, `bid_count`, `last_bid_time`) VALUES
(30, 8, 44, 0, '2023-04-13 18:43:04'),
(31, 13, NULL, 0, NULL),
(32, 12, NULL, 0, NULL),
(33, 16, NULL, 0, NULL),
(34, 9, NULL, 0, NULL),
(35, 17, NULL, 0, NULL),
(36, 18, 44, 0, '2023-05-01 16:28:20'),
(38, 20, NULL, 0, NULL),
(39, 22, 44, 0, '2023-05-03 06:41:52'),
(40, 21, NULL, 0, NULL),
(41, 23, NULL, 0, NULL),
(42, 28, NULL, 0, NULL),
(43, 25, 44, 1, '2023-05-03 09:26:47'),
(44, 31, NULL, 0, NULL),
(45, 27, 71, 0, '2023-12-23 07:05:52'),
(46, 30, 71, 0, '2023-12-23 07:30:53'),
(47, 29, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `eventname` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endDate` date NOT NULL,
  `endTime` time NOT NULL,
  `priceTicket` varchar(100) NOT NULL,
  `description` varchar(400) NOT NULL,
  `img` varchar(400) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT '1234',
  `approval` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `user_id`, `eventname`, `startDate`, `startTime`, `endDate`, `endTime`, `priceTicket`, `description`, `img`, `password`, `approval`) VALUES
(67, 46, 'Pokemon Show', '2023-05-01', '23:00:00', '2023-05-02', '23:30:00', '200', 'A show for kids and Pokemon Lovers', '3.jpg', '1234', 1),
(68, 46, 'Six SIege', '2023-05-02', '10:00:00', '2023-05-03', '22:00:00', '400', 'Gaming Fest', '23.jpg', '1234', 1),
(70, 49, 'CS-Go', '2023-04-02', '11:11:00', '2023-04-03', '13:00:00', '400', 'Gaming Fest for CS- PROs', 'AK.png', '1234', 1),
(71, 49, 'Gaming Event', '2023-05-01', '23:00:00', '2023-05-02', '23:30:00', '500', 'Gaming Fest ', '609118.jpg', '1234', 1),
(72, 58, 'Color of Arts', '2023-05-02', '10:00:00', '2023-05-03', '22:00:00', '500', 'Set your color in your Artwork. join us in our adventure and showcase your work', 'eventbanner.png', '1234', 1),
(73, 49, 'Anime Event 2023', '2023-12-30', '10:00:00', '2024-01-10', '18:00:00', '300', 'Your Favorite Anime Event', 'animeEvent.png', '1234', 1),
(74, 72, 'Movie Show', '2023-11-24', '00:30:00', '2023-12-30', '00:30:00', '200', 'This is a movie event', 'movieGallery.jpg', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`fav_id`, `user_id`, `art_id`) VALUES
(5, 45, 9),
(6, 45, 8),
(7, 44, 9),
(9, 40, 8),
(11, 47, 13),
(12, 47, 14),
(13, 44, 18),
(14, 40, 18),
(18, 51, 31),
(19, 71, 29),
(20, 71, 23),
(21, 87, 23);

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`id`, `following_id`, `follower_id`) VALUES
(17, 49, 40),
(18, 49, 50),
(45, 59, 58),
(46, 40, 60),
(47, 40, 61),
(48, 59, 61),
(56, 51, 50),
(59, 49, 46);

-- --------------------------------------------------------

--
-- Table structure for table `ticketbuy`
--

CREATE TABLE `ticketbuy` (
  `purchase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticketbuy`
--

INSERT INTO `ticketbuy` (`purchase_id`, `user_id`, `event_id`) VALUES
(2, 44, 67),
(4, 44, 68),
(6, 47, 67),
(7, 47, 68),
(8, 44, 70),
(9, 44, 71),
(10, 59, 72),
(11, 71, 74);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `dp` varchar(500) NOT NULL,
  `description` varchar(200) NOT NULL,
  `currancy` int(50) NOT NULL,
  `followers` int(11) NOT NULL,
  `requestCurrency` int(11) NOT NULL,
  `requestedCurrency` int(11) NOT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `lockout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `name`, `email`, `password`, `address`, `contact`, `category`, `dp`, `description`, `currancy`, `followers`, `requestCurrency`, `requestedCurrency`, `failed_attempts`, `lockout_time`) VALUES
(1, 'Admin', 'admin@gmail.com', '1234', 'Dhaka', '', 'Admin', '', '', 0, 0, 0, 0, 0, NULL),
(40, 'Kabir', 'k@gmail.com', '1234', 'Dhaka', '01711672116', 'Artist', 'k.JPG', 'An art lover and devoted whole life towards art', 776315, 1, 0, 0, 3, '2024-09-14 14:27:06'),
(44, 'Sazin', 's@gmail.com', '1234', 'Dhaka', '01624830751', 'Customer', 'DSC_0383.JPG', '', 28200, 0, 0, 0, 0, NULL),
(45, 'Rakib Hasan', 'r@gmail.com', '1234', 'Cumilla', '', 'Customer', '', '', 0, 0, 0, 0, 0, NULL),
(46, 'Rabbi', 'rab@gmail.com', '1234', 'Dhaka', '', 'Gallery', 'gallery2.jpg', '', 2000, 1, 0, 0, 0, NULL),
(47, 'Rakibul ', 'rs@gmail.com', '123', 'Rangpur', '01624830751', 'Customer', '54724.jpg', '', 5500, 0, 0, 0, 0, NULL),
(48, 'asda', 'a@fasfasd', '123', 'asdasd', '', 'Artist', '607877.jpg', '', 0, 0, 0, 0, 0, NULL),
(49, 'Rock Show Gallery', 'rsg@gmail.com', '123', '2/3 Dhanmondi 32, Dhaka,Bangladesh', '01834830751', 'Gallery', 'gallery1.jpg', 'Gallery to exhibate art', 900, 0, 0, 0, 0, NULL),
(50, 'Fuad', 'fuad@gmail.com', '123', 'Sayed Nagar,Dhaka', '01624830871', 'Artist', 'WhatsApp Image 2023-04-14 at 12.42.09 AM.jpeg', '', 50000, 2, 0, 0, 0, NULL),
(51, 'Labib Ahmed', 'labib@gmail.com', '123', 'Dhaka', '+8801624830761', 'Artist', 'WhatsApp Image 2023-04-14 at 12.42.09 AM.jpeg', 'Freelancing Artist!!', 1500, 0, 0, 0, 0, NULL),
(58, 'Dukes Gallery', 'duke@gmail.com', '123', 'Dublin Town,Ireland', '01624830751', 'Gallery', 'dukegallery.jpg', 'A house of arts where our motto is to uphold the talents of the artist and make a suitable place for art lovers to buy artworks', 500, 1, 0, 0, 0, NULL),
(59, 'Abu Bakar', 'abu@gmail.com', '123', 'Cumilla', '01624830761', 'Customer', 'abu.jpg', '', 50000, 0, 0, 0, 0, NULL),
(60, 'Mithila Farjana', 'mithila@gmail.com', '123', 'Dhaka', '01624830651', 'Artist', 'm.jpg', 'In this huge world of art trying to make my own world beautiful with the help of art', 1800, 1, 0, 0, 0, NULL),
(61, 'Shahnewaz Rahman Shishir', 'shishir@gmail.com', '123', 'Khulna', '016245678123', 'Artist', 'shishir.jpg', 'A student of fine arts in Khulna University,Bangladesh.', 3200, 2, 0, 0, 0, NULL),
(62, 'Walking Mans Gallery ', 'w@gmail.com', '123', 'Dhaka', '012318236123', 'Gallery', 'w.png', 'Walking Mans Gallery ', 0, 0, 0, 0, 0, NULL),
(63, 'Vernons Art Gallery', 'v@gmail.com', '123', 'Dhaka', '01233127351', 'Gallery', 'v.png', 'Vernons Art Gallery', 0, 0, 0, 0, 0, NULL),
(65, 'Labib Khan', 'abc@gmail.com', '1234', 'Dhaka', '01711111111', 'Artist', 'user.jpg', 'I sign up as an artist', 0, 0, 0, 0, 0, NULL),
(66, 'Labib Khan', 'c@gmail.com', '1234', 'Dhaka', '01711111111', 'Artist', 'user.jpg', 'I sign up as an artist', 0, 0, 0, 0, 0, NULL),
(67, 'Labib Khan', 'flabib@gmail.com', '1234', 'Dhaka', '01711111111', 'Artist', 'user.jpg', 'I sign up as an artist', 0, 0, 0, 0, 0, NULL),
(68, 'Labib Khan', 'flabisb@gmail.com', '1234', 'Dhaka', '01711111111', 'Artist', 'user.jpg', 'I sign up as an artist', 0, 0, 0, 0, 0, NULL),
(69, 'Labib Khan', 'flabihsb@gmail.com', '1234', 'Dhaka', '01711111111', 'Artist', 'user.jpg', 'I sign up as an artist', 0, 0, 0, 0, 0, NULL),
(70, 'Labib Khan', 'demo1@gmail.com', '1234', 'Dhaka', '01711111111', 'Artist', 'user.jpg', 'I sign up as an artist', 0, 0, 0, 0, 0, NULL),
(71, 'Fuad Hasan Labib', 'labib.knc@gmail.com', '1234', 'Sayed Nagar, Madani Avenue, Dhaka 1000', '+8801627695690', 'Customer', 'Fuad.jpg', 'I love arts so this site is very good source for me to show art and buy.', 2600, 0, 0, 0, 0, NULL),
(72, 'Dhaka Gallery', 'dhakaGallery@gmail.com', '1234', 'Dhaka', '01711111111', 'Gallery', 'dhakaGallery.jpg', 'I sign up as an Gallary owner', 200, 0, 0, 0, 1, NULL),
(81, 'Rabbi', 'rabbi@gmail.com', '$2y$10$Zpb3/lWdauCGpzsaXhvLWOM4UeiCJYfGhQILnufQdFPWoyxZcyzNq', 'Dhaka, Bangladesh', '01698756589', 'Customer', 'CVpic.jpg', 'A art enthusiast', 0, 0, 0, 0, 0, NULL),
(82, 'Khan', 'khan@gmail.com', '$2y$10$5Lt8E39G2WwpXnyzWZ94we46w9SxZ2b0epoZcJmW6yyg3CjoI7fDq', 'Dhaka, Bangladesh', '01678964858', 'Gallery', 'uiu.png', 'Khan GALLARY', 0, 0, 0, 0, 0, NULL),
(83, 'Thuha', 'thuha@gmail.com', '$2y$10$9ISZBRCbV0I4Sjw8pimQgebL08vMn/Pnp6psHcBWxepAn6z1FiAHu', 'Dhaka, Bangladesh', '01689756522', 'Customer', 'uiu.png', 'Art Enthusiast', 0, 0, 0, 0, 0, NULL),
(84, 'Ubusu Shalaka', 'ubusushalaka@gmail.com', '$2y$10$otc/Bg7h3LvUSI7y3wWUVuYRoxO9fycQU8nVINij9Ici0HyR5pHk.', 'Dhaka, Bangladesh', '01627695690', 'Gallery', 'uiu.png', 'Ubusu Shalaka', 0, 0, 0, 0, 0, NULL),
(85, 'Dhaka Gallery', 'gallery@gmail.com', '$2y$10$0vbAN.1VjFFD3jzo.CREg.Ikx1uVYCvaTOZ9PBEOsrkZP7wLnJjtO', 'Dhaka, Bangladesh', '01658964578', 'Gallery', 'Gallery_1.png', 'Largest Gallery in Dhaka', 0, 0, 0, 0, 0, NULL),
(86, 'Nirob', 'nirob@gmail.com', '$2y$10$k.oRpPl0EjzHcf4beUm/7.mXVsC8b9P/VfFf0/FS7qR46sOIrkOhO', 'Dhaka, Bangladesh', '0166455485', 'Customer', 'nirob.jpg', 'Nirob Customer', 500, 0, 0, 0, 0, NULL),
(87, 'Pablo Picasso', 'pablo@gmail.com', '$2y$10$NL/T9usmCHJnlc5lnm2EJeH9klasXiKmam4SB3MhFmCsuXmbHyaTO', 'Malaga Spain', '0986464566', 'Artist', 'picasso.jpg', 'Great Painter', 0, 0, 0, 0, 0, NULL),
(88, 'Vincida', 'vinci@gmail.com', '$2y$10$UNHynqVtkTcttf144uBhO..bh7.RVli9BFoO.z.yMCx66jvUcCv4W', 'Anchiano, Italy', '9999999999', 'Artist', 'vincida.jpg', 'Leonardo di ser Piero da Vinci was an Italian polymath of the High Renaissance who was active as a painter, draughtsman, engineer, scientist, theorist, sculptor, and architect.', 500, 0, 0, 0, 0, NULL),
(89, 'Zainul Abedin', 'abedin@gmail.com', '$2y$10$5q9zGFc5FyuJUHRvmpiEXOKD6wmpQZV7QJ6JnRLxF8zwxfD2t8LB2', 'Kendua, Netrokona, Bangladesh', '01688888888', 'Artist', '6700d4b0b8a63-zainul.jpg', 'Silpacharja', 0, 0, 0, 0, 0, NULL),
(90, 'Fuad Hasan', 'hasan@gmail.com', '$2y$10$4O3KAuJPmQujXyJ.heuSQeF06RVIYa3YyEB4ikPEkqY585MWjyRv.', 'Dhaka, Bangladesh', '01658452544', 'Artist', '67080cbd656e0-about.jpg', 'AN ARTIST', 0, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `user_id`, `art_id`) VALUES
(3, 44, 8),
(4, 44, 9),
(5, 45, 8),
(6, 40, 8),
(7, 40, 9),
(9, 47, 8),
(10, 47, 13),
(11, 47, 14),
(12, 51, 8),
(13, 40, 13),
(14, 40, 18),
(15, 49, 16),
(16, 60, 23),
(17, 60, 18),
(18, 44, 28),
(19, 59, 25),
(20, 59, 23),
(21, 59, 18),
(22, 51, 31),
(23, 51, 30),
(24, 71, 30),
(25, 71, 27),
(26, 86, 13),
(27, 87, 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applyevent`
--
ALTER TABLE `applyevent`
  ADD PRIMARY KEY (`application Id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `art_id` (`art_id`);

--
-- Indexes for table `arts`
--
ALTER TABLE `arts`
  ADD PRIMARY KEY (`artID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `art_id` (`art_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `art_id` (`art_id`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketbuy`
--
ALTER TABLE `ticketbuy`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `art_id` (`art_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applyevent`
--
ALTER TABLE `applyevent`
  MODIFY `application Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `arts`
--
ALTER TABLE `arts`
  MODIFY `artID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `follower`
--
ALTER TABLE `follower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `ticketbuy`
--
ALTER TABLE `ticketbuy`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applyevent`
--
ALTER TABLE `applyevent`
  ADD CONSTRAINT `applyevent_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`eventID`),
  ADD CONSTRAINT `applyevent_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`id`),
  ADD CONSTRAINT `applyevent_ibfk_3` FOREIGN KEY (`art_id`) REFERENCES `arts` (`artID`);

--
-- Constraints for table `arts`
--
ALTER TABLE `arts`
  ADD CONSTRAINT `arts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`id`);

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`id`);

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`art_id`) REFERENCES `arts` (`artID`),
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`id`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`id`);

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`id`),
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`art_id`) REFERENCES `arts` (`artID`);

--
-- Constraints for table `ticketbuy`
--
ALTER TABLE `ticketbuy`
  ADD CONSTRAINT `ticketbuy_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`eventID`),
  ADD CONSTRAINT `ticketbuy_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`id`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`art_id`) REFERENCES `arts` (`artID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
