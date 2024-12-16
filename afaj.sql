-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 16 déc. 2024 à 15:21
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`Id_membre`, `nom`, `prenom`, `email`, `mdp`, `dateNaissance`, `tel`) VALUES
(1, 'Escuder', 'Eloise', 'eloise.escuder@gmail.com', '$2y$10$7xIslWNt6q0x8GydJT2CjuQNwTsLx0NQEH/iflSwYPngZbjk6c6LC', '2005-12-01', ''),
(2, 'escuder', 'emilie', 'emilie.escuder@gmail.com', '$2y$10$2NsVj5SEIP5XKltB7M0a4.58qKhnrNSO.sr1uKpW.wnssqKXm5woy', '2005-02-01', '0661144114'),
(3, 'Escuder', 'Eloïse', 'eloise.escuder@gmail.com', '$2y$10$s/jvx0p7nTFNWYHFqW0iFemEmJ7RxkUwWCma8R6At1VAznc7QSIbO', '1996-02-07', '0661451067'),
(4, 'Escuder', 'Eloïse', 'eloise.escuder@gmail.com', '$2y$10$Z4mbdlsz9CTqDmy8WqPumOQICQuK4IGQ92sfrMi9Olt9g11IKPHzG', '2002-02-13', '0661451067'),
(5, 'Escuder', 'Eloïse', 'eloise.escuder@gmail.com', '$2y$10$iX5j8lquXokfXS/sme8cGu.sliLXTK9jIStv.9.NsfYJX3rmKv8S.', '2002-02-13', '0661451067'),
(6, 'Escuder', 'Eloïse', 'eloise.escuder@gmail.com', '$2y$10$RFa8L4JYeu9TlqlPJeVreeger32Jrx62TF.xkxsEdVLIKHEdUZ0ny', '2002-02-13', '0661451067'),
(7, 'Escuder', 'Eloïse', 'eloise.escuder@gmail.com', '$2y$10$7Nlv8/1EP4SB1M5a3xhdhO1Q8VGJS2BdvOpOesAbc.J2/VyDGAUay', '1996-01-18', '0661451067'),
(8, 'Escuder', 'Eloïse', 'eloise.escuder@gmail.com', '$2y$10$q1B.J1w5NKfduigYE9WzLufq11BtK1P2kmHFvOCEjPzxpEqh9B2m6', '2002-02-06', '0661451067'),
(9, 'Escuder', 'Eloïse', 'eloise.escuder@gmail.com', '$2y$10$Van1mpx1Y4ASknRcOJVbFOhtpjQ4z2IEAdgC3PeW3NoaMYUc1AbPa', '1993-02-10', '0661451067'),
(10, 'Escuder', 'Eloïse', 'eloise.escuder@gmail.com', '$2y$10$4eXfgnpMAkzPDyGvYKhi7.A1sMGHxh07mj/PnUzqfpEIrIPjWlpVm', '2000-02-02', '0661451067'),
(11, 'escuder', 'emilie', 'emilie.email@gmail.com', '$2y$10$QaJPHuSDr19ZY77BE4NWPOsvJvMxTkz1aPAbx57kyllshYu9jqe2O', '2005-02-01', '0661144114'),
(12, 'escuder', 'emilie', 'emilie.email@gmail.com', '$2y$10$WBcna3cADWoE7/oCtpoiM.unyAK1oVI7AkZucywEUEluIT8O8hEGu', '2005-02-01', '0661144114'),
(13, 'moi', 'moi', 'moi.moi@gmail.com', '$2y$10$pOHzJPeRmcKUmk7nrOWOLuPZnu.xir8o/8tdVmY1fXXvbIaOAiuhq', '2004-01-27', '0666666666');

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
(13, 1);
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

--
-- Déchargement des données de la table `mt`
--

INSERT INTO `mt` (`Id_membre`, `Id_membreType`) VALUES
(1, 1),
(2, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
