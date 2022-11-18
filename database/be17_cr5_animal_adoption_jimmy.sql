-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Nov 2022 um 11:23
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be17_cr5_animal_adoption_jimmy`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `vaccinated` enum('yes','no') DEFAULT NULL,
  `breed` varchar(35) DEFAULT NULL,
  `status` enum('adopted','available') DEFAULT NULL,
  `name` varchar(35) NOT NULL,
  `image` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`animal_id`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`, `name`, `image`, `address`) VALUES
(1, 'Our funny Snoop will make you happy', 43, 4, 'yes', 'dog', 'available', 'Snoop', 'https://cdn.pixabay.com/photo/2017/09/25/13/12/puppy-2785074__480.jpg', 'prater 25'),
(2, 'This cat love to play hide and seek', 40, 9, 'yes', 'cat', 'available', 'Shadow', 'https://cdn.pixabay.com/photo/2015/03/27/13/16/maine-coon-694730__480.jpg', 'wien 1180'),
(3, 'Love to watch TV while eating', 12, 2, 'yes', 'edgehog', 'available', 'Sonic', 'https://cdn.pixabay.com/photo/2016/02/22/10/06/hedgehog-1215140__480.jpg', 'wienerwald 87/3'),
(4, 'A real entertainer for the whole family', 22, 12, 'yes', 'parrot', 'available', 'Samba', 'https://cdn.pixabay.com/photo/2018/08/12/16/59/parrot-3601194__480.jpg', 'Vogelhaus, tiergarten 1140 wien'),
(5, 'Love to play Rock n roll, but he is addicted to smoking', 82, 15, 'yes', 'monkey', 'available', 'Gorillaz', 'https://cdn.pixabay.com/photo/2018/06/30/09/29/monkey-3507317__480.jpg', 'Stadtpark 1020 Wien'),
(6, 'Really protective and smart, she is better than any alarm system', 36, 11, 'yes', 'owl', 'available', 'Holy', 'https://cdn.pixabay.com/photo/2018/09/02/15/34/owl-3649048__480.jpg', 'Wien 1230'),
(7, 'With him you will not need a car anymore, he loves bringing eople everywhere', 230, 7, 'yes', 'horse', 'available', 'Pegasus', 'https://cdn.pixabay.com/photo/2016/11/06/22/58/horse-1804425__480.jpg', 'Mödling horsestraße 3'),
(8, 'really into fashion, do not mess with his hair', 190, 6, 'yes', 'cow', 'available', 'Justin', 'https://cdn.pixabay.com/photo/2014/08/30/18/19/cow-431729__480.jpg', 'Bauernstraße 11'),
(9, 'A show on your aquarium', 13, 2, 'no', 'jellyfish', 'available', 'the Jellys', 'https://cdn.pixabay.com/photo/2020/01/12/19/55/jellyfish-4760924__480.jpg', 'Seaquariumstraße 88'),
(10, 'Nedd someone to play with in your swimming pool, he is here for you', 140, 6, 'yes', 'shark', 'available', 'Sharko', 'https://cdn.pixabay.com/photo/2018/03/04/09/41/shark-3197585__480.jpg', 'Donaukanal 33');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `adopt_id` int(11) NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_animal_id` int(11) DEFAULT NULL,
  `adoption_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(35) DEFAULT NULL,
  `last_name` varchar(35) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` int(15) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('user','administrator') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indizes für die Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adopt_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adopt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_3` FOREIGN KEY (`fk_animal_id`) REFERENCES `animals` (`animal_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
