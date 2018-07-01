-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 01. Jul 2018 um 19:41
-- Server-Version: 5.6.38
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `cr11_denis_schuele_php_car_rental`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `telenr` bigint(20) NOT NULL,
  `fk_branch_address_id` int(11) DEFAULT NULL,
  `fk_location_id` int(11) DEFAULT NULL,
  `opening_hours` varchar(12) DEFAULT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `branch`
--

INSERT INTO `branch` (`id`, `telenr`, `fk_branch_address_id`, `fk_location_id`, `opening_hours`, `img`) VALUES
(1, 23421342, 5, 9, '06.00-22.00', 'branch05.jpg'),
(2, 234231423, 1, 1, '00.00-24.00', 'branch04.jpg'),
(3, 43895803, 2, 3, '00.00-24.00', 'branch02.jpg'),
(4, 34534908590, 3, 4, '06.00-22.00', 'branch01.jpg'),
(5, 3453243453, 4, 5, '06.00-22.00', 'branch03.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `branch_address`
--

CREATE TABLE `branch_address` (
  `id` int(11) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `city` varchar(20) NOT NULL,
  `street` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `branch_address`
--

INSERT INTO `branch_address` (`id`, `zipcode`, `city`, `street`, `country`) VALUES
(1, 1300, 'Schwechat', 'Airport', 'Austria'),
(2, 1100, 'Vienna', 'Alfred-Adler-Straße 107', 'Austria'),
(3, 1020, 'Vienna', 'Praterstrasse 1', 'Austria'),
(4, 1110, 'Vienna', 'Guglgasse 6', 'Austria'),
(5, 5020, 'Salzburg', 'Haupftbahnhofstrasse 1', 'Austria');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `fk_location_id` int(11) DEFAULT NULL,
  `fk_car_description_id` int(11) DEFAULT NULL,
  `type` enum('VAN','SUV','Cabrio','Micro Car','Roadster','Combi','LKW') DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `class` enum('Economy','Business','Premium','Luxery') DEFAULT NULL,
  `img` text NOT NULL,
  `available` enum('true','false') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `cars`
--

INSERT INTO `cars` (`id`, `price`, `fk_location_id`, `fk_car_description_id`, `type`, `brand`, `model`, `class`, `img`, `available`) VALUES
(1, 75, 1, 1, 'VAN', 'BMW', '2er Gran Tourer', 'Business', 'car01.png', 'true'),
(2, 110, 8, 2, 'VAN', 'Mercedes', 'Vito', 'Business', 'car02.png', 'false'),
(3, 35, 7, 3, 'Micro Car', 'Toyota', 'Aygo', 'Economy', 'car03.png', 'false'),
(4, 36, 4, 3, 'Micro Car', 'Ford', 'Fiesta', 'Economy', 'car04.png', 'true'),
(5, 39, 4, 4, '', 'Opel', 'Astra', 'Economy', 'car05.png', 'true'),
(6, 80, 5, 1, 'Combi', 'Ford', 'Focus', 'Business', 'car06.png', 'true'),
(7, 88, 1, 1, 'Combi', 'Skoda', 'Octavia', 'Business', 'car07.png', 'true'),
(8, 204, 2, 5, 'Combi', 'BMW', '5er Touring', 'Premium', 'car09.png', 'false'),
(9, 75, 9, 4, 'VAN', 'Ford', 'C-Max', 'Business', 'car08.png', 'true'),
(10, 230, 7, 5, 'SUV', 'BMW', 'X3', 'Luxery', 'car10.png', 'false'),
(11, 91, 8, 1, 'SUV', 'OPEL', 'Antara', 'Business', 'car11.png', 'false'),
(12, 220, 1, 1, 'SUV', 'Ford', 'Edge', 'Premium', 'car12.png', 'false');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `car_descriptions`
--

CREATE TABLE `car_descriptions` (
  `id` int(11) NOT NULL,
  `doors` tinyint(4) NOT NULL,
  `passengers` tinyint(4) NOT NULL,
  `transmittion` enum('Manual','Automatic') NOT NULL,
  `air_condition` enum('Climatronic','Air Condition') NOT NULL,
  `description` text NOT NULL,
  `bags` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `car_descriptions`
--

INSERT INTO `car_descriptions` (`id`, `doors`, `passengers`, `transmittion`, `air_condition`, `description`, `bags`) VALUES
(1, 4, 5, 'Manual', 'Climatronic', 'Haftpflichtversicherung inklusive Österreichische Straßenbenutzungsgebühr inklusive 4.000 Kilometer inklusive Rechnungsversand per E-Mail inklusive ', 3),
(2, 4, 9, 'Manual', 'Climatronic', 'Haftpflichtversicherung inklusive Österreichische Straßenbenutzungsgebühr inklusive 4.000 Kilometer inklusive Rechnungsversand per E-Mail inklusive ', 4),
(3, 2, 4, 'Manual', 'Climatronic', 'Haftpflichtversicherung inklusive Österreichische Straßenbenutzungsgebühr inklusive 4.000 Kilometer inklusive Rechnungsversand per E-Mail inklusive ', 1),
(4, 4, 5, 'Manual', 'Air Condition', 'Haftpflichtversicherung inklusive Österreichische Straßenbenutzungsgebühr inklusive 4.000 Kilometer inklusive Rechnungsversand per E-Mail inklusive ', 2),
(5, 4, 5, 'Automatic', 'Air Condition', 'Haftpflichtversicherung inklusive Österreichische Straßenbenutzungsgebühr inklusive 4.000 Kilometer inklusive Rechnungsversand per E-Mail inklusive', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lon` float(10,6) DEFAULT NULL,
  `location` text,
  `branch` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`id`, `lat`, `lon`, `location`, `branch`) VALUES
(1, 48.106167, 16.568499, 'Airport Vienna', 'true'),
(2, 48.184864, 16.312241, 'Schönbrunn', 'false'),
(3, 48.186668, 16.379999, 'Main Station', 'true'),
(4, 48.209667, 16.390665, 'Prater', 'true'),
(5, 48.185001, 16.420000, 'Gasometer', 'true'),
(6, 46.994045, 15.440131, 'Graz Airtport', 'false'),
(7, 46.638996, 14.335665, 'Klagenfurt Airport', 'false'),
(8, 47.409931, 15.268610, 'Bruck Mur', 'false'),
(9, 47.809490, 13.055010, 'Salzburg City', 'true');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rents`
--

CREATE TABLE `rents` (
  `id` int(11) NOT NULL,
  `fk_car_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `sex` enum('Female','Male','Secret') DEFAULT NULL,
  `ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('User','Co-Admin','Admin') DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `sex`, `ts`, `role`) VALUES
(58, 'testuser@gmx.at', '5d9c68c6c50ed3d02a2fcf54f63993b6', 'Test User', 'Female', '2018-06-30 14:47:57', 'Admin'),
(59, 'denis@gmx.at', '0cc175b9c0f1b6a831c399e269772661', 'a', 'Female', '2018-06-30 15:20:29', 'User');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_location_id` (`fk_location_id`),
  ADD KEY `fk_branch_address_id` (`fk_branch_address_id`);

--
-- Indizes für die Tabelle `branch_address`
--
ALTER TABLE `branch_address`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_location` (`fk_location_id`),
  ADD KEY `fk_car_description_id` (`fk_car_description_id`);

--
-- Indizes für die Tabelle `car_descriptions`
--
ALTER TABLE `car_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_car_id` (`fk_car_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `branch_address`
--
ALTER TABLE `branch_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `car_descriptions`
--
ALTER TABLE `car_descriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `rents`
--
ALTER TABLE `rents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`fk_location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `branch_ibfk_2` FOREIGN KEY (`fk_branch_address_id`) REFERENCES `branch_address` (`id`);

--
-- Constraints der Tabelle `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`fk_location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`fk_car_description_id`) REFERENCES `car_descriptions` (`id`);

--
-- Constraints der Tabelle `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_ibfk_1` FOREIGN KEY (`fk_car_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `rents_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);
