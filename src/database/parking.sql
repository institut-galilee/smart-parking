-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 07 mai 2019 à 04:16
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `parking`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

CREATE TABLE `bookings` (
  `id_booking` int(11) NOT NULL,
  `vehicleno` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_parkingspot` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '1',
  `startTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hour` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`id_booking`, `vehicleno`, `id_user`, `id_parkingspot`, `paid`, `startTime`, `hour`) VALUES
(1, '12-1336B', 12, 27, 1, '2019-05-03 11:33:32', 6),
(2, '121212', 1, 23, 1, '2019-05-05 14:25:14', 1),
(3, '133344', 1, 22, 1, '2019-05-05 14:34:48', 2),
(4, '123456', 1, 22, 1, '2019-05-05 14:48:20', 1),
(5, '123456', 1, 22, 1, '2019-05-05 14:50:41', 3),
(6, '166778', 1, 23, 1, '2019-05-05 14:51:57', 4),
(7, '122114', 1, 15, 1, '2019-05-06 23:02:15', 1),
(8, '122114', 1, 23, 1, '2019-05-06 23:02:23', 1),
(9, '122114', 1, 25, 1, '2019-05-06 23:02:30', 1),
(10, '122114', 1, 25, 1, '2019-05-06 23:03:12', 3),
(11, '122114', 1, 25, 1, '2019-05-06 23:03:13', 3),
(12, '122114', 1, 25, 1, '2019-05-06 23:03:14', 3),
(13, '122114', 1, 25, 1, '2019-05-06 23:03:14', 3),
(14, '122123', 1, 17, 1, '2019-05-06 23:04:28', 1),
(15, '122123', 1, 16, 1, '2019-05-06 23:04:44', 1),
(16, '122123', 1, 15, 1, '2019-05-06 23:05:07', 1),
(17, '122123', 1, 17, 1, '2019-05-06 23:09:56', 1),
(18, '122123', 1, 18, 1, '2019-05-06 23:10:28', 4),
(19, '112334', 1, 19, 1, '2019-05-06 23:12:05', 3),
(20, '112334', 1, 20, 1, '2019-05-06 23:12:24', 2),
(21, '121323', 1, 18, 1, '2019-05-06 23:13:56', 1),
(22, '121323', 1, 17, 1, '2019-05-06 23:14:06', 1),
(23, '2133', 1, 18, 1, '2019-05-06 23:20:54', 1),
(24, '2133', 1, 17, 1, '2019-05-06 23:21:11', 1),
(25, '12331324', 1, 16, 1, '2019-05-06 23:28:59', 1),
(26, '12331324', 1, 18, 1, '2019-05-06 23:29:09', 1);

-- --------------------------------------------------------

--
-- Structure de la table `parkinglots`
--

CREATE TABLE `parkinglots` (
  `id_parkinglot` int(11) NOT NULL,
  `parknom` varchar(255) NOT NULL,
  `etat` tinyint(4) NOT NULL,
  `available` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `addresse` varchar(255) NOT NULL,
  `zipcode` bigint(20) NOT NULL DEFAULT '97201',
  `cost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `parkinglots`
--

INSERT INTO `parkinglots` (`id_parkinglot`, `parknom`, `etat`, `available`, `capacity`, `latitude`, `longitude`, `addresse`, `zipcode`, `cost`) VALUES
(27, 'paris13', 1, 0, 12, 48.956210099712, 2.341461181640625, 'UVilletaneuse, France', 93430, 0),
(25, 'bla', 1, 12, 12, 19.9393, 12.9444, 'BLA', 5100, 12);

-- --------------------------------------------------------

--
-- Structure de la table `parkingspots`
--

CREATE TABLE `parkingspots` (
  `id_parkingspot` int(11) NOT NULL,
  `parkingspotname` varchar(50) DEFAULT NULL,
  `id_parkinglot` int(11) NOT NULL,
  `etat` tinyint(4) DEFAULT NULL,
  `fromtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `totime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `parkingspots`
--

INSERT INTO `parkingspots` (`id_parkingspot`, `parkingspotname`, `id_parkinglot`, `etat`, `fromtime`, `totime`) VALUES
(1, 'A1', 5, 0, '2015-07-25 09:08:00', '2015-07-25 09:08:00'),
(2, 'A2', 5, 0, '2015-07-25 09:08:00', '2015-07-25 09:08:00'),
(15, 'slot1', 27, 1, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(16, 'slot2', 27, 2, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(17, 'slot3', 27, 2, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(18, 'slot4', 27, 2, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(19, 'slot5', 27, 2, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(20, 'slot6', 27, 2, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(21, 'slot7', 27, 0, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(22, 'slot8', 27, 0, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(23, 'slot9', 27, 0, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(24, 'slot10', 27, 0, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(25, 'slot11', 27, 0, '2019-05-02 19:47:28', '2019-05-02 19:47:28'),
(26, 'slot12', 27, 0, '2019-05-02 19:47:28', '2019-05-02 19:47:28');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id_booking`);

--
-- Index pour la table `parkinglots`
--
ALTER TABLE `parkinglots`
  ADD PRIMARY KEY (`id_parkinglot`);

--
-- Index pour la table `parkingspots`
--
ALTER TABLE `parkingspots`
  ADD PRIMARY KEY (`id_parkingspot`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `parkinglots`
--
ALTER TABLE `parkinglots`
  MODIFY `id_parkinglot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `parkingspots`
--
ALTER TABLE `parkingspots`
  MODIFY `id_parkingspot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
