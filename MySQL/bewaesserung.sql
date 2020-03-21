-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 20. Mrz 2020 um 07:43
-- Server-Version: 5.5.60-0+deb7u1-log
-- PHP-Version: 5.6.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bewaesserung`
--

CREATE TABLE `bewaesserung` (
  `id` int(11) NOT NULL,
  `datum` varchar(100) NOT NULL,
  `zeit` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `battery` varchar(150) NOT NULL,
  `temp` varchar(150) NOT NULL,
  `light` varchar(150) NOT NULL,
  `feucht` varchar(150) NOT NULL,
  `leit` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bewaesserung`
--
ALTER TABLE `bewaesserung`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bewaesserung`
--
ALTER TABLE `bewaesserung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
