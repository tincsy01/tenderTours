-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Feb 28. 15:58
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
  `lattitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `num_of_visitors` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `popularity_rating` enum('1','2','3','4','5') NOT NULL,
  `popular` enum('1','2','3','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `checked` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `cities`
--

INSERT INTO `cities` (`city_id`, `organization_name`, `city_name`, `longitude`, `lattitude`, `checked`) VALUES
(1, 'Kristina', 'Gunaros', 0, 0, 0),
(2, '', 'Gunaros', 40.55, 13.78, 0),
(3, '', 'Subotica', 40.55, 14.8, 0),
(4, '', 'Gunaras', 40.55, 13.78, 0),
(5, '', 'valami', 40.55, 13.78, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `reg_expire` datetime NOT NULL,
  `new_password` varchar(128) NOT NULL,
  `new_password_expire` datetime NOT NULL,
  `code` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `organizations`
--

INSERT INTO `organizations` (`org_id`, `org_name`, `city_id`, `username`, `email`, `password`, `phone`, `address`, `description`, `active`, `reg_expire`, `new_password`, `new_password_expire`, `code`) VALUES
(4, 'Kristina', 1, 'krixta', 'tincsy01@gmail.com', '$2y$10$WwtXzhqKBiKc9aSWqjr5/elZMGko1pr6q5syxWf0A9b1BDzmz30Ny', '06561706', 'Bolmanska 12.', 'sgczudxgzuf', NULL, '2023-02-28 00:00:00', '', '0000-00-00 00:00:00', 2147483647);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tours`
--

CREATE TABLE `tours` (
  `tour_id` int(11) NOT NULL,
  `attractions` varchar(128) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `tour_name` varchar(64) NOT NULL,
  `duration` enum('1','2','3','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Rózsa Attila', 'atesz', 'rattila994@gmail.com', '$2y$10$GR2MLW3yQTN3ZbZT1rhQBuK3Ij/lzAM5wgX5r92iZdFPvY16MpEjS', '', 'Partizanska 8.', 2, 1, '', 0, '', '0000-00-00 00:00:00'),
(4, 'Kristina Kočiš', 'admin', 'tincsy01@gmail.com', '$2y$10$mhTj7wE83JG09XsK6MjZOut2CROhzfYIka20xvxxKqI0YYt9Hg5eW', '', 'Partizanska 8.', 1, 1, '', 0, '', '0000-00-00 00:00:00'),
(5, 'Kristina Kočiš', 'krixta', 'tincsy01@gmail.com', '$2y$10$PIButS9tW6DhE19XGJOs8.l9qk8q1H3HGs6wxu8rFfZcb/cIzl4qS', '', 'Partizanska 8.', 0, 0, '5396028149243347761874134007639900987868', 0, '', '2023-02-20 00:00:00'),
(6, 'Kristina Kočiš', 'krixta', 'tincsy01@gmail.com', '$2y$10$/7iprXJSAezE9rNjTwtO5.Q50CL06p/bVXGreFeuqvJAdjLsq45GW', '', 'Partizanska 8.', 0, 0, '2819914470596000961194134971517798481454', 0, '', '2023-02-20 00:00:00'),
(7, 'Kristina Kočiš', 'admin', 'tincsy01@gmail.com', '$2y$10$LOWg9vg0Yck1BnVAE5wwRu6yR9YYQVby69Qgd4UwnXi9bLALlr6Jy', '', 'Partizanska 8.', 0, 0, '2911948304506651884843540273251696365345', 0, '', '2023-02-20 00:00:00'),
(8, 'Kristina Kočiš', 'erzsi', 'admin@admin.com', '$2y$10$Sgu9BUvBZhQhusrOM4cF7e6eYdAE7wb00rP6CJOI/06BZNcREm.uK', '', 'Partizanska 8.', 0, 0, '4211662034180887368304767703598347196650', 0, '', '2023-02-20 00:00:00');

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
  ADD KEY `city_id` (`city_id`);

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
  ADD KEY `tour_id` (`tour_id`);

--
-- A tábla indexei `favorites`
--
ALTER TABLE `favorites`
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
-- A tábla indexei `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `attraction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `organizations`
--
ALTER TABLE `organizations`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  ADD CONSTRAINT `attractions_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Megkötések a táblához `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tours_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tours_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
