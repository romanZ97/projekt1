-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Aug 2022 um 21:22
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `projekt1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
                         `admin_id` int(11) NOT NULL,
                         `full_name` tinytext NOT NULL,
                         `admin_name` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `token_password` tinytext NOT NULL,
                         `token_sassion` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
                            `category_id` int(11) NOT NULL,
                            `category_name` varchar(255) NOT NULL,
                            `category_image` tinytext NOT NULL,
                            `category_status` enum('1','0') NOT NULL,
                            `category_dashboard` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `country`
--

CREATE TABLE `country` (
                           `country_id` int(11) NOT NULL,
                           `country_name` varchar(80) NOT NULL,
                           `country_short_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dish`
--

CREATE TABLE `dish` (
                        `dish_id` int(11) NOT NULL,
                        `dish_name` varchar(255) NOT NULL,
                        `dish_description` text NOT NULL,
                        `dish_price` decimal(10,2) NOT NULL,
                        `dish_status` enum('1','0') NOT NULL,
                        `dish_dashboard` enum('1','0') NOT NULL,
                        `category_id` int(11) NOT NULL,
                        `meat_type_id` int(11) NOT NULL,
                        `country_id` int(11) NOT NULL,
                        `dish_ch_share` decimal(10,2) DEFAULT NULL,
                        `dish_p_share` decimal(10,2) DEFAULT NULL,
                        `dish_f_share` decimal(10,2) DEFAULT NULL,
                        `dish_image` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `meat_type`
--

CREATE TABLE `meat_type` (
                             `meat_type_id` int(11) NOT NULL,
                             `meat_type_name` varchar(80) NOT NULL,
                             `meat_type_image` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order`
--

CREATE TABLE `order` (
                         `order_id` int(11) NOT NULL,
                         `order_nr` varchar(13) NOT NULL,
                         `order_date` datetime NOT NULL,
                         `order_status` enum('1','0') NOT NULL,
                         `order_price` decimal(10,2) NOT NULL,
                         `order_count_position` int(11) NOT NULL,
                         `order_vat` decimal(2,2) NOT NULL,
                         `user_id` int(11) NOT NULL,
                         `customer_surname` varchar(80) NOT NULL,
                         `customer_forename` varchar(80) NOT NULL,
                         `customer_email` varchar(80) NOT NULL,
                         `customer_address` tinytext NOT NULL,
                         `customer_contact` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order_position`
--

CREATE TABLE `order_position` (
                                  `order_position_id` int(11) NOT NULL,
                                  `order_position_nr` int(11) NOT NULL,
                                  `order_id` int(11) NOT NULL,
                                  `dish_id` int(11) NOT NULL,
                                  `op_dish_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reservation`
--

CREATE TABLE `reservation` (
                               `reservation_id` int(11) NOT NULL,
                               `reservation_nr` int(11) NOT NULL,
                               `reservation_status` enum('1','0') NOT NULL,
                               `reservation_date` date NOT NULL,
                               `reservation_time` time NOT NULL,
                               `table_id` int(11) NOT NULL,
                               `user_id` int(11) DEFAULT NULL,
                               `customer_name` varchar(80) NOT NULL,
                               `customer_contact` varchar(80) NOT NULL,
                               `reservation_seat` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `table`
--

CREATE TABLE `table` (
                         `table_id` int(11) NOT NULL,
                         `table_status` enum('1','0') NOT NULL,
                         `table_seat_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
                        `user_id` int(11) NOT NULL,
                        `user_name` varchar(80) NOT NULL,
                        `user_forename` varchar(80) DEFAULT NULL,
                        `user_surname` varchar(80) DEFAULT NULL,
                        `email` varchar(80) NOT NULL,
                        `password` varchar(255) NOT NULL,
                        `address` tinytext DEFAULT NULL,
                        `contact` varchar(80) DEFAULT NULL,
                        `token_password` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_forename`, `user_surname`, `email`, `password`, `address`, `contact`, `token_password`) VALUES
    (1, 'test', NULL, NULL, 'test@test.te', '$2y$10$9ZgF7HyC9X.QO9Jm2k4CW.84eO0rcZ9VjRbLxKrRaxnf4hAK2wjbC', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_favorit`
--

CREATE TABLE `user_favorit` (
                                `favorite_id` int(11) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                `dish_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`admin_id`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
    ADD PRIMARY KEY (`category_id`);

--
-- Indizes für die Tabelle `country`
--
ALTER TABLE `country`
    ADD PRIMARY KEY (`country_id`);

--
-- Indizes für die Tabelle `dish`
--
ALTER TABLE `dish`
    ADD PRIMARY KEY (`dish_id`),
  ADD KEY `fk_kategorie_id_speise` (`category_id`),
  ADD KEY `fk_speise_land_speise` (`country_id`),
  ADD KEY `fk_fleisch_art_speise` (`meat_type_id`);

--
-- Indizes für die Tabelle `meat_type`
--
ALTER TABLE `meat_type`
    ADD PRIMARY KEY (`meat_type_id`);

--
-- Indizes für die Tabelle `order`
--
ALTER TABLE `order`
    ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_user_id_bestellung` (`user_id`);

--
-- Indizes für die Tabelle `order_position`
--
ALTER TABLE `order_position`
    ADD PRIMARY KEY (`order_position_id`),
  ADD KEY `fk_bestellung_id_bestellung_position` (`order_id`),
  ADD KEY `fk_gericht_id_bestellung_position` (`dish_id`);

--
-- Indizes für die Tabelle `reservation`
--
ALTER TABLE `reservation`
    ADD KEY `fk_user_id_reservierung` (`user_id`),
  ADD KEY `fk_tisch_id_reservierung` (`table_id`);

--
-- Indizes für die Tabelle `table`
--
ALTER TABLE `table`
    ADD PRIMARY KEY (`table_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `user_favorit`
--
ALTER TABLE `user_favorit`
    ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `fk_user_id_user_favorit` (`user_id`),
  ADD KEY `fk_speise_id_user_favorit` (`dish_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
    MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
    MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `country`
--
ALTER TABLE `country`
    MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `dish`
--
ALTER TABLE `dish`
    MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `meat_type`
--
ALTER TABLE `meat_type`
    MODIFY `meat_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `order`
--
ALTER TABLE `order`
    MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `order_position`
--
ALTER TABLE `order_position`
    MODIFY `order_position_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `table`
--
ALTER TABLE `table`
    MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `user_favorit`
--
ALTER TABLE `user_favorit`
    MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `dish`
--
ALTER TABLE `dish`
    ADD CONSTRAINT `fk_fleisch_art_speise` FOREIGN KEY (`meat_type_id`) REFERENCES `meat_type` (`meat_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kategorie_id_speise` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_speise_land_speise` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `order`
--
ALTER TABLE `order`
    ADD CONSTRAINT `fk_user_id_bestellung` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `order_position`
--
ALTER TABLE `order_position`
    ADD CONSTRAINT `fk_bestellung_id_bestellung_position` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_gericht_id_bestellung_position` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`dish_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `reservation`
--
ALTER TABLE `reservation`
    ADD CONSTRAINT `fk_tisch_id_reservierung` FOREIGN KEY (`table_id`) REFERENCES `table` (`table_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_reservierung` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `user_favorit`
--
ALTER TABLE `user_favorit`
    ADD CONSTRAINT `fk_speise_id_user_favorit` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`dish_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_user_favorit` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
