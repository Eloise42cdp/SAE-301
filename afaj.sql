-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 déc. 2024 à 10:07
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
  `lagitude` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
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
  `dateDebut` int NOT NULL,
  `dateFin` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_Evenement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenementtype`
--

DROP TABLE IF EXISTS `evenementtype`;
CREATE TABLE IF NOT EXISTS `evenementtype` (
  `Id_Evenement` int NOT NULL,
  `Id_JouerType` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jouertype`
--

DROP TABLE IF EXISTS `jouertype`;
CREATE TABLE IF NOT EXISTS `jouertype` (
  `Id_JouerType` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_JouerType`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  PRIMARY KEY (`Id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`Id_membre`, `nom`, `prenom`, `email`, `mdp`, `dateNaissance`) VALUES
(1, 'Escuder', 'Eloise', 'eloise.escuder@gmail.com', '$2y$10$7xIslWNt6q0x8GydJT2CjuQNwTsLx0NQEH/iflSwYPngZbjk6c6LC', '2005-12-01');

-- --------------------------------------------------------

--
-- Structure de la table `membredroit`
--

DROP TABLE IF EXISTS `membredroit`;
CREATE TABLE IF NOT EXISTS `membredroit` (
  `Id_Membre` int NOT NULL,
  `Id_JouerType` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membretype`
--

DROP TABLE IF EXISTS `membretype`;
CREATE TABLE IF NOT EXISTS `membretype` (
  `Id_MembreType` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_MembreType`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mt`
--

DROP TABLE IF EXISTS `mt`;
CREATE TABLE IF NOT EXISTS `mt` (
  `Id_membre` int NOT NULL,
  `Id_membreType` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
