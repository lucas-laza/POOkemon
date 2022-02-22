-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 22 fév. 2022 à 18:13
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pookemongit`
--

-- --------------------------------------------------------

--
-- Structure de la table `attaques`
--

CREATE TABLE `attaques` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `elem` int(11) NOT NULL,
  `puissance` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `attaques`
--

INSERT INTO `attaques` (`id`, `name`, `type`, `elem`, `puissance`) VALUES
(1, 'Boule de feu', 1, 3, 65),
(2, 'Grosse graine', 0, 1, 45),
(3, 'Crachat d\'eau', 1, 2, 30),
(4, 'Rocher pointu', 0, 4, 70),
(5, 'Pierre qui roule', 1, 4, 40),
(6, '\"Le sol y bouge bcp\"', 0, 5, 70),
(7, 'zapy', 1, 6, 45),
(8, 'atchoum', 1, 7, 40);

-- --------------------------------------------------------

--
-- Structure de la table `elems`
--

CREATE TABLE `elems` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `dmg_e1` decimal(2,1) NOT NULL DEFAULT 1.0,
  `dmg_e2` decimal(2,1) NOT NULL DEFAULT 1.0,
  `dmg_e3` decimal(2,1) NOT NULL DEFAULT 1.0,
  `dmg_e4` decimal(2,1) NOT NULL DEFAULT 1.0,
  `dmg_e5` decimal(2,1) NOT NULL DEFAULT 1.0,
  `dmg_e6` decimal(2,1) NOT NULL DEFAULT 1.0,
  `dmg_e7` decimal(2,1) NOT NULL DEFAULT 1.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `elems`
--

INSERT INTO `elems` (`id`, `name`, `dmg_e1`, `dmg_e2`, `dmg_e3`, `dmg_e4`, `dmg_e5`, `dmg_e6`, `dmg_e7`) VALUES
(1, 'Plante', '1.0', '2.0', '0.5', '2.0', '2.0', '1.0', '0.5'),
(2, 'Eau', '0.5', '0.5', '2.0', '2.0', '2.0', '1.0', '1.0'),
(3, 'Feu', '2.0', '0.5', '0.5', '0.5', '0.5', '1.0', '2.0'),
(4, 'Roche', '0.5', '1.0', '2.0', '1.0', '0.5', '1.0', '2.0'),
(5, 'Sol', '0.5', '1.0', '2.0', '2.0', '1.0', '2.0', '1.0'),
(6, 'Electrik', '1.0', '2.0', '0.5', '1.0', '0.0', '0.5', '1.0'),
(7, 'Glace', '2.0', '1.0', '0.5', '1.0', '2.0', '1.0', '0.5');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`login`, `mdp`) VALUES
('admin', '$2y$10$xXmpcgBP.S8duZ08NW/97.Tu3/134X1yraRIvt37WQnA7pR2NdUMK');

-- --------------------------------------------------------

--
-- Structure de la table `personnages`
--

CREATE TABLE `personnages` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `elem` int(11) NOT NULL,
  `pvmax` int(11) NOT NULL,
  `atk` int(11) NOT NULL,
  `maj` int(11) NOT NULL,
  `arm` int(11) NOT NULL,
  `rmj` int(11) NOT NULL,
  `soin` int(11) NOT NULL,
  `vit` int(11) NOT NULL,
  `phrase` text NOT NULL,
  `img` tinyint(1) NOT NULL DEFAULT 0,
  `A1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `personnages`
--

INSERT INTO `personnages` (`id`, `name`, `elem`, `pvmax`, `atk`, `maj`, `arm`, `rmj`, `soin`, `vit`, `phrase`, `img`, `A1`) VALUES
(1, 'Bulbizarre', 1, 150, 20, 45, 30, 30, 35, 4, '\"Bulbiiiiii\"', 1, 2),
(2, 'Héricendre', 3, 100, 15, 55, 15, 40, 20, 7, '\"Héri héri\"', 1, 1),
(3, 'Gobou', 2, 175, 35, 10, 40, 35, 20, 3, '\"Gobouuu\"', 1, 6),
(6, 'Pikachu', 6, 80, 10, 70, 20, 50, 50, 9, '\"Pika pika\"', 0, 7),
(7, 'Givrali', 7, 125, 40, 50, 15, 15, 40, 5, '\".... glaçon\"', 0, 8),
(8, 'Racaillou', 4, 225, 35, 5, 35, 15, 20, 4, '\"CAILLOU\"', 0, 5),
(11, 'Sabelette', 5, 175, 30, 25, 25, 40, 15, 6, '\"mhhh\"', 0, 6),
(12, 'Kranidos', 4, 200, 50, 5, 35, 30, 10, 2, '\"Je suis un dino\"', 0, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attaques`
--
ALTER TABLE `attaques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `elems`
--
ALTER TABLE `elems`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnages`
--
ALTER TABLE `personnages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attaques`
--
ALTER TABLE `attaques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `elems`
--
ALTER TABLE `elems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personnages`
--
ALTER TABLE `personnages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
