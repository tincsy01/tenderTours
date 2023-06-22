-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Jún 23. 00:29
-- Kiszolgáló verziója: 10.4.22-MariaDB
-- PHP verzió: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tendertours`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `attractions`
--

CREATE TABLE `attractions` (
  `attraction_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `lattitude` varchar(16) NOT NULL,
  `longitude` varchar(16) NOT NULL,
  `num_of_visitors` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `popular` enum('1','2','3','') NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(64) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `attractions`
--

INSERT INTO `attractions` (`attraction_id`, `name`, `lattitude`, `longitude`, `num_of_visitors`, `org_id`, `city_id`, `popular`, `description`, `address`, `category_id`, `image`) VALUES
(24, 'Parliment', '47.4913743', '19.0631325', 3, 18, 11, '1', 'Parliment in Budapest.', 'Vámház krt 1-3', 6, 'parlament.jpg'),
(25, 'Holocaust Memorial Center', '47.4899027', '19.0646685', 12, 18, 11, '1', 'Holocaust Memorial Center', 'Páva u. 39', 1, 'centar.jpg'),
(26, 'Zwack Unicum Museum', '47.4800531', '19.062538', 2, 18, 11, '1', 'Zwack Unicum Museum', 'Dandár utca 1.', 1, 'unicum.jpg'),
(27, 'Corvin Plaza Shopping Mall', '47.4855609', '19.0597312', 9, 18, 11, '1', 'Corvin Plaza', 'Futó utca 37', 7, 'corvin.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Museum'),
(2, 'Curch'),
(3, 'Park'),
(4, 'Square'),
(5, 'Statue'),
(6, 'City hall'),
(7, 'Market'),
(8, 'Bus station'),
(9, 'Train station');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `organization_name` varchar(32) NOT NULL,
  `city_name` varchar(32) NOT NULL,
  `longitude` float NOT NULL,
  `lattitude` float NOT NULL,
  `checked` int(11) DEFAULT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `cities`
--

INSERT INTO `cities` (`city_id`, `organization_name`, `city_name`, `longitude`, `lattitude`, `checked`, `image`) VALUES
(5, 'Subotica', 'Subotica', 40.55, 13.78, 0, 'szabadka.jpg'),
(11, 'Budapest', 'Budapest', 46.1009, 19.6698, NULL, 'pest.jpg'),
(12, 'Bačka Topola', 'Bačka Topola', 19.5827, 45.7979, NULL, 'topola.jpg'),
(13, 'Szeged', 'Szeged', 46.1009, 19.6698, NULL, 'szeged.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `user_id`, `tour_id`, `attraction_id`) VALUES
(2, 'meno hely', 11, 0, 26),
(3, 'akarmi', 11, 0, 26),
(4, 'ammen', 11, 0, 25),
(5, 'ammen', 11, 0, 25),
(6, 'huikh', 11, 0, 24),
(7, 'bumm', 11, 0, 26);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `favourites`
--

CREATE TABLE `favourites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `favourites`
--

INSERT INTO `favourites` (`favorite_id`, `user_id`, `attraction_id`) VALUES
(4, 11, 25);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `attraction_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `organizations`
--

CREATE TABLE `organizations` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(64) NOT NULL,
  `city_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `permission` int(11) NOT NULL DEFAULT 3,
  `status` int(11) NOT NULL,
  `reg_expire` datetime NOT NULL,
  `new_password` varchar(128) NOT NULL,
  `new_password_expire` datetime NOT NULL,
  `code` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `organizations`
--

INSERT INTO `organizations` (`org_id`, `org_name`, `city_id`, `username`, `email`, `password`, `phone`, `address`, `description`, `active`, `permission`, `status`, `reg_expire`, `new_password`, `new_password_expire`, `code`) VALUES
(17, 'Bačka Topola', 12, 'topola', 'tincsy01@gmail.com', '$2y$10$/qTiX9K/yZCoeVZW3b9y7OpxWSWTrluOwQ2cTCVWxqU8b6su0iiXO', '024221234', 'Gavrilo Princip 10', 'Organization from Bačka Topola', 1, 3, 1, '2023-05-07 00:00:00', '', '0000-00-00 00:00:00', 2147483647),
(18, 'Budapest', 11, 'budapest', 'tincsy01@gmail.com', '$2y$10$6PC8Qjlqbi87h9rm1bvJlesvyp46xux.6i8N6tX3XFAtV7kSAG5FS', '06561706', 'Partizanska 8.', 'Organizations from Budapest', 1, 3, 1, '2023-05-07 00:00:00', '', '0000-00-00 00:00:00', 2147483647),
(19, 'Szeged', 5, 'subotica', 'tincsy01@gmail.com', '$2y$10$tqw7P6eqnPmXDAr937fHPuv5ll2dzznvP0xKs7mEom.G/yR2fuiVe', '06561706', 'Korzo 1', 'Organization from Subotica', 0, 3, 1, '2023-05-07 00:00:00', '', '0000-00-00 00:00:00', 2147483647),
(20, 'Szeged', 13, 'szeged', 'szeged@gmail.com', '$2y$10$jNOiqAs8st9pOIu1/Go2oesLbTr7bQjQYMWfCFb1g4zNVdC6WZdd6', '06561706', 'Partizanska 8.', 'Szeged', 1, 3, 1, '2023-06-23 00:00:00', '', '0000-00-00 00:00:00', 2147483647);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `popularity`
--

CREATE TABLE `popularity` (
  `popularity_id` int(11) NOT NULL,
  `evaluation` enum('1','2','3','4','5') NOT NULL,
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tours`
--

CREATE TABLE `tours` (
  `tour_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `tour_name` varchar(64) NOT NULL,
  `duration` enum('1','2','3','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `tours`
--

INSERT INTO `tours` (`tour_id`, `date`, `user_id`, `city_id`, `tour_name`, `duration`) VALUES
(17, '2023-05-25 22:52:00', 11, 11, '', '1'),
(18, '2023-05-26 21:44:00', 11, 11, '', '1'),
(19, '2023-05-18 23:59:00', 11, 11, '', '1'),
(20, '2023-05-11 15:32:00', 11, 11, '', '1'),
(21, '2023-05-26 14:36:00', 11, 11, '', '1'),
(22, '2023-05-22 13:14:00', 11, 11, '', '1'),
(23, '2023-06-28 23:01:00', 11, 11, '', '1'),
(24, '2023-06-29 00:54:00', 11, 11, '', '1'),
(25, '2023-07-05 21:59:00', 11, 11, '', '1'),
(26, '2023-06-24 21:01:00', 11, 11, '', '1'),
(27, '2023-07-13 23:01:00', 11, 11, '', '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tour_attraction`
--

CREATE TABLE `tour_attraction` (
  `tour_attraction` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `tour_attraction`
--

INSERT INTO `tour_attraction` (`tour_attraction`, `tour_id`, `attraction_id`) VALUES
(1, 17, 24),
(2, 17, 25),
(3, 18, 24),
(4, 18, 25),
(5, 18, 26),
(6, 18, 27),
(7, 19, 24),
(8, 20, 24),
(9, 20, 25),
(10, 20, 27),
(11, 21, 24),
(12, 21, 26),
(13, 22, 24),
(14, 22, 25),
(15, 22, 26),
(16, 23, 24),
(17, 24, 24),
(18, 24, 26),
(19, 25, 26),
(20, 25, 27),
(21, 26, 24),
(22, 26, 27),
(23, 27, 24);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `new_password` varchar(64) NOT NULL,
  `address` varchar(64) NOT NULL,
  `permission` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `image` varchar(128) NOT NULL,
  `reg_expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `new_password`, `address`, `permission`, `active`, `code`, `status`, `image`, `reg_expire`) VALUES
(2, 'Rózsa Attila', 'atesz', 'rattila994@gmail.com', '$2y$10$GR2MLW3yQTN3ZbZT1rhQBuK3Ij/lzAM5wgX5r92iZdFPvY16MpEjS', '', 'Partizanska 8.', 2, 0, '', 0, '', '0000-00-00 00:00:00'),
(4, 'Kristina Kočiš', 'admin', 'tincsy0881@gmail.com', '$2y$10$mhTj7wE83JG09XsK6MjZOut2CROhzfYIka20xvxxKqI0YYt9Hg5eW', '', 'Partizanska 8.', 1, 1, '', 0, '', '0000-00-00 00:00:00'),
(5, 'Kristina Kočiš', 'krixta1', 'tincsy041641@gmail.com', '$2y$10$PIButS9tW6DhE19XGJOs8.l9qk8q1H3HGs6wxu8rFfZcb/cIzl4qS', '', 'Partizanska 8.', 2, 1, '5396028149243347761874134007639900987868', 0, '', '2023-02-20 00:00:00'),
(6, 'Kristina Kočiš', 'krixta2', 'tincsy8901@gmail.com', '$2y$10$/7iprXJSAezE9rNjTwtO5.Q50CL06p/bVXGreFeuqvJAdjLsq45GW', '', 'Partizanska 8.', 2, 1, '2819914470596000961194134971517798481454', 0, '', '2023-02-20 00:00:00'),
(7, 'Kristina Kočiš', 'admin', 'tincsy1501@gmail.com', '$2y$10$LOWg9vg0Yck1BnVAE5wwRu6yR9YYQVby69Qgd4UwnXi9bLALlr6Jy', '', 'Partizanska 8.', 0, 1, '2911948304506651884843540273251696365345', 0, '', '2023-02-20 00:00:00'),
(8, 'Kristina Kočiš', 'erzsi1', 'admin@admin.com', '$2y$10$Sgu9BUvBZhQhusrOM4cF7e6eYdAE7wb00rP6CJOI/06BZNcREm.uK', '', 'Partizanska 8.', 2, 1, '4211662034180887368304767703598347196650', 0, '', '2023-02-20 00:00:00'),
(9, 'irma', 'irma', 'tincsy101@gmail.com', '$2y$10$.bsPyC3T3q8LkEMy3lBL/utptwL3jzBRCS7Yy.NZptaHqEGmRRosi', '', 'ledijaiojf njdi 5', 0, 0, '5137353364807183981048193706381830174677', 0, '', '2023-03-20 00:00:00'),
(10, 'Kristina Kočiš', 'erzsi', 'tincsy021@gmail.com', '$2y$10$8XbRd6q2MqrgY7qEO5CsMO9.NA2TjeXngU2jsyQnYQUZUCnXiJugu', '', 'Partizanska 8.', 2, 1, '7782464584117484307193567205144901282896', 0, '', '2023-03-24 00:00:00'),
(11, 'feri', 'feri', 'tincsy011@gmail.com', '$2y$10$8cZlp.TFqlAIxMOWn3ccuuC7gFxLlDZznIzSQ8vP/Bo.fMHS3PfUS', '', 'Bolmanska 12.', 2, 1, '7952264378509105924629497580036429402355', 0, '', '2023-05-09 00:00:00'),
(13, 'Kristina Kočiš', 'krixta3', 'tincsy01@gmail.com', '$2y$10$.H6fGbT88dn0tHJrXxvV0ut2ceKHCfV9xlMNLgle4XQyIfhxcBldC', '', 'Partizanska 8.', 2, 0, '6515171146177095789361779170987338942827', 0, '', '2023-06-21 00:00:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_email_failure`
--

CREATE TABLE `user_email_failure` (
  `user_email_failure_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_time_added` datetime NOT NULL,
  `date_time_tried` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `visitors`
--

CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `attractions`
--
ALTER TABLE `attractions`
  ADD PRIMARY KEY (`attraction_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `category_id` (`category_id`);

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- A tábla indexei `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `attraction_id` (`attraction_id`);

--
-- A tábla indexei `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `attraction_id` (`attraction_id`);

--
-- A tábla indexei `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `attraction_id` (`attraction_id`);

--
-- A tábla indexei `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`org_id`),
  ADD KEY `city_id` (`city_id`);

--
-- A tábla indexei `popularity`
--
ALTER TABLE `popularity`
  ADD PRIMARY KEY (`popularity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `tour_attraction`
--
ALTER TABLE `tour_attraction`
  ADD PRIMARY KEY (`tour_attraction`),
  ADD KEY `attraction_id` (`attraction_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- A tábla indexei `user_email_failure`
--
ALTER TABLE `user_email_failure`
  ADD PRIMARY KEY (`user_email_failure_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `attractions`
--
ALTER TABLE `attractions`
  MODIFY `attraction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `favourites`
--
ALTER TABLE `favourites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `organizations`
--
ALTER TABLE `organizations`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `popularity`
--
ALTER TABLE `popularity`
  MODIFY `popularity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT a táblához `tour_attraction`
--
ALTER TABLE `tour_attraction`
  MODIFY `tour_attraction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `user_email_failure`
--
ALTER TABLE `user_email_failure`
  MODIFY `user_email_failure_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `attractions`
--
ALTER TABLE `attractions`
  ADD CONSTRAINT `attractions_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attractions_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attractions_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`);

--
-- Megkötések a táblához `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `images_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `popularity`
--
ALTER TABLE `popularity`
  ADD CONSTRAINT `popularity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tours_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tours_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `tour_attraction`
--
ALTER TABLE `tour_attraction`
  ADD CONSTRAINT `tour_attraction_ibfk_1` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_attraction_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `user_email_failure`
--
ALTER TABLE `user_email_failure`
  ADD CONSTRAINT `user_email_failure_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visitors_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
