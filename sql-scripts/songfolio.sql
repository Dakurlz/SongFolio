-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  sam. 04 mai 2019 à 23:42
-- Version du serveur :  5.7.25
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `songfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `Albums`
--

CREATE TABLE `Albums` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `slug` int(11) NOT NULL,
  `date_published` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cover` varchar(255) NOT NULL,
  `deezer` varchar(100) DEFAULT NULL,
  `spotify` varchar(100) DEFAULT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

CREATE TABLE `Categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Categories`
--

INSERT INTO `Categories` (`id`, `name`, `slug`, `type`) VALUES
(3, 'test', NULL, ''),
(34, 'xcvcxvxcv update', NULL, 'album'),
(36, 'dsffgh', NULL, 'album'),
(41, 'xcvxv', 'xcvxcv', 'article'),
(42, 'xcvxvsdf update ', 'xcvxcvsdf update ', 'article');

-- --------------------------------------------------------

--
-- Structure de la table `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  `confirm` tinyint(1) NOT NULL,
  `message` longtext CHARACTER SET utf8 NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `like` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Comments`
--

INSERT INTO `Comments` (`id`, `user`, `typeId`, `confirm`, `message`, `date_created`, `like`, `type`) VALUES
(1, 1, 19, 0, 'un comment ', '2019-05-04 23:16:43', 0, 'article');

-- --------------------------------------------------------

--
-- Structure de la table `Contents`
--

CREATE TABLE `Contents` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `slug` text NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `content` varchar(600) NOT NULL,
  `header` varchar(150) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL,
  `img_dir` text,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Contents`
--

INSERT INTO `Contents` (`id`, `type`, `slug`, `cat_id`, `title`, `description`, `content`, `header`, `date_create`, `date_edit`, `author`, `img_dir`, `published`) VALUES
(17, 'page', '/blog', NULL, 'Blog', 'sdf', '<p>sdfsdf</p>', '', '2019-05-04 21:36:36', NULL, 1, 'Format n\'est pas bon.', 1),
(18, 'page', '//sdf update', NULL, 'des', 'dddf', '<p>sdfsdf</p>', '', '2019-05-04 21:48:19', '2019-05-04 22:22:54', 1, 'Format n\'est pas bon.', 0),
(19, 'article', '//sdf', NULL, 'COomment faire se b', 'sdf', '<p>qsdqsdqsd<strong> qsdqs d</strong></p>', '', '2019-05-04 22:34:32', '2019-05-04 22:39:32', 1, 'Format n\'est pas bon.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Groups`
--

CREATE TABLE `Groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Lyrics`
--

CREATE TABLE `Lyrics` (
  `id` int(11) NOT NULL,
  `date_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Menus`
--

CREATE TABLE `Menus` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `data` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Menus`
--

INSERT INTO `Menus` (`id`, `title`, `data`) VALUES
(2, 'Main Menu', '[{\"link\": \"http://3\", \"title\": \"SEO\"}, {\"link\": \"http://2\", \"title\": \"Support\"}, {\"link\": \"http://1\", \"title\": \"Index\"}, {\"link\": \"http://6\", \"title\": \"Contact\", \"children\": [{\"link\": \"http://5\", \"title\": \"Services\", \"children\": [{\"link\": \"http://4\", \"title\": \"Portfoion\"}]}]}, {\"link\": \"http://3\", \"title\": \"About Us\"}, {\"link\": \"http://1\", \"title\": \"Design\"}, {\"link\": \"http://5\", \"title\": \"Develope\"}]'),
(3, 'Main Menu 2', '[{\"link\": \"http://5\", \"title\": \"Services\", \"children\": [{\"link\": \"http://1\", \"title\": \"Design\"}, {\"link\": \"http://5\", \"title\": \"Develope\"}, {\"link\": \"http://3\", \"title\": \"SEO\"}, {\"link\": \"http://3\", \"title\": \"About Us\"}, {\"link\": \"http://4\", \"title\": \"Portfoion\"}, {\"link\": \"http://2\", \"title\": \"Support\", \"children\": [{\"link\": \"http://6\", \"title\": \"Contact\"}]}]}, {\"link\": \"http://1\", \"title\": \"Index\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `Permissions`
--

CREATE TABLE `Permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Settings`
--

CREATE TABLE `Settings` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `value` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Slugs`
--

CREATE TABLE `Slugs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Songs`
--

CREATE TABLE `Songs` (
  `id` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `slug` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `visual` varchar(255) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(60) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `password`, `date_inserted`, `role`, `status`, `date_update`) VALUES
(1, 'Vexyos', '', '$2y$10$MyXBMxoUW8N/xUxoEQccfu5u8NuSnqxqg.T9C2bRoQmsGrpB62uIS', '2019-01-25 14:04:13', '0', 1, NULL),
(2, 'Vexyos', 'test@oot.fr', '$2y$10$uSCMkSR2CIyZxHuUi5og3OSX4Ayg7VTrKZ86UrJvxNpmREpeITw2W', '2019-01-25 14:04:37', '0', 1, NULL),
(3, 'Vexyos', 'test@oot.fr', '$2y$10$kbRUmCg.UO1/BjOPkz7twePermPri0y4MP4haPgy/dhThK151foPa', '2019-01-25 14:05:51', '0', 1, NULL),
(4, 'Vexyos', 'test@oot.fr', '$2y$10$HkSkTRRfl1qgnMYHRLJCOuUEMYz56dCepODayE76JqFhpLOj7KQBu', '2019-01-25 14:06:07', '0', 1, NULL),
(5, 'Vexyos', 'test@oot.fr', '$2y$10$u7ibfbwdjbbi7B5AEtHrQOMnmWVZGcrHu117tu94KE4BpprLkpuDy', '2019-01-25 14:07:09', '0', 1, NULL),
(6, 'Test', 'test@test.fr', '$2y$10$q3Jtbc5l9CXt.9GjI8Ix0OFeAfEVj..X.fwYU4U0b4jRGnnZrVIUS', '2019-01-25 14:11:06', '0', 1, NULL),
(7, 'Admin', 'test@hotmail.fr', '$2y$10$YcKTtIrDC.gnUMG6Vd0DG.VHSeErl9hHNJWL95GapzpzYWj8b07YK', '2019-04-01 08:26:33', 'admin,composeur,chanteur,user,connu', 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Albums`
--
ALTER TABLE `Albums`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Contents`
--
ALTER TABLE `Contents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Groups`
--
ALTER TABLE `Groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Lyrics`
--
ALTER TABLE `Lyrics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Menus`
--
ALTER TABLE `Menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Settings`
--
ALTER TABLE `Settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Slugs`
--
ALTER TABLE `Slugs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Songs`
--
ALTER TABLE `Songs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Albums`
--
ALTER TABLE `Albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Contents`
--
ALTER TABLE `Contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `Groups`
--
ALTER TABLE `Groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Lyrics`
--
ALTER TABLE `Lyrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Menus`
--
ALTER TABLE `Menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Settings`
--
ALTER TABLE `Settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Slugs`
--
ALTER TABLE `Slugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
