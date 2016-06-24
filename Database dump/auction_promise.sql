-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2016 at 03:48 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction_promise`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `parent` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent`) VALUES
(1, 'construction', 0),
(3, 'cleaning', 0),
(4, 'New name', 0);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_bin,
  `url` text COLLATE utf8_bin,
  `path` text COLLATE utf8_bin,
  `type` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `name`, `url`, `path`, `type`, `users_id`) VALUES
(91, '1466686449.png', '/upload/114', 'C:\\xampp\\htdocs\\bogdan\\LARAVEL-PROJECT\\auction\\public\\upload\\114', NULL, 114),
(92, '1466688296.png', '/upload/114', 'C:\\xampp\\htdocs\\bogdan\\LARAVEL-PROJECT\\auction\\public\\upload\\114', NULL, 114),
(93, '1466757996.png', '/upload/114', 'C:\\xampp\\htdocs\\bogdan\\LARAVEL-PROJECT\\auction\\public\\upload\\114', NULL, 114),
(94, '1466766501.png', '/upload/114', 'C:\\xampp\\htdocs\\bogdan\\LARAVEL-PROJECT\\auction\\public\\upload\\114', NULL, 114),
(95, '1466766721.png', '/upload/114', 'C:\\xampp\\htdocs\\bogdan\\LARAVEL-PROJECT\\auction\\public\\upload\\114', NULL, 114),
(96, '1466766786.png', '/upload/114', 'C:\\xampp\\htdocs\\bogdan\\LARAVEL-PROJECT\\auction\\public\\upload\\114', NULL, 114),
(97, '1466766919.png', '/upload/114', 'C:\\xampp\\htdocs\\bogdan\\LARAVEL-PROJECT\\auction\\public\\upload\\114', NULL, 114),
(98, '1466770001.png', '/upload/114', 'C:\\xampp\\htdocs\\bogdan\\LARAVEL-PROJECT\\auction\\public\\upload\\114', NULL, 114);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(3, 'Afghanistan'),
(4, 'Albania'),
(5, 'Algeria'),
(6, 'American Samoa'),
(7, 'Andorra'),
(8, 'Angola'),
(9, 'Anguilla'),
(10, 'Antarctica'),
(11, 'Antigua and Barbuda'),
(12, 'Argentina'),
(13, 'Armenia'),
(14, 'Aruba'),
(15, 'Australia'),
(16, 'Austria'),
(17, 'Azerbaijan'),
(18, 'Bahamas'),
(19, 'Bahrain'),
(20, 'Bangladesh'),
(21, 'Barbados'),
(22, 'Belarus'),
(23, 'Belgium'),
(24, 'Belize'),
(25, 'Benin'),
(26, 'Bermuda'),
(27, 'Bhutan'),
(28, 'Bolivia'),
(29, 'Bosnia and Herzegowina'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil'),
(33, 'British Indian Ocean Territory'),
(34, 'Brunei Darussalam'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cambodia'),
(39, 'Cameroon'),
(40, 'Canada'),
(41, 'Cape Verde'),
(42, 'Cayman Islands'),
(43, 'Central African Republic'),
(44, 'Chad'),
(45, 'Chile'),
(46, 'China'),
(47, 'Christmas Island'),
(48, 'Cocos (Keeling) Islands'),
(49, 'Colombia'),
(50, 'Comoros'),
(51, 'Congo'),
(52, 'Congo, the Democratic Republic of the'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Cote d''Ivoire'),
(56, 'Croatia (Hrvatska)'),
(57, 'Cuba'),
(58, 'Cyprus'),
(59, 'Czech Republic'),
(60, 'Denmark'),
(61, 'Djibouti'),
(62, 'Dominica'),
(63, 'Dominican Republic'),
(64, 'East Timor'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(68, 'Equatorial Guinea'),
(69, 'Eritrea'),
(70, 'Estonia'),
(71, 'Ethiopia'),
(72, 'Falkland Islands (Malvinas)'),
(73, 'Faroe Islands'),
(74, 'Fiji'),
(75, 'Finland'),
(76, 'France'),
(77, 'France Metropolitan'),
(78, 'French Guiana'),
(79, 'French Polynesia'),
(80, 'French Southern Territories'),
(81, 'Gabon'),
(82, 'Gambia'),
(83, 'Georgia'),
(84, 'Germany'),
(85, 'Ghana'),
(86, 'Gibraltar'),
(87, 'Greece'),
(88, 'Greenland'),
(89, 'Grenada'),
(90, 'Guadeloupe'),
(91, 'Guam'),
(92, 'Guatemala'),
(93, 'Guinea'),
(94, 'Guinea-Bissau'),
(95, 'Guyana'),
(96, 'Haiti'),
(97, 'Heard and Mc Donald Islands'),
(98, 'Holy See (Vatican City State)'),
(99, 'Honduras'),
(100, 'Hong Kong'),
(101, 'Hungary'),
(102, 'Iceland'),
(103, 'India'),
(104, 'Indonesia'),
(105, 'Iran (Islamic Republic of)'),
(106, 'Iraq'),
(107, 'Ireland'),
(108, 'Israel'),
(109, 'Italy'),
(110, 'Jamaica'),
(111, 'Japan'),
(112, 'Jordan'),
(113, 'Kazakhstan'),
(114, 'Kenya'),
(115, 'Kiribati'),
(116, 'Korea, Democratic People''s Republic of'),
(117, 'Korea, Republic of'),
(118, 'Kuwait'),
(119, 'Kyrgyzstan'),
(120, 'Lao, People''s Democratic Republic'),
(121, 'Latvia'),
(122, 'Lebanon'),
(123, 'Lesotho'),
(124, 'Liberia'),
(125, 'Libyan Arab Jamahiriya'),
(126, 'Liechtenstein'),
(127, 'Lithuania'),
(128, 'Luxembourg'),
(129, 'Macau'),
(130, 'Macedonia, The Former Yugoslav Republic of'),
(131, 'Madagascar'),
(132, 'Malawi'),
(133, 'Malaysia'),
(134, 'Maldives'),
(135, 'Mali'),
(136, 'Malta'),
(137, 'Marshall Islands'),
(138, 'Martinique'),
(139, 'Mauritania'),
(140, 'Mauritius'),
(141, 'Mayotte'),
(142, 'Mexico'),
(143, 'Micronesia, Federated States of'),
(144, 'Moldova, Republic of'),
(145, 'Monaco'),
(146, 'Mongolia'),
(147, 'Montserrat'),
(148, 'Morocco'),
(149, 'Mozambique'),
(150, 'Myanmar'),
(151, 'Namibia'),
(152, 'Nauru'),
(153, 'Nepal'),
(154, 'Netherlands'),
(155, 'Netherlands Antilles'),
(156, 'New Caledonia'),
(157, 'New Zealand'),
(158, 'Nicaragua'),
(159, 'Niger'),
(160, 'Nigeria'),
(161, 'Niue'),
(162, 'Norfolk Island'),
(163, 'Northern Mariana Islands'),
(164, 'Norway'),
(165, 'Oman'),
(166, 'Pakistan'),
(167, 'Palau'),
(168, 'Panama'),
(169, 'Papua New Guinea'),
(170, 'Paraguay'),
(171, 'Peru'),
(172, 'Philippines'),
(173, 'Pitcairn'),
(174, 'Poland'),
(175, 'Portugal'),
(176, 'Puerto Rico'),
(177, 'Qatar'),
(178, 'Reunion'),
(179, 'Romania'),
(180, 'Russian Federation'),
(181, 'Rwanda'),
(182, 'Saint Kitts and Nevis'),
(183, 'Saint Lucia'),
(184, 'Saint Vincent and the Grenadines'),
(185, 'Samoa'),
(186, 'San Marino'),
(187, 'Sao Tome and Principe'),
(188, 'Saudi Arabia'),
(189, 'Senegal'),
(190, 'Seychelles'),
(191, 'Sierra Leone'),
(192, 'Singapore'),
(193, 'Slovakia (Slovak Republic)'),
(194, 'Slovenia'),
(195, 'Solomon Islands'),
(196, 'Somalia'),
(197, 'South Africa'),
(198, 'South Georgia and the South Sandwich Islands'),
(199, 'Spain'),
(200, 'Sri Lanka'),
(201, 'St. Helena'),
(202, 'St. Pierre and Miquelon'),
(203, 'Sudan'),
(204, 'Suriname'),
(205, 'Svalbard and Jan Mayen Islands'),
(206, 'Swaziland'),
(207, 'Sweden'),
(208, 'Switzerland'),
(209, 'Syrian Arab Republic'),
(210, 'Taiwan, Province of China'),
(211, 'Tajikistan'),
(212, 'Tanzania, United Republic of'),
(213, 'Thailand'),
(214, 'Togo'),
(215, 'Tokelau'),
(216, 'Tonga'),
(217, 'Trinidad and Tobago'),
(218, 'Tunisia'),
(219, 'Turkey'),
(220, 'Turkmenistan'),
(221, 'Turks and Caicos Islands'),
(222, 'Tuvalu'),
(223, 'Uganda'),
(224, 'Ukraine'),
(225, 'United Arab Emirates'),
(226, 'United Kingdom'),
(227, 'United States'),
(228, 'United States Minor Outlying Islands'),
(229, 'Uruguay'),
(230, 'Uzbekistan'),
(231, 'Vanuatu'),
(232, 'Venezuela'),
(233, 'Vietnam'),
(234, 'Virgin Islands (British)'),
(235, 'Virgin Islands (U.S.)'),
(236, 'Wallis and Futuna Islands'),
(237, 'Western Sahara'),
(238, 'Yemen'),
(239, 'Yugoslavia'),
(240, 'Zambia'),
(241, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `promise`
--

CREATE TABLE `promise` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `terms` text,
  `type` tinyint(4) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `featured` tinyint(4) DEFAULT NULL,
  `file_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `auction_end` datetime DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `winners` tinyint(4) DEFAULT NULL,
  `shows` smallint(6) DEFAULT NULL,
  `active` tinyint(2) DEFAULT '0',
  `location_id` int(11) NOT NULL,
  `winner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promise`
--

INSERT INTO `promise` (`id`, `title`, `sub_title`, `description`, `price`, `terms`, `type`, `time`, `featured`, `file_id`, `created_at`, `updated_at`, `auction_end`, `category_id`, `winners`, `shows`, `active`, `location_id`, `winner_id`) VALUES
(22, 'testtest', NULL, 'dfdfgfdgd', 50, 'dfgdfgdfg', 1, NULL, NULL, 91, '2016-06-23 09:54:09', '2016-06-23 10:29:10', '2016-06-24 12:54:09', 4, 1, NULL, 1, 5, NULL),
(23, 'testtest', NULL, 'dsfsddf', 50, 'dfgfdgdfg', 0, NULL, NULL, 92, '2016-06-23 10:24:56', '2016-06-23 10:37:36', NULL, 3, 1, NULL, 1, 9, NULL),
(24, 'testtest', NULL, 'xcvcxvxcv', 50, 'fdgdfgdfgdfg', 0, NULL, NULL, 93, '2016-06-24 05:46:36', '2016-06-24 05:46:36', NULL, 3, 1, NULL, 1, 4, NULL),
(25, 'NEW TITLE', NULL, 'Description', 12.55, 'hjghjhgjhg', 0, NULL, NULL, 94, '2016-06-24 08:08:21', '2016-06-24 13:37:59', NULL, 1, 1, NULL, 1, 11, NULL),
(26, 'dssdfsdfsdfsdf', NULL, 'details', 56.44, 'fgfdgdfgdfg', 0, NULL, NULL, 96, '2016-06-24 08:13:06', '2016-06-24 13:38:11', NULL, 3, 1, NULL, 1, 16, NULL),
(27, 'sdfsdfsdf', NULL, 'sdfsdfsdf', 50, 'dsfdsfsdf', 0, NULL, NULL, 97, '2016-06-24 08:15:19', '2016-06-24 13:38:18', NULL, 3, 1, NULL, 1, 10, NULL),
(28, 'testtestsdfsdfds', NULL, 'sdfsdfdsfsfdsfds', 2343450, 'cvxvxcvxcvxcv', 0, NULL, NULL, 98, '2016-06-24 09:06:41', '2016-06-24 09:06:41', NULL, 1, 1, NULL, 0, 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `promise_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `promise_id`, `amount`, `users_id`, `created_at`, `updated_at`) VALUES
(20, 22, 1, 114, '2016-06-23 09:54:09', '2016-06-23 09:54:09'),
(21, 23, 1, 114, '2016-06-23 10:24:56', '2016-06-23 10:24:56'),
(22, 24, 1, 114, '2016-06-24 05:46:36', '2016-06-24 05:46:36'),
(23, 25, 5, 114, '2016-06-24 08:08:21', '2016-06-24 08:08:21'),
(24, 26, 5, 114, '2016-06-24 08:13:06', '2016-06-24 08:13:06'),
(25, 27, 1, 114, '2016-06-24 08:15:19', '2016-06-24 08:15:19'),
(26, 28, 1, 114, '2016-06-24 09:06:41', '2016-06-24 09:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `val` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` smallint(6) NOT NULL,
  `name` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `category` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(128) DEFAULT NULL,
  `l_name` varchar(128) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `location_id` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `access` tinyint(4) DEFAULT '0',
  `hash` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `password`, `location_id`, `remember_token`, `updated_at`, `created_at`, `active`, `category_id`, `access`, `hash`) VALUES
(114, 'test_name', 'test_Last_name', 'bog@ram.ru', '$2y$10$E7kjPNO6EzxTC02tiU8/qOTc2/A63nbDGNzso84lzuR9UAxOblyiW', 6, 'oskkJXO1HVoA4IEl0jh53RJzc45B9HMxu55bHCQyHdG7ieYkwYnMVjLF9eb9', '2016-06-24 13:29:41', '2016-06-13 05:03:52', 1, 3, 2, '$2y$10$RsMKb.ZrvG/NI/42QbA.OORpjChsaJBu7oYZPgTTOXobIzRJbSNFy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_file_users1_idx` (`users_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promise`
--
ALTER TABLE `promise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_request_promise1_idx` (`promise_id`),
  ADD KEY `fk_request_users1_idx` (`users_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_location1_idx` (`location_id`),
  ADD KEY `fk_users_category1_idx` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `promise`
--
ALTER TABLE `promise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
