-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 25 Avril 2014 à 16:11
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `planeteqcm`
--

CREATE TABLE IF NOT EXISTS `planeteqcm` (
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `score` varchar(255) NOT NULL DEFAULT '1',
  `connecte` varchar(5) NOT NULL DEFAULT 'false',
  `privilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `planeteqcm`
--

INSERT INTO `planeteqcm` (`pseudo`, `mdp`, `email`, `score`, `connecte`, `privilege`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@planete-qcm.fr', '0', 'true', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
