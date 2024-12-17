-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 déc. 2024 à 08:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `afaj`
--

-- --------------------------------------------------------

--
-- Structure de la table `collecte`
--

DROP TABLE IF EXISTS `collecte`;
CREATE TABLE IF NOT EXISTS `collecte` (
  `Id_collecte` int NOT NULL AUTO_INCREMENT,
  `ville` int NOT NULL,
  `adresse` int NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `couleur` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_collecte`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `Id_Evenement` int NOT NULL AUTO_INCREMENT,
  `adresse` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_Evenement`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`Id_Evenement`, `adresse`, `dateDebut`, `dateFin`, `nom`) VALUES
(1, '1 Rue du Lolo', '2024-12-21 10:30:00', '2024-12-21 18:00:00', 'Les super poupe');

-- --------------------------------------------------------

--
-- Structure de la table `evenementtype`
--

DROP TABLE IF EXISTS `evenementtype`;
CREATE TABLE IF NOT EXISTS `evenementtype` (
  `Id_Evenement` int NOT NULL,
  `Id_JouerType` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenementtype`
--

INSERT INTO `evenementtype` (`Id_Evenement`, `Id_JouerType`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `jouertype`
--

DROP TABLE IF EXISTS `jouertype`;
CREATE TABLE IF NOT EXISTS `jouertype` (
  `Id_JouerType` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_JouerType`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jouertype`
--

INSERT INTO `jouertype` (`Id_JouerType`, `nom`) VALUES
(1, 'aux tries / réparation des poupées'),
(2, 'aux tries / réparation des jeux de sociétés'),
(3, 'aux tries / réparation des livres'),
(4, 'aux tries / réparation des peluches');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `Id_membre` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`Id_membre`, `nom`, `prenom`, `email`, `mdp`, `dateNaissance`, `tel`) VALUES
(1, 'Escuder', 'Eloise', 'eloise.escuder@gmail.com', '$2y$10$7xIslWNt6q0x8GydJT2CjuQNwTsLx0NQEH/iflSwYPngZbjk6c6LC', '2005-12-01', ''),
(2, 'escuder', 'emilie', 'emilie.escuder@gmail.com', '$2y$10$2NsVj5SEIP5XKltB7M0a4.58qKhnrNSO.sr1uKpW.wnssqKXm5woy', '2005-02-01', '0661144114');

-- --------------------------------------------------------

--
-- Structure de la table `membredroit`
--

DROP TABLE IF EXISTS `membredroit`;
CREATE TABLE IF NOT EXISTS `membredroit` (
  `Id_Membre` int NOT NULL,
  `Id_JouerType` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membredroit`
--

INSERT INTO `membredroit` (`Id_Membre`, `Id_JouerType`) VALUES
(26, 2),
(26, 3),
(26, 4),
(26, 1),
(27, 2),
(28, 2),
(28, 3),
(28, 4),
(28, 1),
(29, 2),
(29, 3),
(29, 4),
(29, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 1),
(16, 2),
(16, 3),
(16, 4),
(16, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 1),
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membretype`
--

DROP TABLE IF EXISTS `membretype`;
CREATE TABLE IF NOT EXISTS `membretype` (
  `Id_MembreType` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_MembreType`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membretype`
--

INSERT INTO `membretype` (`Id_MembreType`, `nom`) VALUES
(1, 'admin'),
(2, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `mt`
--

DROP TABLE IF EXISTS `mt`;
CREATE TABLE IF NOT EXISTS `mt` (
  `Id_membre` int NOT NULL,
  `Id_membreType` int NOT NULL,
  UNIQUE KEY `Id_membre` (`Id_membre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mt`
--

INSERT INTO `mt` (`Id_membre`, `Id_membreType`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `Id_Vente` int NOT NULL AUTO_INCREMENT,
  `DateDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `HoraireDebut` int NOT NULL,
  `HoraireFin` int NOT NULL,
  `Lieux` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_Vente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
