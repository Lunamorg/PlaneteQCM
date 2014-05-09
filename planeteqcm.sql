-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 08 Mai 2014 à 15:24
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

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
  `connecte` varchar(5) NOT NULL DEFAULT 'false',
  `privilege` int(11) NOT NULL,
  `qcm` int(11) NOT NULL,
  `bonreponse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `planeteqcm`
--

INSERT INTO `planeteqcm` (`pseudo`, `mdp`, `email`, `connecte`, `privilege`, `qcm`, `bonreponse`) VALUES
('kailas', '644b1766577d4fadc0ab94ef67dbd6ca', 'kailas3476@gmail.com', 'false', 0, 0, 0),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@planeteqcm.fr', 'false', 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
