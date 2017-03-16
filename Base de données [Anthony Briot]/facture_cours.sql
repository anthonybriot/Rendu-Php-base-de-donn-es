-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 16 Mars 2017 à 20:00
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `facture_cours`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `NumClient` int(11) NOT NULL,
  `NomClient` varchar(255) NOT NULL,
  `PrenomClient` varchar(255) NOT NULL,
  `AdresseClient` varchar(255) NOT NULL,
  `Cp` varchar(255) NOT NULL,
  `VilleClient` varchar(255) NOT NULL,
  `PaysClient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`NumClient`, `NomClient`, `PrenomClient`, `AdresseClient`, `Cp`, `VilleClient`, `PaysClient`) VALUES
(1, 'Lehmann', 'Nicolas', '12 a rue du sylvaner', '68980', 'Beblenheim', 'France'),
(2, 'toto', 'titi', 'rue de tata', '67000', 'Strasbourg', 'France'),
(3, 'ff', 'tt', '12 rue du toto', '67000', 'Strasbourg', 'France'),
(4, 'gg', 'yy', 'ee', '67000', 'Strasbourg', 'France'),
(5, 'dfsfs', 'fds', 'fds', '55000', 'fds', 'fds'),
(6, 'gdf', 'dsf', 'fdsfsd', '89000', 'dsf', 'fds'),
(7, 'ou', 'pa', 'la', 'la', 'la', 'la');

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `pseudo` char(12) NOT NULL,
  `password` char(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `connexion`
--

INSERT INTO `connexion` (`pseudo`, `password`, `id`) VALUES
('moi', '$2y$10$cHVzO6Xedrr/7ebz27Bt4ONvHfFL8p8yTgBwSTJ8zsxeVIptmH2LG', 1),
('toi', '$2y$10$BIQ3mvTeCN6UiilQNjJWM.AtE44TWBXj1i1XTb32Jj3wiFSUM6LwC', 1),
('anthony', '$2y$10$QFZZ2.EfA9dUNNfTdBdv1Osm/wA0AwFXv4W8fjgixU3qTwHBXlOdq', 1),
('lebarbu', '$2y$10$iUFYe5xNzkwetaeqUetdkuW2ySpbtGdak2138A1O1N1Bzn003sL6q', 1),
('ephi', '$2y$10$AsaiUBSA8x4jsaCrTKR5xuXuDNgt4U4C1ZIbtXKRk4/U/LJbSp3wm', 1);

-- --------------------------------------------------------

--
-- Structure de la table `d_facture`
--

CREATE TABLE `d_facture` (
  `Qte` int(11) NOT NULL,
  `NumFacture` int(11) NOT NULL,
  `NumProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `d_facture`
--

INSERT INTO `d_facture` (`Qte`, `NumFacture`, `NumProduit`) VALUES
(15, 3, 6),
(30, 3, 7),
(50, 3, 8);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `NumFacture` int(11) NOT NULL,
  `DateFacture` date NOT NULL,
  `NumClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`NumFacture`, `DateFacture`, `NumClient`) VALUES
(3, '2017-01-05', 5),
(5, '2017-03-23', 2),
(6, '2016-12-21', 4),
(7, '2017-03-23', 1),
(8, '2016-12-21', 7);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `NumProduit` int(11) NOT NULL,
  `Des` varchar(255) NOT NULL,
  `PUHT` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`NumProduit`, `Des`, `PUHT`) VALUES
(5, 'Ecran 4k', 499.99),
(6, 'Ram', 100),
(7, 'Gpu', 200),
(8, 'clavier', 40),
(13, 'la fesse', 1234);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`NumClient`);

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`pseudo`,`id`);

--
-- Index pour la table `d_facture`
--
ALTER TABLE `d_facture`
  ADD PRIMARY KEY (`NumFacture`,`NumProduit`),
  ADD KEY `NumFacture` (`NumFacture`),
  ADD KEY `NumProduit` (`NumProduit`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`NumFacture`),
  ADD KEY `NumClient` (`NumClient`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`NumProduit`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `NumClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `NumFacture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `NumProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `d_facture`
--
ALTER TABLE `d_facture`
  ADD CONSTRAINT `d_facture_ibfk_1` FOREIGN KEY (`NumFacture`) REFERENCES `facture` (`NumFacture`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_facture_ibfk_2` FOREIGN KEY (`NumProduit`) REFERENCES `produits` (`NumProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`NumClient`) REFERENCES `client` (`NumClient`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
