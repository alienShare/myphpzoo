-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 28 août 2022 à 18:06
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbanimaux`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `animal_nom` varchar(250) NOT NULL,
  `animal_description` varchar(250) NOT NULL,
  `animal_image` varchar(250) NOT NULL,
  `famille_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_nom`, `animal_description`, `animal_image`, `famille_id`) VALUES
(1, 'chien', 'animal domestique', 'chien.png', 1),
(2, 'cochon', 'animal de la ferme', 'cochon.png', 1),
(3, 'serpent', 'animal dangereux', 'serpent.png', 2),
(4, 'crocodile', 'animal des marais', 'croco.png', 2),
(5, 'requin', 'animal mangeur d\'hommes', 'requin.png', 3);

-- --------------------------------------------------------

--
-- Structure de la table `animal_continent`
--

CREATE TABLE `animal_continent` (
  `animal_id` int(11) NOT NULL,
  `continent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `animal_continent`
--

INSERT INTO `animal_continent` (`animal_id`, `continent_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 5),
(3, 1),
(3, 3),
(3, 4),
(4, 3),
(4, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `continent`
--

CREATE TABLE `continent` (
  `continent_id` int(11) NOT NULL,
  `continent_libelle` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `continent`
--

INSERT INTO `continent` (`continent_id`, `continent_libelle`) VALUES
(1, 'Europe'),
(2, 'Asie'),
(3, 'Afrique'),
(4, 'Océanie'),
(5, 'Amérique');

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE `famille` (
  `famille_id` int(11) NOT NULL,
  `famille_libelle` varchar(250) NOT NULL,
  `famille_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`famille_id`, `famille_libelle`, `famille_description`) VALUES
(1, 'mammifère', 'animaux vertébrés nourrissant leurs petits avec du lait'),
(2, 'reptiles', 'animaux vertébrés qui rampent'),
(3, 'poissons', 'animaux invertébrés du monde aquatique');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `FK_ANIMAL_FAMILLE` (`famille_id`);

--
-- Index pour la table `animal_continent`
--
ALTER TABLE `animal_continent`
  ADD PRIMARY KEY (`animal_id`,`continent_id`),
  ADD KEY `FK_CONTINENT_ANIMAL_CONTINENT` (`continent_id`);

--
-- Index pour la table `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`continent_id`);

--
-- Index pour la table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`famille_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `continent`
--
ALTER TABLE `continent`
  MODIFY `continent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `famille`
--
ALTER TABLE `famille`
  MODIFY `famille_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `FK_ANIMAL_FAMILLE` FOREIGN KEY (`famille_id`) REFERENCES `famille` (`famille_id`);

--
-- Contraintes pour la table `animal_continent`
--
ALTER TABLE `animal_continent`
  ADD CONSTRAINT `FK_ANIMAL_ANIMAL_CONTINENT` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `FK_CONTINENT_ANIMAL_CONTINENT` FOREIGN KEY (`continent_id`) REFERENCES `continent` (`continent_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
