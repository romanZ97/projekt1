SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `admin` (
                         `id` int(11) NOT NULL,
                         `full_name` varchar(160) NOT NULL,
                         `username` varchar(80) NOT NULL,
                         `email` varchar(120) NOT NULL,
                         `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`id`, `full_name`, `username`, `email`, `password`) VALUES
    (1, 'test', 'test_admin', 'test@test.t', '202cb962ac59075b964b07152d234b70');

CREATE TABLE `admin_manage` (
                                `id` int(10) UNSIGNED NOT NULL,
                                `full_name` varchar(100) NOT NULL,
                                `username` varchar(100) NOT NULL,
                                `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin_manage` (`id`, `full_name`, `username`, `password`) VALUES
    (1, 'Hauptadmin', 'admin', 'e00cf25ad42683b3df678c61f42c6bda');

CREATE TABLE `category` (
                            `id` int(11) NOT NULL,
                            `category_name` varchar(80) NOT NULL,
                            `image_name` varchar(100) NOT NULL,
                            `featured` varchar(10) NOT NULL,
                            `active` varchar(10) NOT NULL,
                            `icon_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `category` (`id`, `category_name`, `image_name`, `featured`, `active`, `icon_name`) VALUES
                                                                                                    (1, 'Vorspeise', 'vorspeise.png', 'ja', 'ja', 'appetizer'),
                                                                                                    (2, 'Für die Kleinen', 'kinder.png', 'ja', 'ja', 'child'),
                                                                                                    (3, 'Hauptspeisen', 'hauptspeise.png', 'ja', 'ja', 'main'),
                                                                                                    (4, 'Dessert', 'dessert.png', 'ja', 'ja', 'dessert'),
                                                                                                    (5, 'Getränke', 'getränke.png', 'Ja', 'Ja', 'drink');

CREATE TABLE `country` (
                           `id` int(11) NOT NULL,
                           `country_name` varchar(80) NOT NULL,
                           `country_short_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `country` (`id`, `country_name`, `country_short_name`) VALUES
                                                                       (1, 'Deutschland', 'de'),
                                                                       (2, 'Amerika', 'usa'),
                                                                       (3, 'Türkei', 'tur'),
                                                                       (4, 'Syrien', 'syr'),
                                                                       (5, 'Kamerun', 'cmr'),
                                                                       (6, 'Kasachstan', 'kaz'),
                                                                       (7, 'Italien', 'ita'),
                                                                       (8, 'Indien', 'ind'),
                                                                       (9, 'Spanien', 'esp');

CREATE TABLE `food` (
                        `id` int(10) NOT NULL,
                        `title` varchar(150) NOT NULL,
                        `description` varchar(255) NOT NULL,
                        `price` decimal(10,2) NOT NULL,
                        `image_name` varchar(80) NOT NULL,
                        `category_id` int(11) NOT NULL,
                        `meat_type_id` int(11) DEFAULT NULL,
                        `country_id` int(11) DEFAULT NULL,
                        `food_portion` int(11) DEFAULT NULL,
                        `food_portion_unit` varchar(30) DEFAULT NULL,
                        `featured` varchar(10) NOT NULL,
                        `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `meat_type_id`, `country_id`, `food_portion`, `food_portion_unit`, `featured`, `active`) VALUES
                                                                                                                                                                                     (1, 'Beshbarmak', 'Lorem ipsum dolor sit amet, consetetur sadipscing ...', '17.50', 'beshbarmak.png', 3, 1, 6, 300, 'g', 'ja', 'ja'),
                                                                                                                                                                                     (2, 'Pommes mit Ketchup', 'Panierte, frisch geschälte Kartoffelstangen mit hausgemachtem Ketchup aus frischem Tomatenmark mit frischen Gewürzen.', '2.75', 'pommes-frites.png', 1, 6, 2, 200, 'g', 'ja', 'ja'),
                                                                                                                                                                                     (4, 'Test2', 'Lorem ipsum dolor sit amet, consetetur sadipscing ...', '111.00', 'Product-Name-6499.png', 3, 99, 1, 999, 'x', 'ja', 'Ja'),
                                                                                                                                                                                     (13, 'Test', 'Lorem ipsum dolor sit amet, consetetur sadipscing ...', '45.25', 'Product-Name-6499.png', 1, 6, 2, 999, 'bq', 'ja', 'ja'),
                                                                                                                                                                                     (14, 'X1', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '55.50', 'logo.png', 4, 6, 7, 1, 'St.', 'ja', 'ja'),
                                                                                                                                                                                     (15, 'X2', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 4, 6, 7, 1, 'St.', 'nein', 'ja'),
                                                                                                                                                                                     (17, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 4, 6, 7, 1, 'St.', 'ja', 'ja'),
                                                                                                                                                                                     (18, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 4, 6, 7, 1, 'St.', 'nein', 'ja'),
                                                                                                                                                                                     (25, 'X3', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 4, 6, 7, 1, 'St.', 'ja', 'ja'),
                                                                                                                                                                                     (27, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 2, 6, 7, 1, 'St.', 'nein', 'ja'),
                                                                                                                                                                                     (28, 'X4', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 2, 6, 7, 1, 'St.', 'ja', 'ja'),
                                                                                                                                                                                     (29, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 2, 6, 7, 1, 'St.', 'nein', 'ja'),
                                                                                                                                                                                     (30, 'X5', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 2, 6, 7, 1, 'St.', 'ja', 'ja'),
                                                                                                                                                                                     (39, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 5, 7, 7, 1, 'St.', 'nein', 'ja'),
                                                                                                                                                                                     (40, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 5, 7, 7, 1, 'St.', 'ja', 'ja'),
                                                                                                                                                                                     (41, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 5, 7, 7, 1, 'St.', 'nein', 'ja'),
                                                                                                                                                                                     (42, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 5, 7, 7, 1, 'St.', 'ja', 'ja'),
                                                                                                                                                                                     (43, 'XXXXXXXXXXXXXX', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '999.99', 'logo.png', 5, 7, 7, 1, 'St.', 'nein', 'ja'),
                                                                                                                                                                                     (52, 'TestS2', 'Lorem ipsum dolor sit amet, consetetur sadipscing ...', '20.25', 'DishName-6278.png', 1, 3, 1, 250, 'g', 'Ja', 'Ja');

CREATE TABLE `meat_type` (
                             `id` int(11) NOT NULL,
                             `meat_type_name` varchar(80) NOT NULL,
                             `icon_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `meat_type` (`id`, `meat_type_name`, `icon_name`) VALUES
                                                                  (1, 'Rind', 'beef'),
                                                                  (2, 'Schwein', 'pig'),
                                                                  (3, 'Lamm', 'lamb'),
                                                                  (4, 'Fisch', 'fish'),
                                                                  (5, 'Geflügel', 'chiken'),
                                                                  (6, 'Vegan', 'vegan'),
                                                                  (7, 'Drink', 'drink'),
                                                                  (99, 'NA', 'na');

CREATE TABLE `ordering` (
                            `id` int(10) NOT NULL,
                            `order_nr` int(11) NOT NULL,
                            `total_price` decimal(10,2) DEFAULT 0.00,
                            `total_qty` int(11) DEFAULT 0,
                            `order_date` datetime NOT NULL,
                            `status` varchar(60) NOT NULL,
                            `user_id` int(11) DEFAULT NULL,
                            `customer_surname` varchar(30) DEFAULT NULL,
                            `customer_forename` varchar(30) DEFAULT NULL,
                            `customer_contact` varchar(20) DEFAULT NULL,
                            `customer_email` varchar(120) DEFAULT NULL,
                            `customer_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ordering` (`id`, `order_nr`, `total_price`, `total_qty`, `order_date`, `status`, `user_id`, `customer_surname`, `customer_forename`, `customer_contact`, `customer_email`, `customer_address`) VALUES
                                                                                                                                                                                                                (100, 6196, '2.75', 1, '2022-09-30 12:30:03', 'open', 6, 'Muster', 'Muster', '0123123123', 't@t.t', '00000 Muster Muster 0'),
                                                                                                                                                                                                                (101, 4906, '37.75', 3, '2022-09-30 12:31:42', 'open', 6, 'Muster', 'Muster', '0123123123', 't@t.t', '00000 Muster Muster 0'),
                                                                                                                                                                                                                (102, 1768, '20.25', 2, '2022-09-30 12:32:09', 'in lieferung', 6, 'Muster', 'Muster', '0123123123', 't@t.t', '00000 Muster Muster 0'),
                                                                                                                                                                                                                (103, 4964, '17.50', 1, '2022-09-30 13:56:42', 'open', 6, NULL, NULL, NULL, NULL, NULL);

CREATE TABLE `order_position` (
                                  `id` int(11) NOT NULL,
                                  `order_id` int(11) NOT NULL,
                                  `food_id` int(11) NOT NULL,
                                  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `order_position` (`id`, `order_id`, `food_id`, `qty`) VALUES
                                                                      (630, 100, 2, 1),
                                                                      (631, 101, 1, 2),
                                                                      (632, 101, 2, 1),
                                                                      (633, 102, 1, 1),
                                                                      (634, 102, 2, 1),
                                                                      (635, 103, 1, 1);

CREATE TABLE `table_reservation` (
                                     `id` int(11) NOT NULL,
                                     `table_seat_count` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `table_reservation` (`id`, `table_seat_count`) VALUES
                                                               (1, 2),
                                                               (2, 2),
                                                               (3, 2),
                                                               (4, 2),
                                                               (5, 2),
                                                               (6, 2),
                                                               (7, 2),
                                                               (8, 4),
                                                               (9, 4),
                                                               (10, 4),
                                                               (11, 4),
                                                               (12, 4),
                                                               (13, 4),
                                                               (14, 4),
                                                               (15, 4),
                                                               (16, 4),
                                                               (17, 4),
                                                               (18, 4),
                                                               (19, 4),
                                                               (20, 4),
                                                               (21, 4),
                                                               (22, 4),
                                                               (23, 4),
                                                               (24, 4),
                                                               (25, 4),
                                                               (26, 4),
                                                               (27, 4),
                                                               (28, 4),
                                                               (29, 4),
                                                               (30, 4),
                                                               (31, 4),
                                                               (32, 4),
                                                               (33, 6),
                                                               (34, 6),
                                                               (35, 6),
                                                               (36, 6),
                                                               (37, 10),
                                                               (38, 10);

CREATE TABLE `tbl_reservation` (
                                   `id` int(11) NOT NULL,
                                   `reservation_nr` int(11) NOT NULL,
                                   `reservation_status` varchar(60) NOT NULL,
                                   `reservation_date` date NOT NULL,
                                   `reservation_time` time NOT NULL,
                                   `table_id` int(11) NOT NULL,
                                   `user_id` int(11) DEFAULT NULL,
                                   `customer_name` varchar(80) NOT NULL,
                                   `customer_email` varchar(120) NOT NULL,
                                   `customer_contact` varchar(20) NOT NULL,
                                   `reservation_seat` int(3) NOT NULL,
                                   `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_reservation` (`id`, `reservation_nr`, `reservation_status`, `reservation_date`, `reservation_time`, `table_id`, `user_id`, `customer_name`, `customer_email`, `customer_contact`, `reservation_seat`, `message`) VALUES
    (4, 629, 'done', '2022-09-30', '23:59:00', 1, NULL, 'XXXXXXX', 'roman.zhuravel@mnd.thm.de', '0123133', 0, 'BL');

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `user_name` varchar(80) NOT NULL,
                        `user_forename` varchar(80) NOT NULL,
                        `user_surname` varchar(80) NOT NULL,
                        `email` varchar(120) NOT NULL,
                        `password` varchar(255) NOT NULL,
                        `address` varchar(255) NOT NULL,
                        `contact` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `user_name`, `user_forename`, `user_surname`, `email`, `password`, `address`, `contact`) VALUES
                                                                                                                       (4, 't', 'Test', 'Test', 'test@test.test', '$2y$10$Vg3apFRZ0RmHHRxE/CP./uLQbDn7Qw8RVh3wBM1nlh0qKQHeRqgwe', '00000 TestOrt, TestStrasse 00', '+49123456789'),
                                                                                                                       (5, 'test', '', '', 'test.t@t.t', '$2y$10$fcJbNAzK.r0roAGWl0ZgpuuAa5sZgjLP6C/Cah4P9Xh5CYp84v8OC', '', ' 4900'),
                                                                                                                       (6, 'tt', 'Muster', 'Muster', 't@t.t', '$2y$10$w67B4z.mmQM0LVjTrFlqr.qaicaLfPRZCVbvacdZPgaMYsUdO9Vki', '00000 Muster Muster 0', '0123123123');

CREATE TABLE `user_favorit` (
                                `id` int(11) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                `food_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_favorit` (`id`, `user_id`, `food_id`) VALUES
                                                            (163, 4, 1),
                                                            (176, 4, 2);


ALTER TABLE `admin`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `admin_manage`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `category`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `country`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `food`
    ADD PRIMARY KEY (`id`),
  ADD KEY `meat_type_id` (`meat_type_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

ALTER TABLE `meat_type`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `ordering`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

ALTER TABLE `order_position`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id_2` (`order_id`,`food_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

ALTER TABLE `table_reservation`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_reservation`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `table_id` (`table_id`);

ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `user_favorit`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_food_id_user_favorite` (`food_id`),
  ADD KEY `fk_user_id_user_favorite` (`user_id`);


ALTER TABLE `admin`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `admin_manage`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `category`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `country`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `food`
    MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE `meat_type`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

ALTER TABLE `ordering`
    MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

ALTER TABLE `order_position`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=636;

ALTER TABLE `tbl_reservation`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `user_favorit`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;


ALTER TABLE `food`
    ADD CONSTRAINT `fk_category_id_food` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_country_id_food` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_meat_type_id_food` FOREIGN KEY (`meat_type_id`) REFERENCES `meat_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ordering`
    ADD CONSTRAINT `fk_user_id_ordering` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `order_position`
    ADD CONSTRAINT `fk_food_id_order_position` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_id_order_position` FOREIGN KEY (`order_id`) REFERENCES `ordering` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_reservation`
    ADD CONSTRAINT `fk_table_id_reservatinon` FOREIGN KEY (`table_id`) REFERENCES `table_reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_reservation` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `user_favorit`
    ADD CONSTRAINT `fk_food_id_user_favorite` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_user_favorite` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
