-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 08 nov. 2021 à 10:26
-- Version du serveur : 10.6.4-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `links`
--

-- --------------------------------------------------------

--
-- Structure de la table `prefix_link`
--

CREATE TABLE `prefix_link` (
  `id` int(10) UNSIGNED NOT NULL,
  `href` varchar(150) COLLATE utf8mb3_bin NOT NULL,
  `title` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `target` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `name` varchar(100) COLLATE utf8mb3_bin NOT NULL,
  `user_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `prefix_link`
--

INSERT INTO `prefix_link` (`id`, `href`, `title`, `target`, `name`, `user_fk`) VALUES
(1, 'https://discord.com/channels/764389321947086858/875310065622597652', 'lien', '_blank', 'lien', 7),
(6, 'https://www.youtube.com/channel/UCsFoQ4A9CZbF3qag317uZZQ', 'Pierre Giraud', '_blank', 'Playlist Pierre Giraud', 2),
(7, 'https://www.youtube.com/c/grafikart', 'vidéo Grafikart', '_blank', 'Grafikart', 7),
(8, 'https://www.youtube.com/c/grafikart', 'grafikart', '_blank', 'Grafikart', 7),
(9, 'https://www.youtube.com/c/grafikart', 'vidéo Grafikart', '_blank', 'Grafikart', 7),
(10, 'https://www.youtube.com/c/grafikart', 'Grafikart', '_blank', 'Grafikart', 2),
(11, 'https://foutucode.fr/', 'humour dev', '_blank', 'humour dev', 2),
(13, 'https://codepen.io/trending', 'dev +++', '_blank', 'dev++', 7),
(14, 'https://www.youtube.com/watch?v=vYV-XJdzupY&list=RDdkx64SkmP6Q&index=6', 'Stereopony', '_blank', 'Steropony', 2),
(15, 'https://www.youtube.com/watch?v=nJ6A6GC_ki4', ' Asian Kung-Fu Generation', '_blank', ' Asian Kung-Fu Generation', 2),
(16, 'https://www.youtube.com/watch?v=Os_i8CZRdN0&list=OLAK5uy_na7KSvbQ_hHd2DMIy0MmKPucwBr7ONFJE', 'The Showdown', '_blank', 'The Showdown', 2),
(17, 'https://www.youtube.com/watch?v=7iNbnineUCI', 'The Offspring', '_blank', 'The Offspring', 2),
(18, 'https://www.youtube.com/watch?v=7iNbnineUCI', 'The Offspring', '_blank', 'The Offspring', 7),
(19, 'https://www.youtube.com/watch?v=YIqbdnaPcT8&list=RDGMEMJQXQAmqrnmK1SEjY_rKBGA&start_radio=1&rv=7iNbnineUCI', 'Mudvayne', '_blank', 'Mudvayne', 2),
(20, 'https://www.youtube.com/watch?v=YIqbdnaPcT8&list=RDGMEMJQXQAmqrnmK1SEjY_rKBGA&start_radio=1&rv=7iNbnineUCI', 'Mudvayne', '_blank', 'Mudvayne', 7),
(21, 'https://www.youtube.com/watch?v=YIqbdnaPcT8&list=RDGMEMJQXQAmqrnmK1SEjY_rKBGA&start_radio=1&rv=7iNbnineUCI', 'Mudvayne', '_blank', 'Mudvayne', 7),
(22, 'https://www.youtube.com/watch?v=1V4AscLidWg&list=RDEM9VJO2EAK2Dznx4RxBs0yLQ&index=8', 'HIM', '_blank', 'HIM', 2),
(23, 'https://www.youtube.com/watch?v=XFkzRNyygfk&list=RDEMk8jEIzOyB2trfXZrSEVz_Q&start_radio=1', 'RadioHead', '_blank', 'RadioHead', 2),
(24, 'https://www.youtube.com/watch?v=XFkzRNyygfk&list=RDEMk8jEIzOyB2trfXZrSEVz_Q&start_radio=1', 'RadioHead', '_blank', 'RadioHead', 7);

-- --------------------------------------------------------

--
-- Structure de la table `prefix_user`
--

CREATE TABLE `prefix_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(40) COLLATE utf8mb3_bin NOT NULL,
  `prenom` varchar(40) COLLATE utf8mb3_bin NOT NULL,
  `mail` varchar(100) COLLATE utf8mb3_bin NOT NULL,
  `pass` varchar(250) COLLATE utf8mb3_bin NOT NULL,
  `role_fk` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `prefix_user`
--

INSERT INTO `prefix_user` (`id`, `nom`, `prenom`, `mail`, `pass`, `role_fk`) VALUES
(2, 'Elogeek', 'Elo', 'elo@gmail.com', '$2y$10$IATrUVPaIn.dokrYuBndSu9YVG7yNLGrU6hfmbmlRgb/RpMXvN6ji', 1),
(7, 'Nezuko', 'Bubulle', 'bunez@gmail.com', '$2y$10$u3xafd/01U2fJ4f608qTkOdlRy3shZZIpPmmbO.T.P/CvrCuk78Xy', 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `prefix_link`
--
ALTER TABLE `prefix_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk` (`user_fk`);

--
-- Index pour la table `prefix_user`
--
ALTER TABLE `prefix_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail_UNIQUE` (`mail`),
  ADD KEY `role_fk` (`role_fk`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `prefix_link`
--
ALTER TABLE `prefix_link`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `prefix_user`
--
ALTER TABLE `prefix_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `prefix_link`
--
ALTER TABLE `prefix_link`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_fk`) REFERENCES `prefix_user` (`id`);

--
-- Contraintes pour la table `prefix_user`
--
ALTER TABLE `prefix_user`
  ADD CONSTRAINT `role_fk` FOREIGN KEY (`role_fk`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
