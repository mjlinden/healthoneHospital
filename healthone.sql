-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 dec 2020 om 12:37
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthone`
--
CREATE DATABASE IF NOT EXISTS `healthone` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `healthone`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201222130453', '2020-12-22 14:05:16', 62),
('DoctrineMigrations\\Version20201222133824', '2020-12-22 14:38:47', 62),
('DoctrineMigrations\\Version20201222134100', '2020-12-22 14:41:10', 58);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medicijn`
--

CREATE TABLE `medicijn` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `werking` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bijwerking` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kosten` decimal(8,2) NOT NULL,
  `verzekerd` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `medicijn`
--

INSERT INTO `medicijn` (`id`, `naam`, `werking`, `bijwerking`, `kosten`, `verzekerd`) VALUES
(1, 'Paracetamol', 'Paracetamol is een pijnstiller. Het verlaagt ook koorts.\r\nBij verschillende soorten pijn, zoals: hoofdpijn, migraine, keelpijn, oorpijn, spierpijn, gewrichtspijn, menstruatie klachten en artrose (pijn doordat uw gewrichts kraakbeen dunner wordt). Ook bij koorts, griep en verkoudheid.', 'Deze hoofdpijn kan ontstaan als u dit medicijn meer dagen wel dan niet tegen hoofdpijn gebruikt. Na enige tijd ontstaat de hoofdpijn als u het medicijn even niet slikt of later dan gebruikelijk. U kunt er zo afhankelijk van worden.', '1.89', 0),
(2, 'Nivestim', 'Filgrastim-injecties stimuleren het beenmerg om bepaalde witte bloedcellen te maken. Deze witte bloedcellen zijn belangrijk bij de afweer tegen infecties.\r\nOm infecties te voorkomen bij mensen met een verminderde afweer. Bijvoorbeeld na chemotherapie bij kanker, bij hiv en aids en na een beenmerg transplantatie. Werkt snel.', 'Vermoeidheid. Dit kan komen door bloedarmoede of zelden door een te lage bloedsuiker.', '356.00', 1),
(3, 'Tacrolimus', 'Tacrolimus onderdrukt de lichaamseigen afweer tegen vreemde cellen.\r\nOm afstoting na orgaan transplantatie te voorkomen.', 'Behalve het gewenste effect kan dit medicijn bijwerkingen geven. Veel bijwerkingen zijn in eerste instantie alleen in het bloed te meten. Pas later krijgt u er ook klachten van. Om deze klachten te voorkomen zal uw arts uw bloed regelmatig controleren op aanwijzingen voor bijwerkingen.', '2342.50', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `name`) VALUES
(1, 'medewerker1', '[\"ROLE_MEDEWERKER\"]', '$argon2i$v=19$m=65536,t=4,p=1$UUJZTHBHY0Z6YTB0YlBDdw$a3fAA9sVWZ5B4zisMjA83auGmCSV5MLK7jEMSaerDfs', 'Maaike van der Poel');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `medicijn`
--
ALTER TABLE `medicijn`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `medicijn`
--
ALTER TABLE `medicijn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
